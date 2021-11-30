<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancellationPolicyToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancellation_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->integer('cancellation_days_before');
            $table->boolean('protect_against_accidental_bookings')->default(0);
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
        Schema::dropIfExists('cancellation_policies');
    }
}
