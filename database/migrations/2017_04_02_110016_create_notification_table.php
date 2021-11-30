<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('notifications');
        
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('message');
            $table->enum('status',['read', 'unread'])->default('unread');            
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
        Schema::drop('notifications');
    }
}
