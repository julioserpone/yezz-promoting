<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code');
            $table->mediumText('description')->nullable();
            $table->string('type')->default('opened');
            $table->timestamps();
        });

        Schema::create('devices_translations', function(Blueprint $table){
            $table->increments('id');

            $table->integer('device_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['device_id','locale']);
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices_translations');
        Schema::dropIfExists('devices');
    }
}
