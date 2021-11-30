<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    protected $tableName = "addresses";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists($this->tableName);

        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('street_address', 100);
            $table->string('unit', 20)->nullable();
            $table->string('city', 50)->index()->nullable();
            $table->string('country', 50)->index()->nullable();
            $table->string('postal_code', 10)->index()->nullable();
            $table->string('state', 3)->index()->nullable();
            $table->point('position')->index()->nullable();
            $table->bigInteger('created_by')->nullable()->index();
            $table->uuid('record_id')->unique()->index(); // this is to use in the API as ID
            $table->bigInteger('addressable_id');
            $table->string('addressable_type');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->decimal('longitude', 11, 8);
            $table->decimal('latitude', 11, 8);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists($this->tableName);
        Schema::enableForeignKeyConstraints();
    }
}
