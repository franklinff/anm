<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>'auth'], function (){

    Route::get('/', 'DashboardController@index');
    Route::get('listfile', 'DashboardController@listing')->name('listfile');
    Route::get('dashboardfile/{id}','DashboardController@dashboardfile')->name('dashboardfile');

    Route::get('Anmgraph/{id}','GraphController@index');
    Route::get('Moicgraph/{id}','GraphController@graphMoic');

    Route::get('Anm/{id}', 'DashboardController@anm_details')->name('anm');
    Route::get('Moic/{id}', 'DashboardController@moic_details')->name('moic');
    Route::get('Feedback/{id}', 'DashboardController@feedback_details')->name('feedback');
    Route::get('Nudges/{id}', 'DashboardController@nudge_details')->name('nudge');


    Route::get('get-anm', 'TargetdataController@index')->name('dashboard');
    Route::post('import-file', 'TargetdataController@importFile')->name('import.file');
    Route::get('/get-anm-target-data', 'TargetdataController@fetchTargetData');
    Route::post('anm_sms_update', 'TargetdataController@update_sms_schedule')->name('anm_sms_update');
    Route::get('deleteAnmFile/{id}','TargetdataController@deleteFile')->name('deleteAnmFile');

    Route::get('/fetch-process-data/{id}', 'ProcessedFileController@fetchProcessData');
    Route::get('processedfile/{id}','ProcessedFileController@index')->name('processedfile');

    Route::get('get-mos', 'MosController@index'); //okay
    Route::post('mos','MosController@importRankings')->name('mos'); //okay
    Route::get('rankingdetails/{id}', 'MosController@ajaxMoic')->name('rankingdetails'); //okay
    Route::get('export_mos/{id}','MosController@export_mos')->name('export_mos'); //okay
    Route::get('ajax-moic', 'MosController@fetchRankingData'); //okay
    Route::post('sms_update','MosController@update_sms_schedule')->name('sms_update');
    Route::get('deleteFile/{id}','MosController@deleteFile')->name('deleteFile');
    Route::get('rank/{id}', 'MosController@rank_details')->name('rank');

    Route::get('excelimport/{id}', 'ProcessedFileController@export')->name('excel_import');
    Route::get('/ajax/{district}', 'TargetdataController@getBlocks');
    Route::get('/download/moic_zip/{name}', 'MosController@downloadZip');


    Route::get('feedback', 'FeedbackController@index');
    Route::post('import-feedback', 'FeedbackController@importFile')->name('import.feedback');
    Route::get('/feedback_files', 'FeedbackController@feedbackfiles');
    Route::get('detail_feedback/{id}','FeedbackController@feedbackDetail')->name('detail_feedback');
    Route::get('file_details/{id}', 'FeedbackController@file_details');
    Route::get('export_feedback/{id}','FeedbackController@export_feedback')->name('export_feedback');
    Route::post('feed_update', 'FeedbackController@update_feed_schedule');


    Route::get('get-nudges', 'NudgeController@index');
    Route::post('import-nudgefile', 'NudgeController@importNudgeFile')->name('import.nudgefile');
    Route::get('/get-nudge-data', 'NudgeController@fetchNudgesFiles');
    Route::get('nudgedetails/{id}', 'NudgeController@nudgeFileDetails')->name('nudgedetails');
    Route::get('nudgefile/{id}', 'NudgeController@detail_nudge')->name('nudgefile');
    Route::get('deleteNudge/{id}','NudgeController@deleteFile')->name('deleteNudge');



    Route::get('weblinks_anm_export/{id}', 'DashboardController@anm_weblinks_export')->name('weblinks_anm_export');
    Route::get('weblinks_moic_export/{id}', 'DashboardController@moic_weblinks_export')->name('weblinks_moic_export');

});

Route::get('/feedback/{link}', 'FeedbackController@showReport')->name('feedback');
Route::get('/scorecard/{link}', 'MosController@showReport')->name('moic_report');
Route::get('/anm/{id}','WeblinkController@index')->name('weblink');
Route::get('download-image','WeblinkController@downloadImage')->name('download-link');
Auth::routes();