<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('payment_methods');
        
        Schema::create('payment_methods', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name', 50);
             $table->enum('status',['Active', 'Inactive'])->default('Active');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payment_methods');
    }
}
