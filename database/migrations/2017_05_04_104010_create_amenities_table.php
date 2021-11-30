<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('amenities');

        Schema::create('amenities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('description', 100)->nullable();
            $table->string('symbol', 50);
            $table->integer('type_id')->default(0);
            $table->enum('status',['Active', 'Inactive'])->default('Active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('amenities');
    }
}
