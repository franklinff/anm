<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnMoicRankingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moic_ranking', function (Blueprint $table) {
            $table->renameColumn('pdf_path','zip_path')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moic_ranking', function (Blueprint $table) {
            $table->renameColumn('zip_path', 'pdf_path')->after();
        });
    }
}
