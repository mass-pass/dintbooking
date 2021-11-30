<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsMaturedToPointsLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('points_log', function (Blueprint $table) {
            $table->integer('is_matured')->default(0);
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('points_log', function (Blueprint $table) {
            $table->dropColumn('is_matured');
        });
    }
}
