<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bookings');
        
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->string('code', 10)->nullable();
            $table->integer('host_id');
            $table->integer('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['Accepted', 'Pending', 'Cancelled', 'Declined', 'Expired', 'Processing'])->default('Pending');
            $table->integer('guest')->default(0);
            $table->integer('total_night')->default(0);
            $table->double('per_night')->default(0);
            $table->text('custom_price_dates')->nullable();
            $table->double('base_price')->default(0);
            $table->double('cleaning_charge')->default(0);
            $table->double('guest_charge')->default(0);
            $table->double('service_charge')->default(0);
            $table->double('security_money')->default(0);
            $table->double('host_fee')->default(0);
            $table->double('total')->default(0);
            $table->enum('booking_type',['request','instant'])->default('request');
            $table->string('currency_code',10);
            $table->string('cancellation',20);
            $table->string('transaction_id',100);
            $table->integer('payment_method_id')->default(0);
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('declined_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->enum('cancelled_by',['Host', 'Guest'])->nullable();
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
        Schema::drop('bookings');
    }
}
