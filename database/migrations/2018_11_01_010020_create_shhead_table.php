<?php

use App\Console\weMigrations;

class CreateSHHEADTable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SHHEAD', function ($table) {

            $table->integer('SHSHNOIY')->nullable(false)->comment('Sales HEAD IY');
            $table->char('SHSHNO',20)->nullable(false)->comment('Transaction No');
            $table->char('SHDATE',8)->nullable(true)->comment('Transaction Date');
            $table->integer('SHBPNOIY')->nullable(false)->comment('BP HEAD IY');
            $table->decimal('SHTOTL')->nullable(false)->comment('Total Amount');
            
            $this->AutoCreateDefaultColumns('SH', $table);

            $table->primary('SHSHNOIY');
            $table->unique('SHSHNO');    
            $table->foreign('SHBPNOIY')->references('BPBPNOIY')->on('MBPMAS');   
           
        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    { 
        Schema::dropIfExists('SHHEAD'); 
    } 
} 
?> 

