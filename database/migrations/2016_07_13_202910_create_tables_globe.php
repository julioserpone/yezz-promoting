<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesGlobe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Generar tablas countries, states y cities
        \Artisan::call('globe:populate');

        //Agregando tipo Sin Signo a campos ID de Country, State y City. Estas tablas no se generan con un migrate, sino con 'php artisan globe:populate'
        Schema::table('countries', function (Blueprint $table) {
            $table->integer('id')->unsigned()->change();
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });

        Schema::table('states', function (Blueprint $table) {
            $table->integer('id')->unsigned()->change();
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->integer('id')->unsigned()->change();
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Artisan::call('globe:drop');        
    }
}
