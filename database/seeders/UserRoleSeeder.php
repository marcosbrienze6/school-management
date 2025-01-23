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
        UserRole::create(['role' => 'Director']);
        UserRole::create(['role' => 'Coordinator']);
        UserRole::create(['role' => 'Teacher']);
        UserRole::create(['role' => 'Student']);
        UserRole::create(['role' => 'Doorman']);
        UserRole::create(['role' => 'Cleaning']);
        UserRole::create(['role' => 'Kitchen']);
        UserRole::create(['role' => 'Employee']);

    }
}
