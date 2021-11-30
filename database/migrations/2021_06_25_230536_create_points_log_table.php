<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_log', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('points');
            $table->enum('mode', ['added', 'redeemed']);
            $table->string('pointable_type');
            $table->integer('pointable_id');
            $table->text('notes');
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
        Schema::dropIfExists('points_log');
    }
}
