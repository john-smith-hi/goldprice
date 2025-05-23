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
                $take = 12;
                $query->whereBetween('published_at', [
                    now()->startOfWeek()->startOfDay(),
                    now()->endOfWeek()->endOfDay()
                ]);
                break;
            case 'month':
                $take = 12;
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

        return $sampled;
    }
}
