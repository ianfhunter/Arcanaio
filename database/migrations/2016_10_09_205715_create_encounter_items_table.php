<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncounterItemsTable extends Migration
{
    public function up()
    {
        Schema::create('encounter_items', function (Blueprint $table) {
            $table->integer('encounter_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('encounter_items', function($table) {
            $table->foreign('encounter_id')->references('id')->on('encounters');
            $table->foreign('item_id')->references('id')->on('items');
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
        Schema::drop('encounter_items');
        Schema::enableForeignKeyConstraints();
    }
}
