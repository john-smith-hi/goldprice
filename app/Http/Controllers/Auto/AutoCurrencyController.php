<?php
namespace App\Http\Controllers\Auto;

use App\Models\AutoBot;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\Notification;

class AutoCurrencyController
{
    const GET_EVERY_MINUTE = 30;
    const LINK_DATA_CURRENCY = 'https://wise.com/rates/history+live?source=USD&target=VND&length=30&resolution=hourly&unit=day';
    const list_currency = 'USD, VND';
    public function  index(){
        $AUTO_UPDATE_GOLD_CURRENCY = Setting::where('name', 'AUTO_UPDATE_GOLD_CURRENCY')->pluck('value')->first();
        if($AUTO_UPDATE_GOLD_CURRENCY !== '1'){
            return response()->json([
                'success' => false,
                'alert' => 'AUTO_UPDATE_GOLD_CURRENCY đã bị tắt',
            ]);
        }
        try {
            $this->autoGetDataCurrency();
            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            Notification::create(['text' => 'Lỗi tự động lấy api quy đổi tiền tệ vào lúc '.date('d/m/Y H:i:s').'. <br>'.$th]);
            return response()->json([
                'success' => false,
                'alert' => 'Lỗi, xem lại thông báo',
            ]);
        }
        
    }

    function getDataJson($url){
        $response = file_get_contents($url);
        AutoBot::create([
            'url' => $url,
            'request' => '',
            'status_response' => '',
            'response' => '',
        ]);
        $data = json_decode($response, true);
        return $data;
    }

    private function checkGotData($minute=10){
        $lastCurrency = Currency::latest('created_at')->first();
        return $lastCurrency && now()->diffInMinutes($lastCurrency->created_at) < $minute;
    }

    function autoGetDataCurrency(){
        if($this->checkGotData(self::GET_EVERY_MINUTE)){
            Notification::create(['text' => 'Đơn vị tiền tệ đã được cập nhật trong phạm vi '.self::GET_EVERY_MINUTE.' phút gần đây']);
            return false;
        }
        $currencies = array_map('trim', explode(',', self::list_currency));
        $pairs = [];
        for ($i = 0; $i < count($currencies); $i++) {
            for ($j = 0; $j < count($currencies); $j++) {
                if ($i !== $j) {
                    $pairs[] = [$currencies[$i], $currencies[$j]];
                }
            }
        }
        foreach ($pairs as $pair) {
            $url = str_replace(
                ["source=USD", "target=VND"],
                ["source={$pair[0]}", "target={$pair[1]}"],
                self::LINK_DATA_CURRENCY
            );
            $data_response_arr = $this->getDataJson($url);
            foreach ($data_response_arr as $currency_response_arr) {
                $currncy_update_arr = [];
                $currncy_update_arr['source'] = $currency_response_arr['source'];
                $currncy_update_arr['target'] = $currency_response_arr['target'];
                $currncy_update_arr['number_target'] = 1;
                $currncy_update_arr['number_target'] = $currency_response_arr['value'];
                $currncy_update_arr['time'] = $currency_response_arr['time'];
                // Chuyển đổi time từ milliseconds sang datetime
                $currncy_update_arr['datetime'] = \Carbon\Carbon::createFromTimestampMs($currency_response_arr['time'])->toDateTimeString();
                // Kiểm tra nếu đã tồn tại thì update, ngược lại thì thêm mới
                $existing = Currency::where('source', $currncy_update_arr['source'])
                    ->where('target', $currncy_update_arr['target'])
                    ->where('time', $currncy_update_arr['time'])
                    ->first();

                if ($existing) {
                    $existing->update($currncy_update_arr);
                } else {
                    Currency::create($currncy_update_arr);
                }
            }
        }
    }
}