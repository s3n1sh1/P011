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

            $table->integer('TDCOMSIY')->nullable(false)->comment('System Company IY');
            $table->char('TDDSCD',20)->nullable(false)->comment('Kode Deskirpsi');
            $table->char('TDDSNM',100)->nullable(true)->comment('Nama Deskirpsi');
            $table->decimal('TDLGTH')->nullable(false)->comment('Panjang Karakter');
            
            $this->AutoCreateDefaultColumns('TD', $table);

            $table->primary(['TDCOMSIY','TDDSCD']);           
            $table->foreign('TDCOMSIY')->references('SCCOMSIY')->on('SYSCOM');
           
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

