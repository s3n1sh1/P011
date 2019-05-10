<?php
namespace App\Http\Controllers\Forms;

use App\Http\Controllers\cWeController; //as cWeController
use Illuminate\Http\Request;
use App\Models\TBLUSR;
use DB;

class cTBLUSR extends cWeController {

    private $GridObj = [];
    private $GridFilter = [];
    private $GridSort = [];
    private $GridColumns = [];

    public function LoadGrid(Request $request) {

        fnCrtColGrid($this->GridObj, "act", 1, 0, '', 'ACTION', 'Action', 50);
        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'TUUSERIY', 'User IY', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'TUUSER', 'Login Name', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'TUNAME', 'Full Name', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'TUPSWD', 'Password', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 1, '', 'TUEMID', 'Employee ID', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 0, '', 'TUDEPT', 'Department', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 0, '', 'TUMAIL', 'Mail', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 1, '', 'TUWELC', 'Welcome Text', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 0, '', 'TUUSRM', 'User Remark', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 0, '', 'TUREMK', 'Remark', 100);
        fnCrtColGridDefault($this->GridObj, "TU");

        $this->GridFilter = [];
        $this->GridSort = [];
        $this->GridSort[] = array('name'=>'TUUSER','direction'=>'asc');
        $this->GridColumns = [];

        $TBLUSR = TBLUSR::noLock()
                ->where([
                    ['TUDLFG', '=', '0'],
                  ]);

        $TBLUSR = fnQuerySearchAndPaginate($request, $TBLUSR, 
                                           $this->GridObj, 
                                           $this->GridSort, 
                                           $this->GridFilter, 
                                           $this->GridColumns);

        $Hasil = array( "Data"=> $TBLUSR,
                        "Column"=> $this->GridColumns,
                        "Sort"=> $this->GridSort,
                        "Filter"=> $this->GridFilter,
                        "Key"=> 'TUUSERIY');
        // dd($Hasil);
        return response()->jSon($Hasil);     

    }


    private $FormObj = [];

    public function FormObject(Request $request) {

        fnCrtObjNum($this->FormObj, 0, "FF", "3", "Panel4", "TUUSERIY", "ID", "", false, 0);     
        fnCrtObjTxt($this->FormObj, 1, "FF", "2", "Panel1", "TUUSER", "Login Name", "", true, 0, 50);     
            // fnUpdObj($this->FormObj, "TUUSER", array("Helper"=>'Dipakai saat login'));
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel1", "TUNAME", "Full Name", "", true);        
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel1", "TUPSWD", "Password", "", true);    
        fnCrtObjRad($this->FormObj, 1, "FF", "0", "Panel1", "TUDPFG", "Status User", "", "1", "Radio", "DSPLY");      
        fnCrtObjRad($this->FormObj, 1, "FF", "0", "Panel1", "TUEXPP", "Expire Password", "", "1", "Radio", "YN");      
        fnCrtObjDtp($this->FormObj, 1, "FF", "0", "Panel1A", "TUEXPD", "Expire Password Date", "", true);         
        fnCrtObjNum($this->FormObj, 1, "FF", "0", "Panel1B", "TUEXPV", "Expire Password Value", "", false, 0, "","Day", 1, 1, 9999);
        
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel2", "TUEMID", "Employee ID", "", true);        
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel2", "TUDEPT", "Department", "", false);    
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel2", "TUMAIL", "Email", "", false);    
        fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel2", "TUWELC", "Welcome Text", "", false, 100);        
        fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel2", "TUUSRM", "User Remark", "User Remark", false, 200);
        fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel2", "TUREMK", "Remark", "", false, 300);
        fnCrtObjGrd($this->FormObj, 1, "XX", "0", "Panel5", "TBLUAM", "Detail Access", true
                            , "AEDL", "TBLUSR", "LoadTBLUAM");
        fnCrtObjDefault($this->FormObj,"TU");    
        return response()->jSon($this->FormObj);   
    }


    public function FillForm(Request $request) {
        $this->FormObject($request);
        $FillFormObject = $this->getFormObject($this->FormObj);
        // dd($FillFormObject);
        $TBLUSR = TBLUSR::noLock()
                ->select( $FillFormObject )
                ->where([
                    ['TUUSERIY', '=', $request->TUUSERIY],
                    // ['TUUSERIY', '=', '1'],
                  ])->get();
        // dd($TBLUSR);
        $TBLUSR[0]['TBLUAM'] = fnFillGrid($this->LoadTBLUAM($request));
        $Hasil = $this->setFillForm(true, $TBLUSR, "");
        return response()->jSon($Hasil);        

    }   


    public function SaveData(Request $request) {


        $fTBLUSR = json_encode($request->frmTBLUSR);
        $fTBLUSR = json_decode($fTBLUSR, true);

        $Delimiter = "";
        $UnikNo = fnGenUnikNo($Delimiter);

        $HasilCheckBFCS = fnCheckBFCS (
                            array("Table"=>"TBLUSR", 
                                  "Key"=>"TUUSERIY", 
                                  "Data"=>$fTBLUSR, 
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
                                        "Data"=>$fTBLUSR,
                                        "Table"=>"TBLUSR",
                                        "Field"=>['TUUSERIY','TUUSER','TUNAME','TUPSWD','TUEMID','TUDEPT','TUMAIL','TUWELC',
                                                  'TUEXPP','TUEXPD','TUEXPV','TUDPFG','TUUSRM','TUREMK'],
                                        "Where"=>[],
                                        "Iy"=>"TUUSERIY"
                                    ));
                break;
            case "2":
                array_push($SqlStm, array(
                                        "UnikNo"=>$UnikNo,
                                        "Mode"=>"U",
                                        "Data"=>$fTBLUSR,
                                        "Table"=>"TBLUSR",
                                        "Field"=>['TUUSERIY','TUUSER','TUNAME','TUPSWD','TUEMID','TUDEPT','TUMAIL','TUWELC',
                                                  'TUEXPP','TUEXPD','TUEXPV','TUDPFG','TUUSRM','TUREMK'],
                                        "Where"=>['TUUSERIY','=',$fTBLUSR['TUUSERIY']],
                                    ));
                break;
            case "3":
                array_push($SqlStm, array(
                                        "UnikNo"=>$UnikNo,
                                        "Mode"=>"D",
                                        "Data"=>$fTBLUSR,
                                        "Table"=>"TBLUSR",
                                        "Field"=>['TUUSERIY'],
                                        "Where"=>['TUUSERIY','=',$fTBLUSR['TUUSERIY']],
                                    ));
                break;
        }

        $Hasil = $this->doExecuteQuery( $request->AppUserName, $SqlStm, $Delimiter);  
        // $Hasil->message = ""; 
        // $Hasil = array("success"=> $BerHasil, "message"=> " Sukses... ".$message.$b);
        return response()->jSon($Hasil);

    }




    public function LoadTBLUAM(Request $request) {


        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'TANOMRIY', 'User Access IY', 100);
        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'TMNOMR', 'Nomor', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'TMMENU', 'Menu', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 0, '', 'TMSCUT', 'Short Cut', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'TMACES', 'TipeAccess', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'TAACES', 'Access', 100);
        fnCrtColGrid($this->GridObj, "act", 1, 0, '', 'ACTION', 'Action', 50);
        // fnCrtColGridDefault($this->GridObj, "TU");

        $this->GridFilter = [];
        $this->GridSort = [];
        $this->GridSort[] = array('name'=>'TMNOMR','direction'=>'asc');
        $this->GridColumns = [];

        $TBLUSR = TBLUSR::noLock()
                ->leftJoin('TBLUAM','TAUSERIY','TUUSERIY')
                ->leftJoin('TBLMNU','TMMENUIY','TAMENUIY')
                ->where([
                    ['TUDLFG', '=', '0'],
                    ['TUUSERIY', '=', $request->TUUSERIY],
                  ]);

        $TBLUSR = fnQuerySearchAndPaginate($request, $TBLUSR, 
                                           $this->GridObj, 
                                           $this->GridSort, 
                                           $this->GridFilter, 
                                           $this->GridColumns);

        $Hasil = array( "Data"=> $TBLUSR,
                        "Column"=> $this->GridColumns,
                        "Sort"=> $this->GridSort,
                        "Filter"=> $this->GridFilter,
                        "Key"=> 'TANOMRIY');
        // dd($Hasil);
        return response()->jSon($Hasil);     

    }


}
