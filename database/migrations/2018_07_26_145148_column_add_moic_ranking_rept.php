<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumnAddMoicRankingRept extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moic_ranking_reports', function (Blueprint $table) {

            $table->string('phcs_in_the_block',20)->after('phc_rank_in_block');
            $table->string('phcs_in_the_district',20)->after('phcs_in_the_block');

            $table->string('opd_max_score_achieved',20)->after('opd_state');
            $table->string('opd_score_achieved',20)->after('opd_max_score_achieved');

            $table->string('pid_max_score_achieved',20)->after('pid_state');
            $table->string('pid_score_achieved',20)->after('pid_max_score_achieved');

            $table->string('fic_max_score_achieved',20)->after('fic_state');
            $table->string('fic_score_achieved',20)->after('fic_max_score_achieved');

            $table->string('anc3_max_score_achieved',20)->after('anc3_state');
            $table->string('anc3_score_achieved',20)->after('anc3_max_score_achieved');

            $table->string('anc4_max_score_achieved',20)->after('anc4_state');
            $table->string('anc4_score_achieved',20)->after('anc4_max_score_achieved');

            $table->string('anc12_max_score_achieved',20)->after('anc12_state');
            $table->string('anc12_score_achieved',20)->after('anc12_max_score_achieved');

            $table->string('plb_max_score_achieved',20)->after('plb_state');
            $table->string('plb_score_achieved',20)->after('plb_max_score_achieved');

            $table->string('fpiucd_max_score_achieved',20)->after('fpiucd_state');
            $table->string('fpiucdscore_achieved',20)->after('fpiucd_max_score_achieved');

            $table->string('ppiucd_max_score_achieved',20)->after('ppiucd_state');
            $table->string('ppiucd_score_achieved',20)->after('ppiucd_max_score_achieved');

            $table->string('fp_max_score_achieved',20)->after('fp_sterilization_state');
            $table->string('fp_score_achieved',20)->after('fp_max_score_achieved');

            $table->string('pneumonia_max_score_achieved',20)->after('pneumonia_state');
            $table->string('pneumonia_score_achieved',20)->after('pneumonia_max_score_achieved');

            $table->string('malaria_max_score_achieved',20)->after('malaria_state');
            $table->string('malaria_score_achieved',20)->after('malaria_max_score_achieved');

            $table->string('diarrhea_max_score_achieved',20)->after('diarrhea_state');
            $table->string('diarrhea_score_achieved',20)->after('diarrhea_max_score_achieved');

            $table->string('hp_max_score_achieved',20)->after('hp_state');
            $table->string('hp_score_achieved',20)->after('hp_max_score_achieved');

            $table->string('diabetes_max_score_achieved',20)->after('diabetes_state');
            $table->string('diabetes_score_achieved',20)->after('diabetes_max_score_achieved');

            $table->string('cvd_max_score_achieved',20)->after('cvd_state');
            $table->string('cvd_score_achieved',20)->after('cvd_max_score_achieved');

            $table->string('days_patient_voucher_max_score_achieved',20)->after('days_patient_voucher_state');
            $table->string('days_patient_voucher_score_achieved',20)->after('days_patient_voucher_max_score_achieved');

            $table->string('patient_vouchers_max_score_achieved',20)->after('patient_vouchers_state');
            $table->string('patient_vouchers_score_achieved',20)->after('patient_vouchers_max_score_achieved');

            $table->string('med_avail_feedback_max_score_achieved',20)->after('med_avail_feedback_state');
            $table->string('med_avail_feedback_score_achieved',20)->after('med_avail_feedback_max_score_achieved');

            $table->string('test_avail_feedback_max_score_achieved',20)->after('test_avail_state');
            $table->string('test_avail_feedback_score_achieved',20)->after('test_avail_feedback_max_score_achieved');

            $table->string('doc_avail_feedback_max_score_achieved',20)->after('doc_avail_state');
            $table->string('doc_avail_feedback_score_achieved',20)->after('doc_avail_feedback_max_score_achieved');

            $table->string('rajdharaa_max_score_achieved',20)->after('rajdhara_state');
            $table->string('rajdharaa_score_achieved',20)->after('rajdharaa_max_score_achieved');

            $table->string('linelist_vs_expected_max_score_achieved',20)->after('linelist_vs_expected_state');
            $table->string('linelist_vs_expected_score_achieved',20)->after('linelist_vs_expected_max_score_achieved');

            $table->string('pcts_vs_expected_max_score_achieved',20)->after('pcts_vs_expected_state');
            $table->string('pcts_vs_expected_score_achieved',20)->after('pcts_vs_expected_max_score_achieved');

            $table->string('id_max_score_achieved',20)->after('id_state');
            $table->string('id_score_achieved',20)->after('id_max_score_achieved');

            $table->string('fi_max_score_achieved',20)->after('fi_state');
            $table->string('fi_score_achieved',20)->after('fi_max_score_achieved');

            $table->string('pss_max_score_achieved',20)->after('pss_state');
            $table->string('pss_score_achieved',20)->after('pss_max_score_achieved');
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

            $table->dropColumn('phcs_in_the_block');
            $table->dropColumn('phcs_in_the_district');

            $table->dropColumn('opd_max_score_achieved');
            $table->dropColumn('opd_score_achieved');

            $table->dropColumn('pid_max_score_achieved');
            $table->dropColumn('pid_score_achieved');

            $table->dropColumn('fic_max_score_achieved');
            $table->dropColumn('fic_score_achieved');

            $table->dropColumn('anc3_max_score_achieved');
            $table->dropColumn('anc3_score_achieved');

            $table->dropColumn('anc4_max_score_achieved');
            $table->dropColumn('anc4_score_achieved');

            $table->dropColumn('anc12_max_score_achieved');
            $table->dropColumn('anc12_score_achieved');

            $table->dropColumn('plb_max_score_achieved');
            $table->dropColumn('plb_score_achieved');

            $table->dropColumn('fpiucd_max_score_achieved');
            $table->dropColumn('fpiucdscore_achieved');

            $table->dropColumn('ppiucd_max_score_achieved');
            $table->dropColumn('ppiucd_score_achieved');

            $table->dropColumn('fp_max_score_achieved');
            $table->dropColumn('fp_score_achieved');

            $table->dropColumn('pneumonia_max_score_achieved');
            $table->dropColumn('pneumonia_score_achieved');

            $table->dropColumn('malaria_max_score_achieved');
            $table->dropColumn('malaria_score_achieved');

            $table->dropColumn('diarrhea_max_score_achieved');
            $table->dropColumn('diarrhea_score_achieved');

            $table->dropColumn('hp_max_score_achieved');
            $table->dropColumn('hp_score_achieved');

            $table->dropColumn('diabetes_max_score_achieved');
            $table->dropColumn('diabetes_score_achieved');

            $table->dropColumn('cvd_max_score_achieved');
            $table->dropColumn('cvd_score_achieved');

            $table->dropColumn('days_patient_voucher_max_score_achieved');
            $table->dropColumn('days_patient_voucher_score_achieved');

            $table->dropColumn('patient_vouchers_max_score_achieved');
            $table->dropColumn('patient_vouchers_score_achieved');

            $table->dropColumn('med_avail_feedback_max_score_achieved');
            $table->dropColumn('med_avail_feedback_score_achieved');

            $table->dropColumn('test_avail_feedback_max_score_achieved');
            $table->dropColumn('test_avail_feedback_score_achieved');

            $table->dropColumn('doc_avail_feedback_max_score_achieved');
            $table->dropColumn('doc_avail_feedback_score_achieved');

            $table->dropColumn('rajdharaa_max_score_achieved');
            $table->dropColumn('rajdharaa_score_achieved');

            $table->dropColumn('linelist_vs_expected_max_score_achieved');
            $table->dropColumn('linelist_vs_expected_score_achieved');

            $table->dropColumn('pcts_vs_expected_max_score_achieved');
            $table->dropColumn('pcts_vs_expected_score_achieved');

            $table->dropColumn('id_max_score_achieved');
            $table->dropColumn('id_score_achieved');

            $table->dropColumn('fi_max_score_achieved');
            $table->dropColumn('fi_score_achieved');

            $table->dropColumn('pss_max_score_achieved');
            $table->dropColumn('pss_score_achieved');

      });
    }
}
