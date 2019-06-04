<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class stateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_state')->insert([
            'state_name' => 'Rajasthan',
            'status' =>  1,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
