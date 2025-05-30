<?php

namespace Database\Seeders;

use App\Models\AccessLog;
use App\Models\AutoBot;
use App\Models\BannedIp;
use App\Models\Company;
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
        Company::create(['name' => 'SJC']);
        Company::create(['name' => 'DOJI']);
        Company::create(['name' => 'PNJ']);
        Company::create(['name' => 'Ngọc Thẩm']);
        Company::create(['name' => 'Thế giới']);

        // SJC : 12 loại
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Vàng SJC 1L, 10L, 1KG']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Vàng SJC 5 chỉ']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Vàng SJC 0.5 chỉ, 1 chỉ, 2 chỉ']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Vàng nhẫn SJC 99,99% 1 chỉ, 2 chỉ, 5 chỉ']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Vàng nhẫn SJC 99,99% 0.5 chỉ, 0.3 chỉ']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Nữ trang 99,99%']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Nữ trang 99%']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Nữ trang 75%']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Nữ trang 68%']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Nữ trang 61%']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Nữ trang 58,3%']);
        TypeGold::create(['companies_id' => 1 , 'name_vn' => 'Nữ trang 41,7%']);

        // DOJI : 6 loại
        TypeGold::create(['companies_id' => 2 , 'name_vn' => 'SJC Lẻ']);
        TypeGold::create(['companies_id' => 2 , 'name_vn' => 'AVPL']);
        TypeGold::create(['companies_id' => 2 , 'name_vn' => 'Nhẫn tròn 999 Hưng Thịnh Vượng']);
        TypeGold::create(['companies_id' => 2 , 'name_vn' => 'Nữ trang 99.99']);
        TypeGold::create(['companies_id' => 2 , 'name_vn' => 'Nữ trang 99.9']);
        TypeGold::create(['companies_id' => 2 , 'name_vn' => 'Nữ trang 99']);

        // Ngọc Thẩm : 5 loại
        TypeGold::create(['companies_id' => 4 , 'name_vn' => 'Vàng miếng SJC']);
        TypeGold::create(['companies_id' => 4 , 'name_vn' => 'Nhẫn 999.9']);
        TypeGold::create(['companies_id' => 4 , 'name_vn' => 'Vàng 24K (990)']);
        TypeGold::create(['companies_id' => 4 , 'name_vn' => 'Vàng 18K (750)']);
        TypeGold::create(['companies_id' => 4 , 'name_vn' => 'Vàng trắng Au750']);

        // Thế giới
        TypeGold::create(['companies_id' => 5 , 'name_vn' => 'Vàng 24K', 'type' => 1]);

        Setting::create(['name' => 'AUTO_UPDATE_GOLD_PRICE', 'type_value' => 'integer', 'value' => 1, 'note' => 'Tự động cập nhật giá vàng 0/1 : Tắt/Bật']);
        Setting::create(['name' => 'AUTO_UPDATE_GOLD_CURRENCY', 'type_value' => 'integer', 'value' => 1, 'note' => 'Tự động cập nhật giá vàng 0/1 : Tắt/Bật']);
        Setting::create(['name' => 'MAIN_SJC_TYPE_GOLD_VN_ID', 'type_value' => 'integer', 'value' => 1, 'note' => 'Giá trị chính để hiển thị giá vàng SJC Việt Nam']);
        Setting::create(['name' => 'MAIN_9999_TYPE_GOLD_VN_ID', 'type_value' => 'integer', 'value' => 4, 'note' => 'Giá trị chính để hiển thị giá vàng 9999 Việt Nam']);
        Setting::create(['name' => 'MAIN_TYPE_GOLD_WORLD_ID', 'type_value' => 'integer', 'value' => 24, 'note' => 'Giá trị chính để hiển thị giá vàng thế giới']);

        Price::factory()->count(30000)->create();
        // Setting::factory()->count(10)->create();
        AccessLog::factory()->count(100)->create();
        AutoBot::factory()->count(100)->create();
        Feedback::factory()->count(100)->create();
        BannedIp::factory()->count(100)->create();
    }
}
