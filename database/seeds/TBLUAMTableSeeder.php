<?php

use Illuminate\Database\Seeder;
use App\Models\TBLMNU;
use App\Models\TBLUSR;
use App\Models\TBLUAM;

class TBLUAMTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $u = TBLUSR::all()->toArray();
        $m = TBLMNU::all()->toArray();
        $um = [];
        foreach ($u as $uKey => $uValue) {
            $dd = $u[$uKey];
            foreach ($m as $mKey => $mValue) {
                array_push($um, $u[$uKey]+$m[$mKey]);
            }
        }

        foreach ($um as $umKey => $umValue) {
            $TBLUAM = new TBLUAM();
            // $TBLUAM->TANOMRIY = '';
            $TBLUAM->TAUSERIY = $um[$umKey]['TUUSERIY'];
            $TBLUAM->TAMENUIY = $um[$umKey]['TMMENUIY'];
            $TBLUAM->TAACES = $um[$umKey]['TMACES'];
            $TBLUAM->TARGID = 'Default';
            $TBLUAM->TARGDT = Date("Y-m-d H:i:s");
            $TBLUAM->TACHID = 'Default';
            $TBLUAM->TACHDT = Date("Y-m-d H:i:s");
            $TBLUAM->TACHNO = '0';
            $TBLUAM->TADPFG = '1';
            $TBLUAM->TADLFG = '0';
            $TBLUAM->TACSID = 'Default';
            $TBLUAM->TACSDT = Date("Y-m-d H:i:s");
            $TBLUAM->TASRCE = 'FirstSetup';
            $TBLUAM->save();
        }


    }
}
