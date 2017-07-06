<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('combat', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name', 140)->nullable();
             $table->json('data')->nullable();
             $table->integer('user_id')->unsigned();
             $table->timestamps();
             $table->softDeletes();
         });

        Schema::table('combat', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('combat');
        Schema::enableForeignKeyConstraints();
    }
}
