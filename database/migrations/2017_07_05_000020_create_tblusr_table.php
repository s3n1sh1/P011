<?php

use App\Console\weMigrations;

class CreateTBLUSRTable extends weMigrations
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('TBLUSR', function ($table) {

            $table->integer('TUUSERIY')->nullable(false)->comment('User IY');
            // $table->integer('TUUSERIY')->primary()->nullable(false)->comment('User IY');
            $table->char('TUUSER',50)->nullable(false)->comment('User Login');
            $table->char('TUNAME',100)->nullable(true)->comment('User Name');
            $table->char('TUPSWD',100)->nullable(true)->comment('Password');
            $table->char('TUEMID',20)->nullable(true)->comment('Employee ID');
            $table->char('TUDEPT',100)->nullable(true)->comment('Department');
            $table->char('TUMAIL',100)->nullable(true)->comment('Mail');
            $table->longText('TUWELC')->nullable(true)->comment('Welcome Text');
            $table->boolean('TUEXPP')->nullable(true)->comment('Expired');
            $table->char('TUEXPD',8)->nullable(true)->comment('Expired Date');
            $table->integer('TUEXPV')->nullable(true)->default(((3)))->comment('Expired Value');
            $table->integer('TULGCT')->nullable(true)->default(((0)))->comment('Login Counter');
            $table->datetime('TULSLI')->nullable(true)->comment('Last Login');
            $table->datetime('TULSLO')->nullable(true)->comment('Last Logoff');
            $table->binary('TUFOTO')->nullable(true)->comment('Avatar');

            $this->AutoCreateDefaultColumns('TU', $table);

            $table->primary('TUUSERIY');  
            $table->unique('TUUSER');           
        }); 

    } 
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    {  
        Schema::dropIfExists('TBLUSR'); 
    } 
} 
?> 

