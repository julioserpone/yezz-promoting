<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Registro de las sessiones del usuario*/
        Schema::create('logs_session', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();        
            $table->string('serial'); 
            $table->mediumText('devices'); 
            $table->enum('status',array_keys(trans('globals.type_status')))->default('active');        

            $table->foreign('user_id')->references('id')->on('users');       
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs_session');
    }
}
