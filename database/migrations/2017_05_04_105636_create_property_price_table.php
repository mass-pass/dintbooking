<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('property_price');
        
        Schema::create('property_price', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->integer('cleaning_fee')->default(0);
            $table->integer('guest_after')->default(0);
            $table->integer('guest_fee')->default(0);
            $table->integer('security_fee')->default(0);
            $table->integer('price')->default(0);
            $table->integer('weekend_price')->default(0);
            $table->integer('weekly_discount')->default(0);
            $table->integer('monthly_discount')->default(0);
            $table->string('currency_code',10)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('property_price');
    }
}
