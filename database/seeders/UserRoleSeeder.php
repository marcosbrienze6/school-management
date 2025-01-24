<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeds = [
            ['role' => 'Director'],
            ['role' => 'Teacher'],
            ['role' => 'Student'],
            ['role' => 'Parent'],
            ['role' => 'Employee']
        ];

        foreach ($seeds as $seed) {
            UserRole::firstOrCreate($seed);
        }

    }
}
