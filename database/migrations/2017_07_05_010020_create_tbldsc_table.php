<?php

use App\Console\weMigrations;

class CreateTBLDSCTable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBLDSC', function ($table) {

            $table->integer('TDDSCDIY')->nullable(false)->comment('Table HEAD IY');
            $table->char('TDDSCD',20)->nullable(false)->comment('Kode Deskirpsi');
            $table->char('TDDSNM',100)->nullable(true)->comment('Nama Deskirpsi');
            $table->decimal('TDLGTH')->nullable(false)->comment('Panjang Karakter');
            
            $this->AutoCreateDefaultColumns('TD', $table);

            $table->primary('TDDSCDIY');
            $table->unique('TDDSCD');    
           
        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    { 
        Schema::dropIfExists('TBLDSC'); 
    } 
} 
?> 

