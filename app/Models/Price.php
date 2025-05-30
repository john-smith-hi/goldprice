<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeGold;

class Price extends Model
{
    /** @use HasFactory<\Database\Factories\PriceFactory> */
    use HasFactory;

    protected $table = 'prices';
    const OUNCE_TO_LUONG_VANG = 0.829426027;

    protected $fillable = [
        'price_in',
        'price_out',
        'type', // type_gold.id
        'url',
        'published_at',
    ];

    public function typeGold()
    {
        return $this->belongsTo(TypeGold::class, 'type');
    }

    private function USDoz_to_VNDchi($priceUSDoz){
        $latestCurrency = (new Currency())->Lastest();
        $number_target = is_object($latestCurrency) ? $latestCurrency->number_target : $latestCurrency;
        return $priceUSDoz/self::OUNCE_TO_LUONG_VANG/10*$number_target;
    }

    private function AddPriceWorld($sampled){
        // Duyệt qua mỗi dòng của $sampled và thêm 'price_world'
        $sampled = $sampled->map(function ($item) {
            $type_gold = Setting::where('name','MAIN_TYPE_GOLD_WORLD_ID')->pluck('value')->first();
            $nearby = self::where('type', $type_gold)
                ->where('published_at', '<=', $item->published_at)
                // ->where('published_at', '>=', \Carbon\Carbon::parse($item->published_at)->subHour())
                ->orderBy('published_at', 'desc')
                ->limit(1)
                ->first();
            if ($nearby) {
                $item->price_world = ceil($this->USDoz_to_VNDchi($nearby->price_out));
            } else {
                $item->price_world = null;
            }
            return $item;
        });
        return $sampled;
    }

    public function getGoldPrice($time_filter, $type=0, $from_date = null, $to_date = null)
    {
        if(empty($type) || $type===0) $type = Setting::where('name', 'MAIN_SJC_TYPE_GOLD_VN_ID')->pluck('value')->first();
        $query = self::select('price_in', 'price_out', 'type', 'published_at')->where('type', $type);
        if ($time_filter == "custom" && (empty($from_date) || empty($to_date))) {
            $time_filter = "day";
        }
        $take = 10;
        switch ($time_filter) {
            case 'lastest':
                $take = 1;
                $query = $query->orderByDesc('published_at')->limit(1);
                break;
            case 'day':
                $take = 10;
                $query->whereDate('published_at', now()->toDateString());
                break;
            case 'week':
                $take = 14;
                $query->whereBetween('published_at', [
                    now()->startOfWeek()->startOfDay(),
                    now()->endOfWeek()->endOfDay()
                ]);
                break;
            case 'month':
                $take = 14;
                $query->whereBetween('published_at', [
                    now()->startOfMonth()->startOfDay(),
                    now()->endOfMonth()->endOfDay()
                ]);
                break;
            case 'quarter':
                $take = 15;
                $query->whereBetween('published_at', [
                    now()->startOfQuarter()->startOfDay(),
                    now()->endOfQuarter()->endOfDay()
                ]);
                break;
            case 'year':
                $take = 20;
                $query->whereBetween('published_at', [
                    now()->startOfYear()->startOfDay(),
                    now()->endOfYear()->endOfDay()
                ]);
                break;
            case 'custom':
                $take = 15;
                if ($from_date && $to_date) {
                    $from = \DateTime::createFromFormat('d/m/Y', $from_date)?->format('Y-m-d 00:00:00');
                    $to = \DateTime::createFromFormat('d/m/Y', $to_date)?->format('Y-m-d 23:59:59');
                    $query->whereBetween('published_at', [$from, $to]);
                }
                break;
        }
        $data = $query->orderBy('published_at', 'asc')->get();

        $sampled = collect();
        $count = $data->count();

        if ($count > $take) {
            $step = floor($count / $take);
            for ($i = 0; $i < $take; $i++) {
                $sampled->push($data[$i * $step]);
            }
        } else {
            $sampled = $data; // ít hơn 10 thì lấy tất
        }

        return ($time_filter != "time_filter") ? $this->AddPriceWorld($sampled) : $sampled;
    }
}
