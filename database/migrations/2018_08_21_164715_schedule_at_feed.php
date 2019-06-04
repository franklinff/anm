<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScheduleAtFeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_feedback', function (Blueprint $table) {
            $table->dateTime('schedule_at')->after('fill_rate');
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
            $table->string('schedule_at')->after('fill_rate');
        });
    }
}
