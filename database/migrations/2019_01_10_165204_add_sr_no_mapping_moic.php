<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSrNoMappingMoic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moic_ranking_reports', function (Blueprint $table) {
            $table->integer('sr_no')->after('id')->nullable();
        });

        Schema::table('moic_ranking', function (Blueprint $table) {
            $table->integer('sr_no')->after('id')->nullable();
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
            $table->dropColumn('sr_no');
        });

        Schema::table('moic_ranking', function (Blueprint $table) {
            $table->dropColumn('sr_no');
        });

    }
}
