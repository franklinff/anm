<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MonthYearFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_feedback', function (Blueprint $table) {
            $table->tinyInteger('month')->after('filename');
            $table->integer('year')->after('month');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_feedback', function (Blueprint $table) {
            $table->tinyInteger('month')->after('filename');
            $table->integer('year')->after('month');
        });
    }

}
