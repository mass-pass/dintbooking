<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpaceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('space_type');
        
        Schema::create('space_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 25);
            $table->text('description')->nullable();
            $table->enum('status', ['Active','Inactive'])->default('Active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('space_type');
    }
}
