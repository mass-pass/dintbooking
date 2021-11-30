<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenaltyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('penalty');
        
        Schema::create('penalty', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id');
            $table->integer('property_id');
            $table->integer('user_id');
            $table->enum('user_type',['Host', 'Guest']);
            $table->string('currency_code',10);
            $table->double('amount');
            $table->double('remaining_penalty')->default(0);
            $table->enum('reason',['cancelation', 'demurrage', 'violation_of_rules']);
            $table->enum('status',['Pending', 'Completed'])->default('Pending');
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
        Schema::drop('penalty');
    }
}
