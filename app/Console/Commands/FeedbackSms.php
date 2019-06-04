<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FeedbackModel;
use DB;

class FeedbackSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedback:complete_sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making a complete sms';

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
        $table = FeedbackModel::getModel()->getTable();
        $caseString = 'CASE id';
        $ids = '';
        $content = FeedbackModel::select('id','sms','feedback_for_doctor_availability',
                                         'feedback_for_patient_satisfaction','feedback_for_medicine_availability',
                                         'feedback_for_test_availability','weblink')
                                        ->Where('complete_sms','')
                                        ->Where('weblink','!=','')
                                        ->get()->toArray();


        if(count($content)>0){
            $lstRepeatTags = array();
            $lstData = array();
            foreach($content as $k => $key){

                $sms = $key['sms'].'\n';
                $searchStr= "patient experience";
                if(strpos($key['feedback_for_doctor_availability'],$searchStr)) {
                   $lstRepeatTags['doctor'] = "Doctor Availability";
                    $lstData['doctor'] = "";
                }else {
                    $lstData['doctor'] = "Doctor Availability- ".$key['feedback_for_doctor_availability'];
                }
                if(strpos($key['feedback_for_patient_satisfaction'],$searchStr)) {

                   $lstRepeatTags['patient'] = "Patient Satisfaction";
                    $lstData['patient'] = "";
                }else {
                    $lstData['patient'] = "Patient Satisfaction- ".$key['feedback_for_patient_satisfaction'];
                }
                if(strpos($key['feedback_for_medicine_availability'],$searchStr)) {
                   $lstRepeatTags['medicine'] = "Medicine Availability";
                    $lstData['medicine'] = "";
                }else {
                    $lstData['medicine'] = "Medicine Availability- ".$key['feedback_for_medicine_availability'];
                }
                if(strpos($key['feedback_for_test_availability'],$searchStr)) {
                   $lstRepeatTags['test'] = "Test Availability";
                    $lstData['test'] = "";
                }else {
                    $lstData['test'] = "Test Availability- ".$key['feedback_for_test_availability'];
                }

                $lastContent = array_filter($lstData);
                $validContent = implode('\n',$lastContent);

                if(!empty($lstRepeatTags)){
                    $blankTags = implode(' & ',$lstRepeatTags);
                    $validContent .= '\n'.$blankTags.'-पर्याप्त फ़ोन नंबर्स ना होने के कारण patient experience पे निष्कर्ष निकालना मुश्किल है- पेशेंट्स एवं स्टाफ को पेशेंट फीडबैक के बारे में बताएं';
                }
//                $doctor_availability = "Doctor availability- ".$key['feedback_for_doctor_availability'];
//                $patient_satisfaction = "Patient Satisfaction- ".$key['feedback_for_patient_satisfaction'];
//                $medicine_availability = "Medicine Availability- ".$key['feedback_for_medicine_availability'];
//                $test_availability = "Test Availability- ".$key['feedback_for_test_availability'];
//                $sms_complete = $sms.$doctor_availability.$patient_satisfaction.$medicine_availability.$test_availability;

                $link = '\n'." ".url('/feedback/'.$key["weblink"]);

                $sms_complete = $sms.$validContent.$link;

                $id = $key['id'];
                $ids .= " $id,";
                $caseString .= " WHEN" ." ".$key['id']." ". "THEN"." '". $sms_complete."'";
            }
            $ids = trim($ids, ',');

            DB::statement("UPDATE $table SET complete_sms = $caseString END WHERE id IN ($ids)");
            echo "SMS created successfully".PHP_EOL;
        }else{
            echo "All sms are already generated".PHP_EOL;
        }
    }

}
