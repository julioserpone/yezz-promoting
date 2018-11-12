<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localization_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('store_id')->nullable()->unsigned();
            $table->double('longitude', 11, 8);
            $table->double('latitude', 11, 8);
            $table->dateTime('registerOn');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('store_id')->references('id')->on('branchs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('localization_log');
    }
}
