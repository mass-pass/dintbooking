<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutsAndUnitsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('property_layouts');
        Schema::dropIfExists('property_units');
        Schema::dropIfExists('prices');

        Schema::create('property_layouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->unsignedInteger('property_type_id');
            $table->foreign('property_type_id')->references('id')->on('property_type')->onDelete('cascade');

            $table->integer('max_occupancy')->nullable();
            $table->integer('max_occupancy_adults')->nullable();
            $table->integer('max_occupancy_children')->nullable();
            $table->json('beds');
            $table->json('bathrooms');
            $table->json('pricing');
            $table->integer('number_of_units');
            $table->integer('number_of_bathrooms');
            $table->integer('floor_level')->nullable();
            $table->integer('no_of_floors')->nullable();
            $table->unsignedInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('property_units', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_layout_id');
            $table->foreign('property_layout_id')->references('id')->on('property_layouts')->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('priceable_type');
            $table->integer('priceable_id');
            $table->string('category');
            $table->double('amount')->default(0);
            $table->text('comments');
            $table->string('currency_code',10)->nullable();
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
        Schema::dropIfExists('property_layouts');
        Schema::dropIfExists('property_units');
        Schema::dropIfExists('prices');
    }
}
