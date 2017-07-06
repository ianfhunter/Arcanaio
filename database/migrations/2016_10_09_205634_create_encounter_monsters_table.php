<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncounterMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encounter_monsters', function (Blueprint $table) {
            $table->integer('encounter_id')->unsigned();
            $table->integer('monster_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('encounter_monsters', function($table) {
            $table->foreign('encounter_id')->references('id')->on('encounters');
            $table->foreign('monster_id')->references('id')->on('monsters');
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
        Schema::drop('encounter_monsters');
        Schema::enableForeignKeyConstraints();
    }
}
