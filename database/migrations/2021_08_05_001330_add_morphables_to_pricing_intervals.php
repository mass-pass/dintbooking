<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorphablesToPricingIntervals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_intervals', function (Blueprint $table) {
            $table->string('priceable_type');
            $table->integer('priceable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pricing_intervals', function (Blueprint $table) {
            $table->dropColumn('priceable_type');
            $table->dropColumn('priceable_id');
        });
    }
}
