<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('is_customer')->nullable();
            $table->boolean('has_pop')->nullable();
            $table->string('comments')->nullable();

            $table->integer('type_id')->nullable()->unsigned();
            $table->integer('chain_id')->nullable()->unsigned();
            $table->integer('country_id')->nullable()->unsigned();
            $table->integer('state_id')->nullable()->unsigned();
            $table->integer('city_id')->nullable()->unsigned();
            $table->integer('township_id')->nullable()->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->integer('contact_id')->nullable()->unsigned();
            $table->foreign('type_id')->references('id')->on('type_channels');
            $table->foreign('chain_id')->references('id')->on('chains');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('township_id')->references('id')->on('townships');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('contact_id')->references('id')->on('customers');

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
        Schema::dropIfExists('branchs');
    }
}
