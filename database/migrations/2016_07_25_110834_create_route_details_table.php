<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('route_id')->unsigned();
            $table->integer('branch_id')->unsigned();

            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('branch_id')->references('id')->on('branchs');

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
        Schema::dropIfExists('route_details');
    }
}
