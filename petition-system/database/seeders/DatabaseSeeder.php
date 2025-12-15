<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Petition;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user you can log in with
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('secret123'), // login password
        ]);

        // --- Option A: leave petitions empty ---
        // add petitions via /start-petition form in the UI
        // or manually using Tinker:
        // php artisan tinker
        // Petition::create([...]);

        // --- Option B: seed with real demo petitions ---
        Petition::create([
            'title' => 'Save Bandung’s Urban Green Space',
            'description' => 'Protect public parks from overdevelopment and preserve biodiversity.',
            'target' => 10000,
            'signature_count' => 0,
            'donation_total' => 0,
        ]);

        Petition::create([
            'title' => 'Improve Local Education Facilities',
            'description' => 'Upgrade schools and provide better resources for students in West Java.',
            'target' => 5000,
            'signature_count' => 0,
            'donation_total' => 0,
        ]);

        Petition::create([
            'title' => 'Clean Rivers Campaign',
            'description' => 'Organize community efforts to clean and protect rivers in Dayeuhkolot.',
            'target' => 2000,
            'signature_count' => 0,
            'donation_total' => 0,
        ]);
    }
}
