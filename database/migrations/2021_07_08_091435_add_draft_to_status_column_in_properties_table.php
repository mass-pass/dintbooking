<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDraftToStatusColumnInPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            //purpose of adding this Draft value is not to show the system generated name as the property name,
            // letting the users to add the name by themselves
            //probably it would be better to use Draft as the default one
            //but not to break default flow Unlisted is unchanged as default for now
            //TODO:: Draft needs to be set as default in future after analyzing the possible effects
            DB::statement("ALTER TABLE properties MODIFY status ENUM('Unlisted', 'Listed', 'Draft') DEFAULT 'Unlisted' NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
}
