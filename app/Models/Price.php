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
    ];

    public function typeGold()
    {
        return $this->belongsTo(TypeGold::class, 'type');
    }
}
