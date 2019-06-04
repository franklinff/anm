<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MoicRanking;
use Chumper\Zipper\Zipper;
use DB;

class MoicSaveRankingZip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:save_zip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MOIC genarate zip for uploaded excel report';

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
        $genrated_pdf = MoicRanking::where('status', 'Y')->where('ranking_pdf', '!=', '')->where('zip_path', '')->select('id', 'uploaded_file', 'block', 'month', 'year', 'phc_en')->get();
        $cnt = count($genrated_pdf);
        if($cnt > 0){
            $filenames = $genrated_pdf->pluck('uploaded_file')->unique();
            echo count($filenames).' phc\'s have pdf report.!!';
            echo PHP_EOL;
            foreach($filenames as $file){
                $folder = explode('.', $file);
                $pdf_path = public_path().'/moic/rankings/zips/'.$folder[0];
                if(is_dir($pdf_path)){
                    $folders_tozipped = glob($pdf_path);
                    $zipper = new Zipper;
                    $zipper->make($pdf_path.'/'.$folder[0].'.zip')->add($folders_tozipped)->close();
                    \DB::table('moic_ranking')
                        ->where('uploaded_file', $file)
                        ->where('status', 'Y')
                        ->where('ranking_pdf', '!=', '')
                        ->update(['zip_path' => '/moic/rankings/zips/'.$folder[0].'/'.$folder[0].'.zip']);
                    echo 'Zip '.$folder[0].'.zip for '.$file.' is saved at /moic/rankings/zips/'.$folder[0];
                }
                else{
                    echo 'Oops!! PDF for '.$file.' is genarated but not stored.!!';
                }
                echo PHP_EOL;
            }
        }else{
            echo 'Either pdf is not saved or no new request is pending for zip generation.!!';
        }
        echo PHP_EOL;
    }
}
