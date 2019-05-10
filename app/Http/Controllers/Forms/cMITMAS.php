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
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'MMREMK', 'Remark', 100);
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
            // fnUpdObj($this->FormObj, "MMREMK", array("Helper"=>'Terserah anda mau isi apa?'));

        // fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel1", "MMITNM", "Description", "", true, 0, 0, "", "Awal", "Akhir");
        // fnCrtObjNum($this->FormObj, 1, "FF", "0", "Panel1", "MMITDS", "Length Character", "", false, 2, "Num"," Char", 1, 1, 99);
        // fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel1", "MMREMK", "Remark", "Everything You Want", false, 100);
        //     fnUpdObj($this->FormObj, "MMREMK", array("Helper"=>'Terserah anda mau isi apa?'));

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


    public function SaveData(Request $request) {


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

        $SqlStm = [];
        switch ($request->Mode) {
            case "1":
                array_push($SqlStm, array(
                                        "UnikNo"=>$UnikNo,
                                        "Mode"=>"I",
                                        "Data"=>$fMITMAS,
                                        "Table"=>"MITMAS",
                                        "Field"=>['MMITNOIY','MMITNO','MMITNM','MMITDS','MMUNMS','MMDPFG','MMREMK'],
                                        "Where"=>[],
                                        "Iy"=>"MMITNOIY"
                                    ));
                break;
            case "2":
                array_push($SqlStm, array(
                                        "UnikNo"=>$UnikNo,
                                        "Mode"=>"U",
                                        "Data"=>$fMITMAS,
                                        "Table"=>"MITMAS",
                                        "Field"=>['MMITNM','MMITDS','MMUNMS','MMDPFG','MMREMK'],
                                        "Where"=>['MMITNOIY','=',$fMITMAS['MMITNOIY']],
                                    ));
                break;
            case "3":
                array_push($SqlStm, array(
                                        "UnikNo"=>$UnikNo,
                                        "Mode"=>"D",
                                        "Data"=>$fMITMAS,
                                        "Table"=>"MITMAS",
                                        "Field"=>['MMITNOIY'],
                                        "Where"=>['MMITNOIY','=',$fMITMAS['MMITNOIY']],
                                    ));
                break;
        }


        // $Hasil = fnSetExecuteQuery($SqlStm,$Delimiter);    
        $Hasil = $this->doExecuteQuery( $request->AppUserName, $SqlStm, $Delimiter);  
        // $Hasil->message = ""; 
        // $Hasil = array("success"=> $BerHasil, "message"=> " Sukses... ".$message.$b);
        return response()->jSon($Hasil);

    }


    public function LoadGridXXXX(Request $request) {
        echo "Masuk<br>";


        $MITMAS = MITMAS::noLock()
                ->where([
                    ['MMDLFG', '=', '0'],
                  ])
                ->get();
        return response()->jSon($MITMAS);  

        $MITMAS = MITMAS::noLock()
                ->where([
                    ['MMDLFG', '=', '0'],
                  ])
                ->get()->first()->tblsys;
        

    // public function scopeGetTableColumns() {
    //     return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    // }  

        $ABC = MITMAS::getConnection()->get();
        dd($ABC);

        foreach ($MITMAS as $key => $value) {
            # code...
            echo $key; echo $value; echo "<br>";
            print_r($MITMAS[$key]);
            echo "<hr>";

            foreach ($MITMAS[$key]->toArray() as $k => $v) {
                echo $k."-".$v." (".getType($v).") "; echo "<br>";
            }
        }
        echo "<hr>";
        $MITMAS = MITMAS::noLock()->find(1);
        echo $MITMAS;

        echo "<hr>";
        $MITMAS = MITMAS::noLock()->get();
        dd($MITMAS);

        return $MITMAS;

        return response()->jSon($MITMAS);    

    }

}
