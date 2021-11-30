<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone', 30)->nullable();
            $table->string('formatted_phone', 30)->nullable();
            $table->string('carrier_code', 30)->nullable();
            $table->string('default_country', 30)->nullable();
            $table->string('password', 60);
            $table->string('profile_image', 100)->nullable();
            $table->double('balance')->default(0);
            $table->enum('status',['Active', 'Inactive'])->default('Active');            
            $table->rememberToken();
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
