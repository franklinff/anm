<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FeedbackModel;
use App\Classes\Helpers;
use Carbon\Carbon;
use DB;

class FeedbackSmsDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedback:sms_dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send Patient feedback sms to Doctor';

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
        $newsms = FeedbackModel::select('complete_sms','mobile_no','id')
                                ->where('sms_sent',0)
                                ->where('mobile_no','!=','')
                                ->where('complete_sms','!=','')
                                ->where('schedule_at', '<=', Carbon::now())
                                ->get()
                                ->toArray();

     if(count($newsms)>0){
         $ids = [];
            foreach($newsms as $sms){
                $status = Helpers::sendSmsUnicode($sms['complete_sms'],$sms['mobile_no']);
                if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                    $ids[] = $sms['id'];
                }
            }
            FeedbackModel::whereIn('id', $ids)->update(['sms_sent' => 1]);
            echo "SMS sent to the respective doctor provided with a valid contact number".PHP_EOL;
        }else{
            echo "All sms requests are already completed.".PHP_EOL;
        }
    }
}
