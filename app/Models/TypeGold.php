<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeGold extends Model
{
    use HasFactory;

    protected $table = 'type_gold';

    protected $fillable = [
        'name_vn',
        'name_en',
    ];

    public function prices()
    {
        return $this->hasMany(Price::class, 'type');
    }
}
