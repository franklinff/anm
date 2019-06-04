<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SenCompleteGenFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_feedback', function (Blueprint $table) {
            $table->string('complete_sms', 2000)->after('sms');
            $table->tinyInteger('sms_sent')->after('complete_sms')->default(0);
            $table->string('dr_gender')->after('doctor_name_hindi');
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
            $table->string('complete_sms', 2000)->after('sms');
            $table->tinyInteger('sms_sent')->after('complete_sms')->default(0);
            $table->string('dr_gender')->after('doctor_name_hindi');
        });
    }
}
