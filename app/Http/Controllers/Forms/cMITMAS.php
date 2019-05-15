<?php
namespace App\Http\Controllers\Forms;

use App\Http\Controllers\cWeController; //as cWeController
use Illuminate\Http\Request;
use App\Models\MITMAS;
use DB;

class cMITMAS extends cWeController {

    private $GridObj = [];
    private $GridFilter = [];
    private $GridSort = [];
    private $GridColumns = [];

    public function LoadGrid(Request $request) {

        fnCrtColGrid($this->GridObj, "act", 1, 0, '', 'ACTION', 'Action', 50);
        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'MMITNOIY', 'IY', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'MMITNO', 'Code', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'MMITNM', 'Name', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'MMITDS', 'Description', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'MMREMK', 'Remark', 100, '', 100);
        fnCrtColGridDefault($this->GridObj, "MM");

        $this->GridFilter = [];
        $this->GridSort = [];
        $this->GridSort[] = array('name'=>'MMITNO','direction'=>'asc');
        $this->GridColumns = [];

        $MITMAS = MITMAS::noLock()
                ->where([
                    ['MMDLFG', '=', '0'],
                  ]);

        $MITMAS = fnQuerySearchAndPaginate($request, $MITMAS, 
                                           $this->GridObj, 
                                           $this->GridSort, 
                                           $this->GridFilter, 
                                           $this->GridColumns);

        $Hasil = array( "Data"=> $MITMAS,
                        "Column"=> $this->GridColumns,
                        "Sort"=> $this->GridSort,
                        "Filter"=> $this->GridFilter,
                        "Key"=> 'MMITNOIY');
        // dd($Hasil);
        return response()->jSon($Hasil);     

    }


    private $FormObj = [];

    public function FormObject(Request $request) {

        fnCrtObjTxt($this->FormObj, 0, "FF", "3", "Panel1", "MMITNOIY", "IY", "", false);
        fnCrtObjTxt($this->FormObj, 1, "FF", "2", "Panel1", "MMITNO", "Code", "", true, 0, 0, "Big");
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel1", "MMITNM", "Name", "", true);
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel1", "MMITDS", "Description", "", true);
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel1", "MMUNMS", "Unit Measurement", "", true);
        fnCrtObjRad($this->FormObj, 1, "FF", "0", "Panel1", "MMDPFG", "Status", "", "1", "Radio", "DSPLY");
        fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel1", "MMREMK", "Remark", "", false, 100);

        fnCrtObjDefault($this->FormObj,"MM");    
        // dd($this->FormObj);

        return response()->jSon($this->FormObj);   
    }


    public function FillForm(Request $request) {
        $this->FormObject($request);
        $FillFormObject = $this->getFormObject($this->FormObj);
        // dd($FillFormObject);

        $MITMAS = MITMAS::noLock()
                ->select( $FillFormObject )
                ->where([
                    ['MMITNOIY', '=', $request->MMITNOIY],
                    // ['MMITNOIY', '=', '1'],
                  ])->get();
        // dd($MITMAS);

        $Hasil = $this->setFillForm(true, $MITMAS, "");
        // dd($Hasil);
        return response()->jSon($Hasil);        

    }   

    public function SaveData (Request $request) {

        $Hasil = $this->doExecuteQuery( $request->AppUserName, "cMITMAS@StpMITMAS");  
        // $Hasil->message = ""; 
        // $Hasil = array("success"=> $BerHasil, "message"=> " Sukses... ".$message.$b);
        return response()->jSon($Hasil);

    }

    public function StpMITMAS(Request $request) {


        $fMITMAS = json_encode($request->frmMITMAS);
        $fMITMAS = json_decode($fMITMAS, true);

        $Delimiter = "";
        $UnikNo = fnGenUnikNo($Delimiter);

        $HasilCheckBFCS = fnCheckBFCS (
                            array("Table"=>"MITMAS", 
                                  "Key"=>"MMITNOIY", 
                                  "Data"=>$fMITMAS, 
                                  "Mode"=>$request->Mode,
                                  "Menu"=>"", 
                                  "FieldTransDate"=>""));
        if (!$HasilCheckBFCS["success"]) {
            return response()->jSon($HasilCheckBFCS);
        }

        $UserName = $request->AppUserName;

        switch ($request->Mode) {
            case "1":
                $fMITMAS['MMITNOIY'] = fnTBLNOR('MITMAS', $UserName);
                $FinalField = fnGetSintaxCRUD ($UserName, $fMITMAS, 
                    '1', "MM", 
                    ['MMITNOIY','MMITNO','MMITNM','MMITDS','MMUNMS','MMDPFG','MMREMK'], 
                    $UnikNo );
                DB::table('MITMAS')->insert($FinalField);

                break;
            case "2":
                $FinalField = fnGetSintaxCRUD ($UserName, $fMITMAS, 
                    '2', "MM", 
                    ['MMITNM','MMITDS','MMUNMS','MMDPFG','MMREMK'], 
                    $UnikNo );
                DB::table('MITMAS')
                    ->where('MMITNOIY','=',$fMITMAS['MMITNOIY'])
                    ->update($FinalField);

                break;
            case "3":
                DB::table('MITMAS')
                    ->where('MMITNOIY','=',$fMITMAS['MMITNOIY'])      
                    ->delete();
                break;
        }


    }




}
