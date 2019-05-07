<?php

use Illuminate\Database\Seeder;
use App\Models\TBLUSR;
use App\Models\TBLNOR;

class TBLUSRTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $iUSER = 1;


        $Admin = new TBLUSR();
        $Admin->TUUSERIY = $iUSER++;
        $Admin->TUUSER = 'ADMIN';
        $Admin->TUNAME = 'ADMINISTRATOR';
        $Admin->TUPSWD = '0ebcc77dc72360d0eb8e9504c78d38bd';
        $Admin->TURGID = 'Default';
        $Admin->TURGDT = Date("Y-m-d H:i:s");
        $Admin->TUCHID = 'Default';
        $Admin->TUCHDT = Date("Y-m-d H:i:s");
        $Admin->TUCHNO = '0';
        $Admin->TUDPFG = '1';
        $Admin->TUDLFG = '0';
        $Admin->TUCSID = 'Default';
        $Admin->TUCSDT = Date("Y-m-d H:i:s");
        $Admin->TUSRCE = 'FirstSetup';
        $Admin->save();

        $DemoUser = new TBLUSR();
        $DemoUser->TUUSERIY = $iUSER++;
        $DemoUser->TUUSER = 'DEMO';
        $DemoUser->TUNAME = 'USER DEMO';
        $DemoUser->TUPSWD = 'DEMO';
        $DemoUser->TURGID = 'Default';
        $DemoUser->TURGDT = Date("Y-m-d H:i:s");
        $DemoUser->TUCHID = 'Default';
        $DemoUser->TUCHDT = Date("Y-m-d H:i:s");
        $DemoUser->TUCHNO = '0';
        $DemoUser->TUDPFG = '1';
        $DemoUser->TUDLFG = '0';
        $DemoUser->TUCSID = 'Default';
        $DemoUser->TUCSDT = Date("Y-m-d H:i:s");
        $DemoUser->TUSRCE = 'FirstSetup';
        $DemoUser->save();

        $RunNo = new TBLNOR();
        $RunNo->TNTABL = 'TBLUSR';
        $RunNo->TNNOUR = $iUSER;
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
