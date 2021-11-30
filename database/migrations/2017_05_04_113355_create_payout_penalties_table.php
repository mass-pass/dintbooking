<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutPenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('payout_penalties');
        
        Schema::create('payout_penalties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payout_id');
            $table->integer('penalty_id');
            $table->integer('amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('payout_penalties');
    }
}
