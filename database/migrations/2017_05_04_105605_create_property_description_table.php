<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('property_description');
        
        Schema::create('property_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->text('summary')->nullable();
            $table->text('place_is_great_for')->nullable();
            $table->text('about_place')->nullable();
            $table->text('guest_can_access')->nullable();
            $table->text('interaction_guests')->nullable();
            $table->text('other')->nullable();
            $table->text('about_neighborhood')->nullable();
            $table->text('get_around')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('property_description');
    }
}
