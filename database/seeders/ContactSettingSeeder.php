<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ContactSetting::updateOrCreate(
            ['id' => 1],
            [
                'company_email' => 'hello@cypressiqagency.com',
                'phone_number' => '+1 (555) 0123-4567',
                'whatsapp_number' => '+155501234567',
                'address' => 'Accra Business District, Ghana',
                'google_map_embed' => ''
            ]
        );
    }
}
