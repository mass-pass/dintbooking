<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('property_photos');
        
        Schema::create('property_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->string('photo');
            $table->string('message', 105)->nullable();
            $table->integer('cover_photo')->default(0);
            $table->integer('serial')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('property_photos');
    }
}
