<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->bigInteger('rating')->default(0);
            $table->string('reset_password_code')->nullable();
            $table->rememberToken();
            $table->string('company')->default(0)->comment('company or user');
            $table->string('company_id')->nullable()->comment('this table id where company column true, from members');
            $table->string('blocked_subscription')->default(0);
            $table->string('login_blocked')->default(1);
            $table->string('blocked')->default(0);
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->foreign('subscription_id')->references('id')->on('subscription')->nullOnDelete();
            $table->timestamp('subscription_start')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('users');
    }
}
