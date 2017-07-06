<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationItemsTable extends Migration
{
    public function up()
    {
        Schema::create('location_items', function (Blueprint $table) {
            $table->integer('location_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('location_items', function($table) {
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('item_id')->references('id')->on('items');
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
        Schema::drop('location_items');
        Schema::enableForeignKeyConstraints();
    }
}
