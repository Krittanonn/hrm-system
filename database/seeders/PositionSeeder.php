<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('positions')->insert([
            ['name' => 'HR Manager'],
            ['name' => 'Software Developer'],
            ['name' => 'Accountant'],
        ]);
    }

}
