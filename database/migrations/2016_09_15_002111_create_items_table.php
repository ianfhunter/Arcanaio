<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->string('subtype')->nullable();
            $table->text('description')->nullable();
            $table->string('cost')->nullable();
            $table->string('weight')->nullable();
            $table->string('ac')->nullable();
            $table->string('armor_str_req')->nullable();
            $table->string('armor_stealth')->nullable();
            $table->string('weapon_damage')->nullable();
            $table->string('weapon_range')->nullable();
            $table->string('weapon_properties')->nullable();
            $table->string('vehicle_speed')->nullable();
            $table->string('vehicle_capacity')->nullable();
            $table->string('rarity')->nullable();
            $table->string('attunement')->nullable();
            $table->text('notes')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('fork_id')->unsigned()->nullable();
            $table->string('source')->nullable();
            $table->string('system')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

       Schema::table('items', function($table) {
           $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('fork_id')->references('id')->on('items');
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
        Schema::drop('items');
        Schema::enableForeignKeyConstraints();
    }
}
