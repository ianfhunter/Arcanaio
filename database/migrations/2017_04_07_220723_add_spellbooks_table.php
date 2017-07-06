<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpellbooksTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('spellbooks', function (Blueprint $table) {
			$table->integer('player_id')->unsigned();
			$table->integer('spell_id')->unsigned();
			$table->integer('casts')->unsigned()->default('0');
			$table->boolean('prepared')->default('0');
			$table->timestamps();
		});

		Schema::table('spellbooks', function ($table) {
			$table->foreign('player_id')->references('id')->on('players');
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
		Schema::drop('spellbooks');
		Schema::enableForeignKeyConstraints();
	}
}
