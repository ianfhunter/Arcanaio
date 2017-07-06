<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHitDiceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string('hit_dice')->after('hit_dice_size')->nullable();
            $table->text('proficiencies')->after('description')->nullable();
            $table->text('feats')->after('proficiencies')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('hit_dice');
            $table->dropColumn('proficiencies');
            $table->dropColumn('feats');
        });
    }
}
