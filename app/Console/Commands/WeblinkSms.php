<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AnmTargetDataModel;
use App\AnmDetailsModel;

class WeblinkSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weblinksms:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $data = AnmTargetDataModel::select('phc_name','moic_name','moic_mobile_number','anm_name','anm_mobile_number','scenerio','performer_category')
                                    ->where('status','Y')
                                    ->where('sms',Null)
                                    ->where('weblink',Null)
                                    ->get()
                                    ->toArray();
        $lstAnmData = AnmDetailsModel::select('anm_name','anm_translation')->pluck('anm_translation','anm_name')->toArray();

        $lstPhcDetails = array();
        foreach ($data as $value){

            if( strpos($value['anm_name'], ',') !== false ) {
                $multipleAnms = explode(',',$value['anm_name']);
                $anmArray = array();
                foreach($multipleAnms as $anm){
                    if(array_key_exists($anm,$lstAnmData)){
                        $anmName = $lstAnmData[$anm];
                    }else{
                        $anmName = $value['anm_name'];
                    }
                    $anmArray[] = $anmName;
                }
               $value['anm_name'] = implode(',',$anmArray);
            }

            if(array_key_exists($value['anm_name'],$lstAnmData)){
                $value['anm_name'] = $lstAnmData[$value['anm_name']];
            }else{
                $value['anm_name'] = $value['anm_name'];
            }

            $lstPhcDetails[$value['phc_name']][$value['performer_category']][] = $value;

        }
    }
}
