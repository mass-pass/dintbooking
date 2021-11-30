<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('property_steps');
        
        Schema::create('property_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->integer('basics')->default(0);
            $table->integer('description')->default(0);
            $table->integer('location')->default(0);
            $table->integer('photos')->default(0);
            $table->integer('pricing')->default(0);
            $table->integer('booking')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('property_steps');
    }
}
