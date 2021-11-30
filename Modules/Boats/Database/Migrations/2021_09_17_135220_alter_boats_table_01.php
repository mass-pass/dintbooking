<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBoatsTable01 extends Migration
{
    protected $tableName = "boats";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table($this->tableName, function (Blueprint $table) {

            if (Schema::hasColumn($this->tableName, 'title')) {
                $table->string('title')->nullable()->change();
            }

            if (Schema::hasColumn($this->tableName, 'descripton')) {
                $table->string('descripton')->nullable()->change();
            }

            if (Schema::hasColumn($this->tableName, 'insurance_certificate_file')) {
                $table->string('insurance_certificate_file')->nullable()->change();
            }

            if (Schema::hasColumn($this->tableName, 'languages')) {
                $table->string('languages')->nullable()->change();
            }

            if (Schema::hasColumn($this->tableName, 'photos')) {
                $table->string('photos')->nullable()->change();
            }

            if (Schema::hasColumn($this->tableName, 'amenities')) {
                $table->string('amenities')->nullable()->change();
            }

            $table->softDeletes();
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

        Schema::table($this->tableName, function (Blueprint $table) {

            if (Schema::hasColumn($this->tableName, 'title')) {
                $table->string('title')->nullable(false)->change();
            }

            if (Schema::hasColumn($this->tableName, 'descripton')) {
                $table->string('descripton')->nullable(false)->change();
            }

            if (Schema::hasColumn($this->tableName, 'insurance_certificate_file')) {
                $table->string('insurance_certificate_file')->nullable(false)->change();
            }

            if (Schema::hasColumn($this->tableName, 'languages')) {
                $table->string('languages')->nullable(false)->change();
            }

            if (Schema::hasColumn($this->tableName, 'photos')) {
                $table->string('photos')->nullable(false)->change();
            }

            if (Schema::hasColumn($this->tableName, 'amenities')) {
                $table->string('amenities')->nullable(false)->change();
            }

            if (Schema::hasColumn($this->tableName, 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::enableForeignKeyConstraints();
    }
}
