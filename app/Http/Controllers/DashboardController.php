<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\MoicRanking;
use App\FeedbackModel;
use App\NudgeModel;
use DB;
//use DataTables;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{

    public function index()
    {
        $category = '';$list_data = '';
        return view('dashboard',compact('list_data','category'));
    }

    public function listing(Request $request)
    {
       $category = $request['category_module'];

        if($category == 'Anm'){

            $list_data = AnmTargetDataModel::leftjoin('anm_weblink_logs','anm_target_data.id', '=', 'anm_weblink_logs.weblink_id')
                                            ->selectRaw('og_filename,uploaded_on,anm_target_data.id,
                                             SUM(IF(anm_sms_initiated=1, 1, 0)) AS countSentSms,
                                             COUNT(anm_weblink_logs.weblink_id) as weblink_opened,
                                             COUNT(filename) AS total_rows');
                                            if($request->from_date)
                                            {
                                                $list_data->where('uploaded_on', '>=', $request->from_date);
                                            }
                                            if($request->to_date)
                                            {
                                                $list_data->where('uploaded_on', '<=', $request->to_date);
                                            }
            $list_data = $list_data->groupBy('filename')->orderBy('uploaded_on', 'DESC')->get()->toArray();

        }elseif ($category == 'Moic'){  

            $list_data = MoicRanking::selectRaw('og_moic_filename as og_filename,moic_ranking.created_at as uploaded_on,moic_ranking.id,
                                                SUM(IF(sms_sent_initiated=1, 1, 0)) AS countSentSms,
                                                COUNT(moic_logs.weblink_id) as weblink_opened,
                                                COUNT(moic_ranking.og_moic_filename) AS total_rows')
                                    ->leftjoin('moic_ranking_reports', 'moic_ranking.id', '=', 'moic_ranking_reports.rank_id')
                                    ->leftjoin('moic_logs', 'moic_ranking_reports.id', '=', 'moic_logs.weblink_id');
                                     if($request->from_date){
                                         $list_data->where('moic_ranking.created_at','>=',$request->from_date);
                                     }
                                     if($request->to_date){
                                         $list_data ->where('moic_ranking.created_at','<=',$request->to_date);
                                     }
            $list_data = $list_data->groupBy('uploaded_file')->orderBy('uploaded_on', 'DESC')->get()->toArray();

        }elseif ($category == 'Feedback'){

            dd('Feedback');
            $list_data = FeedbackModel::selectRaw('og_filename,created_at as uploaded_on,id,COUNT(filename) AS total_rows');
                                        if($request->from_date){
                                            $list_data->where('created_at','>=',$request->from_date);
                                        }
                                        if($request->to_date){
                                            $list_data ->where('created_at','<=',$request->to_date);
                                        }
            $list_data =  $list_data->groupBy('filename')->get()->toArray();
        }elseif ($category == 'Nudges'){

            $list_data = NudgeModel::selectRaw('id,og_filename,schedule_at,created_at as uploaded_on,COUNT(id)AS total_rows,SUM(IF(sms_sent=1, 1, 0)) AS countSentSms');
                                        if($request->from_date){
                                            $list_data->where('created_at','>=',$request->from_date);
                                        }
                                        if($request->to_date){
                                            $list_data ->where('created_at','<=',$request->to_date);
                                        }
            $list_data = $list_data->groupBy('filename')
                                      ->get()->toArray();
        }

        return view('dashboard',compact('list_data','category'));
    }

    public function anm_details($id){

        $category = 'Anm';
        $file = AnmTargetDataModel::select('filename')
                ->where('id',$id)->get()->toArray();

        $file_data = AnmTargetDataModel::select('weblink','anm_sms_initiated AS sms_sent','anm_weblink_logs.ip_address','anm_weblink_logs.clicked_at',
            'anm_mobile_number AS mobile_no','anm_weblink_logs.ip_address2','anm_weblink_logs.clicked_at2','anm_weblink_logs.ip_address3','anm_weblink_logs.clicked_at3')
                ->leftJoin('anm_weblink_logs', 'anm_target_data.weblink', '=', 'anm_weblink_logs.link')
                ->where('filename',$file[0]['filename'])->paginate(10);


        return view('dashboarddetails',compact('file_data','id','category'));
    }

    public function moic_details($id){

        $category = 'Moic';
        $file = MoicRanking::select('uploaded_file')
                             ->where('id',$id)->first();

        $file_data = DB::table('moic_ranking_reports')->select('moic_ranking_reports.dr_weblink as weblink',
                                                               'moic_logs.ip_address',
                                                               'moic_logs.clicked_at','moic_ranking.mobile as mobile_no',
                                                               'moic_ranking.sms_sent_initiated AS sms_sent',
            'moic_logs.ip_address2','moic_logs.clicked_at2','moic_logs.ip_address3','moic_logs.clicked_at3')
            ->leftJoin('moic_ranking','moic_ranking_reports.sr_no','=','moic_ranking.sr_no')
            ->leftJoin('moic_logs','moic_ranking_reports.dr_weblink','=','moic_logs.link')
            ->where('filename',$file->uploaded_file)
            ->groupBy('moic_ranking_reports.dr_weblink')
            ->paginate(10);

        return view('dashboarddetails',compact('file_data','id','category'));
    }

    public function feedback_details($id){

        $file = FeedbackModel::select('filename')
                                    ->where('id',$id)
                                    ->get()->toArray();

        $filename = $file[0]['filename'];

        $file = FeedbackModel::select('filename')
            ->where('filename',$filename)
            ->get()->toArray();

        return view('dashboarddetails');
    }

    //displays nudge file details
    public function nudge_details($id){
        $location = 'dashboard';
        return view('nudge_detail',compact('id','location'));
    }

    //ANM weblinks excel download
    public function anm_weblinks_export($id)
    {
        $file = AnmTargetDataModel::select('filename')
            ->where('id',$id)
            ->first();

        $data = AnmTargetDataModel::select('weblink','anm_sms_initiated','anm_mobile_number',
            'anm_weblink_logs.ip_address','anm_weblink_logs.clicked_at','anm_weblink_logs.ip_address2','anm_weblink_logs.clicked_at2','anm_weblink_logs.ip_address3','anm_weblink_logs.clicked_at3')
                                ->leftJoin('anm_weblink_logs', 'anm_target_data.id', '=', 'anm_weblink_logs.weblink_id')
                                ->where('filename',$file['filename'])
                                ->get()
                                ->toArray();

        \Excel::create('anm_weblink'.time(), function($excel) use($data) {
            $excel->sheet('anm_weblink', function($sheet) use($data) {
                $excelData = [];
                $excelData[] = [
                    'Weblink',
                    'Mobile number',
                    'SMS sent(y/n)',
                    'IP address1',
                    'Clicked at1',
                    'IP address 2',
                    'IP2 Clicked at',
                    'IP address 3',
                    'IP3 Clicked at'
                ];

                foreach ($data as $value) {
                    if($value['anm_sms_initiated'] == 0 || $value['anm_sms_initiated'] == 2){
                        $sms = 'No';
                    }else{
                        $sms = 'Yes';
                    }

                    $excelData[] = array(
                        url('/').'/anm/'.$value['weblink'],
                        $value['anm_mobile_number'],
                        $sms,
                        $value['ip_address'],
                        $value['clicked_at'],
                        $value['ip_address2'],
                        $value['clicked_at2'],
                        $value['ip_address3'],
                        $value['clicked_at3'],
                    );
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
        })->download('xlsx');
    }

    //MOIC weblinks excel download
    public function moic_weblinks_export($id)
    {
        $file = MoicRanking::select('uploaded_file')
                            ->where('id',$id)
                            ->first();

        $file_data = DB::table('moic_ranking_reports')->select('dr_weblink as weblink','moic_logs.ip_address','moic_logs.clicked_at',
            'moic_ranking.sms_sent_initiated AS sms_sent','moic_ranking.mobile','moic_logs.ip_address2','moic_logs.clicked_at2','moic_logs.ip_address3','moic_logs.clicked_at3')
            ->leftJoin('moic_ranking', 'moic_ranking_reports.sr_no', '=', 'moic_ranking.sr_no')
            ->leftJoin('moic_logs', 'moic_ranking_reports.dr_weblink', '=', 'moic_logs.link')
            ->where('filename',$file['uploaded_file'])
            ->groupBy('moic_ranking_reports.dr_weblink')
            ->get()->toArray();


        \Excel::create('moic_weblink'.time(), function($excel) use($file_data) {
            $excel->sheet('moic_weblink', function($sheet) use($file_data) {
                $excelData = [];
                $excelData[] = [
                    'Weblink',
                    'Mobile number',
                    'SMS sent(y/n)',
                    'IP address1',
                    'IP1 Clicked at',
                    'IP address 2',
                    'IP2 Clicked at',
                    'IP address 3',
                    'IP3 Clicked at'
                ];

                foreach ($file_data as $value) {

                    if($value->sms_sent == 0){
                        $sms = 'No';
                    }else{
                        $sms = 'Yes';
                    }

                    $excelData[] = array(
                        url('/').'/scorecard/'.$value->weblink,
                        $value->mobile,
                        $sms,
                        $value->ip_address,
                        $value->clicked_at,

                        $value->ip_address2,
                        $value->clicked_at2,
                        $value->ip_address3,
                        $value->clicked_at3

                    );
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
        })->download('xlsx');
    }


}




