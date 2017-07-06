<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('key')->after('private')->default(null);
        });
        Schema::table('monsters', function (Blueprint $table) {
            $table->string('key')->after('private')->default(null);
        });
        Schema::table('spells', function (Blueprint $table) {
            $table->string('key')->after('private')->default(null);
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->string('key')->after('private')->default(null);
        });
        Schema::table('npcs', function (Blueprint $table) {
            $table->string('key')->after('private')->default(null);
        });
        Schema::table('encounters', function (Blueprint $table) {
            $table->string('key')->after('private')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('key');
        });
        Schema::table('monsters', function (Blueprint $table) {
            $table->dropColumn('key');
        });
        Schema::table('spells', function (Blueprint $table) {
            $table->dropColumn('key');
        });
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('key');
        });
        Schema::table('npcs', function (Blueprint $table) {
            $table->dropColumn('key');
        });
        Schema::table('encounters', function (Blueprint $table) {
            $table->dropColumn('key');
        });
    }
}
