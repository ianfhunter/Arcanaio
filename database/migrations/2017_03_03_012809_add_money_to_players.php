<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoneyToPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->integer('PP')->after('burrow_speed')->default(0)->nullable();
            $table->integer('EP')->after('PP')->default(0)->nullable();
            $table->integer('GP')->after('EP')->default(0)->nullable();
            $table->integer('SP')->after('GP')->default(0)->nullable();
            $table->integer('CP')->after('SP')->default(0)->nullable();
            $table->json('expertise')->after('proficiency')->nullable();
            $table->boolean('acrobatics_proficiency')->after('acrobatics')->default(0)->nullable();
            $table->boolean('animal_handling_proficiency')->after('animal_handling')->default(0)->nullable();
            $table->boolean('arcana_proficiency')->after('arcana')->default(0)->nullable();
            $table->boolean('athletics_proficiency')->after('athletics')->default(0)->nullable();
            $table->boolean('deception_proficiency')->after('deception')->default(0)->nullable();
            $table->boolean('history_proficiency')->after('history')->default(0)->nullable();
            $table->boolean('insight_proficiency')->after('insight')->default(0)->nullable();
            $table->boolean('intimidation_proficiency')->after('intimidation')->default(0)->nullable();
            $table->boolean('investigation_proficiency')->after('investigation')->default(0)->nullable();
            $table->boolean('medicine_proficiency')->after('medicine')->default(0)->nullable();
            $table->boolean('nature_proficiency')->after('nature')->default(0)->nullable();
            $table->boolean('perception_proficiency')->after('perception')->default(0)->nullable();
            $table->boolean('performance_proficiency')->after('performance')->default(0)->nullable();
            $table->boolean('persuasion_proficiency')->after('persuasion')->default(0)->nullable();
            $table->boolean('religion_proficiency')->after('religion')->default(0)->nullable();
            $table->boolean('sleight_of_hand_proficiency')->after('sleight_of_hand')->default(0)->nullable();
            $table->boolean('stealth_proficiency')->after('stealth')->default(0)->nullable();
            $table->boolean('survival_proficiency')->after('survival')->default(0)->nullable();
            $table->boolean('str_save_proficiency')->after('str_save')->default(0)->nullable();
            $table->boolean('dex_save_proficiency')->after('dex_save')->default(0)->nullable();
            $table->boolean('int_save_proficiency')->after('int_save')->default(0)->nullable();
            $table->boolean('wis_save_proficiency')->after('wis_save')->default(0)->nullable();
            $table->boolean('cha_save_proficiency')->after('cha_save')->default(0)->nullable();
            $table->boolean('con_save_proficiency')->after('con_save')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('PP');
            $table->dropColumn('EP');
            $table->dropColumn('GP');
            $table->dropColumn('SP');
            $table->dropColumn('CP');
            $table->dropColumn('expertise');
            $table->dropColumn('acrobatics_proficiency');
            $table->dropColumn('animal_handling_proficiency');
            $table->dropColumn('arcana_proficiency');
            $table->dropColumn('athletics_proficiency');
            $table->dropColumn('deception_proficiency');
            $table->dropColumn('history_proficiency');
            $table->dropColumn('insight_proficiency');
            $table->dropColumn('intimidation_proficiency');
            $table->dropColumn('investigation_proficiency');
            $table->dropColumn('medicine_proficiency');
            $table->dropColumn('nature_proficiency');
            $table->dropColumn('perception_proficiency');
            $table->dropColumn('performance_proficiency');
            $table->dropColumn('persuasion_proficiency');
            $table->dropColumn('religion_proficiency');
            $table->dropColumn('sleight_of_hand_proficiency');
            $table->dropColumn('stealth_proficiency');
            $table->dropColumn('survival_proficiency');
            $table->dropColumn('str_save_proficiency');
            $table->dropColumn('dex_save_proficiency');
            $table->dropColumn('con_save_proficiency');
            $table->dropColumn('wis_save_proficiency');
            $table->dropColumn('int_save_proficiency');
            $table->dropColumn('cha_save_proficiency');
        });
    }
}
