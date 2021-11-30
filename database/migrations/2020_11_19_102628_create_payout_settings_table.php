<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('type');
            $table->string('email')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('bank_branch_city')->nullable();
            $table->string('bank_branch_address')->nullable();
            $table->integer('country')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->enum('selected',['Yes', 'No'])->default('No');
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
        Schema::dropIfExists('payout_settings');
    }
}
