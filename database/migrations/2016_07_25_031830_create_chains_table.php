<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chain_user_id')->unsigned();
            $table->integer('chain_country_id')->unsigned()->nullable();
            $table->string('identification_chain')->nullable();
            $table->string('name_chain');
            $table->string('phone_chain', 20)->nullable();
            $table->string('email_chain', 80)->nullable();
            $table->string('address_chain', 200)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('chain_user_id')->references('id')->on('users');      //Usuario quien la registra
            $table->foreign('chain_country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chains');
    }
}
