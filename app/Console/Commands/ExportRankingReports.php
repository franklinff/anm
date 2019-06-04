<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MoicRanking;
use Excel;
use DB;


class ExportRankingReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:ranking_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export another sheet from ranking excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $not_exported = MoicRanking::where('status', 'N')->select('uploaded_file')->distinct()->get();
        $drs = MoicRanking::select('id', 'phc_en', 'month', 'year', 'uploaded_file')->where('status', 'N')->get()->toArray();
        $cnt = count($not_exported);
        if($cnt === 0) {
            echo 'All rankings are generated'.PHP_EOL;
            return;
        }
        
        echo $cnt.' file(s) found for rankings report..!!'.PHP_EOL;
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        foreach($not_exported as $file) {
            $path = public_path().'/moic/imports/'.$file->uploaded_file;

            if(! file_exists($path)) {
                echo $file->uploaded_file.' not exists in folder..!!';
                continue;
            }
            
            $sheetName = Excel::load($path)->getSheetNames();
            if(! in_array('PHC_wise_Performance', $sheetName)) {
                echo "Sheet name is invalid..!!";
                continue;
            }

            $rankings = Excel::selectSheets($sheetName[1])->load($path)->get()->toArray();
            $insert = [];
            foreach ($rankings as $ranking) {

                    if($ranking['month_year'] == null){
                    continue;
                }

                $month = $ranking['month_year']->format('m');
                $year = $ranking['month_year']->format('Y');
                
                $particular = array_filter($drs, function($index) use($ranking, $file, $month, $year){
                    return (strtolower($index['phc_en']) == strtolower($ranking['phc_name']) && $index['month'] == $month && $index['year'] == $year && $index['uploaded_file'] == $file->uploaded_file);
                });
                $particular = reset($particular);
                $weblink = '';
                if(empty($particular)) {
                    continue;
                }
                
                $str = substr(str_shuffle($chars), 0, 10).time();
                $weblink = md5($particular['id']);
                
                $insert[] = $this->generateInsert($file, $ranking, $str, $month, $year, $particular);
            }

            if(! DB::table('moic_ranking_reports')->insert($insert)) {
                echo "Failed to generate ranking for file {$file->uploaded_file} ..!!" . PHP_EOL;
                continue;
            }

            MoicRanking::where([
                'status' => 'N',
                'uploaded_file' => $file->uploaded_file
            ])->update(['status' => 'Y']);
            echo "Done {$file->uploaded_file} ..!!" . PHP_EOL;
        }
    }

    private function generateInsert($file, $ranking, $str, $month, $year, $particular)
    {
        return [
            'sr_no'=>trim($ranking['sr_no']),
            'filename' => $file->uploaded_file,
            'district' => $ranking['district_name'],
            'dr_weblink' => $str,
            'block' => $ranking['block_name'],
            'phc_name' => $ranking['phc_name'],
            'moic_name' => $ranking['moic_name'],
            'month' => $month,
            'year' => $year,
            'moic' => $ranking['moic_name'],
            'is_aadarsh_phc' => $ranking['adarsh_phc'],
            'rank_id' => $particular['id'],
            'phc_rank_in_block' => ($ranking['phc_rank_in_the_block'])?$ranking['phc_rank_in_the_block']:0,
            'phcs_in_the_block' => ($ranking['phcs_in_the_block'])?$ranking['phcs_in_the_block']:0,
            'phc_rank_in_district' => ($ranking['phc_rank_in_the_district'])?$ranking['phc_rank_in_the_district']:0,
            'phcs_in_the_district' => ($ranking['phcs_in_the_district'])?$ranking['phcs_in_the_district']:0,

            'opd_target' => ($ranking['opd_cut_off'])?$ranking['opd_cut_off']:0,
            'opd_performance' => ($ranking['opd_performance'])?$ranking['opd_performance']:0,
            'opd_block' => ($ranking['in_opd_block'])?$ranking['in_opd_block']:0,
            'opd_district' => ($ranking['in_opd_district'])?$ranking['in_opd_district']:0,
            'opd_state' => ($ranking['in_opd_state'])?$ranking['in_opd_state']:0,
            'opd_max_score_achieved' => ($ranking['opd_max_score_that_can_be_achieved'])?$ranking['opd_max_score_that_can_be_achieved']:0,
            'opd_score_achieved' => ($ranking['opd_score_achieved'])?$ranking['opd_score_achieved']:0,

            'pid_max_score_achieved' => ($ranking['pid_max_score_that_can_be_achieved'])?$ranking['pid_max_score_that_can_be_achieved']:0,
            'pid_score_achieved' => ($ranking['pid_score_achieved'])?$ranking['pid_score_achieved']:0,
            'pid_target' => ($ranking['pid_cut_off'])?$ranking['pid_cut_off']:0,
            'pid_performance' => ($ranking['pid_performance'])?$ranking['pid_performance']:0,
            'pid_block' => ($ranking['in_pid_block'])?$ranking['in_pid_block']:0,
            'pid_district' => ($ranking['in_pid_district'])?$ranking['in_pid_district']:0,

            'fic_max_score_achieved' => ($ranking['fic_max_score_that_can_be_achieved'])?$ranking['fic_max_score_that_can_be_achieved']:0,
            'fic_score_achieved' => ($ranking['fic_score_achieved'])?$ranking['fic_score_achieved']:0,
            'pid_state' => ($ranking['in_pid_state'])?$ranking['in_pid_state']:0,
            'fic_target' => ($ranking['fic_cut_off'])?$ranking['fic_cut_off']:0,
            'fic_performance' => ($ranking['fic_performance'])?$ranking['fic_performance']:0,
            'fic_block' => ($ranking['in_fic_block'])?$ranking['in_fic_block']:0,
            'fic_district' => ($ranking['in_fic_district'])?$ranking['in_fic_district']:0,
            'fic_state' => ($ranking['in_fic_state'])?$ranking['in_fic_state']:0,

            'anc3_max_score_achieved' => ($ranking['anc3_max_score_that_can_be_achieved'])?$ranking['anc3_max_score_that_can_be_achieved']:0,
            'anc3_score_achieved' => ($ranking['anc3_score_achieved'])?$ranking['anc3_score_achieved']:0,
            'anc3_target' => ($ranking['anc3_cut_off'])?$ranking['anc3_cut_off']:0,
            'anc3_performance' => ($ranking['anc3_performance'])?$ranking['anc3_performance']:0,
            'anc3_block' => ($ranking['in_anc3_block'])?$ranking['in_anc3_block']:0,
            'anc3_district' => ($ranking['in_anc3_district'])?$ranking['in_anc3_district']:0,
            'anc3_state' => ($ranking['in_anc3_state'])?$ranking['in_anc3_state']:0,

            'anc4_max_score_achieved' => ($ranking['anc4_max_score_that_can_be_achieved'])?$ranking['anc4_max_score_that_can_be_achieved']:0,
            'anc4_score_achieved' => ($ranking['anc4_score_achieved'])?$ranking['anc4_score_achieved']:0,
            'anc4_target' => ($ranking['anc4_cut_off'])?$ranking['anc4_cut_off']:0,
            'anc4_performance' => ($ranking['anc4_performance'])?$ranking['anc4_performance']:0,
            'anc4_block' => ($ranking['in_anc4_block'])?$ranking['in_anc4_block']:0,
            'anc4_district' => ($ranking['in_anc4_district'])?$ranking['in_anc4_district']:0,
            'anc4_state' => ($ranking['in_anc4_state'])?$ranking['in_anc4_state']:0,

            'anc12_max_score_achieved' => ($ranking['anc12_max_score_that_can_be_achieved'])?$ranking['anc12_max_score_that_can_be_achieved']:0,
            'anc12_score_achieved' => ($ranking['anc12_score_achieved'])?$ranking['anc12_score_achieved']:0,
            'anc12_target' => ($ranking['anc12_cut_off'])?$ranking['anc12_cut_off']:0,
            'anc12_performance' => ($ranking['anc12_performance'])?$ranking['anc12_performance']:0,
            'anc12_block' => ($ranking['in_anc12_block'])?$ranking['in_anc12_block']:0,
            'anc12_district' => ($ranking['in_anc12_district'])?$ranking['in_anc12_district']:0,
            'anc12_state' => ($ranking['in_anc12_state'])?$ranking['in_anc12_state']:0,

            'plb_max_score_achieved' => ($ranking['plb_max_score_that_can_be_achieved'])?$ranking['plb_max_score_that_can_be_achieved']:0,
            'plb_score_achieved' => ($ranking['plb_score_achieved'])?$ranking['plb_score_achieved']:0,
            'plb_target' => ($ranking['plb_cut_off'])?$ranking['plb_cut_off']:0,
            'plb_performance' => ($ranking['plb_performance'])?$ranking['plb_performance']:0,
            'plb_block' => ($ranking['in_plb_block'])?$ranking['in_plb_block']:0,
            'plb_district' => ($ranking['in_plb_district'])?$ranking['in_plb_district']:0,
            'plb_state' => ($ranking['in_plb_state'])?$ranking['in_plb_state']:0,

            'fpiucd_max_score_achieved' => ($ranking['fpiucd_max_score_that_can_be_achieved'])?$ranking['fpiucd_max_score_that_can_be_achieved']:0,
            'fpiucdscore_achieved' => ($ranking['fpiucdscore_achieved'])?$ranking['fpiucdscore_achieved']:0,
            'fpiucd_target' => ($ranking['fpiucd_cut_off'])?$ranking['fpiucd_cut_off']:0,
            'fpiucd_performance' => ($ranking['fpiucd_performance'])?$ranking['fpiucd_performance']:0,
            'fpiucd_block' => ($ranking['in_fpiucd_block'])?$ranking['in_fpiucd_block']:0,
            'fpiucd_district' => ($ranking['in_fpiucd_district'])?$ranking['in_fpiucd_district']:0,
            'fpiucd_state' => ($ranking['in_fpiucd_state'])?$ranking['in_fpiucd_state']:0,

            'ppiucd_max_score_achieved' => ($ranking['ppiucd_max_score_that_can_be_achieved'])?$ranking['ppiucd_max_score_that_can_be_achieved']:0,
            'ppiucd_score_achieved' => ($ranking['ppiucd_score_achieved'])?$ranking['ppiucd_score_achieved']:0,
            'ppiucd_target' => ($ranking['ppiucd_cut_off'])?$ranking['ppiucd_cut_off']:0,
            'ppiucd_performance' => ($ranking['ppiucd_performance'])?$ranking['ppiucd_performance']:0,
            'ppiucd_block' => ($ranking['in_ppiucd_block'])?$ranking['in_ppiucd_block']:0,
            'ppiucd_district' => ($ranking['in_ppiucd_district'])?$ranking['in_ppiucd_district']:0,
            'ppiucd_state' => ($ranking['in_ppiucd_state'])?$ranking['in_ppiucd_state']:0,

            'fp_max_score_achieved' => ($ranking['fp_max_score_that_can_be_achieved'])?$ranking['fp_max_score_that_can_be_achieved']:0,
            'fp_score_achieved' => ($ranking['fp_score_achieved'])?$ranking['fp_score_achieved']:0,
            'fp_sterilization_target' => ($ranking['fp_sterilization_cut_off'])?$ranking['fp_sterilization_cut_off']:0,
            'fp_sterilization_performance' => ($ranking['fp_sterilization_performance'])?$ranking['fp_sterilization_performance']:0,
            'fp_sterilization_block' => ($ranking['in_fp_sterilization_block'])?$ranking['in_fp_sterilization_block']:0,
            'fp_sterilization_district' => ($ranking['in_fp_sterilization_district'])?$ranking['in_fp_sterilization_district']:0,
            'fp_sterilization_state' => ($ranking['in_fp_sterilization_state'])?$ranking['in_fp_sterilization_state']:0,

            'pneumonia_max_score_achieved' => ($ranking['pneumonia_max_score_that_can_be_achieved'])?$ranking['pneumonia_max_score_that_can_be_achieved']:0,
            'pneumonia_score_achieved' => ($ranking['pneumonia_score_achieved'])?$ranking['pneumonia_score_achieved']:0,
            'pneumonia_target' => ($ranking['pneumonia_cut_off'])?$ranking['pneumonia_cut_off']:0,
            'pneumonia_performance' => ($ranking['pneumonia_performance'])?$ranking['pneumonia_performance']:0,
            'pneumonia_block' => ($ranking['in_pneumonia_block'])?$ranking['in_pneumonia_block']:0,
            'pneumonia_district' => ($ranking['in_pneumonia_district'])?$ranking['in_pneumonia_district']:0,
            'pneumonia_state' => ($ranking['in_pneumonia_state'])?$ranking['in_pneumonia_state']:0,

            'malaria_max_score_achieved' => ($ranking['malaria_max_score_that_can_be_achieved'])?$ranking['malaria_max_score_that_can_be_achieved']:0,
            'malaria_score_achieved' => ($ranking['malaria_score_achieved'])?$ranking['malaria_score_achieved']:0,
            'malaria_target' => ($ranking['malaria_cut_off'])?$ranking['malaria_cut_off']:0,
            'malaria_performance' => ($ranking['malaria_performance'])?$ranking['malaria_performance']:0,
            'malaria_block' => ($ranking['in_malaria_block'])?$ranking['in_malaria_block']:0,
            'malaria_district' => ($ranking['in_malaria_district'])?$ranking['in_malaria_district']:0,
            'malaria_state' => ($ranking['in_malaria_state'])?$ranking['in_malaria_state']:0,

            'diarrhea_max_score_achieved' => ($ranking['diarrhea_max_score_that_can_be_achieved'])?$ranking['diarrhea_max_score_that_can_be_achieved']:0,
            'diarrhea_score_achieved' => ($ranking['diarrhea_score_achieved'])?$ranking['diarrhea_score_achieved']:0,
            'diarrhea_target' => ($ranking['diarrhea_cut_off'])?$ranking['diarrhea_cut_off']:0,
            'diarrhea_performance' => ($ranking['diarrhea_performance'])?$ranking['diarrhea_performance']:0,
            'diarrhea_block' => ($ranking['in_diarrhea_block'])?$ranking['in_diarrhea_block']:0,
            'diarrhea_district' => ($ranking['in_diarrhea_district'])?$ranking['in_diarrhea_district']:0,
            'diarrhea_state' => ($ranking['in_diarrhea_state'])?$ranking['in_diarrhea_state']:0,

            'dengue_max_score_achieved' => ($ranking['dengue_max_score_that_can_be_achieved'])?$ranking['dengue_max_score_that_can_be_achieved']:0,
            'dengue_score_achieved' => ($ranking['dengue_score_achieved'])?$ranking['dengue_score_achieved']:0,
            'dengue_target' => ($ranking['dengue_cut_off'])?$ranking['dengue_cut_off']:0,
            'dengue_performance' => ($ranking['dengue_performance'])?$ranking['dengue_performance']:0,
            'dengue_block' => ($ranking['in_dengue_block'])?$ranking['in_dengue_block']:0,
            'dengue_district' => ($ranking['in_dengue_district'])?$ranking['in_dengue_district']:0,
            'dengue_state' => ($ranking['in_dengue_state'])?$ranking['in_dengue_state']:0,

            'hp_max_score_achieved' => ($ranking['hp_max_score_that_can_be_achieved'])?$ranking['hp_max_score_that_can_be_achieved']:0,
            'hp_score_achieved' => ($ranking['hp_score_achieved'])?$ranking['hp_score_achieved']:0,
            'hp_target' => ($ranking['hp_cut_off'])?$ranking['hp_cut_off']:0,
            'hp_performance' => ($ranking['hp_performance'])?$ranking['hp_performance']:0,
            'hp_block' => ($ranking['in_hp_block'])?$ranking['in_hp_block']:0,
            'hp_district' => ($ranking['in_hp_district'])?$ranking['in_hp_district']:0,
            'hp_state' => ($ranking['in_hp_state'])?$ranking['in_hp_state']:0,

            'diabetes_max_score_achieved' => ($ranking['diabetes_max_score_that_can_be_achieved'])?$ranking['diabetes_max_score_that_can_be_achieved']:0,
            'diabetes_score_achieved' => ($ranking['diabetes_score_achieved'])?$ranking['diabetes_score_achieved']:0,
            'diabetes_target' => ($ranking['diabetes_cut_off'])?$ranking['diabetes_cut_off']:0,
            'diabetes_performance' => ($ranking['diabetes_performance'])?$ranking['diabetes_performance']:0,
            'diabetes_block' => ($ranking['in_diabetes_block'])?$ranking['in_diabetes_block']:0,
            'diabetes_district' => ($ranking['in_diabetes_district'])?$ranking['in_diabetes_district']:0,
            'diabetes_state' => ($ranking['in_diabetes_state'])?$ranking['in_diabetes_state']:0,

            'cvd_max_score_achieved' => ($ranking['cvd_max_score_that_can_be_achieved'])?$ranking['cvd_max_score_that_can_be_achieved']:0,
            'cvd_score_achieved' => ($ranking['cvd_score_achieved'])?$ranking['cvd_score_achieved']:0,
            'cvd_target' => ($ranking['cvd_cut_off'])?$ranking['cvd_cut_off']:0,
            'cvd_performance' => ($ranking['cvd_performance'])?$ranking['cvd_performance']:0,
            'cvd_block' => ($ranking['in_cvd_block'])?$ranking['in_cvd_block']:0,
            'cvd_district' => ($ranking['in_cvd_district'])?$ranking['in_cvd_district']:0,
            'cvd_state' => ($ranking['in_cvd_state'])?$ranking['in_cvd_state']:0,

            'days_patient_voucher_max_score_achieved' => ($ranking['days_patient_voucher_max_score_that_can_be_achieved'])?$ranking['days_patient_voucher_max_score_that_can_be_achieved']:0,
            'days_patient_voucher_score_achieved' => ($ranking['days_patient_voucher_score_achieved'])?$ranking['days_patient_voucher_score_achieved']:0,
            'days_patient_voucher_target' => ($ranking['days_patient_voucher_cut_off'])?$ranking['days_patient_voucher_cut_off']:0,
            'days_patient_voucher_performance' => ($ranking['days_patient_voucher_performance'])?$ranking['days_patient_voucher_performance']:0,
            'days_patient_voucher_block' => ($ranking['in_days_patient_voucher_block'])?$ranking['in_days_patient_voucher_block']:0,
            'days_patient_voucher_district' => ($ranking['in_days_patient_voucher_district'])?$ranking['in_days_patient_voucher_district']:0,
            'days_patient_voucher_state' => ($ranking['in_days_patient_voucher_state'])?$ranking['in_days_patient_voucher_state']:0,

            'patient_vouchers_max_score_achieved' => ($ranking['patient_vouchers_max_score_that_can_be_achieved'])?$ranking['patient_vouchers_max_score_that_can_be_achieved']:0,
            'patient_vouchers_score_achieved' => ($ranking['patient_vouchers_score_achieved'])?$ranking['patient_vouchers_score_achieved']:0,
            'patient_vouchers_target' => ($ranking['patient_vouchers_cut_off'])?$ranking['patient_vouchers_cut_off']:0,
            'patient_vouchers_performance' => ($ranking['patient_vouchers_performance'])?$ranking['patient_vouchers_performance']:0,
            'patient_vouchers_block' => ($ranking['in_patient_vouchers_block'])?$ranking['in_patient_vouchers_block']:0,
            'patient_vouchers_district' => ($ranking['in_patient_vouchers_district'])?$ranking['in_patient_vouchers_district']:0,
            'patient_vouchers_state' => ($ranking['in_patient_vouchers_state'])?$ranking['in_patient_vouchers_state']:0,

            'med_avail_feedback_max_score_achieved' => ($ranking['med_avail_feedback_max_score_that_can_be_achieved'])?$ranking['med_avail_feedback_max_score_that_can_be_achieved']:0,
            'med_avail_feedback_score_achieved' => ($ranking['med_avail_feedback_score_achieved'])?$ranking['med_avail_feedback_score_achieved']:0,
            'med_avail_feedback_target' => ($ranking['med_avail_feedback_cut_off'])?$ranking['med_avail_feedback_cut_off']:0,
            'med_avail_feedback_performance' => ($ranking['med_avail_feedback_performance'])?$ranking['med_avail_feedback_performance']:0,
            'med_avail_feedback_block' => ($ranking['in_med_avail_feedback_block'])?$ranking['in_med_avail_feedback_block']:0,
            'med_avail_feedback_district' => ($ranking['in_med_avail_feedback_district'])?$ranking['in_med_avail_feedback_district']:0,
            'med_avail_feedback_state' => ($ranking['in_med_avail_feedback_state'])?$ranking['in_med_avail_feedback_state']:0,

            'test_avail_feedback_max_score_achieved' => ($ranking['test_avail_feedback_max_score_that_can_be_achieved'])?$ranking['test_avail_feedback_max_score_that_can_be_achieved']:0,
            'test_avail_feedback_score_achieved' => ($ranking['test_avail_feedback_score_achieved'])?$ranking['test_avail_feedback_score_achieved']:0,
            'test_avail_target' => ($ranking['test_avail_feedback_cut_off'])?$ranking['test_avail_feedback_cut_off']:0,
            'test_avail_performance' => ($ranking['test_avail_feedback_performance'])?$ranking['test_avail_feedback_performance']:0,
            'test_avail_block' => ($ranking['in_test_avail_feedback_block'])?$ranking['in_test_avail_feedback_block']:0,
            'test_avail_district' => ($ranking['in_test_avail_feedback_district'])?$ranking['in_test_avail_feedback_district']:0,
            'test_avail_state' => ($ranking['in_test_avail_feedback_state'])?$ranking['in_test_avail_feedback_state']:0,

            'doc_avail_feedback_max_score_achieved' => ($ranking['doc_avail_feedback_max_score_that_can_be_achieved'])?$ranking['doc_avail_feedback_max_score_that_can_be_achieved']:0,
            'doc_avail_feedback_score_achieved' => ($ranking['doc_avail_feedback_score_achieved'])?$ranking['doc_avail_feedback_score_achieved']:0,
            'doc_avail_target' => ($ranking['doc_avail_feedback_cut_off'])?$ranking['doc_avail_feedback_cut_off']:0,
            'doc_avail_performance' => ($ranking['doc_avail_feedback_performance'])?$ranking['doc_avail_feedback_performance']:0,
            'doc_avail_block' => ($ranking['in_doc_avail_feedback_block'])?$ranking['in_doc_avail_feedback_block']:0,
            'doc_avail_district' => ($ranking['in_doc_avail_feedback_district'])?$ranking['in_doc_avail_feedback_district']:0,
            'doc_avail_state' => ($ranking['in_doc_avail_feedback_state'])?$ranking['in_doc_avail_feedback_state']:0,

            'rajdharaa_max_score_achieved' => ($ranking['rajdharaa_max_score_that_can_be_achieved'])?$ranking['rajdharaa_max_score_that_can_be_achieved']:0,
            'rajdharaa_score_achieved' => ($ranking['rajdharaa_score_achieved'])?$ranking['rajdharaa_score_achieved']:0,
            'rajdhara_target' => ($ranking['rajdharaa_cut_off'])?$ranking['rajdharaa_cut_off']:0,
            'rajdhara_performance' => ($ranking['rajdharaa_performance'])?$ranking['rajdharaa_performance']:0,
            'rajdhara_block' => ($ranking['in_rajdharaa_block'])?$ranking['in_rajdharaa_block']:0,
            'rajdhara_district' => ($ranking['in_rajdharaa_district'])?$ranking['in_rajdharaa_district']:0,
            'rajdhara_state' => ($ranking['in_rajdharaa_state'])?$ranking['in_rajdharaa_state']:0,

            'linelist_vs_expected_max_score_achieved' => ($ranking['pregnant_woman_linelist_vs_expected_max_score_that_can_be_achieved'])?$ranking['pregnant_woman_linelist_vs_expected_max_score_that_can_be_achieved']:0,
            'linelist_vs_expected_score_achieved' => ($ranking['pregnant_woman_linelist_vs_expected_score_achieved'])?$ranking['pregnant_woman_linelist_vs_expected_score_achieved']:0,
            'linelist_vs_expected_target' => ($ranking['pregnant_woman_linelist_vs_expected_cut_off'])?$ranking['pregnant_woman_linelist_vs_expected_cut_off']:0,
            'linelist_vs_expected_performance' => ($ranking['pregnant_woman_linelist_vs_expected_performance'])?$ranking['pregnant_woman_linelist_vs_expected_performance']:0,
            'linelist_vs_expected_block' => ($ranking['pregnant_woman_in_linelist_vs_expected_block'])?$ranking['pregnant_woman_in_linelist_vs_expected_block']:0,
            'linelist_vs_expected_district' => ($ranking['pregnant_woman_in_linelist_vs_expected_district'])?$ranking['pregnant_woman_in_linelist_vs_expected_district']:0,
            'linelist_vs_expected_state' => ($ranking['pregnant_woman_in_linelist_vs_expected_state'])?$ranking['pregnant_woman_in_linelist_vs_expected_state']:0,

            'pcts_vs_expected_max_score_achieved' => ($ranking['live_births_pcts_vs_expected_max_score_that_can_be_achieved'])?$ranking['live_births_pcts_vs_expected_max_score_that_can_be_achieved']:0,
            'pcts_vs_expected_score_achieved' => ($ranking['live_births_pcts_vs_expected_score_achieved'])?$ranking['live_births_pcts_vs_expected_score_achieved']:0,
            'pcts_vs_expected_target' => ($ranking['live_births_pcts_vs_expected_cut_off'])?$ranking['live_births_pcts_vs_expected_cut_off']:0,
            'pcts_vs_expected_performance' => ($ranking['live_births_pcts_vs_expected_performance'])?$ranking['live_births_pcts_vs_expected_performance']:0,
            'pcts_vs_expected_block' => ($ranking['live_births_in_pcts_vs_expected_block'])?$ranking['live_births_in_pcts_vs_expected_block']:0,
            'pcts_vs_expected_district' => ($ranking['live_births_in_pcts_vs_expected_district'])?$ranking['live_births_in_pcts_vs_expected_district']:0,
            'pcts_vs_expected_state' => ($ranking['live_births_in_pcts_vs_expected_state'])?$ranking['live_births_in_pcts_vs_expected_state']:0,

            'id_max_score_achieved' => ($ranking['institutional_deliveries_max_score_that_can_be_achieved'])?$ranking['institutional_deliveries_max_score_that_can_be_achieved']:0,
            'id_score_achieved' => ($ranking['institutional_deliveries_score_achieved'])?$ranking['institutional_deliveries_score_achieved']:0,
            'id_target' => ($ranking['institutional_deliveries_cut_off'])?$ranking['institutional_deliveries_cut_off']:0,
            'id_performance' => ($ranking['institutional_deliveries_performance'])?$ranking['institutional_deliveries_performance']:0,
            'id_block' => ($ranking['in_institutional_deliveries_block'])?$ranking['in_institutional_deliveries_block']:0,
            'id_district' => ($ranking['in_institutional_deliveries_district'])?$ranking['in_institutional_deliveries_district']:0,
            'id_state' => ($ranking['in_institutional_deliveries_state'])?$ranking['in_institutional_deliveries_state']:0,

            'fi_max_score_achieved' => ($ranking['full_immunization_max_score_that_can_be_achieved'])?$ranking['full_immunization_max_score_that_can_be_achieved']:0,
            'fi_score_achieved' => ($ranking['full_immunization_score_achieved'])?$ranking['full_immunization_score_achieved']:0,
            'fi_target' => ($ranking['full_immunization_cut_off'])?$ranking['full_immunization_cut_off']:0,
            'fi_performance' => ($ranking['full_immunization_performance'])?$ranking['full_immunization_performance']:0,
            'fi_block' => ($ranking['in_full_immunization_block'])?$ranking['in_full_immunization_block']:0,
            'fi_district' => ($ranking['in_full_immunization_district'])?$ranking['in_full_immunization_district']:0,
            'fi_state' => ($ranking['in_full_immunization_state'])?$ranking['in_full_immunization_state']:0,

            'pss_max_score_achieved' => ($ranking['pss_max_score_that_can_be_achieved'])?$ranking['pss_max_score_that_can_be_achieved']:0,
            'pss_score_achieved' => ($ranking['pss_score_achieved'])?$ranking['pss_score_achieved']:0,
            'pss_target' => ($ranking['pss_cut_off'])?$ranking['pss_cut_off']:0,
            'pss_performance' => ($ranking['pss_performance'])?$ranking['pss_performance']:0,
            'pss_block' => ($ranking['in_pss_block'])?$ranking['in_pss_block']:0,
            'pss_district' => ($ranking['in_pss_district'])?$ranking['in_pss_district']:0,
            'pss_state' => ($ranking['in_pss_state'])?$ranking['in_pss_state']:0,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

            'patient_satisfaction_max_score_achieved' => ($ranking['pss_max_score_that_can_be_achieved'])?$ranking['pss_max_score_that_can_be_achieved']:'00',
            'patient_satisfaction_score_achieved' => ($ranking['pss_score_achieved'])?$ranking['pss_score_achieved']:'00',
            'patient_satisfaction_cut_off' => ($ranking['pss_cut_off'])?$ranking['pss_cut_off']:'00',
            'patient_satisfaction_performance' => ($ranking['pss_performance'])?$ranking['pss_performance']:'00',
            'patient_satisfaction_block' => ($ranking['in_pss_block'])?$ranking['in_pss_block']:'00',
            'patient_satisfaction_district' => ($ranking['in_pss_district'])?$ranking['in_pss_district']:'00',
            'patient_satisfaction_state' => ($ranking['in_pss_state'])?$ranking['in_pss_state']:'00',
        ];
    }
}
