<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyIcalimportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_icalimports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->text('icalendar_url');
            $table->string('icalendar_name')->nullable();
            $table->string('icalendar_last_sync')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_icalimports');
    }
}
