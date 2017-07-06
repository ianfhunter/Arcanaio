<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationNpcsTable extends Migration
{
    public function up()
    {
        Schema::create('location_npcs', function (Blueprint $table) {
            $table->integer('location_id')->unsigned();
            $table->integer('npc_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('location_npcs', function($table) {
            $table->foreign('location_id')->references('id')->on('locations');
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
        Schema::drop('location_npcs');
        Schema::enableForeignKeyConstraints();
    }
}
