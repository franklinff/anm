<?php

namespace App\Console\Commands;

use App\BeneficiaryModel;
use App\DistrictModel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Excel;
use App\AnmTargetDataModel;
use App\AnmDetailsModel;
use App\PhcTranslationModel;
use Illuminate\Support\Facades\Storage;
use File;

class ReadExcelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $open = public_path().'/FileUpload';

        if ($files = glob($open . "/*")) {
            foreach ($files as $filePath)
            {
                $path = $filePath;

                $filename = substr($path, strrpos($path, '/') + 1);

                $counter = 0;

                $sheetName = Excel::load($path, function($sheet) use(&$counter) {
                    $sheet->each(function($sheet) use(&$counter) {
                        $counter++;
                    });
                })->getSheetNames();


                if($counter > 1) {
                    $district_id = AnmTargetDataModel::where('filename', $filename)->pluck('district')->first();

                    //$district_name = trim(strtolower($district_name));

                    //$district_id = DistrictModel::where('district_name', 'LIKE', $district_name)->pluck('id')->first();

                    $arrayList = array();
                    $arrayData = array();

                    $lstAnm = array();
                    $arrayListAnm = array();

                    $phc = array();
                    $arrayListPhc = array();

                   foreach ($sheetName as $key => $sheet) {
                        if ($key == 0) {
                            continue;
                        }

                        $data = Excel::selectSheets($sheet)->load($path, function($sheet) use(&$counter) {
                            $sheet->each(function ($sheet) use (&$counter) {
                                $counter++;
                            });
                        })->get()->toArray();

                        if($sheet == "beneficiary_details") {

                            if(!empty($data)){

                            foreach ($data as $key => $mob) {
                                foreach ($mob as $k => $v) {
                                    if ($k == "phc_name") {
                                        continue;
                                    }

                                    $arrayList['beneficary_mobile_number'] = $v;
                                    $arrayList['district_id'] = $district_id;
                                    $arrayList['phc_name'] = $k;
                                    $arrayList['created_at'] = Carbon::now();
                                    $arrayList['filename'] = $filename;

                                    $arrayData[] = $arrayList;
                                }

                            }
                         }
                        BeneficiaryModel::insert($arrayData); //Inserting Data into Beneficiary Table


                        }

                     /*   if($sheet == "anm_translations"){
                            if(!empty($data)){
                            foreach ($data as $key => $value){
                                if($value['anm_name'] == null && $value['translation'] == null && $value['languageid'] == null )
                                {
                                    continue;
                                }
                                $arrayListAnm['anm_name'] = strtolower($value['anm_name']);
                                $arrayListAnm['anm_mobile_number'] = 9999999999;
                                $arrayListAnm['anm_translation'] = $value['translation'];
                                $arrayListAnm['district_id'] = $district_id;
                                $arrayListAnm['language_id'] = $value['languageid'];
                                $arrayListAnm['status'] = 1;
                                $arrayListAnm['created_at'] = Carbon::now();
                                $lstAnm[] = $arrayListAnm;
                            }
                            }
                            AnmDetailsModel::insert($lstAnm);  //Inserting data into anm_details table
                        }*/


                   /*     if($sheet == "phc_translations"){

                            if(!empty($data)){
                            foreach ($data as $key => $value){
                                if($value['phc_name'] == null && $value['translation'] == null && $value['languageid'] == null )
                                {
                                    continue;
                                }
                                $arrayListPhc['phc_name'] = strtolower($value['phc_name']);
                                $arrayListPhc['phc_translation'] =   $value['translation'];
                                $arrayListPhc['block_id'] = 1;
                                $arrayListPhc['language_id'] = $value['languageid'];
                                $arrayListPhc['status'] = 1;
                                $arrayListPhc['created_at'] = Carbon::now();
                                $phc[] = $arrayListPhc;
                            }
                            }
                            PhcTranslationModel::insert($phc);  //Inserting data into phc table
                        }*/
                    }

                    //update status flag as Y
                    AnmTargetDataModel::where('filename',$filename)->update(['status' => 'Y']);
                    //Trash the file from File upload
                    $oldfile = public_path().'/'.'FileUpload'.'/'.$filename;
                    $newPath = public_path().'/'.'trashFiles'.'/'.$filename;
                    File::move($oldfile,$newPath);

                }
            }
        } else {
            dd('no files');
        }
    }
}
