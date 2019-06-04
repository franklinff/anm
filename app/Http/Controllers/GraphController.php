<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\MoicRanking;


class GraphController extends Controller
{
    public function index($id)
    {
        $category = 'anm';
        $filename= AnmTargetDataModel::select('filename')->where('id',$id)->first()->toArray();

        $list_data = AnmTargetDataModel::leftjoin('anm_weblink_logs','anm_target_data.id', '=', 'anm_weblink_logs.weblink_id')
            ->selectRaw('SUM(IF(anm_sms_initiated=1, 1, 0)) AS countSentSms,COUNT(anm_weblink_logs.weblink_id) as weblink_opened,COUNT(filename) AS total_rows')
            ->where('filename',$filename['filename'])->first()->toArray();

        return view('chart',compact('list_data','category'));

    }

    public function graphMoic($id)
    {
        $category = 'moic';
        $filename= MoicRanking::select('uploaded_file')->where('id',$id)->first()->toArray();

        $list_data = MoicRanking::selectRaw('SUM(IF(sms_sent_initiated=1, 1, 0)) AS countSentSms,
                                                COUNT(moic_logs.weblink_id) as weblink_opened,
                                                COUNT(moic_ranking.og_moic_filename) AS total_rows')
            ->leftjoin('moic_ranking_reports', 'moic_ranking.id', '=', 'moic_ranking_reports.id')
            ->leftjoin('moic_logs', 'moic_ranking.id', '=', 'moic_logs.weblink_id')
            ->where('uploaded_file',$filename['uploaded_file'])->first()->toArray();

        return view('chart',compact('list_data','category'));
    }

}
