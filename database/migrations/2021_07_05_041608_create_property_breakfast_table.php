<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyBreakfastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_breakfast', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->enum('breakfast',['yes', 'no'])->default('yes');
            $table->enum('price-included',['yes', 'no'])->default('no');
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
        Schema::dropIfExists('property_breakfast');
    }
}
