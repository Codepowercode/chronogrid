<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('metal')->nullable();
            $table->string('description')->nullable()->comment('in csv client this column ( brand )');
            $table->string('description1')->nullable();
            $table->string('full_description')->nullable();
            $table->string('model_text')->nullable();
            $table->string('model_description')->nullable();
            $table->string('size')->nullable();
            $table->string('bezel_material')->nullable();
            $table->string('bezel_type')->nullable();
            $table->string('bezel_size')->nullable();
            $table->string('band_material')->nullable();
            $table->string('band_type')->nullable();
            $table->string('dial')->nullable();
            $table->string('dial_markers')->nullable();
            $table->string('retail')->nullable();
            $table->string('path')->nullable();
            $table->string('year')->nullable();
            $table->longText('hash')->nullable();
            $table->longText('json')->nullable();
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
        Schema::dropIfExists('listings');
    }
}
