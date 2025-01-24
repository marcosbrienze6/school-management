<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $seeds = [
            [
                'name' => 'Admin User',
                'email' => 'admin@email.com',
                'cpf' => '1234567890',
                'password' => Hash::make('password123')
            ]
        ];

        foreach ($seeds as $seed) {
            User::firstOrCreate($seed);
        }
    }
}
