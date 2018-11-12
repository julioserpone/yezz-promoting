<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*Todas las acciones de un usuario en una determinada session*/
        Schema::create('logs_action', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('log_session_id')->unsigned();
            $table->text('description');

            $table->foreign('log_session_id')->references('id')->on('logs_session');
            
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
        Schema::dropIfExists('logs_action');
    }
}
