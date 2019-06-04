<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MoicRanking;
use DB;
use App\Classes\Helpers;
use Carbon\Carbon;


class MoicSmsDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:sms_dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send sms to respected moic rankings\'s ';

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
        //To check any new sms request
        $new_sms = MoicRanking::where('sms_sent_initiated', 0)->where('schedule_at', '<=', Carbon::now())->get();

        $count = count($new_sms);
        if($count === 0) {
            echo "All sms requests are done".PHP_EOL;
            return;
        }

        $links = \DB::table('moic_ranking_reports')->pluck('dr_weblink', 'rank_id')->toArray();
        $ids = [];
        $insert_data = [];
        echo $count.' new requests found'.PHP_EOL;
        
        foreach($new_sms as $sms) {
            if(empty($links[$sms->id])) {
                continue;
            }
            
            $weblink = $links[$sms->id];
            $sms_list = [ $sms->sms ];
            $drNames = [ $sms->dr_name_en ];
            $mobiles = [ $sms->mobile ];
            if (strpos($sms->sms, '@@') !== FALSE) {
                $sms_list = explode('@@', $sms->sms);
                $drNames = explode(',', $sms->dr_name_en);
                $mobiles = explode(',', $sms->mobile);
            }

            for ($i = 0, $c = count( $sms_list ); $i < $c; $i++) {
                
                $url = url('/scorecard/'.$weblink);
                $combined_sms = $sms_list[$i].' '.$url;
                $temp = [
                    'filename' => $sms->uploaded_file,
                    'dr_name' => $drNames[$i],
                    'mobile' => $mobiles[$i],
                    'sms' => $combined_sms,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $status = Helpers::sendSmsUnicode($combined_sms, $mobiles[$i]);
                if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                    $ids[] = $sms->id;
                    $temp['is_sent'] = 1;
                    $temp['sent_at'] = Carbon::now();
                }else{
                    $temp['is_sent'] = 0;
                    $temp['sent_at'] = NULL;
                }
                $insert_data[] = $temp;

            }
            
        }
        if( $insert_data ) {
            if( DB::table('mois_anm_sms_logs')->insert($insert_data) ) {
                MoicRanking::whereIn('id',$ids)->update(['sms_sent_initiated' => 1]);
                echo count($ids)." "."SMS Dispatched!!".PHP_EOL;
            }
        }
        

        //Attempt to send failed sms again
/*        $fails = DB::table('mois_anm_sms_logs')->where('is_sent', 0)->whereNUll('sent_at')->get();
        $count = count($fails);
        if($count > 0){
            $insert = [];
            echo $count.' failed requests found'.PHP_EOL;
            foreach($fails as $sms){
                $status = Helpers::sendSmsUnicode($sms->sms, $sms->mobile);
                if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                    $temp['is_sent'] = 1;
                    $temp['sent_at'] = Carbon::now();
                    DB::table('mois_anm_sms_logs')->where('id', $sms->id)->update($temp);
                }else{
                    $temp['is_sent'] = 0;
                    $temp['sent_at'] = NULL;
                    DB::table('mois_anm_sms_logs')->where('id', $sms->id)->update($temp);
                }
            }
            echo "Done!!".PHP_EOL;
        }else{
            echo "All failed sms requests are done".PHP_EOL;
        }*/

    }
}
