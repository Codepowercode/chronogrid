<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('serial_number');
            $table->string('brand');
            $table->text('description');
            $table->string('model_number');
            $table->string('model');
            $table->string('color');
            $table->string('size');
            $table->string('metal');
            $table->string('condition');
            $table->string('more_condition');
            $table->string('year');
            $table->string('bezel_size');
            $table->string('bezel_type');
            $table->string('bezel_metal');
            $table->longText('bracelet_type')->nullable();
            $table->string('band')->nullable();
            $table->string('dial_type');
            $table->text('note')->nullable();
            $table->string('price');
            $table->bigInteger('min_offer_price');
            $table->string('quantity')->nullable();
            $table->string('shipping')->nullable()->comment('seller or buyer');
            $table->boolean('excel')->default(0)->nullable();
            $table->boolean('auction')->default(0);
            $table->string('auction_price')->nullable();
            $table->string('auction_min_bid')->nullable();
            $table->timestamp('auction_start')->nullable();
            $table->timestamp('auction_end')->nullable();
            $table->boolean('auction_status_finish')->default(0)->comment('if auction finished this product hide status (1)');
            $table->boolean('status')->default(1)->comment('show product (1)');
            $table->boolean('blocked_product')->default(1)->comment('blocked product, don`t show (0)');
            $table->string('status_position')->nullable();
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
        Schema::dropIfExists('products');
    }
}
