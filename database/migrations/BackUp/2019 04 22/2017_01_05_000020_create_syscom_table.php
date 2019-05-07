<?php

use App\Console\weMigrations;

class CreateSYSCOMTable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('SYSCOM', function ($table) {

            $table->integer('SCCOMSIY')->primary()->nullable(false)->comment('System Company IY');
            $table->char('SCCODE',50)->nullable(false)->comment('System Company Code');
            $table->char('SCNAME',100)->nullable(true)->comment('System Company Name');
            $table->longText('SCDESC')->nullable(true)->comment('System Company Description');

            $this->AutoCreateDefaultColumns('SC', $table);

            $table->unique('SCCODE');           
        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    {  
        Schema::dropIfExists('SYSCOM'); 
    } 
} 
?> 

