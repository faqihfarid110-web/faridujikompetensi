<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Ensure we don't create duplicate test users if seeding multiple times
        User::updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Create a demo account used for local testing and demonstration.
        // This adds a user with email demo@literasi.com and password "password123".
        // UpdateOrCreate keeps this idempotent and avoids duplicates on repeated seeding.
        User::updateOrCreate([
            'email' => 'demo@literasi.com',
        ], [
            'name' => 'Demo User',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
