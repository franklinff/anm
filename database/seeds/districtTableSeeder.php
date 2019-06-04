<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class districtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_district')->insert([
            'district_name' => 'Alwar',
            'state_id' => 1,
            'status' =>  1,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
