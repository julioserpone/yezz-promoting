<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_datas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('data');
            $table->enum('type',array_keys(trans('profile.arrayContact')));
            $table->string('origin');

            $table->integer('source_id')->unsigned();
            
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
        Schema::dropIfExists('contact_datas');
    }
}
