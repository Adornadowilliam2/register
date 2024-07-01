<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

    
        User::create([
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('123456789'),
            'phone_number' => '09296407470',
        ]);

    }
}
