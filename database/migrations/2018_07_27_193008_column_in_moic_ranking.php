<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumnInMoicRanking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moic_ranking_reports', function (Blueprint $table) {

            $table->integer('rank_id')->after('is_aadarsh_phc');
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

            $table->dropColumn('rank_id');
        });
    }
}
