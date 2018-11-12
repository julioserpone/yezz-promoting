<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_users', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date');

            $table->integer('user_id')->unsigned();
            $table->integer('route_id')->unsigned();
 
            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->softDeletes();
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
        Schema::dropIfExists('route_users');
    }
}
