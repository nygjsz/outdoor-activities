<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Guide;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@outdoor.activity',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        Guide::create(['guide_id' => 'G001', 'name' => 'Ahmad',
            'phone' => '012-3456789', 'experience_years' => 5]);
        Guide::create(['guide_id' => 'G002', 'name' => 'Aiman',
            'phone' => '013-9876543', 'experience_years' => 3]);
        Guide::create(['guide_id' => 'G003', 'name' => 'Aisyah',
            'phone' => '013-9876543', 'experience_years' => 6]);

        Activity::create(['code' => 'A001', 'name' => 'Mount Kinabalu Hike',
            'location' => 'Sabah', 'description' => 'Two-day guided climb.', 'price' => 450,
            'activity_date' => '2026-12-05', 'difficulty' => 'Hard', 'guide_id' => 'G001']);
        Activity::create(['code' => 'A002', 'name' => 'River Kayaking',
            'location' => 'Pahang', 'description' => 'Half-day paddle on the river.', 'price' => 120,
            'activity_date' => '2026-12-12', 'difficulty' => 'Easy', 'guide_id' => 'G002']);
        Activity::create(['code' => 'A003', 'name' => 'Camping at Gunung Datuk',
            'location' => 'Negeri Sembilan', 'description' => 'Overnight camping.', 'price' => 80,
            'activity_date' => '2026-12-20', 'difficulty' => 'Moderate', 'guide_id' => 'G003']);
    }
}