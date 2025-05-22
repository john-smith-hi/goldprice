<?php

namespace Database\Seeders;

use App\Models\AccessLog;
use App\Models\AutoBot;
use App\Models\BannedIp;
use App\Models\Feedback;
use App\Models\Price;
use App\Models\Setting;
use App\Models\TypeGold;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        TypeGold::factory()->count(10)->create();
        Price::factory()->count(1000)->create();
        Setting::factory()->count(10)->create();
        AccessLog::factory()->count(100)->create();
        AutoBot::factory()->count(10)->create();
        Feedback::factory()->count(10)->create();
        BannedIp::factory()->count(10)->create();
    }
}
