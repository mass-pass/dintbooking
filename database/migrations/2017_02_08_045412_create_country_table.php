<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('country');
        
        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_name',5)->unique();
            $table->string('name',100);
            $table->string('iso3',10)->nullable();
            $table->string('number_code',10)->nullable();
            $table->string('phone_code',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('country');
    }
}
