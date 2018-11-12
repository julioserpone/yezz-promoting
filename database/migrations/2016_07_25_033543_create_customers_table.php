<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_customer', 50);
            $table->string('surname_customer', 50);
            $table->string('store_position_customer', 15)->nullable();
            $table->string('phone_customer', 20)->nullable();
            $table->string('email_customer', 80)->nullable();;
            $table->string('address_customer', 150)->nullable();
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
        Schema::drop('customers');
    }
}
