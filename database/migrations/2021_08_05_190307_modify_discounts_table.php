<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->enum('type', ['standard', 'length-of-stay', 'custom'])->default('custom');
            $table->integer('percentage')->default(0);
            $table->enum('applicable_at', ['first-time','early-bird','last-minute','length-of-stay','custom'])->default('custom');
            $table->longText('applicable_meta')->nullable();
            $table->dropColumn('meta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('percentage');
            $table->dropColumn('applicable_at');
            $table->dropColumn('applicable_meta');

            $table->longText('meta');
        });
        //
    }
}
