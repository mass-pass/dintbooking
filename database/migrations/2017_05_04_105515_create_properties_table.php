<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('properties');
        
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('url_name', 100)->nullable();
            $table->integer('host_id');
            $table->tinyInteger('bedrooms')->nullable();
            $table->tinyInteger('beds')->nullable();
            $table->integer('bed_type')->unsigned()->nullable();
            $table->float('bathrooms')->nullable();
            $table->string('amenities')->nullable();
            $table->integer('property_type')->default(0);
            $table->integer('space_type')->default(0);
            $table->tinyInteger('accommodates')->nullable();
            $table->enum('booking_type',['instant', 'request'])->default('request');
            $table->string('cancellation', 50)->default('Flexible');
            $table->enum('status',['Unlisted', 'Listed'])->default('Unlisted');
            $table->tinyInteger('recomended')->nullable();
            $table->softDeletes();      
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
        Schema::drop('properties');
    }
}
