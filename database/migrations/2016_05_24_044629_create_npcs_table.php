<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNpcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('npcs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 140)->nullable();
            $table->text('description')->nullable();
            $table->string('alignment', 80)->nullable();
            $table->string('size', 140)->nullable();
            $table->string('race', 140)->nullable();
            $table->string('ideal')->nullable();
            $table->string('bond')->nullable();
            $table->string('flaw')->nullable();
            $table->smallInteger('AC')->nullable();
            $table->smallInteger('HP')->nullable();
            $table->smallInteger('hit_dice_amount')->nullable();
            $table->smallInteger('hit_dice_size')->nullable();
            $table->smallInteger('str_save')->nullable();
            $table->smallInteger('dex_save')->nullable();
            $table->smallInteger('con_save')->nullable();
            $table->smallInteger('int_save')->nullable();
            $table->smallInteger('wis_save')->nullable();
            $table->smallInteger('cha_save')->nullable();
            $table->smallInteger('strength')->nullable();
            $table->smallInteger('dexterity')->nullable();
            $table->smallInteger('constitution')->nullable();
            $table->smallInteger('intelligence')->nullable();
            $table->smallInteger('wisdom')->nullable();
            $table->smallInteger('charisma')->nullable();
            $table->smallInteger('proficiency')->nullable();
            $table->text('tremorsense')->nullable();
            $table->text('truesight')->nullable();
            $table->text('darkvision')->nullable();
            $table->text('blindsight')->nullable();
            $table->smallInteger('acrobatics')->nullable();
            $table->smallInteger('animal_handling')->nullable();
            $table->smallInteger('arcana')->nullable();
            $table->smallInteger('athletics')->nullable();
            $table->smallInteger('deception')->nullable();
            $table->smallInteger('history')->nullable();
            $table->smallInteger('insight')->nullable();
            $table->smallInteger('intimidation')->nullable();
            $table->smallInteger('investigation')->nullable();
            $table->smallInteger('medicine')->nullable();
            $table->smallInteger('nature')->nullable();
            $table->smallInteger('perception')->nullable();
            $table->smallInteger('performance')->nullable();
            $table->smallInteger('persuasion')->nullable();
            $table->smallInteger('religion')->nullable();
            $table->smallInteger('sleight_of_hand')->nullable();
            $table->smallInteger('stealth')->nullable();
            $table->smallInteger('survival')->nullable();
            $table->string('languages')->nullable();
            $table->string('spell_ability')->nullable();
            $table->string('spell_save')->nullable();
            $table->string('spell_hit')->nullable();
            $table->string('spells_at_will')->nullable();
            $table->string('spells_one')->nullable();
            $table->string('spells_two')->nullable();
            $table->string('spells_three')->nullable();
            $table->text('damage_vulnerabilities')->nullable();
            $table->text('damage_resistances')->nullable();
            $table->text('damage_immunities')->nullable();
            $table->text('condition_immunities')->nullable();
            $table->string('speed')->nullable();
            $table->text('fly_speed')->nullable();
            $table->text('climb_speed')->nullable();
            $table->text('swim_speed')->nullable();
            $table->text('burrow_speed')->nullable();
            $table->string('source')->nullable();
            $table->string('system')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('fork_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('npcs', function($table) {
           $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('fork_id')->references('id')->on('npcs');
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
        Schema::drop('npcs');
        Schema::enableForeignKeyConstraints();
    }
}
