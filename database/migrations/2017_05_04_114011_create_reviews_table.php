<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('reviews');
        
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->integer('booking_id');
            $table->integer('property_id');
            $table->enum('reviewer',['guest', 'host']);
            $table->text('message')->nullable();
            $table->text('secret_feedback')->nullable();
            $table->text('comments')->nullable();
            $table->text('improve_message')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('accuracy')->nullable();
            $table->text('accuracy_message')->nullable();
            $table->integer('location')->nullable();
            $table->text('location_message')->nullable();
            $table->integer('communication')->nullable();
            $table->text('communication_message')->nullable();
            $table->integer('checkin')->nullable();
            $table->text('checkin_message')->nullable();
            $table->integer('cleanliness')->nullable();
            $table->text('cleanliness_message')->nullable();
            $table->integer('amenities')->nullable();
            $table->text('amenities_message')->nullable();
            $table->integer('value')->nullable();
            $table->text('value_message')->nullable();
            $table->integer('house_rules')->nullable();
            $table->integer('recommend')->nullable();
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
        Schema::drop('reviews');
    }
}
