<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MoicRanking;
use DB;
use Chumper\Zipper\Zipper;
use PDF;

class MoicRankingsPDF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:save_pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MOIC rankings save pdf from moic_ranking & moic_ranking_report table';

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
        if (!isset($_SERVER["SCRIPT_FILENAME"])) $_SERVER["SCRIPT_FILENAME"] = "";
        $not_genrated_pdf = MoicRanking::where('status', 'Y')->where('ranking_pdf', '')->where('zip_path', '')->select('id', 'uploaded_file', 'block', 'month', 'year', 'phc_en')->get();
        $cnt = count($not_genrated_pdf);
        if($cnt > 0){
            $months = \DB::table('master_months')->pluck('month_english', 'id')->toArray();
            $filenames = $not_genrated_pdf->pluck('uploaded_file')->unique()->toArray();
            $reports_for_xls = DB::table('moic_ranking_reports')->whereIn('filename', $filenames)->get();
            echo $cnt.' rows are there for pdf generation';
            echo PHP_EOL;
            foreach($not_genrated_pdf as $single){
                $found = $reports_for_xls->filter(function($value,$key) use($single){
                    return (strtolower($value->phc_name) == strtolower($single->phc_en) && $value->month == $single->month && $value->year == $single->year && $value->filename == $single->uploaded_file);
                });
                $first = $found->first();
                if(!empty($first)){
                    $folder = explode('.',$single->uploaded_file);
                    $array = json_decode(json_encode($first));
                    $path = '/moic/rankings/zips/'.$folder[0].'/'.$single['block'];
                    if (!is_dir(public_path().$path)) {
                        mkdir(public_path().$path, 0777, true);
                    }
                    $fname = time().snake_case($array->phc_name).'.pdf';
                    libxml_use_internal_errors(true);
                    libxml_use_internal_errors(true);
                    $pdf = PDF::setPaper('A4');
                    $pdf = PDF::loadView('pdfv2', ['report' => $array, 'months' => $months])->save(public_path().$path.'/'.$fname);
                    echo 'File '.$fname.' is saved in moic/rankings/zips/'.$folder[0].'/'.$single['block'];

                    $pdf = MoicRanking::find($single->id);
                    $pdf->ranking_pdf = '/moic/rankings/zips/'.$folder[0].'/'.$single['block'].'/'.$fname;
                    $pdf->save();
                }else{
                    echo "Rankings not found.!!";
                }
                echo PHP_EOL;
            }
        }else{
            echo 'Either report is not genarated or no new request is pending for pdf generation';
        }
        echo PHP_EOL;
    }
}
