<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'department_id' => 2, // IT
                'position_id' => 2,   // Developer
                'hire_date' => '2023-01-01',
                'phone' => '0812345678',
                'address' => 'Bangkok',
                'user_id' => 2, // employee user
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

}
