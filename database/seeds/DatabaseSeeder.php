<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(Language::class);
         $this->call(MonthsTableSeeder::class);
         $this->call(stateTableSeeder::class);
         $this->call(districtTableSeeder::class);
         $this->call(Block::class);
    }
}
