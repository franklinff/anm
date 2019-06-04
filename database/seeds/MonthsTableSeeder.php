<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MonthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = [
            [
                'month_english' => 'January',
                'month_translated' => 'जनवरी',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'February',
                'month_translated' => 'फ़रवरी',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'March',
                'month_translated' => 'मार्च',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'April',
                'month_translated' => 'अप्रैल',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'May',
                'month_translated' => 'मई',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'June',
                'month_translated' => 'जून',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'July',
                'month_translated' => 'जुलाई',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'August',
                'month_translated' => 'अगस्त',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'September',
                'month_translated' => 'सितंबर',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'October',
                'month_translated' => 'अक्टूबर',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'November',
                'month_translated' => 'नवंबर',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'month_english' => 'December',
                'month_translated' => 'दिसंबर',
                'language_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ]
        ];


        DB::table('master_months')->insert($months);
    }
}
