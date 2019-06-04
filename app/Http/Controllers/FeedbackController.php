<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Classes\ConvertToUnicode;
use File;
use DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Storage;
use App\FeedbackModel;
use DataTables;
use App\Http\Requests\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $district = District::pluck('district_name', 'id');
        return view('patient_feedback',compact('district'));
    }

    public function importFile(Feedback $request)
    {
        $obj = new ConvertToUnicode();
        if ($request->hasFile('sample_file')) {
            $extension = File::extension($request->sample_file->getClientOriginalName(''));

            $months = DB::table('master_months')->pluck('month_translated', 'id');
            if ($extension == "xlsx" || $extension == "xls") {
                $path = $request->file('sample_file')->getRealPath();
                $data = \Excel::selectSheets('Patient_Feedback')->load($path)->get()->toArray();
                $file_name = time() . $request->sample_file->getClientOriginalName();
                $og_file_name = $request->sample_file->getClientOriginalName();
                $day_time = Carbon::now()->toDateTimeString('Y-m-d');
                if (count($data) > 0) {
                    foreach ($data as $key => $value) {
                        $gender = "";
                        if($value['gender'] == 'male'){
                            $gender = "चाहते";
                        }else{
                            $gender = "चाहती";
                        }

                        $arr[] = [
                            'district' => $value["district"],
                            'block_hindi' => $obj->convert_to_unicode2($value["block_name_in_hindi"]),
                            'phc' => $value["phc"],
                            'phc_hindi' => $obj->convert_to_unicode2($value["phc_name_in_hindi"]),
                            'doctor_name' => $value["name_of_incharge"],
                            'doctor_name_hindi' => $obj->convert_to_unicode2($value["doctor_name_in_hindi"]),
                            'mobile_no' => $value["mobile_no"],
                            'people_responded_for_doctor_availability' => $value["people_responded_for_doctor_availability"],
                            'patient_feedback_score_for_doctor_availability' => $value["patient_feedback_score_for_doctor_availability"],
                            'feedback_for_doctor_availability' => $value["feedback_for_doctor_availability"],
                            'people_responded_for_medicine_availability' => $value["people_responded_for_medicine_availability"],
                            'patient_feedback_for_medicine_availibility' => $value["patient_feedback_for_medicine_availibility"],
                            'feedback_for_medicine_availability' => $value["feedback_for_medicine_availability"],
                            'people_responded_for_test_availability' => $value["people_responded_for_test_availability"],
                            'patient_feedback_score_for_test_availibility' => $value["patient_feedback_score_for_test_availibility"],
                            'feedback_for_test_availability' => $value["feedback_for_test_availability"],
                            'people_responded_for_patient_satisfaction' => $value["people_responded_for_patient_satisfaction"],
                            'patient_feedback_score_for_patient_satisfaction' => $value["patient_feedback_score_for_patient_satisfaction"],
                            'feedback_for_patient_satisfaction' => $value["feedback_for_patient_satisfaction"],
                            'moic_attendance' => $value["moic_attendance"],
                            'stock_against_demand' => $value["stock_against_demand"],
                            'types_of_test_conducted' => $value["types_of_test_conducted"],
                            'no_of_patient_phone_number_received' => $value["no_of_patient_phone_number_received"],
                            'opd' =>$value["opd"],
                            'fill_rate' =>$value["fill_rate"],
                            'og_filename'=> $og_file_name,
                            'filename'=>$file_name,
                            'created_at'=>$day_time,
                            'schedule_at'=>  $request->get("schedule_at"),
                            'month' => $request->get('month'),
                            'year' => $request->get('year'),
                            'dr_gender' => $value["gender"],
                            'sms'=> $obj->convert_to_unicode2($value["doctor_name_in_hindi"]).',क्या आप जानना '.$gender.'  हैं की,'. $months[$request->get('month')]." ".'माह  मे'." ".$obj->convert_to_unicode2($value["phc_name_in_hindi"])." ".'आदर्श पी अच् सी के patients का अनुभव कैसा रहा?',
                        ];
                    }
                    if (!empty($arr)) {
                        $inserted = DB::table('patient_feedback')->insert($arr);

                        if ($inserted) {
                            Session::flash('success', 'File Uploaded successfully!');
                            Storage::putFileAs('Feedback', $request->file('sample_file'), $file_name);
                            return back();
                        }
                    }

                } else {
                    Session::flash('error', 'Please select valid data file.');
                    return back();
                }
            } else {
                Session::flash('error', 'Please upload a valid xls/xlsx file only');
                return back();
            }
        }
    }

    public function feedbackfiles()
    {
        $feedback = FeedbackModel::select('id','og_filename','filename','schedule_at', \DB::raw('group_concat(distinct sms_sent) as sms_sent_initiateds'))
                                    ->selectRaw("DATE(created_at) as uploaded_on" )
                                    ->groupBy('filename')
                                    ->orderBy('created_at', 'DESC')
                                    ->get();
        $db = Datatables::of($feedback);

        $db->addColumn('sr_no', function ($feedback) {
            static $i = 0;
            $i++;
            return $i;
        })->rawColumns(['sr_no']);

        $db->addColumn('actions', function ($feedback) {
            return '<a href="' . route('detail_feedback', $feedback['id']) . '">View details</a>';
        })->addColumn('reschedule', function($feedback){
            $arr = explode(',', $feedback['sms_sent_initiateds']);
            if(empty ($arr[1])) {
                return '<input type="hidden" id="' . $feedback['filename'] . '" value="' . $feedback['filename'] . '">
                    <input type="text" class="re_schedule" name="re_schedule" class="form-control">';
            }
            return 'SMS\'s for this are already sent';
        })->rawColumns(['actions','reschedule']);

        return $db->make(true);
    }

    public function feedbackDetail($id)
    {
        return view('feedback_detail',compact('id'));
    }

    public function file_details($id)
    {
        $file = FeedbackModel::select('filename')->where('id',$id)->get()->toArray();
        $file_name = $file[0]['filename'];

        $feedback_details = FeedbackModel::select('id','phc','doctor_name','district','sms','weblink',
                                                    'feedback_for_doctor_availability',
                                                    'feedback_for_medicine_availability',
                                                    'feedback_for_test_availability',
                                                    'feedback_for_patient_satisfaction'
                                                    )
                                        ->orderBy('created_at', 'DESC')
                                        ->where('filename',$file_name)
                                        ->get()->toArray();

        $db = Datatables::of($feedback_details);
      //  $db->addColumn('sr_no', function () { static $i = 0;  $i++; return $i; })->rawColumns(['id']);
        $db->addColumn('weblink', function ($feedback_details){
            if($feedback_details["weblink"]){
                //  return url('/feedback/'.$feedback_details["weblink"]);
                return '<a href="'.url('/feedback/'.$feedback_details["weblink"]).'" target="_blank"> Click !</a>';
            }
            return "Processing";
        })->rawColumns(['weblink']);

        return $db->make(true);
    }

    public function export_feedback($id)
    {
        $file = FeedbackModel::select('filename')
            ->where('id',$id)
            ->first()->toArray();
        $file_name = $file['filename'];

        $feedback_data = FeedbackModel::select('district',
                                                'block_hindi',
                                                'phc',
                                                'phc_hindi',
                                                'doctor_name',
                                                'doctor_name_hindi',
                                                'mobile_no',
                                                'people_responded_for_doctor_availability',
                                                'patient_feedback_score_for_doctor_availability',
                                                'feedback_for_doctor_availability',
                                                'people_responded_for_medicine_availability',
                                                'patient_feedback_for_medicine_availibility',
                                                'feedback_for_medicine_availability',
                                                'people_responded_for_test_availability',
                                                'patient_feedback_score_for_test_availibility'
                                                ,'feedback_for_test_availability',
                                                'people_responded_for_patient_satisfaction',
                                                'patient_feedback_score_for_patient_satisfaction',
                                                'feedback_for_patient_satisfaction',
                                                'moic_attendance',
                                                'stock_against_demand',
                                                'types_of_test_conducted',
                                                'no_of_patient_phone_number_received',
                                                'opd',
                                                'fill_rate')
                                        ->where('filename',$file_name)->get()->toArray();

        \Excel::create('Feedback'.time(), function($excel) use($feedback_data) {
            $excel->sheet('Patient_Feedback', function ($sheet) use ($feedback_data) {
                $excelData = [];
                $excelData[] = [
                    'District',
                    'Block Name in Hindi',
                    'PHC',
                    'PHC Name in hindi',
                    'Name of Incharge',
                    'Doctor name in hindi',
                    'Mobile No',
                    'People Responded For Doctor Availability',
                    'Patient Feedback Score For Doctor Availability',
                    'Feedback For Doctor Availability',
                    'People Responded For Medicine Availability',
                    'Patient Feedback For Medicine Availibility',
                    'Feedback For Medicine Availability',
                    'People Responded For Test Availability',
                    'Patient Feedback Score For Test Availibility',
                    'Feedback For Test Availability',
                    'People Responded For Patient Satisfaction',
                    'Patient Feedback Score For Patient Satisfaction',
                    'Feedback For Patient Satisfaction',
                    'MOIC Attendance',
                    'Stock % against demand',
                    'Types Of Test Conducted',
                    'No of Patient Phone Number Received',
                    'OPD',
                    '% Fill Rate'
                ];
                foreach ($feedback_data as $value) {
                    $excelData[] = array(
                        $value['district'],
                        $value['block_hindi'],
                        $value['phc'],
                        $value['phc_hindi'],
                        $value['doctor_name'],
                        $value['doctor_name_hindi'],
                        $value['mobile_no'],
                        $value['people_responded_for_doctor_availability'],
                        $value['patient_feedback_score_for_doctor_availability']*(100).'%', //percent
                        $value['feedback_for_doctor_availability'],
                        $value['people_responded_for_medicine_availability'],
                        $value['patient_feedback_for_medicine_availibility']*(100).'%', //percent
                        $value['feedback_for_medicine_availability'],
                        $value['people_responded_for_test_availability'],
                        $value['patient_feedback_score_for_test_availibility']*(100).'%', //percent
                        $value['feedback_for_test_availability'],
                        $value['people_responded_for_patient_satisfaction'],
                        $value['patient_feedback_score_for_patient_satisfaction']*(100).'%', //percent
                        $value['feedback_for_patient_satisfaction'],
                        $value['moic_attendance'],
                        $value['stock_against_demand'],
                        $value['types_of_test_conducted'],
                        $value['no_of_patient_phone_number_received'],
                        $value['opd'],
                        $value['fill_rate']*(100).'%', //percent
                    );
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
        })->download('xlsx');
    }

    public function update_feed_schedule(Request $request)
    {
        $data = $request->toArray();
        $file_name =$data['filename'];
        $date_time=$data['date_time'];
        $result = FeedbackModel::where('filename',$file_name)->update(array('schedule_at'=>$date_time));
        return $result;
    }

    public function showReport($link)
    {
        $ip = $this->getRealIpAddr();
        $insert = [];
        $temp_feedback_logs = [
            'ip_address' => $ip ,
            'clicked_at' => Carbon::now(),
            'link' => $link,
            'created_at' => Carbon::now()
        ];
        $insert = $temp_feedback_logs;
        $already_clicked = DB::table('feedback_logs')->select('id')->where('link',$link)->get();

        if(count($already_clicked) == 0){
            DB::table('feedback_logs')->insert($insert);
        }

        $months = \DB::table('master_months')->pluck('month_english', 'id')->toArray();
        $feedback = FeedbackModel::select(
                    'people_responded_for_doctor_availability',
                    'patient_feedback_score_for_doctor_availability',
                    'people_responded_for_medicine_availability',
                    'patient_feedback_for_medicine_availibility',
                    'people_responded_for_test_availability',
                    'patient_feedback_score_for_test_availibility',
                    'people_responded_for_patient_satisfaction',
                    'patient_feedback_score_for_patient_satisfaction',
                    'moic_attendance',
                    'stock_against_demand',
                    'types_of_test_conducted',
                    'opd',
                    'fill_rate',
                    'no_of_patient_phone_number_received',
                    'feedback_for_doctor_availability',
                    'feedback_for_medicine_availability',
                    'feedback_for_test_availability',
                    'feedback_for_patient_satisfaction',
                    'phc',
                    'district',
                    'year',
                    'month'
                    )->where('weblink',$link)->get()->toArray();
        $feedbackdata = $feedback[0];
        return view('feedback', compact('feedbackdata', 'months'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
