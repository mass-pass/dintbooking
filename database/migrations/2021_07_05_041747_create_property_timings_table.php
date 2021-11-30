<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_timings', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->time('check_in_from');
            $table->time('check_in_until');
            $table->time('checkout_from');
            $table->time('checkout_until');
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
        Schema::dropIfExists('property_timings');
    }
}
