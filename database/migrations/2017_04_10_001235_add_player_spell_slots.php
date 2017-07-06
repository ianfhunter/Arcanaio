<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlayerSpellSlots extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('player_spell_slots', function (Blueprint $table) {
			$table->integer('player_id')->unsigned();
			$table->integer('0-level (Cantrip)')->unsigned()->default(0);
			$table->integer('1st-level')->unsigned()->default(0);
			$table->integer('2nd-level')->unsigned()->default(0);
			$table->integer('3rd-level')->unsigned()->default(0);
			$table->integer('4th-level')->unsigned()->default(0);
			$table->integer('5th-level')->unsigned()->default(0);
			$table->integer('6th-level')->unsigned()->default(0);
			$table->integer('7th-level')->unsigned()->default(0);
			$table->integer('8th-level')->unsigned()->default(0);
			$table->integer('9th-level')->unsigned()->default(0);
			$table->integer('0-level (Cantrip) Pact')->unsigned()->default(0);
			$table->integer('1st-level Pact')->unsigned()->default(0);
			$table->integer('2nd-level Pact')->unsigned()->default(0);
			$table->integer('3rd-level Pact')->unsigned()->default(0);
			$table->integer('4th-level Pact')->unsigned()->default(0);
			$table->integer('5th-level Pact')->unsigned()->default(0);
			$table->integer('6th-level Pact')->unsigned()->default(0);
			$table->integer('7th-level Pact')->unsigned()->default(0);
			$table->integer('8th-level Pact')->unsigned()->default(0);
			$table->integer('9th-level Pact')->unsigned()->default(0);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::table('player_spell_slots', function ($table) {
			$table->foreign('player_id')->references('id')->on('players');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::disableForeignKeyConstraints();
		Schema::drop('player_spell_slots');
		Schema::enableForeignKeyConstraints();
	}
}
