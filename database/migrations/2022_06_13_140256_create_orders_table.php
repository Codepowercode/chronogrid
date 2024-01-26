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
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->foreign('seller_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->foreign('offer_id')->references('id')->on('order_offers')->nullOnDelete();
            $table->string('quantity')->default('1');
            $table->string('price');
            $table->string('original_price')->nullable();
            $table->string('type')->nullable();
            $table->string('track_number')->nullable();
            $table->string('delivery');
            $table->longText('history')->nullable();
            $table->string('pdf')->nullable();
            $table->string('shipping')->nullable()->comment('buyer or seller');
            $table->boolean('auction')->default(0);
            $table->string('transfer_status')->nullable();
            $table->string('status')->default(0)->comment('cancel product in 24h');
            $table->bigInteger('canceled_user_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
