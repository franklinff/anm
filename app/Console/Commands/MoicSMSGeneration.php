<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MoicRanking;
use DB;
use App\Classes\Helpers;

class MoicSMSGeneration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:sms_create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate sms for moic asd per rankings and performace category format';

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

        $moic = MoicRanking::whereNull('sms')->where('sms_sent_initiated',0)->orderBy('id', 'ASC')->get();
        
        if (count($moic) === 0) {
            echo "No data found to generate sms.".PHP_EOL;
            return;
        }

        $files = $moic->groupBy('uploaded_file');
        foreach ($files as $file) {
            $grouped = $file->groupBy('block')->toArray();
            $months = DB::table('master_months')->pluck('month_translated', 'id');

            $lstArray = array();
            foreach ($grouped as $group => $moics) {
                foreach($moics as $toppers){
                    $lstArray[$toppers['block']][$toppers['rank']] = $toppers;
                }
            }
            
            foreach($lstArray as $blockName => $rankName) {
                foreach($rankName as $key => $value) {
                    
                    $rank = Helpers::ordinal_suffix($value['rank']);
                    $drNames = $value['dr_name_hin'];
                    if (strpos($value['dr_name_hin'], 'ए') !== FALSE) {
                        $drNames = explode('ए', $value['dr_name_hin']);
                    } elseif (strpos($value['dr_name_hin'], ',') !== FALSE) {
                        $drNames = explode(',', $value['dr_name_hin']);
                    }

                    if (is_string($drNames)) {
                        $drNames = [ $drNames ];
                    }

                    $sms_list = [];
                    foreach ($drNames as $drName) {
                        
                        $sms = '';
                        $sms = "क्या आप बने अपने ज़िले में मिसाल? \r\n";
                        if($value['scenerio'] == "TOP") {
                            $sms.= $drName.', '.$months[$value['month']].' '.'में आपकी PHC'.' '.$value['phc_hin'].'अलवर ज़िले के सर्वश्रेष्ठ PHCs में से एक है !आपकी PHC'.' '.$value['block_hin'].' '. 'ब्लॉक में '.$rank.'नंबर पे आयी |';
                        } elseif ($value['scenerio'] == "MID") {
                            $sms.= $drName.', '.$months[$value['month']] .' '.'में आपकी PHC'.' '.$value['phc_hin'].' ने अलवर ज़िले में अच्छा प्रदर्शन किया |आप और मेहनत कर, अलवर के सर्वश्रेष्ठ PHCs में आने की कोशिश करें !आपकी PHC'.' '.$value['block_hin'].' '.'ब्लॉक में '.' '.$rank.' '.'नंबर पे आयी |';
                        } elseif ($value['scenerio'] == "BOTTOM") {
                            $sms.= $drName.', '.$months[$value['month']] .' '.'में आपकी PHC '.' '.$value['phc_hin'].' अलवर ज़िले के अधिकांश PHCs से पीछे रही |आप और मेहनत कर, अलवर के सर्वश्रेष्ठ PHCs में आने की कोशिश करें !आपकी PHC'.' '.$value['block_hin'].' '.'ब्लॉक में '.' '.$rank.' '.'नंबर पे आयी |';
                        }
                        // print_r($value['scenerio']);
                        
                        $sms.= $value['block_hin'].' '.'ब्लॉक में PHC'.' '.$rankName[1]['phc_hin'].' '.'और'.' '.$rankName[2]['phc_hin'].' '.'इस महीने अव्वल रहे और इन् PHCs के'.' '.$rankName[1]['dr_name_hin'].' '.'और'.' '.$rankName[2]['dr_name_hin'].' '.'ने अच्छा कार्य किया !';
                        
                        $sms.='अगले महीने रैंक को और इम्प्रूव करने के लिए नीचे दिए गए PHC स्कोरकार्ड लिंक पर क्लिक करें और स्कोरकार्ड का प्रयोग सेक्टर मीटिंग्स में अवश्य करें। ';
                        $sms_list[] = $sms;

                    }

                    $indiv_moic = MoicRanking::find($value['id']);
                    // $indiv_moic->sms = $sms;
                    $indiv_moic->sms = implode('@@', $sms_list);
                    $indiv_moic->save();
                    echo "Updated.".PHP_EOL;
                }
            }
        }
    }
}







//                exit;
//
//                    $lstArray = array();
//                    foreach($moics as $segregation){
//
//                        if($segregation['rank'] == 1 || $segregation['rank'] == 2){
//                            $lstArray['toppers'][] = $segregation;
//                        }else{
//                            $lstArray[$segregation['rank']] = $segregation;
//                        }
//                        dd($lstArray);
//                    }
//
//
//                    $price = array();
//                    foreach ($moics as $key => $row)
//                    {
//                        $price[$key] = $row['rank'];
//                    }
//                    array_multisort($price, SORT_ASC, $moics);
//
//                    dd($price);






                    /*                    $tops = array_filter($moics, function($single){  //4
                                            return (trim($single['scenerio']) == 'TOP');
                                        });
                                        $middle = array_filter($moics, function($single){  //5
                                            return (trim($single['scenerio']) == 'MIDDLE');
                                        });
                                        $bottom = array_filter($moics, function($single){  //5
                                            return (trim($single['scenerio']) == 'BOTTOM');
                                        });

                                        if(!empty($tops)){
                                            if($tops){
                                                $topphctext = Helpers::renderHindi(array_column($tops, 'phc_hin'), '');
                                                $topdoctext = Helpers::renderHindi(array_column($tops, 'dr_name_hin'), '');
                                            }else{
                                                $topphctext = '';
                                                $topdoctext = '';
                                            }
                                        }

                                        if(!empty($middle)) {
                                            if ($middle) {
                    //                          $middlephc = Helpers::renderHindi(array_column($middle, 'phc_hin'), '');
                                                $middlePhcArray = array_column($middle, 'phc_hin');
                                            } else {
                                                $middlephc = '';
                                                $middlePhcArray = '';
                                            }
                                        }else{
                                            $middlePhcArray = '';
                                        }

                                        if(!empty($bottom)) {
                                            if ($bottom) {
                    //                          $bottomphc = Helpers::renderHindi(array_column($bottom, 'phc_hin'), '');
                                                $bottomPhcArray = array_column($bottom, 'phc_hin');
                                            } else {
                                                $bottomphc = '';
                                                $bottomPhcArray = '';
                                            }
                                        }else{
                                            $bottomPhcArray = '';
                                        }

                                        $listMiddlePhc = "";
                                        $listBottomPhc = "";*/

                    //foreach($moics as $single){




/*                        if(!empty($middlePhcArray)){
                            $listMiddlePhc = array_slice($middlePhcArray,0,3);
                            if(in_array($single['phc_hin'],$listMiddlePhc)){
                                $middlephc = Helpers::renderHindi($listMiddlePhc, '');
                            }else{
                                if($single['scenerio']=='MIDDLE') {
                                    $actualKey = count($listMiddlePhc) - 1;
                                    $listMiddlePhc[$actualKey] = $single['phc_hin'];
                                    $middlephc = Helpers::renderHindi($listMiddlePhc, '');
                                }else{
                                    $middlephc = Helpers::renderHindi($listMiddlePhc, '');
                                }
                            }
                        }

                        if (!empty($bottomPhcArray)){
                            $listBottomPhc = array_slice($bottomPhcArray,0,3);
                            if(in_array($single['phc_hin'],$listBottomPhc)){
                                $bottomphc = Helpers::renderHindi($listBottomPhc, '');
                            }else{
                                if($single['scenerio']=='BOTTOM') {
                                    $actualKey = count($listBottomPhc) - 1;
                                    $listBottomPhc[$actualKey] = $single['phc_hin'];
                                    $bottomphc = Helpers::renderHindi($listBottomPhc, '');
                                }else{
                                    $bottomphc = Helpers::renderHindi($listBottomPhc, '');
                                }
                            }
                        }*/

//                        $rank = Helpers::ordinal_suffix($single['rank']);
//                        $sms = '';
//                        $sms = "क्या आप बने अपने ज़िले में मिसाल? \r\n";
//                        if($single['scenerio'] == 'TOP'){
//                            $sms.= $single['dr_name_hin'].' '.$months[$single['month']].' '.'में आपकी PHC'.$single['phc_hin'].'अलवर ज़िले के सर्वश्रेष्ठ PHCs में से एक है !आपकी PHC'.' '.$single['block_hin'].' '. 'ब्लॉक में '.$rank.'नंबर पे आयी |';
//                        }elseif($single['scenerio'] == 'MIDDLE'){
//                            $sms.= $single['dr_name_hin'].' '.$months[$single['month']] .'में आपकी PHC'.$single['phc_hin'].' ने अलवर ज़िले में अच्छा प्रदर्शन किया |आप और मेहनत कर, अलवर के सर्वश्रेष्ठ PHCs में आने की कोशिश करें !आपकी PHC' .$single['block_hin']. 'ब्लॉक में '.$rank.'नंबर पे आयी |';
//                        }elseif($single['scenerio'] == 'BOTTOM'){
//                            $sms.= $single['dr_name_hin'].' '.$months[$single['month']] .'में आपकी PHC '.$single['phc_hin'].' अलवर ज़िले के अधिकांश PHCs से पीछे रही |आप और मेहनत कर, अलवर के सर्वश्रेष्ठ PHCs में आने की कोशिश करें !आपकी PHC' .$single['block_hin']. 'ब्लॉक में '.$rank.'नंबर पे आयी |';
//                        }
//                        $sms.= $single['block_hin'].'ब्लॉक में PHC' .''.''.''. 'इस महीने अव्वल रहे और इन् PHCs के' .' '. '     '. ' '.'ने अच्छा कार्य किया !';
//                        $sms.='अगले महीने रैंक को और इम्प्रूव करने के लिए निचे दिए गए पीएचसी स्कोरकार्ड लिंक पर क्लिक करें और स्कोरकार्ड का प्रयोग सेक्टर मीटिंग्स में अवश्य करें। ';
//
//                        $indiv_moic = MoicRanking::find($single['id']);
//                        $indiv_moic->sms = $sms;
//                        $indiv_moic->save();
//                        echo "Updated.".PHP_EOL;
//                    }
//                }
//            }
//        }else{
//            echo "All sms's are updated.".PHP_EOL;
//        }
//    }
//}



/*                        $sms.= $single['dr_name_hin'].',आपकी PHC'.' '.$single['phc_hin'].' '.$months[$single['month']].' '.'के महीने मे'.' '.$single['block_hin'].' '.'में'.' '.$rank.' '.' नंबर पे आयी'.' ';
                        if(!empty($topphctext)){
                            $sms .= $single['block_hin'].' '.'ब्लॉक में PHC'.' '.rtrim($topphctext,',').' '.'ने इस महीने सब के लिए एक मिसाल बन दिखाया और इन् पीएचसीस के '.' '.rtrim($topdoctext,',').' '.'ने सराहनीये कार्य किया है।';
                        }
                        $sms.=' अगले महीने रैंक को और इम्प्रूव करने के लिए निचे दिए गए पीएचसी स्कोरकार्ड लिंक पर क्लिक करें और स्कोरकार्ड का प्रयोग सेक्टर मीटिंग्स में अवश्य करें।';*/

//                        $sms = '';
//                        $sms = $single['dr_name_hin'].', क्या आप जानना चाहते हैं की '.$single['block_hin'].' ब्लॉक की कौनसी पीएचसी '.$months[$single['month']].' '.$single['year']. ' के महीने में बेहतरीन प्रदर्शन कर, एक मिसाल बनी? ';
//                        if(!empty($topphctext)){
//                        $sms .= $single['block_hin'].' ब्लॉक में पीएचसी '.rtrim($topphctext, ',').' अव्वल रहीं और इन् पीएचसीस के डॉक्टर - '.rtrim($topdoctext, ',').'  ने सराहनीये कार्य किया। ';
//                        }
//                        if(!empty($middlephc)){
//                        $sms .= 'पीएचसी '.$middlephc.' के डॉक्टरों ने भी अच्छा कार्य किया।';
//                        }
//                        if(!empty($bottomphc)) {
//                        $sms .= 'पीएचसी ' . $bottomphc . '  में बेहतर परिणामों के लिए सुद्धारण की आवश्यकता है।';
//                        }
//                        $sms .= 'रैंक को कैसे सुद्धारा जाये-जानने के लिए पीएचसी स्कोरकार्ड का प्रयोग करें। पीएचसी स्कोरकार्ड देखने के लिए यहाँ क्लिक करें:';
