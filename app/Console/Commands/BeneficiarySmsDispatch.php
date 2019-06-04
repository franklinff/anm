<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BeneficiaryModel;
use App\AnmTargetDataModel;
use DB;
use App\Classes\Helpers;
use Carbon\Carbon;



class BeneficiarySmsDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'beneficiary:sms_dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send sms to beneficiary from targetted data';

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
        $newsms = BeneficiaryModel::where('benef_sms_initiated', 0)->get();
        $cnt = count($newsms);
        if($cnt > 0){
            $benef_sms = AnmTargetDataModel::select('beneficiary_custom_msg', 'phc_name', 'weblink')->where('schedule_at', '<=', Carbon::now())->groupBy('phc_name')->get()->toArray();
            echo $cnt." new beneficiary sms requests found".PHP_EOL;
            $insert = [];
            foreach ($newsms as $sms){
                $found = array_filter($benef_sms, function($index) use($sms){
                    return $sms->phc_name == $index['phc_name'];
                });
                if(!empty($found)){
                    $ids[] = $sms->id;
                    $array = reset($found);
                    $combined_sms = $array['beneficiary_custom_msg'].' '.url('/anm/'.$array['weblink']);
                    $temp = [
                        'filename' => $sms->filename,
                        'name' => ($sms->phc_name != '')?$sms->phc_name:'',
                        'mobile' => ($sms->beneficary_mobile_number != '')?$sms->beneficary_mobile_number:0,
                        'type' => 'beneficiary',
                        'sms' => $combined_sms,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    $status = Helpers::sendSmsUnicode($combined_sms, $sms->beneficary_mobile_number);
                    if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                        $temp['is_sent'] = 1;
                        $temp['sent_at'] = Carbon::now();
                    }
                    $insert[] = $temp;
                }
            }
            if(!empty($insert)){
                DB::table('anm_mos_smslogs')->insert($insert);
                BeneficiaryModel::whereIn('id', $ids)->update(['benef_sms_initiated' => 1]);
            }
            echo "Dispatched!!".PHP_EOL;
        }else{
            echo "All new beneficiary sms requests are dispatched".PHP_EOL;
        }

        //Attempt to send failed sms again
        $fails = DB::table('anm_mos_smslogs')->where('is_sent', 0)->whereNUll('sent_at')->get();
        $count = count($fails);
        if($count > 0){
            $insert = [];
            echo $count.' failed requests found'.PHP_EOL;
            foreach($fails as $sms){
                $status = Helpers::sendSmsUnicode($sms->sms, $sms->mobile);
                if($status['status']){
                    $temp['is_sent'] = 1;
                    $temp['sent_at'] = Carbon::now();
                    DB::table('anm_mos_smslogs')->where('id', $sms->id)->update($temp);
                }
            }
            echo "Dispatched!!".PHP_EOL;
        }else{
            echo "All failed sms requests are done".PHP_EOL;
        }
    }
}
