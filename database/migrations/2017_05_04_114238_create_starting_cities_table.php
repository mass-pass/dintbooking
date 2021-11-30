<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStartingCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starting_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('image', 100)->nullable();
            $table->enum('status', ['Active','Inactive'])->default('Active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('starting_cities');
    }
}
