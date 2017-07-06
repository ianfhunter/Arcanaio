<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivateColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('private')->after('view_count')->default(0);
        });
        Schema::table('monsters', function (Blueprint $table) {
            $table->integer('private')->after('view_count')->default(0);
        });
        Schema::table('spells', function (Blueprint $table) {
            $table->integer('private')->after('view_count')->default(0);
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->integer('private')->after('view_count')->default(0);
        });
        Schema::table('npcs', function (Blueprint $table) {
            $table->integer('private')->after('view_count')->default(0);
        });
        Schema::table('encounters', function (Blueprint $table) {
            $table->integer('private')->after('view_count')->default(0);
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
            $table->dropColumn('private');
        });
        Schema::table('monsters', function (Blueprint $table) {
            $table->dropColumn('private');
        });
        Schema::table('spells', function (Blueprint $table) {
            $table->dropColumn('private');
        });
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('private');
        });
        Schema::table('npcs', function (Blueprint $table) {
            $table->dropColumn('private');
        });
        Schema::table('encounters', function (Blueprint $table) {
            $table->dropColumn('private');
        });
    }
}
