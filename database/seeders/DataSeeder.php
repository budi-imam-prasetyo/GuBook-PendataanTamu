<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['month' => 'Apr', 'value' => 50],
            ['month' => 'May', 'value' => 40],
            ['month' => 'Jun', 'value' => 300],
            ['month' => 'Jul', 'value' => 220],
            ['month' => 'Aug', 'value' => 500],
            ['month' => 'Sep', 'value' => 250],
            ['month' => 'Oct', 'value' => 400],
            ['month' => 'Nov', 'value' => 230],
            ['month' => 'Dec', 'value' => 500],
        ];

        DB::table('data')->insert($data);
    }
}