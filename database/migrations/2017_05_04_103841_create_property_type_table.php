<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('property_type');

        Schema::create('property_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->enum('status',['Active', 'Inactive'])->default('Active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('property_type');
    }
}
