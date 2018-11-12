<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Registro de actividades de los usuarios*/
        Schema::create('logs_activity_branch', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();        
            $table->integer('branch_id')->unsigned();
            $table->string('comment', 250)->nullable();
            $table->dateTime('entry_time');
            $table->dateTime('departure_time');
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branchs');
            
            $table->timestamps();
        });

        Schema::create('logs_activity_branch_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('log_activity_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('product_id_reference')->unsigned()->nullable();    //Id del producto al cual hace competencia
            $table->text('product_features')->nullable();
            $table->smallInteger('stock')->nullable();;
            $table->smallInteger('exhibition')->nullable();
            $table->smallInteger('sales')->nullable();
            $table->decimal('purchase_price', 10, 2)->default(0)->nullable();
            $table->decimal('sale_price', 10, 2)->default(0)->nullable();       //Sale price to client
            $table->text('old_item_id')->nullable()->comment('Para evitar el duplicado');   //posiblemente sea eliminado
            
            $table->foreign('log_activity_id')->references('id')->on('logs_activity_branch');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_id_reference')->references('id')->on('products');
            
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
        Schema::dropIfExists('logs_activity_branch_items');
        Schema::dropIfExists('logs_activity_branch');
    }
}
