<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Photos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('photos');
        
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photoable_type');
            $table->integer('photoable_id');
            $table->string('photo');
            $table->string('message', 105)->nullable();
            $table->integer('cover_photo')->default(0);
            $table->integer('serial')->default(0);
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
        Schema::dropIfExists('photos');
    }
}
