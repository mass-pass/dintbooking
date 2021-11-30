<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisputesPayouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('disputes');
        Schema::create('disputes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id');
            $table->text('message')->nullable();
            $table->integer('from_user');
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
        Schema::dropIfExists('disputes');
    }
}
