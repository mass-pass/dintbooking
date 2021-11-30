<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabiityDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_dates', function (Blueprint $table) {
            $table->id();
            $table->string('blockable_type');
            $table->integer('blockable_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('notes');

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
        Schema::dropIfExists('blocked_dates');
    }
}
