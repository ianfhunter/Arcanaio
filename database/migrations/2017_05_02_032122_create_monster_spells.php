<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonsterSpells extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('monster_spells', function (Blueprint $table) {
			$table->integer('monster_id')->unsigned();
			$table->integer('spell_id')->unsigned();
			$table->string('level')->nullable();
			$table->timestamps();
		});

		Schema::table('monster_spells', function ($table) {
			$table->foreign('monster_id')->references('id')->on('monsters');
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
		Schema::drop('monster_spells');
		Schema::enableForeignKeyConstraints();
	}
}
