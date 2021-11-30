<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('property_address');
        
        Schema::create('property_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('latitude',50)->nullable();
            $table->string('longitude',50)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('country',5)->nullable();
            $table->string('postal_code',25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('property_address');
    }
}
