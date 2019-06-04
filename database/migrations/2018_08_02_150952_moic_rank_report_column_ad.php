<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoicRankReportColumnAd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moic_ranking_reports', function (Blueprint $table) {
            $table->string('dengue_max_score_achieved',20)->after('diarrhea_score_achieved');
            $table->string('dengue_score_achieved',20)->after('dengue_max_score_achieved');
            $table->string('dengue_target',20)->after('dengue_score_achieved');
            $table->string('dengue_performance',20)->after('dengue_target');
            $table->string('dengue_block',20)->after('dengue_performance');
            $table->string('dengue_district',20)->after('dengue_block');
            $table->string('dengue_state',20)->after('dengue_district');
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
            $table->dropColumn('dengue_max_score_achieved');
            $table->dropColumn('dengue_score_achieved');
            $table->dropColumn('dengue_target');
            $table->dropColumn('dengue_performance');
            $table->dropColumn('dengue_block');
            $table->dropColumn('dengue_district');
            $table->dropColumn('dengue_state');
        });
    }
}
