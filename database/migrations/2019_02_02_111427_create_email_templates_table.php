<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('temp_id');
            $table->string('subject', 191);
            $table->text('body');
            $table->string('link_text', 191)->nullable();
            $table->string('lang', 10);
            $table->enum('type', ['email', 'sms']);
            $table->integer('lang_id');
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
        Schema::dropIfExists('email_templates');
    }
}
