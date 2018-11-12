<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
        //Used for translations
        Schema::create('type_channel_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('type_channel_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['type_channel_id','locale']);
            $table->foreign('type_channel_id')->references('id')->on('type_channels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_channel_translations');
        Schema::dropIfExists('type_channels');
    }
}
