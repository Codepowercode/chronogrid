<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('type_section')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('alt_phone_number')->nullable();
            $table->string('website')->nullable();
            $table->string('company_contact')->nullable();
            $table->longText('business_hours')->nullable();

            $table->longText('trade')->nullable();

            $table->string('iwjg_member_number')->nullable();
            $table->string('rapnet_member_number')->nullable();
            $table->string('jbt_member_number')->nullable();
            $table->string('poligon_member_number')->nullable();
            $table->boolean('tawd')->default(0);

            $table->longText('about_company')->nullable();

            $table->longText('bank_information')->nullable();

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
        Schema::dropIfExists('user_info');
    }
}
