<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if not exists
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        // Create client user if not exists
        if (!User::where('email', 'client@example.com')->exists()) {
            User::create([
                'name' => 'Client User',
                'email' => 'client@example.com',
                'password' => Hash::make('password'),
                'role' => 'client',
            ]);
        }

        // Create additional client users if needed
        $existingClientCount = User::where('role', 'client')->count();
        if ($existingClientCount < 5) {
            $usersToCreate = 5 - $existingClientCount;
            User::factory($usersToCreate)->create([
                'role' => 'client'
            ]);
        }
    }
}
