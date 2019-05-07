<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(SYSCOMTableSeeder::class);
        $this->call(TBLUSRTableSeeder::class);
        $this->call(TBLMNUTableSeeder::class);
        $this->call(TBLUAMTableSeeder::class);
        $this->call(TBLDSCTBLSYSTableSeeder::class);
        
    }
}
