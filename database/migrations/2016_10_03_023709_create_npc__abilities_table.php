<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNPCAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('npc_abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('npc_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

       Schema::table('npc_abilities', function($table) {
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
        Schema::drop('npc_abilities');
    }
}
