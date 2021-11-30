<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->text('message')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('read')->default(0);
            $table->integer('archive')->default(0);
            $table->integer('star')->default(0);
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
        Schema::drop('messages');
    }
}
