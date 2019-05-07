<?php

use App\Console\weMigrations;

class CreateTBLMNUTable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBLMNU', function ($table) {

            $table->integer('TMMENUIY')->nullable(false)->comment('Menu IY');
            // $table->integer('TMMENUIY')->primary()->nullable(false)->comment('Menu IY');
            $table->char('TMNOMR',20)->nullable(false)->comment('Nomor Urut');
            $table->char('TMGRUP',250)->nullable(true)->comment('Kelompok Menu');
            $table->char('TMMENU',200)->nullable(false)->comment('Menu');
            $table->longText('TMDESC')->nullable(true)->comment('Menu Deskirpsi');
            $table->char('TMSCUT',20)->nullable(true)->comment('Short Cut');
            $table->char('TMACES',20)->nullable(true)->comment('Menu Akses');
            $table->integer('TMBCDT')->nullable(true)->comment('BackDate');
            $table->integer('TMFWDT')->nullable(true)->comment('ForwardDate');
            $table->char('TMURLW',200)->nullable(true)->comment('URL');
            $table->char('TMSYFG',10)->nullable(true)->comment('System Flag');
            $table->integer('TMUSCT')->nullable(true)->comment('User Hit Count');
            $table->datetime('TMLSDT')->nullable(true)->comment('User Hit Last Date');
            $table->char('TMLSBY',50)->nullable(true)->comment('User Hit Last By');
            $table->char('TMRLDT',8)->nullable(true)->comment('Release Date');
            $table->longText('TMGRID')->nullable(true)->comment('Grid Syntax');

            $this->AutoCreateDefaultColumns('TM', $table);

            $table->primary('TMMENUIY');  
            $table->unique('TMNOMR');           

        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    { 
        Schema::dropIfExists('TBLMNU'); 
    } 
} 
?> 

