<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->id();
            $table->string('boat_type');
            $table->unsignedInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('city');
            $table->string('harbour');
            $table->string('harbour_other');
            $table->boolean('is_owner_professional')->default(0);
            $table->string('manufacturer');
            $table->string('model');
            $table->boolean('is_rented_with_captain')->default(0);
            $table->string('name');
            $table->string('title');
            $table->text('descripton');
            $table->integer('authorised_onboard_capacity');
            $table->integer('recommended_onboard_capacity');
            $table->integer('cabin_count');
            $table->integer('berth_count');
            $table->integer('bathroom_count');
            $table->integer('length');
            $table->integer('fuel_consumption_ga_h');
            $table->integer('speed_km_h');
            $table->integer('year_of_construction');
            $table->integer('year_of_renovation');
            $table->double('insurance_security_deposit');
            $table->text('insurance_certificate_file');
            $table->boolean('is_insured')->default(0);
            $table->double('price');
            $table->json('languages');
            $table->json('photos');
            $table->json('amenities');

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
        Schema::dropIfExists('boats');
    }
}
