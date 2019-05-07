<?php

use App\Console\weMigrations;

class CreateTBLSYSTable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBLSYS', function ($table) {

            $table->integer('TSSYCDIY')->nullable(false)->comment('Table Detail IY');
            $table->integer('TSDSCDIY')->nullable(false)->comment('Table Head IY');
            $table->char('TSSYCD',20)->nullable(false)->comment('Kode');
            $table->char('TSSYNM',200)->nullable(true)->comment('Deskirpsi');
            $table->decimal('TSSYV1')->nullable(true)->comment('Value 1');
            $table->decimal('TSSYV2')->nullable(true)->comment('Value 2');
            $table->decimal('TSSYV3')->nullable(true)->comment('Value 3');
            $table->longText('TSSYT1')->nullable(true)->comment('Text 1');
            $table->longText('TSSYT2')->nullable(true)->comment('Text 2');
            $table->longText('TSSYT3')->nullable(true)->comment('Text 3');
            $table->char('TSLSV1',200)->nullable(true)->comment('Label Value 1');
            $table->char('TSLSV2',200)->nullable(true)->comment('Label Value 2');
            $table->char('TSLSV3',200)->nullable(true)->comment('Label Value 3');
            $table->char('TSLST1',200)->nullable(true)->comment('Label Text 1');
            $table->char('TSLST2',200)->nullable(true)->comment('Label Text 2');
            $table->char('TSLST3',200)->nullable(true)->comment('Label Text 3');
            
            $this->AutoCreateDefaultColumns('TS', $table);

            $table->primary('TSSYCDIY');  
            $table->unique(['TSDSCDIY','TSSYCD']);    
            $table->foreign('TSDSCDIY')->references('TDDSCDIY')->on('TBLDSC');     
            // $table->foreign('TSCOMSIY')->references('TDCOMSIY')->on('TBLDSC');      
            // $table->foreign(array('TSCOMSIY','TSDSCD'))->references(array('TDCOMSIY','TDDSCD'))->on('TBLDSC');     
        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    { 
        Schema::dropIfExists('TBLSYS'); 
    } 
} 
?> 

