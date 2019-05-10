<?php

use App\Console\weMigrations;

class CreateSHLINETable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SHLINE', function ($table) {

            $table->integer('SLSLNOIY')->nullable(false)->comment('Sales LINE  IY');
            $table->integer('SLSLNO')->nullable(false)->comment('Nomor Urut');
            $table->integer('SLSHNOIY')->nullable(false)->comment('Sales HEAD IY');
            $table->integer('SLITNOIY')->nullable(false)->comment('Item HEAD IY');
            $table->decimal('SLQTYS')->nullable(false)->comment('Qty');
            $table->decimal('SLHARG')->nullable(false)->comment('Harga');
            $table->decimal('SLTOTL')->nullable(false)->comment('Total Line Amount');
            
            $this->AutoCreateDefaultColumns('SL', $table);

            $table->primary('SLSLNOIY');
            $table->unique(['SLSHNOIY','SLSLNO']);    
            $table->foreign('SLSHNOIY')->references('SHSHNOIY')->on('SHHEAD');   
            $table->foreign('SLITNOIY')->references('MMITNOIY')->on('MITMAS');   
           
        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    { 
        Schema::dropIfExists('SHLINE'); 
    } 
} 
?> 

