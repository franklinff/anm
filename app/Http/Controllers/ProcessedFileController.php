<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\BeneficiaryModel;
use App\DistrictModel;
use App\Block;

use DataTables;

class ProcessedFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $status = AnmTargetDataModel::select('status')
            ->where('id',$id)
            ->first()->toArray();
        return view('processedfile',compact('id','status'));
    }

    public function fetchProcessData($id){
        $file_name = AnmTargetDataModel::select('filename')
                    ->where('id',$id)
                    ->first();

      //  echo $file_name;die;

        $processData = AnmTargetDataModel::select('id','block','phc_name', 'subcenter','weblink','beneficiary_code','moic_code', 'anm_custom_msg',
            'moic_custom_msg', 'beneficiary_custom_msg')
                                        ->where('status','Y')
                                        ->where('filename','LIKE',$file_name['filename'])
                                        ->get()
                                        ->toArray();

        $db = Datatables::of($processData);
        $db->addColumn('sr_no', function ($processData){ static $i = 0; $i++; return $i; }) ->rawColumns(['id']);
        $db->addColumn('weblink', function ($processData){
            return url('/anm/'.$processData["weblink"]);
        })->addColumn('anm_sms_span', function ($processData){
            return '<span class="">'.$processData['anm_custom_msg'].'</span>';
        })->addColumn('moic_sms_span', function ($processData){
            return '<span class="">'.$processData['moic_custom_msg'].'</span>';
        })->addColumn('benef_sms_span', function ($processData){
            return '<span class="">'.$processData['beneficiary_custom_msg'].'</span>';
        })->rawColumns(['weblink', 'anm_sms_span', 'moic_sms_span', 'benef_sms_span']);


        return $db->make(true);
    }



   public function export($request){

       $file = AnmTargetDataModel::select('filename')
                    ->where('id',$request)
                    ->first();
        $file_name = $file['filename'];

        $anm_target_data = AnmTargetDataModel::with(['district'])->select('*')
                                            ->where('status','Y')
                                            ->where('filename','=',$file_name)
                                            ->get()
                                            ->toArray();

       $weblink_message = AnmTargetDataModel::where('filename','=',$file_name)
                                ->select('weblink','phc_name','beneficiary_custom_msg')
                                ->distinct('phc_name')
                                ->get()
                                ->toArray();
       $weblink = array();
       $message = array();

       foreach($weblink_message as $msglink){
          $weblink[$msglink['phc_name']] = $msglink['weblink'];
           $message[$msglink['phc_name']] = $msglink['beneficiary_custom_msg'];
      }

       $block=AnmTargetDataModel::select('block')->where('filename',$file_name)->first();
       $block_name = $block['block'];

        $beneficiary_data = BeneficiaryModel::select('beneficary_mobile_number','district_id','phc_name','master_district.district_name')
                                              ->join('master_district','beneficary_details.district_id', '=', 'master_district.id')
                                              ->where('filename','=',$file_name)
                                              ->get()
                                              ->toArray();
       \Excel::create('target_data'.time(), function($excel) use($anm_target_data,$beneficiary_data,$block_name,$weblink,$message) {

           $excel->sheet('target_data', function($sheet) use($anm_target_data) {
               $excelData = [];
               $excelData[] = [
                   'District',
                   'Block',
                   'Phc Name',
                   'MOIC Name',
                   'MOIC Phone Number',
                   'ANM Name',
                   'ANM Phone Number',
                   'Performer Category',
                   'Scenario',
                   'Weblink',
                   'Anm customised text message',
                   'MOIC customised text message',
                   'Final Anm sms',
                   'Final Moic sms'
               ];

               foreach ($anm_target_data as $value) {
                   $excelData[] = array(
                       $value['district']['district_name'],
                       $value['block'],
                       ucwords($value['phc_name']),
                       $value['moic_name'],
                       $value['moic_mobile_number'],
                       $value['anm_name'],
                       $value['anm_mobile_number'],
                       $value['performer_category'],
                       $value['scenerio'],
                       url('/anm/'.$value['weblink']),
                       $value['anm_custom_msg'],
                       $value['moic_custom_msg'],
                       $value['anm_custom_msg'].url('/anm/'.$value['weblink']),
                       $value['moic_custom_msg'].url('/anm/'.$value['weblink'])
                   );
               }
               $sheet->fromArray($excelData, null, 'A1', true, false);
           });

           $excel->sheet('beneficiary', function($sheet) use($beneficiary_data,$block_name,$weblink,$message) {
               $excelData = [];

               $excelData[] = [
                   'District',
                   'Block',
                   'Phc Name',
                   'Beneficiary Phone Number',
                   'Weblink',
                   'Beneficiary message',
                   'Final sms'
               ];

               foreach ($beneficiary_data as $value) {

                   if(array_key_exists($value['phc_name'],$weblink)){
                       $weblink_text = $weblink[$value['phc_name']];
                   }else{
                       $weblink_text = null;
                   }

                   if($weblink_text != null){
                       $link_weblink_text = url('/weblink',$weblink_text);
                   }else{
                       $link_weblink_text = null;
                   }

                   if(array_key_exists($value['phc_name'],$message)){
                       $message_text = $message[$value['phc_name']];
                   }else{
                       $message_text = null;
                   }

                   $excelData[] = array(
                       $value['district_name'],
                       ucwords($block_name),
                       ucwords($value['phc_name']),
                       $value['beneficary_mobile_number'],
                       $link_weblink_text,
                       $message_text,
                       $message_text.$link_weblink_text,

                   );
               }
               $sheet->fromArray($excelData, null, 'A1', true, false);
           });

       })->download('xlsx');


   }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
