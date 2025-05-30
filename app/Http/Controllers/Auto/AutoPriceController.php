<?php

namespace App\Http\Controllers\Auto;

use App\Models\Company;
use App\Models\Price;
use Illuminate\Support\Facades\Http;
use App\Models\TypeGold;
use App\Models\AutoBot;
use App\Models\Notification;
use App\Models\Setting;

class AutoPriceController
{
    const GET_EVERY_MINUTE = 30;
    const GUESS_WORK_DONE_MINUTE = 5;
    const LINK_DATA_NGOCTHAM = 'https://giavang.org/trong-nuoc/ngoc-tham/';
    const LINK_DATA_DOJI = 'https://giavang.org/trong-nuoc/doji/';
    const LINK_DATA_SJC = 'https://giavang.org/trong-nuoc/sjc/';
    const LINK_DATA_THEGIOI = 'https://giavang.org/the-gioi/';
    const NUMBER_OF_TYPE_GOLD_NGOCTHAM = 5;
    const NUMBER_OF_TYPE_GOLD_DOJI = 6;
    const NUMBER_OF_TYPE_GOLD_SJC = 12;

    public function index(){
        $AUTO_UPDATE_GOLD_PRICE = Setting::where('name', 'AUTO_UPDATE_GOLD_PRICE')->pluck('value')->first();
        if($AUTO_UPDATE_GOLD_PRICE !== '1'){
            return response()->json([
                'success' => false,
                'alert' => 'AUTO_UPDATE_GOLD_PRICE đã bị tắt',
            ]);
        }
        try {
            $this->autoGetDataTheGioi();
            $this->autoGetDataNgocTham();
            $this->autoGetDataDoji();
            $this->autoGetDataSJC();
            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            Notification::create(['text' => 'Lỗi tự động crawl giá vàng vào lúc '.date('d/m/Y H:i:s').'. <br>'.$th]);
            return response()->json([
                'success' => false,
                'alert' => 'Lỗi, xem lại thông báo',
            ]);
        }
    }

    private function getDomHtml($url){
        // Disable SSL verification
        $response = Http::withOptions(['verify' => false])->get($url);

        AutoBot::create([
            'url' => $url,
            'request' => '',
            'status_response' => $response->status(),
            'response' => '',
        ]);

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $response->body());
        libxml_clear_errors();

        return $dom;
    }

    private function checkGotData($companies_id, $minute=10){
        // $typeGoldId = TypeGold::where('companies_id', $companies_id)->pluck('id')->first();
        // $lastPrice = Price::where('type', $typeGoldId)->latest('published_at')->first();
        // return $lastPrice && abs(now()->diffInMinutes($lastPrice->published_at)) < ($minute+self::GUESS_WORK_DONE_MINUTE);
        return false; 
    }

    private function PriceInputVND($priceText, $multiple=1){
        return (integer)str_replace(".", "", $priceText) * $multiple;
    }

    private function PriceInputUSD($priceText, $multiple=1){
        return (double)str_replace(",", "", $priceText) * $multiple;
    }
    
    private function autoGetDataNgocTham(){
        $companies_id = Company::where('name', 'like', '%Ngọc Thẩm%')->pluck('id')->first();
        if($this->checkGotData($companies_id, self::GET_EVERY_MINUTE)){
            Notification::create(['text' => 'Vàng Ngọc Thẩm đã được cập nhật trong phạm vi '.self::GET_EVERY_MINUTE.' phút gần đây']);
            return false;
        }
        $data_link = self::LINK_DATA_NGOCTHAM;
        $typeGoldIds = TypeGold::where('companies_id', $companies_id)->pluck('id')->toArray();
        $typeGoldCount = 0;
        $dom = $this->getDomHtml($data_link);
        $tables = $dom->getElementsByTagName('table');
        $rowCount = 0;
        if(empty($tables)){Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);return;}
        foreach ($tables as $table) {
            if ($table !== $tables->item(0)) break;
            $trs = $table->getElementsByTagName('tr');
            if(empty($trs)){Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);return;}
            if ($trs->length > 1) {
                for ($i = 1; $i < $trs->length; $i++) { // bỏ qua tr đầu tiên : dòng tiêu đề
                    if ($rowCount >= self::NUMBER_OF_TYPE_GOLD_NGOCTHAM) {
                        break 2; // Thoát cả hai vòng lặp
                    }
                    // <tr>
                    // <th>Vàng miếng SJC</th>
                    // <td class="text-right">117.500</td>
                    // <td class="text-right">120.000</td>
                    // </tr>
                    $tr = $trs->item($i);
                    $ths = $tr->getElementsByTagName('th');
                    if ($ths->length == 1) {
                        $type_gold_name_vn_th = trim($ths->item(0)->textContent);
                        $type_gold_name_vn = TypeGold::where('id', $typeGoldIds[$typeGoldCount])->value('name_vn');
                        if($type_gold_name_vn_th != $type_gold_name_vn){
                            Notification::create(['text' => $data_link.' có thay đổi về loại vàng']);
                            break 2;
                        }
                    }else{
                        Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);
                        break 2;
                    }
                    $tds = $tr->getElementsByTagName('td');
                    if ($tds->length == 2) {
                        $price_in = $this->PriceInputVND($tds->item(0)->textContent, 100);
                        $price_out = $this->PriceInputVND($tds->item(1)->textContent, 100);
                        $data_price = [];
                        $data_price['price_in'] = $price_in;
                        $data_price['price_out'] = $price_out;
                        $data_price['type'] = $typeGoldIds[$typeGoldCount++]; // trong nước
                        $data_price['url'] =  $data_link;
                        $data_price['published_at'] = date('Y-m-d H:i:s');
                        Price::create($data_price);
                    }else{
                        Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);
                        break 2;
                    }
                    $rowCount++;
                }
            }
        }
    }

    private function autoGetDataDoji(){
        $companies_id = Company::where('name', 'like', '%DOJI%')->pluck('id')->first();
        if($this->checkGotData($companies_id, self::GET_EVERY_MINUTE)){
            Notification::create(['text' => 'Vàng DOJI đã được cập nhật trong phạm vi '.self::GET_EVERY_MINUTE.' phút gần đây']);
            return false;
        }
        $data_link = self::LINK_DATA_DOJI;
        $typeGoldIds = TypeGold::where('companies_id', $companies_id)->pluck('id')->toArray();
        $typeGoldCount = 0;
        $dom = $this->getDomHtml($data_link);
        $tables = $dom->getElementsByTagName('table');
        $rowCount = 0;
        if(empty($tables)){Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);return;}
        foreach ($tables as $table) {
            if ($table !== $tables->item(0)) break;
            $trs = $table->getElementsByTagName('tr');
            if(empty($trs)){Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);return;}
            if ($trs->length > 1) {
                for ($i = 1; $i < $trs->length; $i++) { // bỏ qua tr đầu tiên : dòng tiêu đề
                    if ($rowCount >= self::NUMBER_OF_TYPE_GOLD_DOJI) {
                        break 2; // Thoát cả hai vòng lặp
                    }
                    // <tr>
                    //     <th rowspan="6">Hà Nội</th>
                    //     <td>SJC Lẻ</td>
                    //     <td class="text-right">118.000</td>
                    //     <td class="text-right">120.000</td>
                    // </tr>
                    $tr = $trs->item($i);
                    $tds = $tr->getElementsByTagName('td');
                    if ($tds->length == 3) {
                        $type_gold_name_vn_th = trim($tds->item(0)->textContent);
                        $type_gold_name_vn = TypeGold::where('id', $typeGoldIds[$typeGoldCount])->value('name_vn');
                        if($type_gold_name_vn_th != $type_gold_name_vn){
                            Notification::create(['text' => $data_link.' có thay đổi về loại vàng']);
                            break 2;
                        }
                        $price_in = $this->PriceInputVND($tds->item(1)->textContent, 100);
                        $price_out = $this->PriceInputVND($tds->item(2)->textContent, 100);
                        $data_price = [];
                        $data_price['price_in'] = $price_in;
                        $data_price['price_out'] = $price_out;
                        $data_price['type'] = $typeGoldIds[$typeGoldCount++]; // trong nước
                        $data_price['url'] =  $data_link;
                        $data_price['published_at'] = date('Y-m-d H:i:s');
                        Price::create($data_price);
                    }else{
                        Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);
                        break 2;
                    }
                    $rowCount++;
                }
            }
        }
    }

    private function autoGetDataSJC(){
        $companies_id = Company::where('name', 'like', '%SJC%')->pluck('id')->first();
        if($this->checkGotData($companies_id, self::GET_EVERY_MINUTE)){
            Notification::create(['text' => 'Vàng SJC đã được cập nhật trong phạm vi '.self::GET_EVERY_MINUTE.' phút gần đây']);
            return false;
        }
        $data_link = self::LINK_DATA_SJC;
        $typeGoldIds = TypeGold::where('companies_id', $companies_id)->pluck('id')->toArray();
        $typeGoldCount = 0;
        $dom = $this->getDomHtml($data_link);
        $tables = $dom->getElementsByTagName('table');
        $rowCount = 0;
        if(empty($tables)){Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);return;}
        foreach ($tables as $table) {
            if ($table !== $tables->item(0)) break;
            $trs = $table->getElementsByTagName('tr');
            if(empty($trs)){Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);return;}
            if ($trs->length > 1) {
                for ($i = 1; $i < $trs->length; $i++) { // bỏ qua tr đầu tiên : dòng tiêu đề
                    if ($rowCount >= self::NUMBER_OF_TYPE_GOLD_SJC) {
                        break 2; // Thoát cả hai vòng lặp
                    }
                    // <tr>
                    // <th rowspan="12">Hồ Chí Minh</th>
                    // <td>Vàng SJC 1L, 10L, 1KG</td>
                    // <td class="text-right">118.500</td>
                    // <td class="text-right">120.500</td>
                    // </tr>
                    $tr = $trs->item($i);
                    $tds = $tr->getElementsByTagName('td');
                    if ($tds->length == 3) {
                        $type_gold_name_vn_th = trim($tds->item(0)->textContent);
                        $type_gold_name_vn = TypeGold::where('id', $typeGoldIds[$typeGoldCount])->value('name_vn');
                        if($type_gold_name_vn_th != $type_gold_name_vn){
                            Notification::create(['text' => $data_link.' có thay đổi về loại vàng']);
                            break 2;
                        }
                        $price_in = $this->PriceInputVND($tds->item(1)->textContent, 100);
                        $price_out = $this->PriceInputVND($tds->item(2)->textContent, 100);
                        $data_price = [];
                        $data_price['price_in'] = $price_in;
                        $data_price['price_out'] = $price_out;
                        $data_price['type'] = $typeGoldIds[$typeGoldCount++]; // trong nước
                        $data_price['url'] =  $data_link;
                        $data_price['published_at'] = date('Y-m-d H:i:s');
                        Price::create($data_price);
                    }else{
                        Notification::create(['text' => $data_link.' có thay đổi về table tr th td']);
                        break 2;
                    }
                    $rowCount++;
                }
            }
        }
    }

    private function autoGetDataTheGioi(){
        $companies_id = Company::where('name', 'like', '%Thế giới%')->pluck('id')->first();
        if($this->checkGotData($companies_id, self::GET_EVERY_MINUTE)){
            Notification::create(['text' => 'Vàng thế giới đã được cập nhật trong phạm vi '.self::GET_EVERY_MINUTE.' phút gần đây']);
            return false;
        }
        $data_link = self::LINK_DATA_THEGIOI;
        // Giá vàng thế giới chỉ có 1 type gold
        $typeGoldId = TypeGold::where('companies_id', $companies_id)->pluck('id')->first();
        $dom = $this->getDomHtml($data_link);
        // Lấy tất cả các span có class "crypto-price"
        $spans = $dom->getElementsByTagName('span');
        $priceUSD = [];
        foreach ($spans as $span) {
            if ($span->hasAttribute('class') && strpos($span->getAttribute('class'), 'crypto-price') !== false) {
            $priceUSD[] = trim($span->textContent);
            }
        }
        if (empty($priceUSD)) {
            Notification::create(['text' => $data_link.' không tìm thấy span class crypto-price']);
            return;
        }
        $priceUSD = $this->PriceInputUSD($priceUSD[0]);
        Price::create([
            'price_in' => 0, // giá vàng thế giới chỉ có 1 giá
            'price_out' => $priceUSD,
            'type' => $typeGoldId,
            'url' => $data_link,
            'published_at' => date('Y-m-d H:i:s'),
        ]);

    }
}