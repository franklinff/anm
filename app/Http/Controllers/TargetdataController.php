<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use Illuminate\Support\Facades\Storage;
use Session;
use Carbon\Carbon;
use Excel;
use File;
use DB;
use DataTables;
use App\Classes\ConvertToUnicode;

use Illuminate\Support\Facades\Auth;
use App\District;
use App\Block;
use App\Http\Requests\ImportAnmRequest;


class TargetdataController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $district = District::pluck('district_name', 'id');
        $first_district = $district->first();
        $block = Block::whereHas('district', function ($query) use ($first_district) {
            $query->where('district_name', $first_district);
        })->pluck('block_name', 'id');
        return view('import', compact('district', 'block'));
    }

    public function fetchTargetData()
    {
        $target_data = AnmTargetDataModel::select('id', 'og_filename as filenames','filename', 'uploaded_on','schedule_at', 'status', 'created_at',
                \DB::raw('group_concat(distinct anm_sms_initiated) as anm_sent'),
                \DB::raw('group_concat(distinct moic_sms_initiated) as moic_sent'))
                ->selectRaw("(CASE WHEN status='N' THEN 'Pending' WHEN status='Y' THEN 'Successful' END) as status")
                ->groupBy('filename')
                ->orderBy('created_at', 'DESC')
                ->get();

        $db = Datatables::of($target_data);
        $db->addColumn('sr_no', function ($target_data) {
                static $i = 0;
                $i++;
                return $i;
                })->rawColumns(['id']);
        $db->addColumn('actions', function ($target_data) {
            return '<a href="' . route('processedfile', $target_data['id']) . '">View details</a>';
        })->addColumn('reschedule', function($target_data){
        $arr_anm = explode(',', $target_data['anm_sent']);
        $arr_moic = explode(',', $target_data['moic_sent']);
            if( in_array("1", $arr_anm) || in_array("1", $arr_moic)){
                     return 'SMS\'s for this are already sent';
                }elseif (in_array("0", $arr_anm)){
                    return '<input type="hidden" id="'.$target_data['filename'].'" value="'.$target_data['filename'].'">
                        <input type="text" class="re_schedule" name="re_schedule" class="form-control">';
                }elseif (in_array("2", $arr_anm)){
                return 'SMS\'s disabled';
            }
        })->addColumn('delete_file', function ($target_data) {
            $arr_anm = explode(',', $target_data['anm_sent']);
            if(in_array("1", $arr_anm)){
                return 'SMS already sent';
            }else{
                return '<a href="'.route('deleteAnmFile',$target_data['id']).'">Delete</a>';
            }
        })->rawColumns(['actions','reschedule','delete_file']);

        return $db->make(true);
    }

    public function importFile(ImportAnmRequest $request)
    {
    //    dd($request->all());
        $obj = new ConvertToUnicode();
        //$this->validate($request, array('sample_file' => 'required'));;
        if ($request->hasFile('sample_file')) {
            $extension = File::extension($request->sample_file->getClientOriginalName(''));

            $months = DB::table('master_months')->pluck('month_translated', 'id');
            if ($extension == "xlsx" || $extension == "xls") {
                $path = $request->file('sample_file')->getRealPath();
                $data = \Excel::selectSheets('target_data')->load($path)->get()->toArray();
                $file_name = time() . $request->sample_file->getClientOriginalName();
                $og_file_name = $request->sample_file->getClientOriginalName();
                $day_time = Carbon::now()->toDateTimeString('Y-m-d');
                $day = Carbon::now()->toDateString('Y-m-d');
                $web = array();
                $beneficiary = array();
                $moic = array();
                if (count($data) > 0) {
                    $phcNameInHindi = "";
                    $moicNameInHindi = "";
                    $anmNameInHindi = "";
                    foreach ($data as $key => $value) {

                        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                        $str = substr(str_shuffle($chars), 0, 10).time();
                        $web[$value["phc_name"]] = $str;

                        $str1 = substr(str_shuffle($chars), 0, 10);
                        $beneficiary[] = $value["phc_name"];
                        $beneficiary[$value["phc_name"]] = $str1;

                        if (!in_array($value["phc_name"], $web)) {
                            $str2 = substr(str_shuffle($chars), 0, 10);
                            $moic[] = $value["phc_name"];
                            $moic[$value["phc_name"]] = $str2;
                        }
                        //$separated = explode(',', $obj->convert_to_unicode2($value['anm_name_hindi']));
                        $msg = '';
                        $separated = $value['anm_name_hindi'];
                        $anmNameInHindi = $obj->convert_to_unicode2($value['anm_name_hindi']);

                        if(strtoupper($value["performer_category"]) == "TOP"){
                            if(str_contains($value['anm_name_hindi'], ',')){
                                $separated = [];
                                $exploded = explode(',', $value['anm_name_hindi']);
                                foreach ($exploded as $single) {
                                    $separated[] = $obj->convert_to_unicode2($single);
                                }
                                $anmNameInHindi = implode(',', $separated);
                                foreach ($separated as $single) {
                                    $msg .= rtrim($single, ' ') .' '.'दीदी बधाई हो!90% से अधिक बच्चों का टीकाकरण तथा 45% से अधिक गर्भवती महिलाओं के चार ANC चेकप कर दिखाने पर -'.' ' .$months[$request->get('month')] .' '.'के महीने में आपने, अपने PHC सेक्टर में अव्वल दर्जे  का काम कर दिखाया। हमें पूरी उम्मीद है कि आप अगले महीने भी इसी तरह काम करेंगे तथा साथ ही साथ अपने क्षेत्र की सभी ANMsके लिए भी मार्गदर्शक बनते हुए उन्हें और बेहतर काम करने के लिए बढ़ावा देंगी!बने रहिये -आप हम सब के लिए एक मिसाल हैं!जानने के लिए कि'.' '.$months[$request->get('month')].' '. 'की महीने में PHC' .' '.$obj->convert_to_unicode2($value['phc_name_hindi']).' '.'की ANMsने कैसा काम किया, नीचे दिए गए लिंक पर क्लिक कीजिए:==';
                                }
                            }else{
                            $msg = $obj->convert_to_unicode2($value['anm_name_hindi']).' '.'दीदी बधाई हो!90% से अधिक बच्चों का टीकाकरण तथा 45% से अधिक गर्भवती महिलाओं के चार ANC चेकप कर दिखाने पर -'.' '.$months[$request->get('month')].' '.'के महीने में आपने, अपने PHC सेक्टर में अव्वल दर्जे का काम कर दिखाया। हमें पूरी उम्मीद है कि आप अगले महीने भी इसी तरह काम करेंगे तथा साथ ही साथ अपने क्षेत्र की सभी ANMs के लिए भी मार्गदर्शक बनते हुए उन्हें और बेहतर काम करने के लिए बढ़ावा देंगी!बने रहिये - आप हम सब के लिए एक मिसाल हैं!जानने के लिए कि'.' '.$months[$request->get('month')].' '. 'की महीने में PHC'.' '.$obj->convert_to_unicode2($value['phc_name_hindi']).' '.'की ANMs ने कैसा काम किया, नीचे दिए गए लिंक पर क्लिक कीजिए:';
                            }
                        }

                        elseif(strtoupper($value["performer_category"]) == "MIDDLE"){
                            if(str_contains($value['anm_name_hindi'], ',')){
                                $separated = [];
                                $exploded = explode(',', $value['anm_name_hindi']);

                                foreach ($exploded as $single) {
                                    $separated[] = $obj->convert_to_unicode2($single);
                                }

                                $anmNameInHindi = implode(',', $separated);

                                foreach ($separated as $single) {
                                    $msg .=rtrim($single, ' ') .' '.'दीदी, आपने'.' '.$months[$request->get('month')].' '. 'के महीने में  60% से अधिक बच्चों का टीकाकरण साथ ही साथ 15% से अधिक गर्भवती महिलाओं के चार ANC चेकप पूरे कर दिखाए। आप अपने लक्ष्य के बहुत पास पहुँच चुके हैं!अगली बार आप कम से कम 90% बच्चों का टीकाकरण,साथ ही साथ,45% गर्भवती महिलाओं की चार ANC चेकप पूरे करिये ताकि आप अपने क्षेत्र में अव्वल नंबर पर आ पाएं और सबसे ज़्यादा हेल्थ सर्विसेज़ प्रदान करके, बाक़ी सभी ANMs के लिए एक मिसाल बन जाएं।जानने के लिए कि '.' '.$months[$request->get('month')].' '. 'की महीने में PHC'.' '.$obj->convert_to_unicode2($value['phc_name_hindi']).' '.'की ANMs ने कैसा काम किया, नीचे दिए गए लिंक पर क्लिक कीजिए:==';
                                }
                            }else{
                                $msg = $obj->convert_to_unicode2($value['anm_name_hindi']).' '.'दीदी, आपने'.' '.$months[$request->get('month')].' '.'के महीने में  60% से अधिक बच्चों का टीकाकरण साथ ही साथ 15% से अधिक गर्भवती महिलाओं के चार ANC चेकप पूरे कर दिखाए। आप अपने लक्ष्य के बहुत पास पहुँच चुके हैं! अगली बार आप कम से कम 90% बच्चों का टीकाकरण ,साथ ही साथ,45% गर्भवती महिलाओं की चार ANC चेकप पूरे करिये ताकि आप अपने क्षेत्र में अव्वल नंबर पर आ पाएं और सबसे ज़्यादा हेल्थ सर्विसेज़ प्रदान करके, बाक़ी सभी ANMs के लिए एक मिसाल बन जाएं। जानने के लिए कि '.' '.$months[$request->get('month')].' '. 'की महीने में PHC'.' '.$obj->convert_to_unicode2($value['phc_name_hindi']).' '. 'की ANMs ने कैसा काम किया, नीचे दिए गए लिंक पर क्लिक कीजिए:';
                            }
                        }

                        elseif(strtoupper($value["performer_category"]) == "BOTTOM"){
                            if(str_contains($value['anm_name_hindi'], ',')){
                                $separated = [];
                                $exploded = explode(',', $value['anm_name_hindi']);
                                foreach ($exploded as $single) {
                                    $separated[] = $obj->convert_to_unicode2($single);
                                }
                                $anmNameInHindi = implode(',', $separated);
                                foreach ($separated as $single) {
                                    $msg .= rtrim($single, ' ') .' '.'दीदी,'.' '.$months[$request->get('month')].' '. 'के महीने में आपने MCHN डे पर मेहनत तो करी, पर अभी आपके क्षेत्र में 60% से भी कम बच्चों का टीकाकरण तथा 15% से भी कम गर्भवती महिलाओं के चार ANC चेकप हुए हैं।थोड़ी और मेहनत्त करने में जुट्ट जायिये, ताकि अगली बार आप कम से कम 60% बच्चों का टीकाकरण साथ ही साथ 15% गर्भवती महिलाओं की चार ANC चेकप पूरी करवा सकेंगे और अपने लक्ष्य के और करीब आ जाएँगे।जानने के लिए कि'.' '.$months[$request->get('month')].' '. 'की महीने में PHC'.' '.$obj->convert_to_unicode2($value['phc_name_hindi']).' '.'की ANMs ने कैसा काम किया, नीचे दिए गए लिंक पर क्लिक कीजिए:==';
                                }
                            }else{
                                $msg =$obj->convert_to_unicode2($value['anm_name_hindi']).' '.'दीदी,'.' '.$months[$request->get('month')].' '.'के महीने में आपने MCHN डे पर मेहनत तो करी, पर अभी आपके क्षेत्र में 60% से भी कम बच्चों का टीकाकरण तथा 15% से भी कम गर्भवती महिलाओं के चार ANC चेकप हुए हैं।थोड़ी और मेहनत्त करने में जुट्ट जायिये, ताकि अगली बार आप कम से कम 60% बच्चों का टीकाकरण साथ ही साथ 15% गर्भवती महिलाओं की चार ANC चेकप पूरी करवा सकेंगे और अपने लक्ष्य के और करीब आ जाएँगे। जानने के लिए कि '.' '.$months[$request->get('month')].' '. 'की महीने में PHC'.' '.$obj->convert_to_unicode2($value['phc_name_hindi']).' '.'की ANMs ने कैसा काम किया, नीचे दिए गए लिंक पर क्लिक कीजिए:';
                            }
                        }

//                        if(str_contains($value['anm_name_hindi'], ',')){
//                            $separated = [];
//                            $exploded = explode(',', $value['anm_name_hindi']);
//                            foreach ($exploded as $single) {
//                                $separated[] = $obj->convert_to_unicode2($single);
//                            }
//                            $anmNameInHindi = implode(',', $separated);
//                            foreach ($separated as $single) {
//                                $msg .= rtrim($single, ' ') . ', क्या आप जानना चाहते हैं की ' . $months[$request->get('month')] . ' ' . $request->get('year') . ' में ' . $obj->convert_to_unicode2($value['phc_name_hindi']) . ' पीएचसी की कौनसी एनम् सबसे अच्छा काम करके, एक मिसाल बनी? जानने के लिए नीचे लिंक पर क्लिक करके देखिये:==';
//                            }
//                        }else{
//                            $msg = $obj->convert_to_unicode2($value['anm_name_hindi']).', क्या आप जानना चाहते हैं की ' . $months[$request->get('month')] . ' ' . $request->get('year') . ' में ' . $obj->convert_to_unicode2($value['phc_name_hindi']) . ' पीएचसी की कौनसी एनम् सबसे अच्छा काम करके, एक मिसाल बनी? जानने के लिए नीचे लिंक पर क्लिक करके देखिये:';
//                        }

                        $phcNameInHindi = $obj->convert_to_unicode2($value["phc_name_hindi"]);
                        $moicNameInHindi = $obj->convert_to_unicode2($value["moic_name_hindi"]);
                        if(!empty($value["subcenter_name_hindi"])){
                            $subcenterNameInHindi = $obj->convert_to_unicode2($value["subcenter_name_hindi"]);
                        }else{
                            $subcenterNameInHindi = $obj->convert_to_unicode2($value["phc_name_hindi"]);
                        }

                        if($request->get("disable_sms")){
                            $arr[] = [
                                'district' => $request->get("district"),
                                'block' => $value["block"],
                                'subcenter' => $value["phcsc"],
                                'phc_name' => strtolower($value["phc_name"]),
                                'phc_hin' => $phcNameInHindi,
                                'moic_name' => $value["moic_name"],
                                'moic_hin' => $moicNameInHindi,
                                'moic_mobile_number' => $value["moic_phone_number"],
                                'anm_name' => $value["anm_name"],
                                'anm_hin' => $anmNameInHindi,
                                'anm_mobile_number' => $value["anm_phone_number"],
                                'performer_category' => strtoupper($value["performer_category"]),
                                'scenerio' => $value["scenario"],
                                'created_at' => $day_time,
                                'uploaded_on' => $day,
                                'weblink' => $web[$value["phc_name"]],
                                'schedule_at'=>  $request->get("schedule_at"),
                                'anm_sms_initiated' => 2,                    //set by default to 1  so it wont schedule sms
                                'filename' => $file_name,
                                'og_filename' => $og_file_name,
                                'month' => $request->get('month'),
                                'year' => $request->get('year'),
                                'anm_custom_msg' => rtrim($msg, ','),
                                'moic_custom_msg' => '----',
                                'beneficiary_custom_msg' => '----',
                                'subcenter_hindi'=> trim($subcenterNameInHindi),
                            ];

                        }else{

                            $this->validate($request, [
                                'schedule_at' => 'required'
                            ]);

                            $arr[] = [
                                'district' => $request->get("district"),
                                'block' => $value["block"],
                                'subcenter' => $value["phcsc"],
                                'phc_name' => strtolower($value["phc_name"]),
                                'phc_hin' => $phcNameInHindi,
                                'moic_name' => $value["moic_name"],
                                'moic_hin' => $moicNameInHindi,
                                'moic_mobile_number' => $value["moic_phone_number"],
                                'anm_name' => $value["anm_name"],
                                'anm_hin' => $anmNameInHindi,
                                'anm_mobile_number' => $value["anm_phone_number"],
                                'performer_category' => strtoupper($value["performer_category"]),
                                'scenerio' => $value["scenario"],
                                'created_at' => $day_time,
                                'uploaded_on' => $day,
                                'weblink' => $web[$value["phc_name"]],
                                'schedule_at'=>  $request->get("schedule_at"),
                                'filename' => $file_name,
                                'og_filename' => $og_file_name,
                                /*'beneficiary_code'=> $beneficiary[$value["phc_name"]],
                                'moic_code'=>$moic[$value["phc_name"]],*/
                                'month' => $request->get('month'),
                                'year' => $request->get('year'),
                                'anm_custom_msg' => rtrim($msg, ','),
                                'moic_custom_msg' => $obj->convert_to_unicode2($value['moic_name_hindi']) . ', क्या आप जानना चाहते हैं की ' . $months[$request->get('month')] . ' ' . $request->get('year') . ' में ' . $obj->convert_to_unicode2($value['phc_name_hindi']) . ' पीएचसी की कौनसी एनम् सबसे अच्छा काम करके, एक मिसाल बनी? जानने के लिए नीचे लिंक पर क्लिक करके देखिये:',
                                'beneficiary_custom_msg' => 'क्या आप जानना चाहते हैं की ' . $months[$request->get('month')] . ' ' . $request->get('year') . ' में ' . $obj->convert_to_unicode2($value['phc_name_hindi']) . ' पीएचसी की कौनसी एनम् सबसे अच्छा काम करके, एक मिसाल बनी? जानने के लिए नीचे लिंक पर क्लिक करके देखिये:',
                                'subcenter_hindi'=> trim($subcenterNameInHindi),
                            ];
                        }
                    }
                    if (!empty($arr)) {
                        $inserted = DB::table('anm_target_data')->insert($arr);
                        if ($inserted) {
                            Session::flash('success', 'File Uploaded successfully!');
                            Storage::putFileAs('FileUpload', $request->file('sample_file'), $file_name);
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


    public function deleteFile($id)
    {
        $file_name = AnmTargetDataModel::select('filename','og_filename')
            ->where('id',$id)
            ->first()->toArray();
        $result = AnmTargetDataModel::where('filename',$file_name['filename'])->delete();
        Session::flash('error','File deleted');
        return back();
    }


    public function getBlocks(District $district)
    {
        try{
            return ['status' => 200, 'data' => $district->blocks];
        }catch(Exception $ex){
            return ['status' => 404 ,'message' => 'not found', 'data' => ''];
        }
    }


    public function update_sms_schedule(Request $request)
    {
        $data = $request->toArray();
        $file_name =$data['file_name'];
        $date_time=$data['date_time'];
        $result = AnmTargetDataModel::where('filename',$file_name)->update(array('schedule_at'=>$date_time));
        return $result;
    }
}
