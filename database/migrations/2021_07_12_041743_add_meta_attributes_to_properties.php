<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaAttributesToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->boolean('breakfast')->default(1);
            $table->boolean('breakfast_price_included')->default(0);
            $table->double('breakfast_price')->default(0);

            $table->time('check_in_from');
            $table->time('check_in_until');
            $table->time('checkout_from');
            $table->time('checkout_until');
            $table->boolean('credit_allowed')->default(0);
            $table->string('licence_number');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('breakfast');
            $table->dropColumn('breakfast_price_included');
            $table->dropColumn('breakfast_price');

            $table->dropColumn('check_in_from');
            $table->dropColumn('check_in_until');
            $table->dropColumn('checkout_from');
            $table->dropColumn('checkout_until');
            $table->dropColumn('credit_allowed');
            $table->dropColumn('licence_number');
        });
    }
}
