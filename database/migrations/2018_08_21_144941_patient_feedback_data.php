<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PatientFeedbackData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('patient_feedback', function (Blueprint $table) {
            $table->increments('id');

            $table->string('district');
            $table->string('block_hindi')->collation('utf8_general_ci');
            $table->string('phc');
            $table->string('phc_hindi')->collation('utf8_general_ci');
            $table->string('doctor_name');
            $table->string('doctor_name_hindi')->collation('utf8_general_ci');

            $table->string('mobile_no');
            $table->string('people_responded_for_doctor_availability');
            $table->string('patient_feedback_score_for_doctor_availability');
            $table->string('feedback_for_doctor_availability');
            $table->string('people_responded_for_medicine_availability');
            $table->string('patient_feedback_for_medicine_availibility');
            $table->string('feedback_for_medicine_availability');
            $table->string('people_responded_for_test_availability');
            $table->string('patient_feedback_score_for_test_availibility');
            $table->string('feedback_for_test_availability');
            $table->string('people_responded_for_patient_satisfaction');
            $table->string('feedback_for_patient_satisfaction');
            $table->string('moic_attendance');
            $table->string('stock_against_demand');
            $table->string('types_of_test_conducted');
            $table->string('no_of_patient_phone_number_received');
            $table->string('opd');
            $table->string('fill_rate');

            $table->timestamp('created_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_feedback');
    }
}
