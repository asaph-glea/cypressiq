<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Set ADMIN_PASSWORD in your .env before running this seeder.
     */
    public function run(): void
    {
        $password = env('ADMIN_PASSWORD');

        if (empty($password)) {
            $this->command->error('ADMIN_PASSWORD is not set in your .env file. Seeder aborted.');
            return;
        }

        User::firstOrCreate(
            ['email' => 'admin@cypressiq.agency'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make($password),
                'is_admin' => true,
            ]
        );

        $this->command->info('Admin user seeded successfully.');

        // Seed SEO Blogs
        $this->call([
            SeoBlogSeeder::class,
        ]);
        $this->command->info('SEO blogs seeded successfully.');
    }
}
