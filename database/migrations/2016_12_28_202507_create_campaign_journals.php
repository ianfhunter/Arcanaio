<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignJournals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('campaign_id')->unsigned();
            $table->string('title');
            $table->text('body');
            $table->integer('elapsed_time')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('journals', function($table) {
           $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('campaign_id')->references('id')->on('campaigns');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('journals');
    }
}
