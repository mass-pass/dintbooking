<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeBoatFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->string('harbour_other')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->text('descripton')->nullable()->change();
            $table->text('insurance_certificate_file')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
