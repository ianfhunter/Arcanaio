<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLikeCountItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('like_count')->after('user_id')->default(0);
            $table->integer('view_count')->after('like_count')->default(0);
        });
        Schema::table('spells', function (Blueprint $table) {
            $table->integer('like_count')->after('user_id')->default(0);
            $table->integer('view_count')->after('like_count')->default(0);
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->integer('like_count')->after('user_id')->default(0);
            $table->integer('view_count')->after('like_count')->default(0);
        });
        Schema::table('npcs', function (Blueprint $table) {
            $table->integer('like_count')->after('user_id')->default(0);
            $table->integer('view_count')->after('like_count')->default(0);
        });
        Schema::table('encounters', function (Blueprint $table) {
            $table->integer('like_count')->after('user_id')->default(0);
            $table->integer('view_count')->after('like_count')->default(0);
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
            $table->dropColumn('like_count');
            $table->dropColumn('view_count');
        });
        Schema::table('spells', function (Blueprint $table) {
            $table->dropColumn('like_count');
            $table->dropColumn('view_count');
        });
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('like_count');
            $table->dropColumn('view_count');
        });
        Schema::table('npcs', function (Blueprint $table) {
            $table->dropColumn('like_count');
            $table->dropColumn('view_count');
        });
        Schema::table('encounters', function (Blueprint $table) {
            $table->dropColumn('like_count');
            $table->dropColumn('view_count');
        });
    }
}
