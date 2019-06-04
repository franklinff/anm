<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AnmTargetDataModel;
use DB;
use App\Classes\Helpers;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;

class AnmSmsDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anm:sms_dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send sms to anm from targetted data';

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
        $newsms = AnmTargetDataModel::where('anm_sms_initiated', 0)->where('schedule_at', '<', Carbon::now())->get();
        $cnt = count($newsms);
        if($cnt > 0){
            echo $cnt." new anm sms requests found".PHP_EOL;
            $insert_data = [];
            $ids= [];
            foreach ($newsms as $sms){
                $separated_msg = explode('==', $sms->anm_custom_msg);
                $separated_num = explode(',', $sms->anm_mobile_number);
                $separated_anm = explode(',', $sms->anm_name);
                $cnt = count($separated_num);
                for($i=0; $i<$cnt; $i++){
                    $combined_sms = $separated_msg[$i].' '.url('/anm/'.$sms->weblink);
                    $temp = [
                        'filename' => $sms->filename,
                        'name' => $separated_anm[$i],
                        'mobile' => $separated_num[$i],
                        'type' => 'anm',
                        'sms' => $combined_sms,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];

                    $status = Helpers::sendSmsUnicode($combined_sms, $separated_num[$i]);
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

            if(!empty($insert_data)){
                DB::table('anm_mos_smslogs')->insert($insert_data);
                AnmTargetDataModel::whereIn('id', $ids)->update(['anm_sms_initiated' => 1]);
            }
            echo count($ids)." "."SMS Dispatched!!".PHP_EOL;
        }else{
            echo "All new anm sms requests are dispatched".PHP_EOL;
        }

/*        //Attempt to send failed sms again
        $fails = DB::table('anm_mos_smslogs')->where('is_sent', 0)->whereNUll('sent_at')->get();
        $count = count($fails);
        if($count > 0){
            echo $count.' failed requests found'.PHP_EOL;
            foreach($fails as $sms){
                $status = Helpers::sendSmsUnicode($sms->sms, $sms->mobile);
                if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                    $temp['is_sent'] = 1;
                    $temp['sent_at'] = Carbon::now();
                    DB::table('anm_mos_smslogs')->where('id', $sms->id)->update($temp);
                }else{
                    $temp['is_sent'] = 0;
                    $temp['sent_at'] = NULL;
                    DB::table('anm_mos_smslogs')->where('id', $sms->id)->update($temp);
                }
            }
            echo "Dispatched!!".PHP_EOL;
        }else{
            echo "All failed sms requests are done".PHP_EOL;
        }*/
    }
}
