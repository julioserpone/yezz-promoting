<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->string('username')->unique();
            $table->enum('status', array_keys(trans('globals.type_status')))->default('active');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('temp_password');
            $table->dateTime('due_date_temp_pass');
            $table->rememberToken();

            $table->foreign('person_id')->references('id')->on('persons_data');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('country_id')->references('id')->on('countries');

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
        Schema::dropIfExists('users');
    }
}
