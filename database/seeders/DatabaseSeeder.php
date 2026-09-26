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
        $password = config('services.admin.password') ?: env('ADMIN_PASSWORD');
        $email = config('services.admin.email') ?: env('ADMIN_EMAIL', 'admin@cypressiq.agency');

        if (empty($password)) {
            $this->command->error('ADMIN_PASSWORD is not set in your .env file or configuration. Seeder aborted.');
            return;
        }

        // 1. Super Admin Account
        User::updateOrCreate(
            ['email' => $email],
            [
                'name'      => 'Executive Admin',
                'password'  => Hash::make($password),
                'role'      => User::ROLE_SUPER_ADMIN,
                'is_admin'  => true,
                'is_active' => true,
            ]
        );

        // 2. Growth & Marketing (Sales + Marketing) Department Account
        User::firstOrCreate(
            ['email' => 'growth@cypressiq.agency'],
            [
                'name'      => 'Growth & Sales Team',
                'password'  => Hash::make($password),
                'role'      => User::ROLE_GROWTH,
                'is_admin'  => true,
                'is_active' => true,
            ]
        );

        // 3. Product & Engineering (Product PM + Engineer) Department Account
        User::firstOrCreate(
            ['email' => 'engineer@cypressiq.agency'],
            [
                'name'      => 'Product & Engineering Lead',
                'password'  => Hash::make($password),
                'role'      => User::ROLE_PRODUCT_ENGINEER,
                'is_admin'  => true,
                'is_active' => true,
            ]
        );

        $this->command->info('Super Admin, Growth & Marketing, and Product & Engineering users seeded successfully.');

        // Seed SEO Blogs & Trust / Social Proof
        $this->call([
            SeoBlogSeeder::class,
            TrustSeeder::class,
        ]);
        $this->command->info('SEO blogs and Trust data seeded successfully.');
    }
}
