<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('encounters', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name', 140)->nullable();
             $table->string('level', 140)->nullable();
             $table->string('type', 140)->nullable();
             $table->string('environment', 140)->nullable();
             $table->text('hook')->nullable();
             $table->text('description')->nullable();
             $table->text('monster_notes')->nullable();
             $table->text('npc_notes')->nullable();
             $table->text('loot_notes')->nullable();
             $table->string('coins')->nullable();
             $table->string('source')->nullable();
             $table->string('system')->nullable();
             $table->integer('user_id')->unsigned();
             $table->integer('fork_id')->unsigned()->nullable();
             $table->timestamps();
             $table->softDeletes();
         });

         Schema::table('encounters', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('fork_id')->references('id')->on('encounters');
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
        Schema::drop('encounters');
        Schema::enableForeignKeyConstraints();
    }
}
