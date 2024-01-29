<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('addressID');
            $table->datetime('order_date');
            $table->decimal('payment_total', 8, 2);
            $table->string('payment_method');
            // $table->string('shipping_method');
            $table->string('payment_status');
            $table->string('order_status');
            $table->tinyText('add_notes');
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users');
            $table->foreign('addressID')->references('id')->on('shipping_addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
