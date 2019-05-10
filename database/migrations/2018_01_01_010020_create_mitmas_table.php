<?php

use App\Console\weMigrations;

class CreateMITMASTable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MITMAS', function ($table) {

            $table->integer('MMITNOIY')->nullable(false)->comment('Item HEAD IY');
            $table->char('MMITNO',20)->nullable(false)->comment('Item Code');
            $table->char('MMITNM',100)->nullable(false)->comment('Item Name');
            $table->char('MMITDS',200)->nullable(true)->comment('Item Description');
            $table->char('MMUNMS',100)->nullable(true)->comment('UNIT MEASUREMENT');
            
            $this->AutoCreateDefaultColumns('MM', $table);

            $table->primary('MMITNOIY');
            $table->unique('MMITNO');    
           
        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    { 
        Schema::dropIfExists('MITMAS'); 
    } 
} 
?> 

