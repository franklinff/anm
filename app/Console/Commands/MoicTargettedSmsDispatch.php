<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AnmTargetDataModel;
use DB;
use App\Classes\Helpers;
use Carbon\Carbon;


class MoicTargettedSmsDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:targetted_sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send sms to moic from targetted data';

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
        $newsms = AnmTargetDataModel::where('moic_sms_initiated', 0)->where('schedule_at', '<', Carbon::now())->get();
        $cnt = count($newsms);
        if($cnt > 0){
            echo $cnt." new moic sms requests found".PHP_EOL;
            $ids = $newsms->pluck('id');
            $insert = [];
            foreach ($newsms as $sms){
                $combined_sms = $sms->moic_custom_msg.' '.url('/anm/'.$sms->weblink);
                $temp = [
                    'filename' => $sms->filename,
                    'name' => $sms->moic_name,
                    'mobile' => $sms->moic_mobile_number,
                    'type' => 'moic',
                    'sms' => $combined_sms,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $status = Helpers::sendSmsUnicode($combined_sms, $sms->moic_mobile_number);
                if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                    $temp['is_sent'] = 1;
                    $temp['sent_at'] = Carbon::now();
                }
                $insert[] = $temp;
            }
            if(!empty($insert)){
                DB::table('anm_mos_smslogs')->insert($insert);
                AnmTargetDataModel::whereIn('id', $ids)->update(['moic_sms_initiated' => 1]);
            }
            echo "Dispatched!!".PHP_EOL;
        }else{
            echo "All new moic sms requests are dispatched".PHP_EOL;
        }

        //Attempt to send failed sms again
        $fails = DB::table('anm_mos_smslogs')->where('is_sent', 0)->whereNUll('sent_at')->get();
        $count = count($fails);
        if($count > 0){
            $ids = $fails->pluck('id');
            $insert = [];
            echo $count.' failed requests found'.PHP_EOL;
            foreach($fails as $sms){
                $status = Helpers::sendSmsUnicode($sms->sms, $sms->mobile);
                if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                    $temp['is_sent'] = 1;
                    $temp['sent_at'] = Carbon::now();
                }
                DB::table('anm_mos_smslogs')->where('id', $sms->id)->update($temp);
            }
            echo "Dispatched!!".PHP_EOL;
        }else{
            echo "All failed sms requests are done".PHP_EOL;
        }
    }
}
