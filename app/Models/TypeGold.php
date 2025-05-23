<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeGold extends Model
{
    use HasFactory;

    protected $table = 'type_gold';

    protected $fillable = [
        'companies_id',
        'name_vn',
        'name_en',
        'note',
        'type',
    ];

    public function prices()
    {
        return $this->hasMany(Price::class, 'type');
    }
}
