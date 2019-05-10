<?php

use Illuminate\Database\Seeder;
use App\Models\TBLMNU;
use App\Models\TBLNOR;

class TBLMNUTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $i = 1;

        $defaultFieldTBLMNU = [];
        $defaultFieldTBLMNU = array( "TMRGID" => 'Default',
                                     "TMRGDT" => Date("Y-m-d H:i:s"),
                                     "TMCHID" => 'Default',
                                     "TMCHDT" => Date("Y-m-d H:i:s"),
                                     "TMCHNO" => '0',
                                     "TMDPFG" => '1',
                                     "TMDLFG" => '0',
                                     "TMCSID" => 'Default',
                                     "TMCSDT" => Date("Y-m-d H:i:s"),
                                     "TMSRCE" => 'FirstSetup',
                                  );

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '01';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'FILE';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = '';
        $TBLMNU->TMACES = '';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = '';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '0105';
        $TBLMNU->TMGRUP = 'FORM01';
        $TBLMNU->TMMENU = 'LOG FILE';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = 'FIL005';
        $TBLMNU->TMACES = 'VXL';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = 'TBLSLF';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();        

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '0110';
        $TBLMNU->TMGRUP = 'FORM01';
        $TBLMNU->TMMENU = 'ERROR LOG FILE';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = 'FIL010';
        $TBLMNU->TMACES = 'VXL';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = 'TBLELF';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();    

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '0115';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'MENU';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = 'FIL015';
        $TBLMNU->TMACES = 'VAEDXL';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = 'TBLMNU';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();    

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '0120';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'USER';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = 'FIL020';
        $TBLMNU->TMACES = 'VAEDXL';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = 'TBLUSR';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();    

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '02';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'MASTER';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = '';
        $TBLMNU->TMACES = '';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = '';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '0205';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'TABEL HEAD';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = 'MAS005';
        $TBLMNU->TMACES = 'VAEDXL';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = 'TBLDSC';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();        

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '0210';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'TABEL DETAIL';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = 'MAS010';
        $TBLMNU->TMACES = 'VAEDXL';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = 'TBLSYS';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();     

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '0215';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'ITEM';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = 'MAS015';
        $TBLMNU->TMACES = 'VAEDXL';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = 'MITMAS';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();     

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '0220';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'BISNIS PARTNER';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = 'MAS020';
        $TBLMNU->TMACES = 'VAEDXL';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = 'MBPMAS';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();  

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '11';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'TRANSACTION';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = '';
        $TBLMNU->TMACES = '';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = '';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();

        $TBLMNU = new TBLMNU();
        $TBLMNU->TMMENUIY = $i++;
        $TBLMNU->TMNOMR = '1105';
        $TBLMNU->TMGRUP = '';
        $TBLMNU->TMMENU = 'SALES';
        $TBLMNU->TMDESC = '';
        $TBLMNU->TMSCUT = 'SAL010';
        $TBLMNU->TMACES = 'VAEDXL';
        $TBLMNU->TMBCDT = '99';
        $TBLMNU->TMFWDT = '99';
        $TBLMNU->TMURLW = 'SHHEAD';
        $TBLMNU->TMSYFG = 'W';
        $TBLMNU->TMRLDT = Date("Ymd");
        $TBLMNU->TMGRID = '';
        $TBLMNU->TMREMK = '';
        foreach ($defaultFieldTBLMNU as $K => $D) { $TBLMNU[$K] = $D; }
        $TBLMNU->save();  


// ================================================================================================================
        $RunNo = new TBLNOR();
        $RunNo->TNTABL = 'TBLMNU';
        $RunNo->TNNOUR = $i;
        $RunNo->TNRGID = 'Default';
        $RunNo->TNRGDT = Date("Y-m-d H:i:s");
        $RunNo->TNCHID = 'Default';
        $RunNo->TNCHDT = Date("Y-m-d H:i:s");
        $RunNo->TNCHNO = '0';
        $RunNo->TNDPFG = '1';
        $RunNo->TNDLFG = '0';
        $RunNo->TNCSID = 'Default';
        $RunNo->TNCSDT = Date("Y-m-d H:i:s");
        $RunNo->TNSRCE = 'FirstSetup';        
        $RunNo->save();


    }
}
