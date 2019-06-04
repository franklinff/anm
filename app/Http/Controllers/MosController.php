<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\PhcTranslationModel;
use App\District;
use App\Http\Requests\ImportMosRankingRequest;
use App\MoicRanking;
use Excel;
use File;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Storage;
use App\Classes\ConvertToUnicode;
use Chumper\Zipper\Zipper;
use App\RankingZip;
use Session;
use DB;



class MosController extends Controller
{

    public function index()
    {
        return view('mois');
    }

    public function fetchRankingData(){

        $moic = MoicRanking::select('id','og_moic_filename AS filenames', 'zip_path', 'schedule_at','uploaded_file','created_at', \DB::raw('group_concat(distinct sms_sent_initiated) as sms_sent_initiateds'))
            ->selectRaw("DATE(created_at) as uploaded_on" )
            ->groupBy('uploaded_file')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();

        $db = Datatables::of($moic);
        $db->addColumn('sr_no', function ($moic){ static $i = 0; $i++; return $i; }) ->rawColumns(['id']);
        $db->addColumn('actions', function ($moic) {
            return '<a href="'.route('rankingdetails',$moic['id']).'">View details</a>';
        })->addColumn('download_zip', function($moic){
            if($moic['zip_path'] != ''){
                $folder = explode('.', $moic['uploaded_file']);
                return '<a href="'.url('/download/moic_zip/'.$folder[0]).'" target="_blank">Download Zip</a>';
            }
            return "Processing";
        })->addColumn('reschedule', function($moic){
            $arr_reschedule = explode(',', $moic['sms_sent_initiateds']);
            if(in_array("1", $arr_reschedule)){
                return 'SMS already sent';
            }elseif(in_array("0", $arr_reschedule)){

                return '<input type="hidden" id="'.$moic['uploaded_file'].'" value="'.$moic['id'].'">
                        <input type="text" class="re_schedule" name="re_schedule" class="form-control">';
            }elseif (in_array("2", $arr_reschedule)){
                return 'SMS\'s are disabled';
            }
        })->addColumn('delete_file', function ($moic) {

            $arr_delete = explode(',', $moic['sms_sent_initiateds']);
            if(in_array("1", $arr_delete)){
                return 'SMS already sent';
            }else{
                $currentTime = time();
                $created_at = strtotime('+10 minutes', strtotime($moic['created_at']));
                    if($created_at > $currentTime){
                        return '<a href="' . route('deleteFile', $moic['id']) . '" class="moicdisabled">Delete</a>';
                    }else{
                        return '<a href="' . route('deleteFile', $moic['id']) . '">Delete</a>';
                    }
            }
        })->rawColumns(['actions', 'download_zip', 'reschedule','delete_file']);
        return $db->make(true);
    }

    public function ajaxMoic($id)
    {
        return view('moic_detail',compact('id'));
    }


    public function rank_details($id)
    {
        $links = \DB::table('moic_ranking_reports')->pluck('dr_weblink', 'rank_id')->toArray();
        $file = MoicRanking::select('uploaded_file')->where('id',$id)->get()->toArray();
        $file_name = $file[0]['uploaded_file'];

        $moic = MoicRanking::select('id', 'block', 'ranking_pdf', 'sms', 'phc_en', 'dr_name_en')
                            ->orderBy('created_at', 'DESC')
                            ->where('uploaded_file',$file_name)
                            ->get()->toArray();

        $db = Datatables::of($moic);

        $db->addColumn('sr_no', function ($moic){
            static $i = 0; $i++; return $i;
        })->addColumn('sms_span', function($moic){
            $modifyed = str_replace('(', '<span class="">', $moic['sms']);
            $modifyed = str_replace(')', '</span>', $modifyed);
            return '<span class="">'.$modifyed.'</span>';
        })->addColumn('link', function($moic) use($links){
            if(!empty($links[$moic['id']])){
                return '<a href="'.url('/scorecard/'.$links[$moic['id']]).'" target="_blank">View</a>';
            }
            return "Processing";
        })->rawColumns(['id', 'sms_span', 'link']);
        return $db->make(true);
    }

    public function importRankings(ImportMosRankingRequest $request)
    {
        $obj = new ConvertToUnicode();
        if($request->hasFile('sample_file')){
        $extension = File::extension($request->sample_file->getClientOriginalName(''));

            if ($extension == "xlsx" || $extension == "xls") {
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::selectSheets('MOIC_Ranking_SMS')->load($path)->get()->toArray();
            $file_name = time() .$request->sample_file->getClientOriginalName();

            $moic_filename = $request->sample_file->getClientOriginalName();
            $day_time = Carbon::now()->toDateTimeString('Y-m-d');
            $day = Carbon::now()->toDateString('Y-m-d');
            $web = array();
            $beneficiary = array();
            $moic = array();

                if (count($data)>0) {
                    foreach ($data as $key => $value) {
                        if($value['block']==null){
                            continue;
                        }
                        $phcNameInHindi = $obj->convert_to_unicode2($value["phc_name_in_hindi"]);
                        $doctorNameInHindi = $obj->convert_to_unicode2($value["doctor_name_in_hindi"]);
                        $blockNameInHindi = $obj->convert_to_unicode2($value["block_name_in_hindi"]);

                        if($request->get("disable_sms")){

                            $arr[] = [
                                'block' => $value["block"],
                                'block_hin' => $blockNameInHindi,
                                'phc_en' =>$value["phc"],
                                'phc_hin' => $phcNameInHindi,
                                'dr_name_en' =>$value["name_of_incharge"],
                                'dr_name_hin' =>$doctorNameInHindi,
                                'mobile' =>$value["mobile_no"],
                                'email' => $value["email_id"],
                                'scenerio' => strtoupper($value["performance"]),
                                'og_moic_filename'=> $moic_filename,
                                'uploaded_file' => $file_name,
                                'ranking_pdf' => '',
                                'zip_path' => '',
                                'schedule_at'=>  $request->get("schedule_at"),
                                'month' => $request->get('month'),
                                'year' => $request->get('year'),
                                'created_at'=> Carbon::now(),
                                'updated_at'=> Carbon::now(),
                                'rank'=>$value["rank"],
                                'sr_no'=>trim($value['sr_no']),
                                'sms_sent_initiated' => 2,                    //set by default to 2  so it wont schedule sms
                            ];

                        }else{

                            $this->validate($request, [
                                'schedule_at' => 'required'
                            ]);

                            $arr[] = [
                                'block' => $value["block"],
                                'block_hin' => $blockNameInHindi,
                                'phc_en' =>$value["phc"],
                                'phc_hin' => $phcNameInHindi,
                                'dr_name_en' =>$value["name_of_incharge"],
                                'dr_name_hin' =>$doctorNameInHindi,
                                'mobile' =>$value["mobile_no"],
                                'email' => $value["email_id"],
                                'scenerio' => strtoupper($value["performance"]),
                                'og_moic_filename'=> $moic_filename,
                                'uploaded_file' => $file_name,
                                'ranking_pdf' => '',
                                'zip_path' => '',
                                'schedule_at'=>  $request->get("schedule_at"),
                                'month' => $request->get('month'),
                                'year' => $request->get('year'),
                                'created_at'=> Carbon::now(),
                                'updated_at'=> Carbon::now(),
                                'rank'=>$value["rank"],
                                'sr_no'=>trim($value['sr_no']),
                            ];
                        }

                    }
                    if (!empty($arr)) {
                        $dir = 'moic/imports'; $pdfdir = 'moic/rankings';
                        $inserted = MoicRanking::insert($arr);
                        if($inserted){
                            Storage::putFileAs($dir, $request->file('sample_file'), $file_name);
                            return redirect('get-mos')->with(['success' => 'Files uploaded successfully']);
                        }
                    }
                }else {
                    Session::flash('error', 'Please select valid data file.');
                    return back();
                }
            }
            else
            {
                Session::flash('error','Please upload a valid xls/xlsx file only.');
                return back();
            }
        }
    }

    public function export_mos($id){
        $file = MoicRanking::select('uploaded_file')
                                        ->where('id',$id)
                                        ->first()->toArray();
        $file_name = $file['uploaded_file'];

        $moic_data = MoicRanking::select('id','block','phc_en','dr_name_en','mobile','email','ranking_pdf','sms')
                                        ->where('uploaded_file',$file_name)
                                        ->get()
                                        ->toArray();
        $links = \DB::table('moic_ranking_reports')->pluck('dr_weblink', 'rank_id')->toArray();

        \Excel::create('moic_ranking'.time(), function($excel) use($moic_data,$links) {

            $excel->sheet('moic', function ($sheet) use ($moic_data,$links) {
                $excelData = [];
                $excelData[] = [
                    'Block',
                    'Phc Name',
                    'Doctor name',
                    'Phone Number',
                    'Email',
                    'Weblink',
                    'Sms'
                ];

                foreach ($moic_data as $value) {
                    if (array_key_exists($value['id'],$links))
                    {
                        $link = url('scorecard/'.$links[$value['id']]);
                    }
                    else
                    {
                        $link = null;
                    }

                    $excelData[] = array(
                        $value['block'],
                        $value['phc_en'],
                        $value['dr_name_en'],
                        $value['mobile'],
                        $value['email'],
                        $link,
                        $value['sms']
                    );
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
        })->download('xlsx');

    }

    public function testZip($value='')
    {
        $zipper = new Zipper;
        $file = public_path().'/moic/rankings/ranking_pdf.zip';
        $zipper->make($file)->folder('rankings')->add(public_path().'/moic/rankings/1531460592PHC_Scorecard.pdf');
        $zipper->zip($file)->folder('rankings')->add(public_path().'/moic/rankings/1531495739PHC_Scorecard.pdf');
        $zipper->zip($file)->folder('rankings')->add(public_path().'/moic/rankings/1531719521PHC_Scorecard.pdf');
        $zipper->close();
        return ['status' => 'Done'];
    }

    public function unzip()
    {
        $zipper = new Zipper;
        $path = public_path().'/moic/rankings/ranking_pdf.zip';
        $zipper->make($path)->folder('rankings')->extractTo(public_path().'/moic/zip');
        return ['status' => 'Done'];
    }

    public function showReport($link)
    {
        $ip = $this->getRealIpAddr();
        $temp_moic_logs = [
            'ip_address' => $ip ,
            'clicked_at' => Carbon::now(),
            'link' => $link,
            'created_at' => Carbon::now(),
            'click_count' => 1
        ];

        $already_clicked = DB::table('moic_logs')->select('id','click_count')->where('link',$link)->get()->first();

        if(count($already_clicked) == 0){

            DB::table('moic_logs')->insert($temp_moic_logs);
            $moic_data = MoicRanking::leftJoin('moic_ranking_reports', 'moic_ranking_reports.sr_no', '=', 'moic_ranking.sr_no')
                                    ->where('moic_ranking_reports.dr_weblink', $link)
                                    ->select('moic_ranking.mobile','moic_ranking_reports.id')->get()->first();
            $mobile = $moic_data->mobile;
            $weblink_id = $moic_data->id;

            DB::table('moic_logs')
                ->where('link', $link)
                ->update([
                    'mobile_no' => $mobile,
                    'weblink_id' => $weblink_id
                ]);

        }elseif($already_clicked->click_count == 1){
            DB::table('moic_logs')
                ->where('link',$link)
                ->update(['ip_address2' => $ip,'clicked_at2' =>Carbon::now(),'click_count'=>2]);
        }elseif($already_clicked->click_count == 2){
            DB::table('moic_logs')
                ->where('link',$link)
                ->update(['ip_address3' => $ip,'clicked_at3' =>Carbon::now(),'click_count'=>3]);
        }

        $months = \DB::table('master_months')->pluck('month_english', 'id')->toArray();
        $report = \DB::table('moic_ranking_reports')->where('dr_weblink', $link)->get()->toArray();
        if(!empty($report)){
            $report = $report[0];
            return view('moic_reports', compact('report', 'months'));
        }else{
            dd('This url is not found,please wait for next sms');
            //return redirect('/get-mos');
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

    public function downloadZip($path)
    {
        $path = public_path().'/moic/rankings/zips/'.$path.'/'.$path.'.zip';
        return response()->download($path);
    }

    public function update_sms_schedule(Request $request)
    {
        $data = $request->toArray();
        $file_name =$data['file_name'];
        $date_time=$data['date_time'];
        $result = MoicRanking::where('uploaded_file',$file_name)->update(array('schedule_at'=>$date_time));
        return $result;
    }

    public function deleteFile($id)
    {
        $file_name = MoicRanking::select('uploaded_file','og_moic_filename')
                             ->where('id',$id)
                             ->first()->toArray();
        $result = MoicRanking::where('uploaded_file',$file_name['uploaded_file'])->delete();
        Session::flash('error','File deleted');
        return back();
    }

}
