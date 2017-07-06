<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNpcSpells extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('npc_spells', function (Blueprint $table) {
			$table->integer('npc_id')->unsigned();
			$table->integer('spell_id')->unsigned();
			$table->string('level')->nullable();
			$table->timestamps();
		});

		Schema::table('npc_spells', function ($table) {
			$table->foreign('npc_id')->references('id')->on('npcs');
			$table->foreign('spell_id')->references('id')->on('spells');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::disableForeignKeyConstraints();
		Schema::drop('npc_spells');
		Schema::enableForeignKeyConstraints();
	}
}
