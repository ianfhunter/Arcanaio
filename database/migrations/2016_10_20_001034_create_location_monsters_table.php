<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_monsters', function (Blueprint $table) {
            $table->integer('location_id')->unsigned();
            $table->integer('monster_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('location_monsters', function($table) {
            $table->foreign('location_id')->references('id')->on('locations');
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
        Schema::drop('location_monsters');
        Schema::enableForeignKeyConstraints();
    }
}
