<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoicRankingsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moic_ranking_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('district');
            $table->string('dr_weblink', 255);
            $table->string('block');
            $table->string('phc_name');
            $table->tinyInteger('month');
            $table->integer('year');
            $table->integer('moic');
            $table->enum('is_aadarsh_phc', ['0', '1']);
            $table->string('phc_rank_in_block', 20)->default('0');
            $table->string('phc_rank_in_district', 20)->default('0');

            $table->string('opd_target', 20)->default('0');
            $table->string('opd_performance', 20)->default('0');
            $table->string('opd_block', 20)->default('0');
            $table->string('opd_district', 20)->default('0');
            $table->string('opd_state', 20)->default('0');

            $table->string('pid_target', 20)->default('0');
            $table->string('pid_performance', 20)->default('0');
            $table->string('pid_block', 20)->default('0');
            $table->string('pid_district', 20)->default('0');
            $table->string('pid_state', 20)->default('0');

            $table->string('fic_target', 20)->default('0');
            $table->string('fic_performance', 20)->default('0');
            $table->string('fic_block', 20)->default('0');
            $table->string('fic_district', 20)->default('0');
            $table->string('fic_state', 20)->default('0');

            $table->string('anc3_target', 20)->default('0');
            $table->string('anc3_performance', 20)->default('0');
            $table->string('anc3_block', 20)->default('0');
            $table->string('anc3_district', 20)->default('0');
            $table->string('anc3_state', 20)->default('0');

            $table->string('anc4_target', 20)->default('0');
            $table->string('anc4_performance', 20)->default('0');
            $table->string('anc4_block', 20)->default('0');
            $table->string('anc4_district', 20)->default('0');
            $table->string('anc4_state', 20)->default('0');

            $table->string('anc12_target', 20)->default('0');
            $table->string('anc12_performance', 20)->default('0');
            $table->string('anc12_block', 20)->default('0');
            $table->string('anc12_district', 20)->default('0');
            $table->string('anc12_state', 20)->default('0');

            $table->string('plb_target', 20)->default('0');
            $table->string('plb_performance', 20)->default('0');
            $table->string('plb_block', 20)->default('0');
            $table->string('plb_district', 20)->default('0');
            $table->string('plb_state', 20)->default('0');

            $table->string('fpiucd_target', 20)->default('0');
            $table->string('fpiucd_performance', 20)->default('0');
            $table->string('fpiucd_block', 20)->default('0');
            $table->string('fpiucd_district', 20)->default('0');
            $table->string('fpiucd_state', 20)->default('0');

            $table->string('ppiucd_target', 20)->default('0');
            $table->string('ppiucd_performance', 20)->default('0');
            $table->string('ppiucd_block', 20)->default('0');
            $table->string('ppiucd_district', 20)->default('0');
            $table->string('ppiucd_state', 20)->default('0');

            $table->string('fp_sterilization_target', 20)->default('0');
            $table->string('fp_sterilization_performance', 20)->default('0');
            $table->string('fp_sterilization_block', 20)->default('0');
            $table->string('fp_sterilization_district', 20)->default('0');
            $table->string('fp_sterilization_state', 20)->default('0');

            $table->string('pneumonia_target', 20)->default('0');
            $table->string('pneumonia_performance', 20)->default('0');
            $table->string('pneumonia_block', 20)->default('0');
            $table->string('pneumonia_district', 20)->default('0');
            $table->string('pneumonia_state', 20)->default('0');

            $table->string('malaria_target', 20)->default('0');
            $table->string('malaria_performance', 20)->default('0');
            $table->string('malaria_block', 20)->default('0');
            $table->string('malaria_district', 20)->default('0');
            $table->string('malaria_state', 20)->default('0');

            $table->string('diarrhea_target', 20)->default('0');
            $table->string('diarrhea_performance', 20)->default('0');
            $table->string('diarrhea_block', 20)->default('0');
            $table->string('diarrhea_district', 20)->default('0');
            $table->string('diarrhea_state', 20)->default('0');

            $table->string('hp_target', 20)->default('0');
            $table->string('hp_performance', 20)->default('0');
            $table->string('hp_block', 20)->default('0');
            $table->string('hp_district', 20)->default('0');
            $table->string('hp_state', 20)->default('0');

            $table->string('diabetes_target', 20)->default('0');
            $table->string('diabetes_performance', 20)->default('0');
            $table->string('diabetes_block', 20)->default('0');
            $table->string('diabetes_district', 20)->default('0');
            $table->string('diabetes_state', 20)->default('0');

            $table->string('cvd_target', 20)->default('0');
            $table->string('cvd_performance', 20)->default('0');
            $table->string('cvd_block', 20)->default('0');
            $table->string('cvd_district', 20)->default('0');
            $table->string('cvd_state', 20)->default('0');

            $table->string('days_patient_voucher_target', 20)->default('0');
            $table->string('days_patient_voucher_performance', 20)->default('0');
            $table->string('days_patient_voucher_block', 20)->default('0');
            $table->string('days_patient_voucher_district', 20)->default('0');
            $table->string('days_patient_voucher_state', 20)->default('0');

            $table->string('patient_vouchers_target', 20)->default('0');
            $table->string('patient_vouchers_performance', 20)->default('0');
            $table->string('patient_vouchers_block', 20)->default('0');
            $table->string('patient_vouchers_district', 20)->default('0');
            $table->string('patient_vouchers_state', 20)->default('0');

            $table->string('med_avail_feedback_target', 20)->default('0');
            $table->string('med_avail_feedback_performance', 20)->default('0');
            $table->string('med_avail_feedback_block', 20)->default('0');
            $table->string('med_avail_feedback_district', 20)->default('0');
            $table->string('med_avail_feedback_state', 20)->default('0');

            $table->string('test_avail_target', 20)->default('0');
            $table->string('test_avail_performance', 20)->default('0');
            $table->string('test_avail_block', 20)->default('0');
            $table->string('test_avail_district', 20)->default('0');
            $table->string('test_avail_state', 20)->default('0');

            $table->string('doc_avail_target', 20)->default('0');
            $table->string('doc_avail_performance', 20)->default('0');
            $table->string('doc_avail_block', 20)->default('0');
            $table->string('doc_avail_district', 20)->default('0');
            $table->string('doc_avail_state', 20)->default('0');

            $table->string('rajdhara_target', 20)->default('0');
            $table->string('rajdhara_performance', 20)->default('0');
            $table->string('rajdhara_block', 20)->default('0');
            $table->string('rajdhara_district', 20)->default('0');
            $table->string('rajdhara_state', 20)->default('0');

            $table->string('linelist_vs_expected_target', 20)->default('0');
            $table->string('linelist_vs_expected_performance', 20)->default('0');
            $table->string('linelist_vs_expected_block', 20)->default('0');
            $table->string('linelist_vs_expected_district', 20)->default('0');
            $table->string('linelist_vs_expected_state', 20)->default('0');

            $table->string('pcts_vs_expected_target', 20)->default('0');
            $table->string('pcts_vs_expected_performance', 20)->default('0');
            $table->string('pcts_vs_expected_block', 20)->default('0');
            $table->string('pcts_vs_expected_district', 20)->default('0');
            $table->string('pcts_vs_expected_state', 20)->default('0');

            $table->string('id_target', 20)->default('0');
            $table->string('id_performance', 20)->default('0');
            $table->string('id_block', 20)->default('0');
            $table->string('id_district', 20)->default('0');
            $table->string('id_state', 20)->default('0');

            $table->string('fi_target', 20)->default('0');
            $table->string('fi_performance', 20)->default('0');
            $table->string('fi_block', 20)->default('0');
            $table->string('fi_district', 20)->default('0');
            $table->string('fi_state', 20)->default('0');

            $table->string('pss_target', 20)->default('0');
            $table->string('pss_performance', 20)->default('0');
            $table->string('pss_block', 20)->default('0');
            $table->string('pss_district', 20)->default('0');
            $table->string('pss_state', 20)->default('0');

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
        Schema::dropIfExists('moic_ranking_reports');
    }
}
