<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('reports');
        
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->integer('user_id');
            $table->text('message')->nullable();
            $table->enum('status',['unsolved', 'solved'])->default('unsolved');
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
        Schema::drop('reports');
    }
}
