<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('productID');
            $table->integer('qty');
            $table->decimal('price_subtotal', 8, 2);
            // $table->decimal('price_total', 8, 2);
            $table->boolean('chosen')->default(false);
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users');
            $table->foreign('productID')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
