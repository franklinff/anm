<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsMoicRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moic_ranking_reports', function (Blueprint $table) {
            $table->string('patient_satisfaction_max_score_achieved', 10)->default('00');
            $table->string('patient_satisfaction_score_achieved', 10)->default('00');
            $table->string('patient_satisfaction_cut_off', 10)->default('00');
            $table->string('patient_satisfaction_performance', 10)->default('00');
            $table->string('patient_satisfaction_block', 10)->default('00');
            $table->string('patient_satisfaction_district', 10)->default('00');
            $table->string('patient_satisfaction_state', 10)->default('00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moic_ranking_reports', function (Blueprint $table) {
            $table->dropColumn('patient_satisfaction_max_score_achieved');
            $table->dropColumn('patient_satisfaction_score_achieved');
            $table->dropColumn('patient_satisfaction_cut_off');
            $table->dropColumn('patient_satisfaction_performance');
            $table->dropColumn('patient_satisfaction_block');
            $table->dropColumn('patient_satisfaction_district');
            $table->dropColumn('patient_satisfaction_state');
        });
    }
}
