<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('salaries')->insert([
            [
                'employee_id' => 1,
                'base_salary' => 30000,
                'bonus' => 5000,
                'deduction' => 1000,
                'net_salary' => 34000,
                'payment_date' => '2025-07-01',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

}
