<?php

use App\Console\weMigrations;

class CreateMBPMASTable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MBPMAS', function ($table) {

            $table->integer('BPBPNOIY')->nullable(false)->comment('BP HEAD IY');
            $table->char('BPBPNO',20)->nullable(false)->comment('BP CODE'); // BP --> CUSTOMER SUPPLIER
            $table->char('BPNAME',100)->nullable(true)->comment('BP NAME');
            $table->longText('BPADDR')->nullable(false)->comment('BP ADDRESS');
            
            $this->AutoCreateDefaultColumns('BP', $table);

            $table->primary('BPBPNOIY');
            $table->unique('BPBPNO');    
           
        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    { 
        Schema::dropIfExists('MBPMAS'); 
    } 
} 
?> 

