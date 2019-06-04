<?php

namespace App\Http\Controllers;

use Dompdf\Exception;
use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\PhcTranslationModel;
use App\DistrictModel;

use App\AnmDetailsModel;
use Illuminate\Support\Facades\DB;
use Anam\PhantomMagick\Converter;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class WeblinkController extends Controller
{
    public function index($id)
    {
        $anm_target_data = AnmTargetDataModel::select('phc_name','scenerio','month','year','filename')
                                                ->where('weblink',$id)
                                                ->get()
                                                ->toArray();

        $selected_month = DB::table('master_months')
                            ->select('month_english','id')
                            ->where('id', $anm_target_data[0]['month'])->first();

        $current_month = $selected_month->month_english;
        $next_mt = date('F', strtotime('+1 month', strtotime($anm_target_data[0]['year'].'-'.$anm_target_data[0]['month'].'-'.'01')));

        $month_details = DB::table('master_months')
            ->pluck('month_translated', 'month_english')->toArray();

        if(array_key_exists($current_month, $month_details))
        {
            $current_month = $month_details[$current_month];
            $next_month = $month_details[$next_mt];
        }
//        $next_month = date('F',strtotime('first day of +1 month'));
//
//        if(array_key_exists($next_month, $month_details))
//        {
//            $next_month = $month_details[$next_month];
//        }
        $targetDataVariable = array();
        $anm_moic_code = array();
        $anm_beneficiary_code = array();
        $targetDataVariable = $anm_target_data;
        $type = 'anm';
        $lstAnmCategory = array();
        $last_target_data = AnmTargetDataModel::select('district','phc_name','phc_hin','moic_name','moic_hin','moic_mobile_number','anm_name','anm_hin','subcenter_hindi',
            'anm_mobile_number','performer_category','scenerio')
            ->where('phc_name',$targetDataVariable[0]['phc_name'])
            ->where('filename',$targetDataVariable[0]['filename'])
            ->get()
            ->toArray();
        foreach ($last_target_data as $value){
            $lstAnmCategory[$value['performer_category']][] = $value;
        }

        $lstData = array();

        if(!empty($lstAnmCategory['TOP'])){
            $lstData['phc_name'] = $lstAnmCategory['TOP'][0]['phc_hin'];
        }
        if(!empty($lstAnmCategory['MIDDLE'])){
            $lstData['phc_name'] = $lstAnmCategory['MIDDLE'][0]['phc_hin'];
        }
        if(!empty($lstAnmCategory['BOTTOM'])){
            $lstData['phc_name'] = $lstAnmCategory['BOTTOM'][0]['phc_hin'];
        }

        if($type == 'anm')
        {
            foreach($lstAnmCategory as $key => $value)
            {
                $lstValue = array();
                $lstUniqueSubcenter = array();
                foreach ($value as $uniqueValue)
                {
                    if(in_array($uniqueValue['subcenter_hindi'],$lstUniqueSubcenter)){
                        continue;
                    }
                    $lstUniqueSubcenter[] = $uniqueValue['subcenter_hindi'];
                    $lstValue[] = $uniqueValue;
                }
                foreach ($lstValue as $anm => $details)
                {
                    if(! next($lstValue))
                    {
                        $lstData[$key]['end'] = $details['subcenter_hindi'];
                    }
                    else
                    {
                        $lstData[$key]['subcenter'][] = $details['subcenter_hindi'];
                    }
                }
            }
        }

        $ip = $this->getRealIpAddr();

        $anm_weblink_logs = [
            'ip_address' => $ip ,
            'clicked_at' => Carbon::now(),
            'link' => $id,
            'created_at' => Carbon::now(),
            'click_count' => 1
        ];

        $already_clicked = DB::table('anm_weblink_logs')->select('id','click_count')->where('link',$id)->get()->first();

        if(count($already_clicked) == 0 ){

            DB::table('anm_weblink_logs')->insert($anm_weblink_logs);

            DB::update('update anm_weblink_logs
               set weblink_id=(select id from anm_target_data where anm_target_data.weblink=anm_weblink_logs.link),
                mobile_no=(select anm_mobile_number from anm_target_data where anm_target_data.weblink=anm_weblink_logs.link)
               WHERE weblink_id = 0');

        }elseif($already_clicked->click_count == 1){

            DB::table('anm_weblink_logs')
                ->where('link',$id)
                ->update(['ip_address2' => $ip,'clicked_at2' =>Carbon::now(), 'click_count'=>2 ]);

        }elseif($already_clicked->click_count == 2){

            DB::table('anm_weblink_logs')
                ->where('link',$id)
                ->update(['ip_address3' => $ip,'clicked_at3' =>Carbon::now(),'click_count'=>3]);

        }

        if(!empty($targetDataVariable)){

                $scenario = $targetDataVariable[0]['scenerio'];
                $scenes = 'scenario_' . $scenario;
                if ($scenario == 1) {
                    return view('scenerio/scenerio_01', compact('lstData', 'type', 'current_month', 'next_month', 'scenes'));
                }
                if ($scenario == 2) {
                    return view('scenerio/scenerio_02', compact('lstData', 'current_month', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 3) {
                      return view('scenerio/scenerio_03', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 4) {;
                    return view('scenerio/scenerio_04', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 5) {
                    return view('scenerio/scenerio_05', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 6) {
                    return view('scenerio/scenerio_06', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 7) {
                    return view('scenerio/scenerio_07', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 8) {
                    return view('scenerio/scenerio_08', compact('current_month', 'lstData', 'type', 'next_month','scenes'));
                }
            }else{
                abort(404);
            }
    }

    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function downloadImage()
    {
        $url = URL::previous();

        Converter::make($url)
            ->toJpg()
            ->download('anm.jpg');
    }
}
