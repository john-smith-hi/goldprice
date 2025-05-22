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
        'price',
        'type',
        'url',
        'published_at',
    ];

    public function typeGold()
    {
        return $this->belongsTo(TypeGold::class, 'type');
    }

    public function getGoldPrice($type, $time_filter, $from_date = null, $to_date = null)
    {
        $query = self::select('price', 'type', 'published_at')->where('type', $type);
        if ($time_filter == "custom" && (empty($from_date) || empty($to_date))) {
            $time_filter = "day";
        }
        switch ($time_filter) {
            case 'day':
                $query->whereDate('published_at', now()->toDateString());
                break;
            case 'week':
                $query->whereBetween('published_at', [
                    now()->startOfWeek()->startOfDay(),
                    now()->endOfWeek()->endOfDay()
                ]);
                break;
            case 'month':
                $query->whereBetween('published_at', [
                    now()->startOfMonth()->startOfDay(),
                    now()->endOfMonth()->endOfDay()
                ]);
                break;
            case 'quarter':
                $query->whereBetween('published_at', [
                    now()->startOfQuarter()->startOfDay(),
                    now()->endOfQuarter()->endOfDay()
                ]);
                break;
            case 'year':
                $query->whereBetween('published_at', [
                    now()->startOfYear()->startOfDay(),
                    now()->endOfYear()->endOfDay()
                ]);
                break;
            case 'custom':
                if ($from_date && $to_date) {
                    $from = \DateTime::createFromFormat('d/m/Y', $from_date)?->format('Y-m-d 00:00:00');
                    $to = \DateTime::createFromFormat('d/m/Y', $to_date)?->format('Y-m-d 23:59:59');
                    $query->whereBetween('published_at', [$from, $to]);
                }
                break;
        }
        return $query->get();
    }
}
