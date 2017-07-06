<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNPCActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('npc_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('npc_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('attack_type')->nullable();
            $table->string('damage_type')->nullable();
            $table->string('attack_bonus')->nullable();
            $table->string('damage_dice')->nullable();
            $table->string('damage_bonus')->nullable();
            $table->string('range')->nullable();
            $table->boolean('legendary')->nullable();
            $table->timestamps();
        });

       Schema::table('npc_actions', function($table) {
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
        Schema::drop('npc_actions');
    }
}