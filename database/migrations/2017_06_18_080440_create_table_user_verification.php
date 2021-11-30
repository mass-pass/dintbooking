<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserVerification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users_verification');
        
        Schema::create('users_verification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->enum('email', ['yes', 'no'])->default('no');
            $table->enum('facebook', ['yes', 'no'])->default('no');
            $table->enum('google', ['yes', 'no'])->default('no');
            $table->enum('linkedin', ['yes', 'no'])->default('no');
            $table->enum('phone', ['yes', 'no'])->default('no');
            $table->string('fb_id', 50)->nullable();
            $table->string('google_id', 50)->nullable();
            $table->string('linkedin_id', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_verification');
    }
}
