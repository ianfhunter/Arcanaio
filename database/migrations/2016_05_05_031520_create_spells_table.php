<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spells', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('page')->nullable();
            $table->string('range')->nullable();
            $table->string('components')->nullable();
            $table->text('material')->nullable();
            $table->boolean('ritual')->nullable();
            $table->string('duration')->nullable();
            $table->string('concentration')->nullable();
            $table->string('casting_time')->nullable();            
            $table->string('level')->nullable();
            $table->string('school')->nullable();            
            $table->string('class')->nullable();
            $table->text('higher_level')->nullable();
            $table->string('archetype')->nullable();
            $table->string('domains')->nullable();
            $table->string('oaths')->nullable();
            $table->string('circles')->nullable();
            $table->string('patrons')->nullable();
            $table->string('system')->nullable();
            $table->string('source')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('fork_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('spells', function($table) {
           $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('fork_id')->references('id')->on('spells');
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
        Schema::drop('spells');
        Schema::enableForeignKeyConstraints();
    }
}
