<?php
namespace App\Http\Controllers\Forms;

use App\Http\Controllers\cWeController; //as cWeController
use Illuminate\Http\Request;
use App\Models\MBPMAS;
use DB;

class cMBPMAS extends cWeController {

    private $GridObj = [];
    private $GridFilter = [];
    private $GridSort = [];
    private $GridColumns = [];

    public function LoadGrid(Request $request) {

        fnCrtColGrid($this->GridObj, "act", 1, 0, '', 'ACTION', 'Action', 50);
        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'BPBPNOIY', 'IY', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'BPBPNO', 'Code', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'BPNAME', 'Name', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'BPADDR', 'Address', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'BPREMK', 'Remark', 100);
        fnCrtColGridDefault($this->GridObj, "BP");

        $this->GridFilter = [];
        $this->GridSort = [];
        $this->GridSort[] = array('name'=>'BPBPNO','direction'=>'asc');
        $this->GridColumns = [];

        $MBPMAS = MBPMAS::noLock()
                ->where([
                    ['BPDLFG', '=', '0'],
                  ]);

        $MBPMAS = fnQuerySearchAndPaginate($request, $MBPMAS, 
                                           $this->GridObj, 
                                           $this->GridSort, 
                                           $this->GridFilter, 
                                           $this->GridColumns);

        $Hasil = array( "Data"=> $MBPMAS,
                        "Column"=> $this->GridColumns,
                        "Sort"=> $this->GridSort,
                        "Filter"=> $this->GridFilter,
                        "Key"=> 'BPBPNOIY');
        // dd($Hasil);
        return response()->jSon($Hasil);     

    }


    private $FormObj = [];

    public function FormObject(Request $request) {

        fnCrtObjTxt($this->FormObj, 0, "FF", "3", "Panel1", "BPBPNOIY", "IY", "", false);
        fnCrtObjTxt($this->FormObj, 1, "FF", "2", "Panel1", "BPBPNO", "Code", "", true, 0, 0, "Big");
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel1", "BPNAME", "Name", "", true);
        fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel1", "BPADDR", "Address", "", false, 100);
        fnCrtObjRad($this->FormObj, 1, "FF", "0", "Panel1", "BPDPFG", "Status", "", "1", "Radio", "DSPLY");
        fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel1", "BPREMK", "Remark", "", false, 100);
            // fnUpdObj($this->FormObj, "BPREMK", array("Helper"=>'Terserah anda mau isi apa?'));

        // fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel1", "BPNAME", "Description", "", true, 0, 0, "", "Awal", "Akhir");
        // fnCrtObjNum($this->FormObj, 1, "FF", "0", "Panel1", "BPADDR", "Length Character", "", false, 2, "Num"," Char", 1, 1, 99);
        // fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel1", "BPREMK", "Remark", "Everything You Want", false, 100);
        //     fnUpdObj($this->FormObj, "BPREMK", array("Helper"=>'Terserah anda mau isi apa?'));

        fnCrtObjDefault($this->FormObj,"BP");    
        // dd($this->FormObj);

        return response()->jSon($this->FormObj);   
    }


    public function FillForm(Request $request) {
        $this->FormObject($request);
        $FillFormObject = $this->getFormObject($this->FormObj);
        // dd($FillFormObject);

        $MBPMAS = MBPMAS::noLock()
                ->select( $FillFormObject )
                ->where([
                    ['BPBPNOIY', '=', $request->TDDSCDIY],
                    // ['BPBPNOIY', '=', '1'],
                  ])->get();
        // dd($MBPMAS);

        $Hasil = $this->setFillForm(true, $MBPMAS, "");
        // dd($Hasil);
        return response()->jSon($Hasil);        

    }   


    public function SaveData(Request $request) {


        $fMBPMAS = json_encode($request->frmMBPMAS);
        $fMBPMAS = json_decode($fMBPMAS, true);

        $Delimiter = "";
        $UnikNo = fnGenUnikNo($Delimiter);

        $HasilCheckBFCS = fnCheckBFCS (
                            array("Table"=>"MBPMAS", 
                                  "Key"=>"BPBPNOIY", 
                                  "Data"=>$fMBPMAS, 
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
                                        "Data"=>$fMBPMAS,
                                        "Table"=>"MBPMAS",
                                        "Field"=>['BPBPNOIY','BPBPNO','BPNAME','BPADDR','BPDPFG','BPREMK'],
                                        "Where"=>[],
                                        "Iy"=>"BPBPNOIY"
                                    ));
                break;
            case "2":
                array_push($SqlStm, array(
                                        "UnikNo"=>$UnikNo,
                                        "Mode"=>"U",
                                        "Data"=>$fMBPMAS,
                                        "Table"=>"MBPMAS",
                                        "Field"=>['BPNAME','BPADDR','BPDPFG','BPREMK'],
                                        "Where"=>['BPBPNOIY','=',$fMBPMAS['BPBPNOIY']],
                                    ));
                break;
            case "3":
                array_push($SqlStm, array(
                                        "UnikNo"=>$UnikNo,
                                        "Mode"=>"D",
                                        "Data"=>$fMBPMAS,
                                        "Table"=>"MBPMAS",
                                        "Field"=>['BPBPNOIY'],
                                        "Where"=>['BPBPNOIY','=',$fMBPMAS['BPBPNOIY']],
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


        $MBPMAS = MBPMAS::noLock()
                ->where([
                    ['BPDLFG', '=', '0'],
                  ])
                ->get();
        return response()->jSon($MBPMAS);  

        $MBPMAS = MBPMAS::noLock()
                ->where([
                    ['BPDLFG', '=', '0'],
                  ])
                ->get()->first()->tblsys;
        

    // public function scopeGetTableColumns() {
    //     return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    // }  

        $ABC = MBPMAS::getConnection()->get();
        dd($ABC);

        foreach ($MBPMAS as $key => $value) {
            # code...
            echo $key; echo $value; echo "<br>";
            print_r($MBPMAS[$key]);
            echo "<hr>";

            foreach ($MBPMAS[$key]->toArray() as $k => $v) {
                echo $k."-".$v." (".getType($v).") "; echo "<br>";
            }
        }
        echo "<hr>";
        $MBPMAS = MBPMAS::noLock()->find(1);
        echo $MBPMAS;

        echo "<hr>";
        $MBPMAS = MBPMAS::noLock()->get();
        dd($MBPMAS);

        return $MBPMAS;

        return response()->jSon($MBPMAS);    

    }

}
