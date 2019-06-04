<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Language extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_language')->insert([
            'language' => 'Hindi',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
