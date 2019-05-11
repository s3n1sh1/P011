<?php
namespace App\Http\Controllers\Forms;

use App\Http\Controllers\cWeController; //as cWeController
use Illuminate\Http\Request;
use App\Models\TBLMNU;
use DB;

class cTBLMNU extends cWeController {

    private $GridObj = [];
    private $GridFilter = [];
    private $GridSort = [];
    private $GridColumns = [];

    public function LoadGrid(Request $request) {

        fnCrtColGrid($this->GridObj, "act", 1, 0, '', 'ACTION', 'Action', 50);
        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'TMMENUIY', 'Menu IY', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'TMNOMR', 'No Urut', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'TMMENU', 'Menu Description', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'TMSCUT', 'Short Cut', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 1, '', 'TMACES', 'Menu Access', 100);
        fnCrtColGrid($this->GridObj, "num", 0, 0, '', 'TMBCDT', 'Back Dt', 100);
        fnCrtColGrid($this->GridObj, "num", 0, 0, '', 'TMFWDT', 'Forward Dt', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 1, '', 'TMURLW', 'Form', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 1, '', 'TMGRUP', 'Group', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 0, '', 'TMUSRM', 'User Remark', 100);
        fnCrtColGrid($this->GridObj, "txt", 0, 0, '', 'TMREMK', 'Remark', 100);
        fnCrtColGridDefault($this->GridObj, "TM");

        $this->GridFilter = [];
        $this->GridSort = [];
        $this->GridSort[] = array('name'=>'TMNOMR','direction'=>'asc');
        $this->GridColumns = [];

        $TBLMNU = TBLMNU::noLock()
                ->where([
                    ['TMDLFG', '=', '0'],
                  ]);

        $TBLMNU = fnQuerySearchAndPaginate($request, $TBLMNU, 
                                           $this->GridObj, 
                                           $this->GridSort, 
                                           $this->GridFilter, 
                                           $this->GridColumns);

        $Hasil = array( "Data"=> $TBLMNU,
                        "Column"=> $this->GridColumns,
                        "Sort"=> $this->GridSort,
                        "Filter"=> $this->GridFilter,
                        "Key"=> 'TMMENUIY');
        // dd($Hasil);
        return response()->jSon($Hasil);     

    }


    private $FormObj = [];

    public function FormObject(Request $request) {

        fnCrtObjNum($this->FormObj, 0, "FF", "3", "Panel1", "TMMENUIY", "ID", "", false, 0);      
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "PanelA", "TMNOMR", "Code Menu", "", true, 0, 20, "Big");     
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "PanelA", "TMSCUT", "Short Cut", "", false);    
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "PanelB", "TMMENU", "Description", "", true);        
        fnCrtObjRad($this->FormObj, 1, "FF", "0", "Panel1", "TMACES", "Menu Access", "", "1", "toggle", "MODE", false);
        fnCrtObjRad($this->FormObj, 1, "FF", "0", "Panel1", "TMDPFG", "Status", "", "1", "Radio", "DSPLY");      
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel2", "TMSYFG", "System Flag", "", true);  
        fnCrtObjNum($this->FormObj, 1, "FF", "0", "Panel2", "TMBCDT", "Back Date", "", false, 2, "","Day", 1, 1, 9999);
        fnCrtObjNum($this->FormObj, 1, "FF", "0", "Panel2", "TMFWDT", "Forward Date", "", false, 2, "","Day", 1, 1, 9999);
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel3", "TMURLW", "URL", "", false);        
        fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel3", "TMGRUP", "File Group", "", false);        
            fnUpdObj($this->FormObj, "TMGRUP", array("Helper"=>'Jika File Group diisi, Maka Menu tersebut akan refer ke file yang sama'));
        fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel4", "TMUSRM", "User Remark", "User Remark", false, 100);
        fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel4", "TMREMK", "Remark", "Everything You Want", false, 100);
            fnUpdObj($this->FormObj, "TMREMK", array("Helper"=>'Terserah anda mau isi apa?'));

        fnCrtObjDefault($this->FormObj,"TM");    
        // dd($this->FormObj);

        return response()->jSon($this->FormObj);   
    }


    public function FillForm(Request $request) {
        $this->FormObject($request);
        $FillFormObject = $this->getFormObject($this->FormObj);
        // dd($FillFormObject);

        $TBLMNU = TBLMNU::noLock()
                ->select( $FillFormObject )
                ->where([
                    ['TMMENUIY', '=', $request->TMMENUIY],
                    // ['TMMENUIY', '=', '1'],
                  ])->get();
        // dd($TBLMNU);

        $Hasil = $this->setFillForm(true, $TBLMNU, "");
        // dd($Hasil);
        return response()->jSon($Hasil);        

    }   

    public function SaveData (Request $request) {

        $Hasil = $this->doExecuteQuery( $request->AppUserName, "cTBLMNU@StpTBLMNU");  
        // $Hasil->message = ""; 
        // $Hasil = array("success"=> $BerHasil, "message"=> " Sukses... ".$message.$b);
        return response()->jSon($Hasil);

    }

    public function StpTBLMNU(Request $request) {


        $fTBLMNU = json_encode($request->frmTBLMNU);
        $fTBLMNU = json_decode($fTBLMNU, true);

        $Delimiter = "";
        $UnikNo = fnGenUnikNo($Delimiter);

        $HasilCheckBFCS = fnCheckBFCS (
                            array("Table"=>"TBLMNU", 
                                  "Key"=>"TMMENUIY", 
                                  "Data"=>$fTBLMNU, 
                                  "Mode"=>$request->Mode,
                                  "Menu"=>"", 
                                  "FieldTransDate"=>""));
        if (!$HasilCheckBFCS["success"]) {
            return response()->jSon($HasilCheckBFCS);
        }


        $UserName = $request->AppUserName;

        switch ($request->Mode) {
            case "1":
                $fTBLMNU['TMMENUIY'] = fnTBLNOR('TBLMNU', $UserName);
                $FinalField = fnGetSintaxCRUD ($UserName, $fTBLMNU, 
                    '1', "TM", 
                    ['TMMENUIY','TMNOMR','TMSCUT','TMMENU','TMACES','TMDPFG','TMSYFG',
                     'TMBCDT','TMFWDT','TMURLW','TMGRUP','TMUSRM','TMREMK'], 
                    $UnikNo );
                DB::table('TBLMNU')->insert($FinalField);
                break;
            case "2":
                $FinalField = fnGetSintaxCRUD ($UserName, $fTBLMNU, 
                    '2', "TM", 
                    ['TMNOMR','TMSCUT','TMMENU','TMACES','TMDPFG','TMSYFG','TMBCDT','TMFWDT',
                     'TMURLW','TMGRUP','TMUSRM','TMREMK'], 
                    $UnikNo );
                DB::table('TBLMNU')
                    ->where('TMMENUIY','=',$fTBLMNU['TMMENUIY'])
                    ->update($FinalField);
                break;
            case "3":
                DB::table('TBLMNU')
                    ->where('TMMENUIY','=',$fTBLMNU['TMMENUIY'])      
                    ->delete();
                break;
        }


    }

}
