<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FeedbackModel;
use DB;

class FeedbackWeb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedback:weblink';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weblink for feedback creation.';

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
        $empty_weblink_id = FeedbackModel::select('id')
            ->where('weblink','')
            ->get()->toArray();

        if (count($empty_weblink_id) > 0) {
            foreach ($empty_weblink_id as $key => $value) {
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $str = substr(str_shuffle($chars), 0, 10);
                $weblink = $str.$value['id'];

                $id = $value['id'];
                $ids .= "$id,";
                $caseString .= " WHEN" ." ".$value['id']." ". "THEN"." '". $weblink."'";
            }

            $id_s = trim($ids, ',');
            DB::statement("UPDATE $table SET weblink = $caseString END WHERE id IN ($id_s)");
            echo "Weblink created successfully".PHP_EOL;
        }else{
            echo "Weblink are already generated".PHP_EOL;
        }
    }

}


