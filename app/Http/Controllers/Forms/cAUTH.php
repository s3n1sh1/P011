<?php
namespace App\Http\Controllers\Forms;

use App\Http\Controllers\cWeController; //as cWeController
use Illuminate\Http\Request;
use App\Models\TBLUSR;
use App\Models\TBLMNU;
use DB;

class cAUTH extends cWeController {

    /*
    	Cara testing....
        http://localhost:8099/laravelwili/index.php/getData2?Controller=c_user&Method=login&TUUSER=admin&TUPSWD=admin&FLAG_ECHO=true
        http://localhost:8099/laravelwili/index.php/getData?Data=fSJmZHNhIjoiUkVTVVVUIiwibmlnb0wiOiJkb2h0ZU0iLCJyZXNVX2MiOiJyZWxsb3J0bm9DIns=
    */

    public function Login(Request $request) {
        
        $DataJSon = fnDecrypt($request->Data, "");
        // echo ;
        if (is_null($DataJSon)) {
            return response()->Json(fnProtectHack());
        }

        foreach($DataJSon as $row => $value) {  // Begin Looping DataJSon
            $request->request->add(array($row => $value));
        }  // End Looping DataJSon

        $TBLUSR = TBLUSR::select('TUUSER', 'TUPSWD')
                ->where([
                    ['TUUSER', '=', $request->TUUSER],
                  ])
                ->get();     

// echo "Password : (".fnEncryptPassword($request->TUPSWD).") ";
// dd($TBLUSR->toArray());

        $Sukses = false;
		if (count($TBLUSR)==0) {
	        $Sukses = false;
		} else {
            $arr_TBLUSR = $TBLUSR[0];
            if ($request->TUPSWD=="") { 
                $Sukses = false; 
            } else if (rtrim($arr_TBLUSR['TUPSWD'])==fnEncryptPassword($request->TUPSWD)) { 
                $Sukses = true; 
            }
		}   

        if ($Sukses) {
            // $UserClientInfo = $_SERVER['REMOTE_ADDR'].gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $UserClientInfo = $_SERVER['REMOTE_ADDR'];

            // begin generate token
            $Koneksi = DB::connection()->getConfig("host").DB::connection()->getDatabaseName().$request->AppName;
            $Date = date('Ymd_His');
            $token = $Koneksi."".$Date."".$request->TUUSER.$UserClientInfo;
            $token = fnEncryptPassword("WilEdi2019".$token);            
            $tokenvalue = fnEncryptPassword("WilEdi2019".$token);
            // end generate token

            // begin generate cookies
            $cookiesCode = DB::connection()->getConfig("host").DB::getDatabaseName().$request->AppName.$Date;

            $cookiesToken = fnEncryptPassword("token".$cookiesCode);
            $cookiesName = fnEncryptPassword("name".$cookiesCode);
            $cookiesDate = fnEncryptPassword("dateInfo".$cookiesCode);

            $cookiesTokenValue = $tokenvalue;
            $cookiesNameValue = fnEncryptPassword($request->TUUSER.$Date);
            $cookiesDateValue = fnEncryptPassword($Date);
            // end generate cookies

            return response()->json([
                                'success'=>true,
                                'message'=>'',
                                'dateInfo'=>$Date,
                                'token'=>$token
                            ])
                            ->withCookie(cookie($cookiesToken, $cookiesTokenValue, 1))
                            ->withCookie(cookie($cookiesName, $cookiesNameValue, 1))
                            ->withCookie(cookie($cookiesDate, $cookiesDateValue, 1));
        } else {
            // return response()->json(['success'=>false,'data'=>$TBLUSR,'token'=>'','Cookies_Name'=>'']);         
            return response()->json([
                                'success'=>false,
                                'message'=>'Username and Password not match!!!',
                                'dateInfo'=>'',
                                'token'=>'']);         
        }           

    }

    public function CheckLogin(Request $request) {

        // $UserClientInfo = $_SERVER['REMOTE_ADDR'].gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $UserClientInfo = $_SERVER['REMOTE_ADDR'];

        $Koneksi = DB::connection()->getConfig("host").DB::connection()->getDatabaseName().$request->AppName;
        $Date = $request->AppDateInfo;
        $token = $Koneksi."".$Date."".$request->AppUserName.$UserClientInfo;
        $token = fnEncryptPassword("WilEdi2019".$token);                 

        if ( $token==$request->AppToken )  {
            return response()->json(['success'=>true,'message'=>'','dateInfo'=>$Date]);
        } else {
            return response()->json(['success'=>false,'message'=>'','dateInfo'=>$Date]);
        }

    }    

    public function GetProfile(Request $request) {
        
        $TBLUSR = TBLUSR::select('TUFOTO')
                ->where([
                    ['TUUSER', '=', $request->name],
                  ])
                ->get();   

        $Hasil = $this->fnGenDataFile($TBLUSR[0]['TUFOTO']);

        return response()->jSon($Hasil); 
                
    }    

    public function Logout(Request $request) {
    
    }


    function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                    $element['icon'] = 'folder_open';
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function LoadUserTreeMenu(Request $request) {

        /*
           $TBLMNU = TBLMNU_Model::select('TMMENU', 'TMNOMR', 'TMSCUT', 'TMMENUIY')
                    ->where([
                        ['TMDPFG', '=', '1'],
                      ])
                    ->orderBy('TMNOMR')
                    ->get();

        */

        $USERIY = fnGetRec('TBLUSR','TUUSERIY','TUUSER',$request->Username,'');

        $TBLMNU = DB::table('TBLMNU')
                ->select('TMMENU', 'TMNOMR', 'TMSCUT', 'TMMENUIY', 'TMACES', 'TAACES', 'TMURLW', 'TMGRUP')
                ->leftJoin('TBLUAM', function($join) use($USERIY) {
                    $join->on('TAMENUIY', '=', 'TMMENUIY');
                    $join->where('TAUSERIY', '=', $USERIY->TUUSERIY);
                })
                ->where([
                    ['TMDPFG', '=', '1'],
                  ])
                ->orderBy('TMNOMR')
                ->get();


        $tree = []; $rute = [];
        foreach($TBLMNU as $row) {  // Begin Looping Record TBLMNU  
            $Pjg = strlen(rtrim($row->TMNOMR));
            $Disabled = false;
            $icon = 'launch';
            $id = rtrim($row->TMNOMR);    // ID
            $nilai = [];
            if (rtrim($row->TMSCUT)=="") {  // Begin Nama Menu
                $name = rtrim($row->TMMENU);    
                $value = 'H'.rtrim($row->TMMENUIY); // Nilai
                $nilai[] = array("id"=> "", "label"=> $name ) ; 
            } else {
                $name = "[".rtrim($row->TMSCUT)."] ".rtrim($row->TMMENU);    
                // $name = rtrim($row->TMMENU). " (". rtrim($row->TMACES).") (".rtrim($row->TAACES).")"; 
                if (!strpos(" ".rtrim($row->TAACES),"V")) {
                    $Disabled=true;
                    $icon='block';
                }
                $nilai[] = array("id"=> rtrim($row->TMMENUIY), 
                                 "label"=> $name, 
                                 "label1"=>rtrim($row->TMSCUT), 
                                 "label2"=>rtrim($row->TMMENU) ) ; 
                $value = rtrim($row->TMMENUIY); // Nilai
            } // End Nama Menu

            $pid = substr($id,0,($Pjg-2));  // Parent ID

            

            // $tree[] = array("label"=>$name,"icon"=>'folder',"value"=>$value,"id"=>$id,"parent_id"=>$pid);               
            // $tree[] = array("label"=>$name,"disabled"=>'true',"value"=>$value,"id"=>$id,"parent_id"=>$pid);               
            $tree[] = array("label"=>$name,
                            "disabled"=>$Disabled,
                            "icon"=>$icon,
                            "id"=>$id,
                            "value"=>$value,
                            "parent_id"=>$pid,
// ----------------------------------------------------------------------
                            "title"=>rtrim($row->TMMENU),
                            "shortCut"=>rtrim($row->TMSCUT),
                            "idMenu"=>$row->TMMENUIY,
                            "layout"=>"1",
                            "titleAction"=>"",
                            "modeAction"=>"",
                            "menuAkses"=>rtrim($row->TMACES),
                            "userAkses"=>rtrim($row->TAACES),
// ----------------------------------------------------------------------
                            "tombol"=>array("V"=>$this->SetTombol("V", rtrim($row->TMACES), rtrim($row->TAACES)),
                                            "A"=>$this->SetTombol("A", rtrim($row->TMACES), rtrim($row->TAACES)),
                                            "E"=>$this->SetTombol("E", rtrim($row->TMACES), rtrim($row->TAACES)),
                                            "D"=>$this->SetTombol("D", rtrim($row->TMACES), rtrim($row->TAACES)),
                                            "L"=>$this->SetTombol("L", rtrim($row->TMACES), rtrim($row->TAACES)),
                                            "V"=>$this->SetTombol("V", rtrim($row->TMACES), rtrim($row->TAACES)),
                                            "X"=>$this->SetTombol("X", rtrim($row->TMACES), rtrim($row->TAACES)),
                                            "R"=>$this->SetTombol("R", rtrim($row->TMACES), rtrim($row->TAACES)),
                                            "P"=>$this->SetTombol("P", rtrim($row->TMACES), rtrim($row->TAACES)),
                                            "Save"=>array("has"=>true,"show"=>false,"disabled"=>false),
                                            "Cancel"=>array("has"=>true,"show"=>false,"disabled"=>false),
                                            ),
// ----------------------------------------------------------------------
                            "XXXX"=>"XXXX");               


            if (rtrim($row->TMURLW)!="") {  // Begin Data Rute
                $rute[] = array("path"=>rtrim($row->TMGRUP) === "" ? rtrim($row->TMURLW) : rtrim($row->TMGRUP),
                                "name"=>$row->TMMENUIY,
                                "shortCut"=>rtrim($row->TMSCUT),
                                "url"=>rtrim($row->TMURLW),
                                // "props"=>array("".rtrim($row->TMURLW) => array( "Mode"=> "5", "sidebar"=>false) ),
                                // "props"=>array("".rtrim($row->TMURLW) => array( "Mode"=> "5", "sidebar"=>false), "Mode" => "ABCDE" ),
                                // "props"=>array("Mode" => rtrim($row->TMURLW) ),
                                // "menu"=>rtrim($row->TMMENU)."/".fnEncryptPassword('W'.$row->TMMENUIY.date('YmdHis') )
                                "menu"=>fnEncryptPassword('W'.$row->TMMENUIY.date('YmdHis') )
                                // "menu"=>$row->TMMENUIY 
                                );               
            } // End Data Rute

        }  // End Looping Record TBLMNU

        $DataTree = $this->buildTree($tree);
        $DataRute = $rute;
        
        $Hasil = array("DataTree"=>$DataTree,
                       "DataRute"=>$DataRute);

        return response()->jSon($Hasil);        

    }    

    function SetTombol($mode, $m, $u) {
        $has = false; 
        $show = false; 
        $disabled = true; 

        if (strpos(' '.strtoupper($m), strtoupper($mode), 0) > 0 ) { 
            $has = true; $show = true; $disabled = true; 
            if (strpos(' '.strtoupper($u), strtoupper($mode), 0) > 0 ) { 
                $disabled = false;             
            }
        }
        return array("has"=>$has,"show"=>$show,"disabled"=>$disabled) ;
    }

}
