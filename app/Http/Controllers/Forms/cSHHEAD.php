<?php
namespace App\Http\Controllers\Forms;

use App\Http\Controllers\cWeController; //as cWeController
use Illuminate\Http\Request;
use App\Models\SHHEAD;
use App\Models\SHLINE;
use DB;

class cSHHEAD extends cWeController {

    private $GridObj = [];
    private $GridFilter = [];
    private $GridSort = [];
    private $GridColumns = [];

    public function LoadGrid(Request $request) {

        fnCrtColGrid($this->GridObj, "act", 1, 0, '', 'ACTION', 'Action', 50);
        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'SHSHNOIY', 'IY', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'SHSHNO', 'Transaction No', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'SHDATE', 'Date', 100);
        fnCrtColGrid($this->GridObj, "num", 1, 1, '', 'SHTOTL', 'Total Amount', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'SHREMK', 'Remark', 100);
        fnCrtColGridDefault($this->GridObj, "SH");

        $this->GridFilter = [];
        $this->GridSort = [];
        $this->GridSort[] = array('name'=>'SHSHNO','direction'=>'asc');
        $this->GridColumns = [];

        $SHHEAD = SHHEAD::noLock()
                ->where([
                    ['SHDLFG', '=', '0'],
                  ]);

        $SHHEAD = fnQuerySearchAndPaginate($request, $SHHEAD, 
                                           $this->GridObj, 
                                           $this->GridSort, 
                                           $this->GridFilter, 
                                           $this->GridColumns);

        $Hasil = array( "Data"=> $SHHEAD,
                        "Column"=> $this->GridColumns,
                        "Sort"=> $this->GridSort,
                        "Filter"=> $this->GridFilter,
                        "Key"=> 'SHSHNOIY');
        // dd($Hasil);
        return response()->jSon($Hasil);     

    }


    private $FormObj = [];

    public function FormObject(Request $request) {

        fnCrtObjTxt($this->FormObj, 0, "FF", "3", "Panel1", "SHSHNOIY", "IY", "", false);
        fnCrtObjTxt($this->FormObj, 1, "FF", "3", "Panel1", "SHSHNO", "Transaction No", "", false);
        fnCrtObjDtp($this->FormObj, 1, "FF", "2", "Panel1", "SHDATE", "Transaction Date", "", true);         
        fnCrtObjPop($this->FormObj, 1, "FF", "2", "Panel1", "SHBPNOIY", "BPBPNO", "BPNAME", "Customer", "", true, "MBPMAS", true, 1);
        fnCrtObjNum($this->FormObj, 1, "FF", "3", "Panel1", "SHTOTL", "Total Amount", "", false, 0, "","IDR", 1);
        fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel1", "SHREMK", "Remark", "", false, 100);

        fnCrtObjGrd($this->FormObj, 1, "XX", "0", "Panel5", "SHLINE", "Detail Sales", true
                            , "AEDL", "SHHEAD", "LoadSHLINE");
            // fnUpdObj($this->FormObj, "SHREMK", array("Helper"=>'Terserah anda mau isi apa?'));

        // fnCrtObjTxt($this->FormObj, 1, "FF", "0", "Panel1", "SHDATE", "Description", "", true, 0, 0, "", "Awal", "Akhir");
        // fnCrtObjNum($this->FormObj, 1, "FF", "0", "Panel1", "SHBPNOIY", "Length Character", "", false, 2, "Num"," Char", 1, 1, 99);
        // fnCrtObjRmk($this->FormObj, 1, "FF", "0", "Panel1", "SHREMK", "Remark", "Everything You Want", false, 100);
        //     fnUpdObj($this->FormObj, "SHREMK", array("Helper"=>'Terserah anda mau isi apa?'));

        fnCrtObjDefault($this->FormObj,"SH");    
        // dd($this->FormObj);

        return response()->jSon($this->FormObj);   
    }


    public function FillForm(Request $request) {
        $this->FormObject($request);
        $FillFormObject = $this->getFormObject($this->FormObj);
        // dd($FillFormObject);

        $SHHEAD = SHHEAD::noLock()
                ->select( $FillFormObject )
                ->leftJoin('MBPMAS', 'BPBPNOIY', 'SHBPNOIY')
                ->where([
                    ['SHSHNOIY', '=', $request->SHSHNOIY],
                    // ['SHSHNOIY', '=', '1'],
                  ])->get();
        // dd($SHHEAD);

        $SHHEAD[0]['SHLINE'] = fnFillGrid($this->LoadSHLINE($request));
        $Hasil = $this->setFillForm(true, $SHHEAD, "");
        // dd($Hasil);
        return response()->jSon($Hasil);        

    }   



    private $FormObjDetail = [];

    public function FormObjectDetail(Request $request) {

        fnCrtObjTxt($this->FormObjDetail, 0, "FF", "3", "Panel11", "SLSLNOIY", "Line IY", "", false);
        fnCrtObjTxt($this->FormObjDetail, 0, "FF", "3", "Panel11", "SLSHNOIY", "Head IY", "", false);
        fnCrtObjTxt($this->FormObjDetail, 0, "FF", "3", "Panel11", "SLITNOIY", "Item IY", "", false);
        fnCrtObjPop($this->FormObjDetail, 1, "FF", "2", "Panel11", "SLITNOIY", "MMITNO", "MMITDS", "Item", "", true, "MITMAS", true, 1);
        fnCrtObjNum($this->FormObjDetail, 1, "FF", "0", "Panel11", "SLQTYS", "Qty", "", false, 0, "","", 1);
        fnCrtObjNum($this->FormObjDetail, 1, "FF", "0", "Panel11", "SLHARG", "Harga", "", false, 0, "","IDR", 1);
        fnCrtObjNum($this->FormObjDetail, 1, "FF", "3", "Panel11", "SLTOTL", "Total", "", false, 0, "","IDR", 1);
        fnCrtObjRmk($this->FormObjDetail, 1, "FF", "0", "Panel11", "SLREMK", "Remark", "", false, 100);
            // fnUpdObj($this->FormObj, "SHREMK", array("Helper"=>'Terserah anda mau isi apa?'));


        return response()->jSon($this->FormObjDetail);   
    }

    public function LoadSHLINE(Request $request) {


        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'SLSLNOIY', 'Line IY', 100);
        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'SLSHNOIY', 'Head IY', 100);
        fnCrtColGrid($this->GridObj, "hdn", 1, 1, '', 'SLITNOIY', 'Item IY', 100);
        // fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'SLSLNO', 'Nomor', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'MMITNO', 'Item Code', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 0, '', 'MMITDS', 'Item Name', 100);
        fnCrtColGrid($this->GridObj, "num", 1, 1, '', 'SLQTYS', 'Qty', 100);
        fnCrtColGrid($this->GridObj, "num", 1, 1, '', 'SLHARG', 'Harga', 100);
        fnCrtColGrid($this->GridObj, "num", 1, 1, '', 'SLTOTL', 'Total', 100);
        fnCrtColGrid($this->GridObj, "txt", 1, 1, '', 'SLREMK', 'Remark', 100);

        fnCrtColGrid($this->GridObj, "act", 1, 0, '', 'ACTION', 'Action', 50);
        // fnCrtColGridDefault($this->GridObj, "TU");

        $this->GridFilter = [];
        $this->GridSort = [];
        $this->GridSort[] = array('name'=>'SLSLNOIY','direction'=>'asc');
        $this->GridColumns = [];

        $SHLINE = SHLINE::noLock()
                ->leftJoin('MITMAS','MMITNOIY','SLITNOIY')
                ->where([
                    ['SLDLFG', '=', '0'],
                    ['SLSHNOIY', '=', $request->SHSHNOIY],
                  ]);

        $SHLINE = fnQuerySearchAndPaginate($request, $SHLINE, 
                                           $this->GridObj, 
                                           $this->GridSort, 
                                           $this->GridFilter, 
                                           $this->GridColumns);

        $Hasil = array( "Data"=> $SHLINE,
                        "Column"=> $this->GridColumns,
                        "Sort"=> $this->GridSort,
                        "Filter"=> $this->GridFilter,
                        "Key"=> 'SLSLNOIY');
        // dd($Hasil);
        return response()->jSon($Hasil);     

    }


    public function SaveData (Request $request) {


        // $Hasil = fnSetExecuteQuery($SqlStm,$Delimiter);    
        $Hasil = $this->doExecuteQuery2( $request->AppUserName, "cSHHEAD@StpSHHEAD");  
        // $Hasil->message = ""; 
        // $Hasil = array("success"=> $BerHasil, "message"=> " Sukses... ".$message.$b);
        return response()->jSon($Hasil);

    }


    public function StpSHHEAD(Request $request) {


        $fSHHEAD = json_encode($request->frmSHHEAD);
        $fSHHEAD = json_decode($fSHHEAD, true);

        $Delimiter = "";
        $UnikNo = fnGenUnikNo($Delimiter);

        $HasilCheckBFCS = fnCheckBFCS (
                            array("Table"=>"SHHEAD", 
                                  "Key"=>"SHSHNOIY", 
                                  "Data"=>$fSHHEAD, 
                                  "Mode"=>$request->Mode,
                                  "Menu"=>"", 
                                  "FieldTransDate"=>""));
        if (!$HasilCheckBFCS["success"]) {
            return response()->jSon($HasilCheckBFCS);
        }

        $UserName = $request->AppUserName;

        switch ($request->Mode) {
            case "1":
                $NO = DB::Table('SHHEAD')->max('SHSHNOIY');
                $fSHHEAD['SHSHNO'] = 'SALES/'.substr('0000000'.($NO+1),-6);
                // $fSHHEAD['SHSHNO'] = 'SALES/000025';

                $fSHHEAD['SHSHNOIY'] = fnTBLNOR('SHHEAD', $UserName);
                $FinalField = fnGetSintaxCRUD ($UserName, $fSHHEAD, 
                    '1', "SH", 
                    ['SHSHNOIY','SHSHNO','SHDATE','SHBPNOIY','SHTOTL','SHREMK'], 
                    $UnikNo );
                DB::table('SHHEAD')->insert($FinalField);


                $DataDetail = $fSHHEAD['SHLINE']; 
                foreach($DataDetail as $key => $value) {
                    $fSHLINE = $DataDetail[$key];
                    $fSHLINE['SLSLNO'] = $key;
                    $fSHLINE['SLSHNOIY'] = $fSHHEAD['SHSHNOIY'];
                    $fSHLINE['SLSLNOIY'] = fnTBLNOR('SHLINE', $UserName);
                    $FinalField = fnGetSintaxCRUD ($UserName, $fSHLINE, 
                        '1', "SL", 
                        ['SLSLNOIY','SLSLNO','SLSHNOIY','SLITNOIY','SLQTYS','SLHARG','SLTOTL','SLREMK'], 
                        $UnikNo );
                    DB::table('SHLINE')->insert($FinalField);
                } 

                break;
            case "2":
                $FinalField = fnGetSintaxCRUD ($UserName, $fSHHEAD, 
                    '2', "SH", 
                    ['SHDATE','SHBPNOIY','SHTOTL','SHREMK'], 
                    $UnikNo );
                DB::table('SHHEAD')
                    ->where(['SHSHNOIY','=',$fSHHEAD['SHSHNOIY']])                    
                    ->update($FinalField);

                DB::table('SHLINE')
                    ->where(['SLSHNOIY','=',$fSHHEAD['SHSHNOIY']])      
                    ->delete();

                $DataDetail = $fSHHEAD['SHLINE']; 
                foreach($DataDetail as $key => $value) {
                    $fSHLINE = $DataDetail[$key];
                    $fSHLINE['SLSHNOIY'] = $fSHHEAD['SHSHNOIY'];
                    $fSHLINE['SLSLNOIY'] = fnTBLNOR('SHLINE', $UserName);
                    $FinalField = fnGetSintaxCRUD ($UserName, $fSHLINE, 
                        '1', "SL", 
                        ['SLSLNOIY','SLSLNO','SLSHNOIY','SLITNOIY','SLQTYS','SLHARG','SLTOTL','SLREMK'], 
                        $UnikNo );
                    DB::table('SHLINE')->insert($FinalField);
                } 


                break;
            case "3":
                DB::table('SHLINE')
                    ->where('SLSHNOIY','=',$fSHHEAD['SHSHNOIY'])      
                    ->delete();
                DB::table('SHHEAD')
                    ->where('SHSHNOIY','=',$fSHHEAD['SHSHNOIY'])      
                    ->delete();
                break;
        }


    }


    public function LoadGridXXXX(Request $request) {
        echo "Masuk<br>";


        $SHHEAD = SHHEAD::noLock()
                ->where([
                    ['SHDLFG', '=', '0'],
                  ])
                ->get();
        return response()->jSon($SHHEAD);  

        $SHHEAD = SHHEAD::noLock()
                ->where([
                    ['SHDLFG', '=', '0'],
                  ])
                ->get()->first()->tblsys;
        

    // public function scopeGetTableColumns() {
    //     return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    // }  

        $ABC = SHHEAD::getConnection()->get();
        dd($ABC);

        foreach ($SHHEAD as $key => $value) {
            # code...
            echo $key; echo $value; echo "<br>";
            print_r($SHHEAD[$key]);
            echo "<hr>";

            foreach ($SHHEAD[$key]->toArray() as $k => $v) {
                echo $k."-".$v." (".getType($v).") "; echo "<br>";
            }
        }
        echo "<hr>";
        $SHHEAD = SHHEAD::noLock()->find(1);
        echo $SHHEAD;

        echo "<hr>";
        $SHHEAD = SHHEAD::noLock()->get();
        dd($SHHEAD);

        return $SHHEAD;

        return response()->jSon($SHHEAD);    

    }

}
