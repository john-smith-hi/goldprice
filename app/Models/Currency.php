<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    /** @use HasFactory<\Database\Factories\CurrencyFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'currencies';

    protected $fillable = [
        'source',
        'target',
        'number_source',
        'number_target',
        'datetime',
        'time',
    ];

    public function Lastest($source="USD", $target="VND"){
        $result = Currency::where('source', $source)
            ->where('target', $target)
            ->orderByDesc('datetime')
            ->limit(1)
            ->get(['number_source', 'number_target'])
            ->first();

        return $result ?? 0;
    }
}
