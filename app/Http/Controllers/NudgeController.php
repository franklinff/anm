<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NudgeModel;
use Carbon\Carbon;
use DataTables;
use App\Http\Requests\ImportNudgeRequest;
use Session;


class NudgeController extends Controller
{
    //Load nudge file
    public function index()
    {
        return view('nudge');
    }

    //Import nudge excel and insert into DB
    public function importNudgeFile(ImportNudgeRequest $request)
    {
        $file_name = time() . $request->sample_file->getClientOriginalName();
        $og_file_name = $request->sample_file->getClientOriginalName();
        $path = $request->file('sample_file')->getRealPath();
        $data = \Excel::load($path)->get()->toArray();
        $upload_file_time = Carbon::now()->toDateTimeString('Y-m-d');

        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                if(isset($value['phone']) || isset($value['message'])){
                    $arr[] = [
                        'phone_no' => floor($value['phone']),
                        'message'=> $value['message'],
                        'filename' => $file_name,
                        'og_filename' => $og_file_name,
                        'created_at' => $upload_file_time,
                        'schedule_at'=>  $request->get("schedule_at"),
                    ];
                }else{
                    Session::flash('error', 'Please upload a valid Excel!');
                    return redirect('/get-nudges');
                }
            }
            $inserted = NudgeModel::insert($arr);
            if($inserted){
                Session::flash('success', 'File Uploaded successfully!');
                return back();
            }
        }else{
            Session::flash('error', 'Please check the Excel content!');
            return redirect('/get-nudges');
        }
    }

    //Displays the uploaded nudge files
    public function fetchNudgesFiles()
    {
        $nudge_data = NudgeModel::select('id', 'og_filename as filename','created_at','schedule_at',\DB::raw('COUNT(id) as total_rows'))
            ->groupBy('filename')
            ->orderBy('created_at', 'DESC')
            ->get()->toArray();

        $db = Datatables::of($nudge_data);
        $db->addColumn('sr_no', function () {
            static $i = 0;
            $i++;
            return $i;
        })->rawColumns(['sr_no']);

        $db->addColumn('filename', function ($nudge_data) {
            return $nudge_data['filename'];
        })->addColumn('uploaded_on', function($nudge_data){
            return $nudge_data['created_at'];
        })->addColumn('schedule_at', function ($nudge_data) {
            return $nudge_data['schedule_at'];
        })->addColumn('total_rows', function ($nudge_data) {
            return $nudge_data['total_rows'];
        })->addColumn('view', function ($nudge_data) {
            return '<a href="' . route('nudgedetails', $nudge_data['id']) . '">File details</a>';
        })->addColumn('action', function ($nudge_data) {
            return '<a href="' . route('deleteNudge', $nudge_data['id']) . '">Delete</a>';
        })->rawColumns(['filename','uploaded_on','schedule_at','total_rows','view','action']);

        return $db->make(true);
    }

    //Load nudge details file
    public function nudgeFileDetails($id)
    {
        $location = 'nudge_file';
        return view('nudge_detail',compact('id','location'));
    }

    //Displays individual nudge file details
    public function detail_nudge($id)
    {
        $file = NudgeModel::select('filename')->where('id',$id)->get()->toArray();
        $nudge_file_content = NudgeModel::select('phone_no','message','sms_sent')
                            ->where('filename',$file[0]['filename'])
                            ->get()->toArray();
        $db = Datatables::of($nudge_file_content);

        $db->addColumn('sr_no', function (){
            static $i = 0;
            $i++;
            return $i;
        })->addColumn('phone_number', function($nudge_file_content){
            return $nudge_file_content['phone_no'];
        })->addColumn('message', function($nudge_file_content){
            return $nudge_file_content['message'];
        })->addColumn('sms_sent', function($nudge_file_content){
            if($nudge_file_content['sms_sent'] == 0){
                return 'No';
            }else{
                return 'Yes';
            }
        })->rawColumns(['phone_number', 'message','sms_sent']);
        return $db->make(true);
    }

    //Soft delete nudge file
    public function deleteFile($id)
    {
        $file_name = NudgeModel::select('filename')
                     ->where('id',$id)->first()->toArray();
        $result = NudgeModel::where('filename',$file_name['filename'])->delete();
        Session::flash('error','Nudge file deleted');
        return back();
    }

}
