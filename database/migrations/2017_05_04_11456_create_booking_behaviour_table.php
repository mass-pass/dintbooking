<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingBehaviourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('booking_behaviour');
        Schema::create('booking_behaviour', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->nullable();
            $table->integer('sender_id');
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
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
        Schema::drop('booking_behaviour');
    }
}
