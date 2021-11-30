<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyBedsApartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_beds_apartment', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->integer('single_bedroom')->default(0);
            $table->integer('double_bedroom')->default(0);
            $table->integer('large_bedroom')->default(0);
            $table->integer('extra_large_bedroom')->default(0);
            $table->integer('bunk_bedroom_div')->default(0);
            $table->integer('sofa_bedroom_div')->default(0);
            $table->integer('futon_bedroom_div')->default(0);
            $table->integer('from_user');
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
        Schema::dropIfExists('property_beds_apartment');
    }
}
