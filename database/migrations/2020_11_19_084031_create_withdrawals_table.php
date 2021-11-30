<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('payout_id')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->string('uuid', 13)->nullable();
            $table->decimal('subtotal')->nullable();
            $table->decimal('amount')->nullable();
            $table->string('payment_method_info')->nullable();
            $table->string('email')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable(); 
            $table->string('swift_code')->nullable();
            $table->enum('status',['Pending', 'Success', 'Refund', 'Blocked']);
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
        Schema::dropIfExists('withdrawals');
    }
}
