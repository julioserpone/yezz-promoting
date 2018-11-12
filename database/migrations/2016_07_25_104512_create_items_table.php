<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('purchase_price', 10, 2)->default(0)->nullable();
            $table->decimal('sale_price', 10, 2)->default(0)->nullable();       //Sale price to client
            $table->integer('stock')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branchs');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
