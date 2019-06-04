<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Block extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_block')->insert([
            'block_name' => 'Bansur',
            'district_id'=> 1,
            'created_at' => Carbon::now()->toDateTimeString(),
            'status' => 1
        ]);
    }
}
