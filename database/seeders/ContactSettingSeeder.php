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
                'phone_number' => '+254 745 763 093',
                'whatsapp_number' => '+254745763093',
                'address' => 'Pinkam House Nakuru, Kenya',
                'google_map_embed' => ''
            ]
        );
    }
}
