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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'cpf' => '12345678901',
            'password' => bcrypt('password'),
            'user_role_id' => 1, // Associando ao papel "Admin"
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'cpf' => '09876543210',
            'password' => bcrypt('password'),
            'user_role_id' => 2, // Associando ao papel "User"
        ]);
    }
}
