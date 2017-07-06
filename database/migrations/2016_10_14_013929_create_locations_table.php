<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('locations', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name');
             $table->text('description');
             $table->text('history')->nullable();
             $table->text('demographics')->nullable();
             $table->text('government')->nullable();
             $table->text('menu')->nullable();
             $table->text('other_items')->nullable();
             $table->string('type')->nullable();
             $table->string('subtype')->nullable();
             $table->string('owner')->nullable();
             $table->string('price')->nullable();
             $table->string('system')->nullable();
             $table->string('source')->nullable();
             $table->integer('user_id')->unsigned()->nullable();
             $table->integer('fork_id')->unsigned()->nullable();
             $table->timestamps();
             $table->softDeletes();
         });

         Schema::table('locations', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('fork_id')->references('id')->on('locations');
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
        Schema::drop('locations');
        Schema::enableForeignKeyConstraints();
    }
}
