<?php
    $weLicence = true;

    if (!$weLicence) {
        die('abc');
    }

	function Test123($str) {
		return "ABCDEF".$str;
	}

    function fnProtectHack() {
        // $computerId = $_SERVER['HTTP_USER_AGENT']." - ".$_SERVER['REMOTE_PORT']." - ".$_SERVER['REMOTE_ADDR'];
        $Data = ["Your IP"=>$_SERVER['REMOTE_ADDR'],
                 "Your Device Name"=>gethostbyaddr($_SERVER['REMOTE_ADDR']),
                 "Recorded"=>true,
                 "Warning"=>"Dont try to do some stupid thing!"
                    ];    
        return $Data;
    }

    function fnEnCrypt($a) {
    	$flag = false;
									    	if ($flag) echo "<hr>";
											if ($flag) echo "<br>Original : ".$a."<br>";
        $a = base64_encode("WilEdi2019").$a;
        $a = base64_encode($a); 			if ($flag) echo "<br>Base64_Encode : ".$a."<br>";
        $a = strrev($a); 					if ($flag) echo "<br>Reverse : ".$a."<br>";
        $b = str_split($a,strlen($a)/2); 	if ($flag) echo "<br>Split String (Dibagi 2)<br>Menjadi 1 : $b[0]<br>Menjadi 2 : $b[1] <br>";
        $c = str_split($b[0]);
        $d = str_split($b[1]);

        $e = []; 
        foreach($c as $key=>$value) {
            array_push($e, $c[$key].$d[$key]);
        }

        $f = implode("",$e); 				if ($flag) echo "<br>".$f."<br>";
        // $f = base64_decode($f); 			if ($flag) echo "<br>".$f."<br>";
        
    										if ($flag) echo "<hr>";
    	return $f;

    }


    function fnDeCrypt($a) {
    	$flag = false;
									    	if ($flag) echo "<hr>";
											if ($flag) echo "<br>Original : ".$a."<br>";

        $b = str_split($a);
        $c = []; $d = []; $ab = "a";
        foreach($b as $key=>$value) {
        	if ($ab == "a") {
            	array_push($c, $b[$key]);
        		$ab = "b";
        	} else {
            	array_push($d, $b[$key]);
        		$ab = "a";
        	}
        }
        									if ($flag) echo "<br>Split String (Dibagi 2)<br>Menjadi 1 : ".implode("",$c)."<br>Menjadi 2 : ".implode("",$d)." <br>";
        $e = implode("",$c).implode("",$d);	if ($flag) echo "<br>Digabung menjadi 1 : ".implode("",$c).implode("",$d)." <br>";
        $e = strrev($e);					if ($flag) echo "<br>DiReverse : ".$e." <br>";
        $e = base64_decode($e); 			if ($flag) echo "<br>Base64_Decode : ".$e." <br>";
        $keys = base64_encode("WilEdi2019");
        $e = preg_replace("/".$keys."/", "", $e,1);
        $e = json_decode($e);  
    										if ($flag) echo "<hr>";
    	return $e;

    }

    function fnEncryptPassword($Password) {
        $JumlahSQL = 0;
        for ($i = 1; $i <= strlen($Password); $i++) {
            $HurufSQL = substr($Password, $i - 1, 1);
            $HurufSQL = ord($HurufSQL);
            $HurufSQL*=$i;
            $JumlahSQL+=$HurufSQL;
        }
        return md5($JumlahSQL);
    }



/*=================================================================================================================================*/
/*=======BEGIN GRID================================================================================================================*/
/*=================================================================================================================================*/

    function fnCrtColGridDefault(&$Column, $Prefix) {   

        fnCrtColGrid($Column, "txt", 0, 0, '', $Prefix.'RGID', 'Entry By', 100, 'left');
        fnCrtColGrid($Column, "txt", 0, 0, '', $Prefix.'RGDT', 'Entry Date', 100, 'center');
        fnCrtColGrid($Column, "txt", 0, 0, '', $Prefix.'CHID', 'Change By', 100, 'left');
        fnCrtColGrid($Column, "txt", 0, 0, '', $Prefix.'CHDT', 'Change Date', 100, 'center');
        fnCrtColGrid($Column, "num", 0, 0, '', $Prefix.'CHNO', 'Change Num', 100, 'right');
        fnCrtColGrid($Column, "txt", 0, 0, '', $Prefix.'CSID', 'Change System By', 100, 'left');
        fnCrtColGrid($Column, "txt", 0, 0, '', $Prefix.'CSDT', 'Change System Date', 100, 'center');

    }   

    function fnCrtColGrid(&$Column, $Tipe, $Required, $Tampil, $TipeGrid, $Field, $Label, $Width, 
                                  $Align = "", $PanjangKalimat = 0) {   

        if ($Align=="") {

            switch (strtoupper($Tipe)) {
                case "ACT":
                    $Align="left";
                    break;
                case "DTP":
                    $Align="center";
                    break;
                case "NUM":
                    $Align="right";
                    break;
                case "TXT":
                    $Align="left";
                    break;
            }

        }

        $Column[] = array ("name" => $Field,
                           "label" => $Label,
                           "field" => $Field,
                           "tipe" => strtolower($Tipe),
                           "tipeGrid" => strtolower($Tipe.$TipeGrid),
                           "width" => $Width,
                           "required" => $Required === 1 ? true : false,
                           "tampil" => $Tampil === 1 ? true : false,
                           "align" => $Align,
                           // "sortable" => $Sortable,
                           "sortable" => false,
                           "FilterOperator" => "",
                           "FilterValue" => "",
                           "panjangKalimat" => $PanjangKalimat,
                           "value" => $Field,
                           // "urut" =>isset($SortArray[$Field]) ? $SortArray[$Field] : '',                           
                           "xxxxx" => "xxxx");
    }         


    function fnQuerySearchAndPaginate($Request, $TableModel, $Obj, &$Sort, &$Filter, &$ColumnGrid) {   

        $Filter = [];
        if (!is_null($Request->cari)) {
            $Filter = $Request->cari;
        }

        if (!is_null($Request->urut)) {
            $Sort = [];
            $Sort = $Request->urut;
        } else {          
            $Sort = json_decode(json_encode($Sort));
        }

        // $b = array_filter($Obj, function ($a) { return $a['tipe'] != 'hdn'; } );
        // $a = array_splice($b,0,100);
        // dd($a);

        $driver = DB::connection()->getConfig("driver");
        if ($driver=="sqlsrv") {
            $B1 = "["; $B2 = "]";
        } else if ($driver=="mysql") { 
            $B1 = ""; $B2 = "";
        } 

        $Col = []; $ColumnGrid = [];
        foreach($Obj as $k => $f) {
            if ($f['tipe'] != 'act') { $Col[] = $f['field']; }
            if ($f['tipe'] != 'hdn') { $ColumnGrid[] = $f; }
            // echo ($v[$k]);
        }

        $TableModel->select($Col);

        foreach ($Sort as $s) {
            $TableModel->orderBy($s->name,$s->direction);
        }

        $condition = "";
        if (!is_null($Request->AllColumns)) {
        //   $TableModel->where(function ($query) use($Col, $Request) {
        //       foreach ($Col as $c) {
        //         // echo "or ".$c." like '%master%'";
        //         $query->orwhere($c, 'LIKE', '%'.$Request->AllColumns.'%');
        //       }            
        //   });
            $or = "";
            foreach ($Col as $c) {
                $nilai = str_replace("'","''",$Request->AllColumns);
                
                $condition = $condition.$or." ".$B1.$c.$B2."  like '%".$nilai."%'";
                $or = " or ";
            }
            $condition = " (".$condition.") ";
        }

        foreach ($Filter as $f) {

            if($condition != "") {
                $condition = $condition."And";
            }

            $nilai = str_replace("'","''",$f->filterValue);

            if($f->filterOperator == 'in') {
                // $TableModel->whereIn($f->field, explode(',', $f->filterValue));
                $condition = $condition." ".$B1.$f->field.$B2." "." in (".explode(',', $nilai).")";
            } else if($f->filterOperator == 'like') {
                // $TableModel->where($f->field, 'LIKE', '%'.$f->filterValue.'%');
                $condition = $condition." ".$B1.$f->field.$B2." "." like '%".$nilai."%'";
            } else if($f->filterOperator == 'likeRight') {
                // $TableModel->where($f->field, 'LIKE', $f->filterValue.'%');
                $condition = $condition." ".$B1.$f->field.$B2." "." like '".$nilai."%'";
            } else {
                // $TableModel->where($f->field, $f->filterOperator, $f->filterValue);
                $condition = $condition." ".$B1.$f->field.$B2." "." ".$f->filterOperator." '".$nilai."'";
            }
        }  
        
        if (!is_null($Request->SubMethod)) {
            if (rtrim($Request->SubMethod) != "") {
                if($condition != "") {
                    $condition = $condition."And";
                }
                if(substr($Request->Method,0,6) === "TBLSYS"){
                    $condition = $condition." TSDSCD = '".$Request->SubMethod."' ";
                }
            }
        }

        if (!is_null($Request->Condition)) {
            if (rtrim($Request->Condition) != "") {
                if($condition != "") {
                    $condition = $condition."And";
                }
                $condition = $condition." ".$Request->Condition." ";
            }
        }

        if($condition != ""){
            $TableModel->whereRaw($condition);
        }

        // Sintax Check SQL
        // $sql = $TableModel->toSql();
        // dd($sql);
        // dd($TableModel);

        // dd($Request->perPage);
        if($Request->perPage != "0") {
            // $page = $Request->page;
            // $perPage = $Request->perPage;
            // $offset = ($page * $perPage) - $perPage;
            // return $TableModel->offset($offset)->limit($perPage)->get();
            return $TableModel->paginate($Request->perPage);
        } else {
            // dd("masuk else");
            return $TableModel->paginate($TableModel->count());
            // return $TableModel->get();
        }
        

    }     
/*=================================================================================================================================*/
/*=====END GRID====================================================================================================================*/
/*=================================================================================================================================*/









/*=================================================================================================================================*/
/*======BEGIN STANDARD OBJECT======================================================================================================*/
/*=================================================================================================================================*/
    function fnCrtObj(&$Obj, $Show, $FFTipe, $Mode, $Tipe, $Panel, $Code, $Name, $Description, $Required) {   
        if ($Description == "") { $Description = $Name; }
        $Obj[$Code] = array(
                       "Code" => $Code,
                       "Tipe" => strtolower($Tipe), 
                       "Panel" => $Panel, 
                       "Mode" => $Mode, 
                       "ReadOnly" => false, 
                       "Show" => $Show === 1 ? true : false,
                       "FFTipe" => $FFTipe,  // FillForm Type Untuk Query Field Fill Form
                       "Required" => $Required,
                       "Name" => $Name,
                       "Description" => $Description, 
                       "Value" => ''
                       );
    }        

    function fnUpdObj(&$Obj, $Code, $LainLain) {   
        $Obj[$Code] = array_merge($Obj[$Code], $LainLain);
    }   
/*=================================================================================================================================*/
/*======End STANDARD OBJECT========================================================================================================*/
/*=================================================================================================================================*/








/*=================================================================================================================================*/
/*======BEGIN OBJECT===============================================================================================================*/
/*=================================================================================================================================*/

    function fnCrtObjDefault(&$Obj, $Prefix) {   
        fnCrtObjTxt($Obj, 1, "FF", "3", "PnlXXX", $Prefix."RGID", "Register ID", "", false);
        fnCrtObjTxt($Obj, 1, "FF", "3", "PnlXXX", $Prefix."RGDT", "Register Date", "", false);
        fnCrtObjTxt($Obj, 1, "FF", "3", "PnlXXX", $Prefix."CHID", "Change ID", "", false);
        fnCrtObjTxt($Obj, 1, "FF", "3", "PnlXXX", $Prefix."CHDT", "Change Date", "", false);
        fnCrtObjNum($Obj, 1, "FF", "3", "PnlXXX", $Prefix."CHNO", "Change Num", "", false);
        fnCrtObjTxt($Obj, 1, "FF", "3", "PnlXXX", $Prefix."CSID", "Change System ID", "", false);
        fnCrtObjTxt($Obj, 1, "FF", "3", "PnlXXX", $Prefix."CSDT", "Change System Date", "", false);
    }  

    function fnCrtObjTxt(&$Obj, $Show, $FFTipe, $Mode, $Panel, $Code, $Name, $Description = "", $Required, 
                                $Min = 0, $Max = 0, $Capital = "", $Prefix = "", $Suffix = "") {   
        /* 
            $Capital = ['Normal','Big','Small'] 
         */        
        if ($Capital == "") { $Capital = "Normal"; }
        fnCrtObj($Obj, $Show, $FFTipe, $Mode, "txt", $Panel, $Code, $Name, $Description, $Required);
        fnUpdObj($Obj, $Code, array("Min" => $Min, 
                                    "Max" => $Max,
                                    "Prefix" => $Prefix,  
                                    "Suffix" => $Suffix,
                                    "Capital" => strtoupper($Capital)) );
    } 


    function fnCrtObjNum(&$Obj, $Show, $FFTipe, $Mode, $Panel, $Code, $Name, $Description = "", $Required, 
                                $Decimal = 0, $Prefix = "", $Suffix = "", $Step = 1, $MinValue = 0, $MaxValue = 0) {   
        fnCrtObj($Obj, $Show, $FFTipe, $Mode, "num", $Panel, $Code, $Name, $Description, $Required);
        fnUpdObj($Obj, $Code, array("Decimal" => $Decimal,
                                    "Step" => $Step,
                                    "Prefix" => $Prefix,  
                                    "Suffix" => $Suffix,
                                    "MinValue" => $MinValue, 
                                    "MaxValue" => $MaxValue,) );
    } 

    function fnCrtObjCmb(&$Obj, $Show, $FFTipe, $Mode, $Panel, $Code, $Name, $Description = "", $DefaultValue, 
                                $Jenis, $TableCode, $Required = true, $Split = "", $Condition = "", $Table="TBLSYS") {   

        $ListData = fnGetComboData($Table, $TableCode, $Condition = "");
        /* 
            $Jenis = ['Single','Radio','Multiple'] 
         */
        fnCrtObj($Obj, $Show, $FFTipe, $Mode, "cmb", $Panel, $Code, $Name, $Description, $Required);
        fnUpdObj($Obj, $Code, array("Jenis" => strtoupper($Jenis),
                                    "DefaultValue" => $DefaultValue,
                                    "Options" => $ListData,
                                    "SplitParam" => $Split) );
    } 

    function fnCrtObjRad(&$Obj, $Show, $FFTipe, $Mode, $Panel, $Code, $Name, $Description = "", $DefaultValue, 
                                $Jenis, $TableCode, $Required = true, $Split = "", $Condition = "", $Table="TBLSYS") {   

        $ListData = fnGetComboData($Table, $TableCode, $Condition = "");
        /* 
            $Jenis = ['Radio','Toggle'] 
         */
        fnCrtObj($Obj, $Show, $FFTipe, $Mode, "rad", $Panel, $Code, $Name, $Description, $Required);
        fnUpdObj($Obj, $Code, array("Title" => $Name,
                                    "Jenis" => strtolower($Jenis),
                                    "DefaultValue" => $DefaultValue,
                                    "Value" => strtolower($Jenis) == 'toggle' ? [] : '',
                                    "Options" => $ListData,
                                    "SplitParam" => $Split) );
    } 

    function fnCrtObjTog(&$Obj, $Show, $FFTipe, $Mode, $Panel, $Code, $Name, $Description = "", $DefaultValue, 
                                $Left = false) {   
        /* 
            $Value = true || false
         */
        fnCrtObj($Obj, $Show, $FFTipe, $Mode, "tog", $Panel, $Code, $Name, $Description, true);
        fnUpdObj($Obj, $Code, array("Left" => $Left,
                                    "DefaultValue" => $DefaultValue) );

    } 

    function fnCrtObjRmk(&$Obj, $Show, $FFTipe, $Mode, $Panel, $Code, $Name, $Description = "", $Required, 
                                $Height = 100) {   
        fnCrtObj($Obj, $Show, $FFTipe, $Mode, "rmk", $Panel, $Code, $Name, $Description, $Required );
        fnUpdObj($Obj, $Code, array("Height" => $Height) );
    } 


    function fnCrtObjPop(&$Obj, $Show, $FFTipe, $Mode, $Panel, $Code, $popCode, $popDesc, $Name, $Description = "", $Required, 
                                $popTable, $popQuery=true, $searchChar=3, $popCondition="") {

        $SubMethod = "";
        fnCrtObj($Obj, $Show, $FFTipe, $Mode, "pop", $Panel, $Code, $Name, $Description, $Required);

        if(!$popQuery) {
            if(substr(strtoupper($popTable),0,6) === "TBLSYS") {
                $SubMethod = str_replace("TBLSYS_", "", strtoupper($popTable));
                $popTable = "TBLSYS";
            } 
        }

        fnUpdObj($Obj, $Code, array("ReadOnly" => true,
                                    "Controller" => $popQuery === true ? $popTable : "LOADGRID",
                                    "Method" => $popQuery === true ? "LoadGrid" : $popTable,
                                    "ShowPopUpModal"=>false,
                                    "Pops"=>array($popCode=>array("Value"=>"",
                                                                  "Show"=>true),
                                                  $popDesc=>array("Value"=>"",
                                                                  "Show"=>true),
                                                  $popCode.$popDesc=>array("Value"=>"",
                                                                           "Disabled"=>false)),
                                    "Grid"=>"",
                                    "SearchChar" => $searchChar,
                                    "PopCode" => $popCode,
                                    "PopDesc" => $popDesc,
                                    "PopData" => "") );

    }

    function fnCrtObjDtp(&$Obj, $Show, $FFTipe, $Mode, $Panel, $Code, $Name, $Description = "", $Required, $DateType="date",
                                $FormatDisplay="D-MMMM-YYYY", $Min = "", $Max = "") {
        fnCrtObj($Obj, $Show, $FFTipe, $Mode, "dtp", $Panel, $Code, $Name, $Description, $Required);
        fnUpdObj($Obj, $Code, array( "DateType" => $DateType, 
                                            "FormatDisplay" => $FormatDisplay, 
                                            "Min" => $Min, 
                                            "Max" => $Max) );
    } 



    function fnCrtObjGrd(&$Obj, $Show, $FFTipe, $Mode, $Panel, $Code, $Name, $Required, $action, 
                            $controller, $methodGrid) {
        fnCrtObj($Obj, $Show, $FFTipe, $Mode, "grd", $Panel, $Code, $Name, $Name, $Required);
        fnUpdObj($Obj, $Code, array( "Controller" => $controller,
                                     "Method" => $methodGrid,
                                     "Action" => $action,
                                     "OpenForm" => true,
                                     "SaveForm" => true,
                                     "GrdAuth" => "",
                                     "GrdKey" => "") );
    }

/*=================================================================================================================================*/
/*======END OBJECT=================================================================================================================*/
/*=================================================================================================================================*/






    function fnGetRec($Table, $Field, $FieldKey, $FieldKeyValue, $Condition) {

        $Rec = DB::table($Table)
                        ->Select(explode(',',$Field))
                        ->where($FieldKey,'=',$FieldKeyValue)
                        ->where(function ($query) use($Condition) {
                              if ( is_array($Condition) ) {
                                $query->where($Condition);
                              }
                          })
                        ->get();

        return $Rec[0];
    
    }

    function fnGetComboData($Table, $TableCode, $Condition = "") {
        $ListData = [];
        switch (strtoupper($Table)) {
            case "TBLSYS":
                $Model = "Tblsys";        

                $Condition = [];
                array_push($Condition, ['TDDSCD','=',$TableCode]);
                array_push($Condition, ['TSDLFG','=','0']);
                array_push($Condition, ['TSDPFG','=','1']);
                // dd($Condition);

                $NamespacedModel = 'App\\Models\\' . $Model;
                $Table = $NamespacedModel::noLock()
                            ->select('TSSYCD','TSSYNM')
                            ->leftJoin('TBLDSC', 'TDDSCDIY', 'TSDSCDIY')
                            ->where($Condition)
                            ->get();

                // dd($Table);
                foreach($Table as $row) {  // Begin Looping Record ListData  
                    $ListData[] = array("label"=> rtrim($row->TSSYNM),
                                        // "icon"=> 'home',  
                                        "value"=>rtrim($row->TSSYCD)) ; 
                } // End Looping Record ListData
                // dd($ListData);

                break;
            default:
                break;
        }
        return $ListData;

    }





/*======================================================================================================================*/
/*======BEGIN CRUD======================================================================================================*/
/*======================================================================================================================*/


    function fnFillGrid($Data) {
        $Hasil = $Data;
        $Hasil = json_encode($Hasil);
        $Hasil = json_decode($Hasil, true);
        return $Hasil['original'];
    }


    function fnGenDelimiter($length = 10) {
        //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = '~`!@$^*()_-{}[]:;<>?|0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function fnGenUnikNo(&$Delimiter) {
        $Delimiter = fnGenDelimiter();
        // dd(date('Ymd_H:i:s:u _')); 
        return date('Ymd_His_').strrev($Delimiter);
    }

    function fnGetSintaxCRUD ($UserName, $AllField, $Mode, $Prefix, $Fields, $UnikNo) {

        $FinalField = array_filter( $AllField,
                            function ($key) use ($Fields) {
                                return in_array($key, $Fields);
                            },
                            ARRAY_FILTER_USE_KEY
                        );

        switch ($Mode) {
            case "1":
                $FinalField = array_merge($FinalField, array(
                                            $Prefix."DLFG"=>"0",
                                            $Prefix."RGID"=>$UserName,
                                            $Prefix."RGDT"=>Date("Y-m-d H:i:s"),
                                            $Prefix."CHID"=>$UserName,
                                            $Prefix."CHDT"=>Date("Y-m-d H:i:s"),
                                            $Prefix."CHNO"=>"0",
                                            $Prefix."CSID"=>$UserName,
                                            $Prefix."CSDT"=>Date("Y-m-d H:i:s"),
                                            $Prefix."CSNO"=>$UnikNo
                                        ));
                break;
            case "2": 
                $FinalField = array_merge($FinalField, array(
                                            $Prefix."DLFG"=>"0",
                                            $Prefix."CHID"=>$UserName,
                                            $Prefix."CHDT"=>Date("Y-m-d H:i:s"),
                                            $Prefix."CHNO"=>$AllField[$Prefix."CHNO"]+1,
                                            $Prefix."CSID"=>$UserName,
                                            $Prefix."CSDT"=>Date("Y-m-d H:i:s")
                                        ));           
                break;
            case "3":
                $FinalField = array_merge($FinalField, array(
                                            $Prefix."CHID"=>$UserName,
                                            $Prefix."CHDT"=>Date("Y-m-d H:i:s"),
                                            $Prefix."CHNO"=>"0",
                                            $Prefix."CSID"=>$UserName,
                                            $Prefix."CSDT"=>Date("Y-m-d H:i:s")
                                        ));           
                break;
            default:
                $FinalField = array_merge($FinalField, array(
                                            $Prefix."CSID"=>$UserName,
                                            $Prefix."CSDT"=>Date("Y-m-d H:i:s")
                                        ));                       
                break;
        }

        return $FinalField;
    }



    function fnCheckBFCS ($Obj) {

        if ($Obj["Mode"]!="1") { // Begin Check Change System Date
            if (is_array($Obj["Key"])) {
                $Prefix = SubStr($Obj["Key"][0],0,2);
                $Key = $Obj["Key"][0];
                $arrCondition = [];
                for ($i=1; $i < count($Obj["Key"]); $i++) {
                    array_push($arrCondition,array($Obj["Key"][$i],
                                                   '=',
                                                   $Obj["Data"][$Obj["Key"][$i]]
                                                   ));
                }
            } else {
                $Prefix = SubStr($Obj["Key"],0,2);
                $Key = $Obj["Key"];
                $arrCondition = "";
            }

            $arrCSDT = fnGetRec($Obj["Table"], 
                                $Prefix.'CSDT'.",".$Prefix.'CSID', 
                                $Key, $Obj["Data"][$Key], $arrCondition) ;
            // var_dump($arrCSDT);
            $CSDT = $Prefix.'CSDT';
            $CSID = $Prefix.'CSID';

            if ($arrCSDT->$CSDT != $Obj["Data"][$Prefix.'CSDT']) {
                return array("success"=>false, "message"=>"This Record already change by '".$arrCSDT->$CSID. "', Please refresh your data!!!");            
            }

        }  // End Check Change System Date

        if ($Obj["Menu"]!="") {  // Begin Check BackDate 
            $arrMENU = fnGetRec("TBLMNU","TMMENU,TMBFDT,TMFWDT", "TMURLW", $Obj["Menu"], "") ;


            $TGL = date('Ymd');
            $TGL_TRANS = $Obj["Data"][$Obj["FieldTransDate"]]; //"20181120";
            $diff1 = date_diff(date_create($TGL),date_create($TGL_TRANS));
            $daysdiff = $diff1->format("%R%a");
            $daysdiff = abs($daysdiff);
            if ($TGL < $TGL_TRANS) {
                if ($arrMENU->TMFWDT > $daysdiff) {
                  return array("success"=>false, "message"=>"Forward Date only ".$arrMENU->TMFWDT." days");
                } 
            } else if ($TGL > $TGL_TRANS) {
                if ($arrMENU->TMBCDT > $daysdiff) {
                  return array("success"=>false, "message"=>"Bac kDate only ".$arrMENU->TMBCDT." days");
                } 
            } 

        } // End Check BackDate

        return array("success"=>true, "message"=>"");            
    }

    function fnTBLNOR($Table, $UserName) {
        $NoIY = 1;
        $TBLNOUR = DB::table("TBLNOR")
                        ->Select(['TNTABL' , 'TNNOUR'])
                        ->where('TNTABL','=',$Table)
                        // ->where('TNTABL','=','TBLMNU')
                        ->get();
        if (count($TBLNOUR)) {
            // var_dump($TBLNOUR[0]);
            $NoIY = ($TBLNOUR[0]->TNNOUR+1);
            $TBLNOR = array("TNTABL"=>$Table,"TNNOUR"=>$NoIY);
            $FinalTBLNOR = fnGetSintaxCRUD ($UserName, $TBLNOR, '1', "TN", ['TNTABL','TNNOUR'], "" );
            DB::table('TBLNOR')
                ->where('TNTABL','=',$Table)
                ->update($FinalTBLNOR);   
        } else {
            $TBLNOR = array("TNTABL"=>$Table,"TNNOUR"=>"1");
            $FinalTBLNOR = fnGetSintaxCRUD ($UserName, $TBLNOR, '1', "TN", ['TNTABL','TNNOUR'], "" );
            DB::table('TBLNOR')
                ->insert($FinalTBLNOR);   
        }
        return $NoIY;    
    }

    function fnSetExecuteQuery ($UserName, $cm) {
        $HasilExec = null;
        try{
            DB::enableQueryLog();            
            $HasilExec = DB::transaction(function () use($UserName, $cm) {
                return App::call('\App\Http\Controllers\Forms\\'.$cm);
            });
            $QueryLog = DB::getQueryLog();
            fnSaveSqlSintax($QueryLog, $UserName);
            $BerHasil = true;
        } catch (\Exception $e){ 

            $message = $e->errorInfo[2];
            // $eCode = $e;
            $eCode = fnSaveSqlError($e, $UserName);
            // $message = $a->sql;
            $BerHasil = false;
        }        
        /*
            Jika StpXXXXX tidak Response apa apa
            maka akan masuk is_null($hasilExec)

            Jika StpXXXXX ada Responses apa apa
            maka akan pake response StpXXXXX
        */
        if (is_null($HasilExec)) {
            if ($BerHasil) {
                $Hasil = array("success"=> true, "message"=> "*** Success ***", "eCode"=>"");
                // $Hasil = array("success"=> true, "message"=> "*** Success ***");
            } else {
                $Hasil = array("success"=> false, "message"=> $message, "eCode"=>$eCode);
                // $Hasil = array("success"=> false, "message"=> $message);
            }
        } else {
            $Hasil = json_encode($HasilExec);
            $Hasil = json_decode($Hasil, true);
            $Hasil = $Hasil['original'];
        }

        return $Hasil;
    }


    function fnGetSqlSintax($QueryLog) {
        $STMT = "";
        foreach ($QueryLog as $k => $Q) {
            $sql = $Q['query'];
            $bindings = $Q['bindings'];
            // Process the query's SQL and parameters and create the exact query
            foreach ($bindings as $i => $binding) {
                if ($binding instanceof \DateTime) {
                    $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                } else {
                    if (is_string($binding)) {
                        $bindings[$i] = "'$binding'";
                    }
                }
            }
            $query = str_replace(array('%', '?'), array('%%', '%s'), $sql);
            $query = vsprintf($query, $bindings);
            $STMT .= $query.";
"; // Harus begini supaya didatabasenya ada enternya

        }        
        return $STMT;

    }

    function fnSaveSqlSintax($QueryLog, $UserName) {

        $TQSTMT = fnGetSqlSintax($QueryLog);

        $TABLE = 'App\\Models\\TBLSLF';
        $TBLSLF = new $TABLE;
        $TBLSLF->TQUSER = $UserName;
        $TBLSLF->TQSTMT = $TQSTMT;
        $TBLSLF->TQREMK = json_encode($QueryLog);
        $TBLSLF->TQRGID = 'Default';
        $TBLSLF->TQRGDT = Date("Y-m-d H:i:s");
        $TBLSLF->TQCHID = 'Default';
        $TBLSLF->TQCHDT = Date("Y-m-d H:i:s");
        $TBLSLF->TQCHNO = '0';
        $TBLSLF->TQDPFG = '1';
        $TBLSLF->TQDLFG = '0';
        $TBLSLF->TQCSID = 'Default';
        $TBLSLF->TQCSDT = Date("Y-m-d H:i:s");
        $TBLSLF->TQSRCE = 'FirstSetup';
        $TBLSLF->save();        

    }

    function fnSaveSqlError($exception, $UserName) {
        $sql = $exception->getSql();
        $bindings = $exception->getBindings();

        // Process the query's SQL and parameters and create the exact query
        foreach ($bindings as $i => $binding) {
            if ($binding instanceof \DateTime) {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } else {
                if (is_string($binding)) {
                    $bindings[$i] = "'$binding'";
                }
            }
        }
        $query = str_replace(array('%', '?'), array('%%', '%s'), $sql);
        $query = vsprintf($query, $bindings);

        // Here's the part you need
        $errorInfo = $exception->errorInfo;

        $data = [
            'sql'        => $query,
            'message'    => isset($errorInfo[2]) ? $errorInfo[2] : '',
            'sql_state'  => $errorInfo[0],
            'error_code' => $errorInfo[1]
        ];


        $TEREMK = fnGetSqlSintax(DB::getQueryLog());
        $TEREMK .= $query;

        $TABLE = 'App\\Models\\TBLELF';
        $TBLELF = new $TABLE;
        $TBLELF->TEUSER = $UserName;
        $TBLELF->TEERNO = $errorInfo[1];
        $TBLELF->TEERST = $errorInfo[0];
        $TBLELF->TEERMS = isset($errorInfo[2]) ? $errorInfo[2] : '';
        $TBLELF->TESPTR = '';
        $TBLELF->TESTMT = $query;
        $TBLELF->TEREMK = $TEREMK;
        $TBLELF->TERGID = 'Default';
        $TBLELF->TERGDT = Date("Y-m-d H:i:s");
        $TBLELF->TECHID = 'Default';
        $TBLELF->TECHDT = Date("Y-m-d H:i:s");
        $TBLELF->TECHNO = '0';
        $TBLELF->TEDPFG = '1';
        $TBLELF->TEDLFG = '0';
        $TBLELF->TECSID = 'Default';
        $TBLELF->TECSDT = Date("Y-m-d H:i:s");
        $TBLELF->TESRCE = 'FirstSetup';
        $TBLELF->save();

        return $data;
        // Now store the error into database, if you want..
        // ....
    }



/*======================================================================================================================*/
/*======END CRUD========================================================================================================*/
/*======================================================================================================================*/



