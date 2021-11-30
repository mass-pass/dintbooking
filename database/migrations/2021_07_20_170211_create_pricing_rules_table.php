<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_intervals', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('property_layout_id');
            $table->foreign('property_layout_id')->references('id')->on('property_layouts')->onDelete('cascade');

            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('min_los')->default(0);
            $table->integer('max_los')->default(0);
            $table->boolean('closed_arrivals')->default(0);
            $table->boolean('closed_departure')->default(0);
            $table->double('extra_charges_additional_guest')->default(0);
            $table->double('charges_sunday')->default(0);
            $table->double('charges_monday')->default(0);
            $table->double('charges_tuesday')->default(0);
            $table->double('charges_wednesday')->default(0);
            $table->double('charges_thursday')->default(0);
            $table->double('charges_friday')->default(0);
            $table->double('charges_saturday')->default(0);

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
        Schema::dropIfExists('pricing_intervals');
    }
}
