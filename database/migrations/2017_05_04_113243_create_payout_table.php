<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('payouts');
        
        Schema::create('payouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id');
            $table->integer('user_id');
            $table->integer('property_id');
            $table->enum('user_type',['Host', 'Guest']);
            $table->string('account')->nullable();
            $table->double('amount')->default(0);
            $table->double('penalty_amount')->default(0);
            $table->enum('status',['Completed', 'Future']);
            $table->string('currency_code',10);
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
        Schema::drop('payouts');
    }
}
