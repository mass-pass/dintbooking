<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('accounts');
        
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('postal_code',25)->nullable();
            $table->string('country',5)->nullable();
            $table->string('currency_code',10);
            $table->text('account');
            $table->integer('payment_method_id');
            $table->enum('selected',['Yes', 'No'])->default('No');
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
        Schema::drop('accounts');
    }
}
