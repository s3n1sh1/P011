<?php

use App\Console\weMigrations;

class CreateTBLUAMTable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBLUAM', function ($table) {

            $table->increments('TANOMRIY')->nullable(false)->comment('IY'); // ini sudah primary karena increments
            $table->integer('TAUSERIY')->nullable(false)->comment('TBLUSR IY');
            $table->integer('TAMENUIY')->nullable(false)->comment('TBLMNU IY');
            $table->char('TAACES',20)->nullable(true)->comment('Access Menu');
            $table->datetime('TALSDT')->nullable(true)->comment('Last Date Use');
            $table->integer('TAUSCT')->nullable(true)->comment('Use Count');

            $this->AutoCreateDefaultColumns('TA', $table);

            // $table->primary(['TACOMSIY','TAUSERIY','TAMENUIY']);  
            $table->unique(array('TAUSERIY', 'TAMENUIY'));
            $table->foreign('TAUSERIY')->references('TUUSERIY')->on('TBLUSR');
            $table->foreign('TAMENUIY')->references('TMMENUIY')->on('TBLMNU');    
            // $table->foreign('TACOMSIY')->references('SCCOMSIY')->on('SYSCOM');
            // $table->foreign(array('TACOMSIY','TAUSERIY'))->references(array('TUCOMSIY','TUUSERIY'))->on('TBLUSR');  
            // $table->foreign(array('TACOMSIY','TAMENUIY'))->references(array('TMCOMSIY','TMMENUIY'))->on('TBLMNU');  
        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    {       
        Schema::dropIfExists('TBLUAM'); 
    } 
} 
?> 

