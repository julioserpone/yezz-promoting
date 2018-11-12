<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('identity_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthdate');
            $table->mediumText('description');
            $table->string('pic_url', 150)->nullable();
            $table->enum('gender', array_keys(trans('globals.gender')))->default('male');
            $table->enum('language', array_keys(trans('globals.language')))->default('es');
            $table->mediumText('address')->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons_data');
    }
}
