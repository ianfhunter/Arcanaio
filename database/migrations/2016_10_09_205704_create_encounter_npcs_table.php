<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncounterNpcsTable extends Migration
{
    public function up()
    {
        Schema::create('encounter_npcs', function (Blueprint $table) {
            $table->integer('encounter_id')->unsigned();
            $table->integer('npc_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('encounter_npcs', function($table) {
            $table->foreign('encounter_id')->references('id')->on('encounters');
            $table->foreign('npc_id')->references('id')->on('npcs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::drop('encounter_npcs');
        Schema::enableForeignKeyConstraints();
    }
}
