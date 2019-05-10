<?php

use Illuminate\Database\Seeder;
use App\Models\TBLDSC;
use App\Models\TBLSYS;
use App\Models\TBLNOR;

class TBLDSCTBLSYSTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $iDSC = 1;
        $iSYS = 1;

        $defaultFieldTBLDSC = [];
        $defaultFieldTBLDSC = array( "TDRGID" => 'Default',
                                     "TDRGDT" => Date("Y-m-d H:i:s"),
                                     "TDCHID" => 'Default',
                                     "TDCHDT" => Date("Y-m-d H:i:s"),
                                     "TDCHNO" => '0',
                                     "TDDPFG" => '1',
                                     "TDDLFG" => '0',
                                     "TDCSID" => 'Default',
                                     "TDCSDT" => Date("Y-m-d H:i:s"),
                                     "TDSRCE" => 'FirstSetup',
                                  );

        $defaultFieldTBLSYS = [];
        $defaultFieldTBLSYS = array( "TSRGID" => 'Default',
                                     "TSRGDT" => Date("Y-m-d H:i:s"),
                                     "TSCHID" => 'Default',
                                     "TSCHDT" => Date("Y-m-d H:i:s"),
                                     "TSCHNO" => '0',
                                     "TSDPFG" => '1',
                                     "TSDLFG" => '0',
                                     "TSCSID" => 'Default',
                                     "TSCSDT" => Date("Y-m-d H:i:s"),
                                     "TSSRCE" => 'FirstSetup',
                                  );


        $TBLDSC = new TBLDSC();
        $TBLDSC->TDDSCDIY = $iDSC++;
        $TBLDSC->TDDSCD = 'YN';
        $TBLDSC->TDDSNM = 'YESNO';
        $TBLDSC->TDLGTH = '1';
        foreach ($defaultFieldTBLDSC as $K => $D) { $TBLDSC[$K] = $D; }
        $TBLDSC->save();


        // $TBLSYS->TSSYV1 = ''; $TBLSYS->TSSYV2 = ''; $TBLSYS->TSSYV3 = '';
        // $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        // $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        // $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';

        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = '1';
        $TBLSYS->TSSYNM = 'YES';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();


        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = '0';
        $TBLSYS->TSSYNM = 'NO';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();


/*--------------------------------------------------------------*/


        $TBLDSC = new TBLDSC();
        $TBLDSC->TDDSCDIY = $iDSC++;
        $TBLDSC->TDDSCD = 'DSPLY';
        $TBLDSC->TDDSNM = 'DISPLAY';
        $TBLDSC->TDLGTH = '1';
        foreach ($defaultFieldTBLDSC as $K => $D) { $TBLDSC[$K] = $D; }
        $TBLDSC->save();


        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = '0';
        $TBLSYS->TSSYNM = 'Not Display';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();


        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = '1';
        $TBLSYS->TSSYNM = 'Display';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();


/*--------------------------------------------------------------*/

        $TBLDSC = new TBLDSC();
        $TBLDSC->TDDSCDIY = $iDSC++;
        $TBLDSC->TDDSCD = 'MODE';
        $TBLDSC->TDDSNM = 'Mode Access';
        $TBLDSC->TDLGTH = '1';
        foreach ($defaultFieldTBLDSC as $K => $D) { $TBLDSC[$K] = $D; }
        $TBLDSC->save();

        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = 'V';
        $TBLSYS->TSSYNM = 'View';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();

        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = 'A';
        $TBLSYS->TSSYNM = 'Add';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();

        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = 'E';
        $TBLSYS->TSSYNM = 'Edit';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();

        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = 'D';
        $TBLSYS->TSSYNM = 'Delete';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();

        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = 'L';
        $TBLSYS->TSSYNM = 'View List';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();

        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = 'X';
        $TBLSYS->TSSYNM = 'Export To Excel';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();

        $TBLSYS = new TBLSYS();
        $TBLSYS->TSDSCDIY = ($iDSC-1);
        $TBLSYS->TSSYCDIY = $iSYS++;
        $TBLSYS->TSSYCD = 'R';
        $TBLSYS->TSSYNM = 'Confirm / Approved';
        $TBLSYS->TSSYV1 = '0'; $TBLSYS->TSSYV2 = '0'; $TBLSYS->TSSYV3 = '0';
        $TBLSYS->TSSYT1 = ''; $TBLSYS->TSSYT2 = ''; $TBLSYS->TSSYT3 = '';
        $TBLSYS->TSLSV1 = ''; $TBLSYS->TSLSV2 = ''; $TBLSYS->TSLSV3 = '';
        $TBLSYS->TSLST1 = ''; $TBLSYS->TSLST2 = ''; $TBLSYS->TSLST3 = '';
        foreach ($defaultFieldTBLSYS as $K => $D) { $TBLSYS[$K] = $D; }
        $TBLSYS->save();

/*--------------------------------------------------------------*/

        $RunNoDSC = new TBLNOR();
        $RunNoDSC->TNTABL = 'TBLDSC';
        $RunNoDSC->TNNOUR = $iDSC;
        $RunNoDSC->TNRGID = 'Default';
        $RunNoDSC->TNRGDT = Date("Y-m-d H:i:s");
        $RunNoDSC->TNCHID = 'Default';
        $RunNoDSC->TNCHDT = Date("Y-m-d H:i:s");
        $RunNoDSC->TNCHNO = '0';
        $RunNoDSC->TNDPFG = '1';
        $RunNoDSC->TNDLFG = '0';
        $RunNoDSC->TNCSID = 'Default';
        $RunNoDSC->TNCSDT = Date("Y-m-d H:i:s");
        $RunNoDSC->TNSRCE = 'FirstSetup';        
        $RunNoDSC->save();

        $RunNoSYS = new TBLNOR();
        $RunNoSYS->TNTABL = 'TBLSYS';
        $RunNoSYS->TNNOUR = $iSYS;
        $RunNoSYS->TNRGID = 'Default';
        $RunNoSYS->TNRGDT = Date("Y-m-d H:i:s");
        $RunNoSYS->TNCHID = 'Default';
        $RunNoSYS->TNCHDT = Date("Y-m-d H:i:s");
        $RunNoSYS->TNCHNO = '0';
        $RunNoSYS->TNDPFG = '1';
        $RunNoSYS->TNDLFG = '0';
        $RunNoSYS->TNCSID = 'Default';
        $RunNoSYS->TNCSDT = Date("Y-m-d H:i:s");
        $RunNoSYS->TNSRCE = 'FirstSetup';        
        $RunNoSYS->save();

/*--------------------------------------------------------------*/


    }
}
