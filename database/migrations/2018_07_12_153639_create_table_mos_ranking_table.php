<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMosRankingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moic_ranking', function (Blueprint $table) {
            $table->increments('id');
            $table->string('block');
            $table->string('block_hin');
            $table->string('phc_en');
            $table->string('phc_hin');
            $table->string('dr_name_en');
            $table->string('dr_name_hin');
            $table->bigInteger('mobile');
            $table->string('email', 255);
            $table->string('scenerio');
            $table->string('uploaded_file');
            $table->string('ranking_pdf');
            $table->string('sms', 1000)->nullable();
            $table->tinyInteger('month');
            $table->integer('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moic_ranking');
    }
}
