<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeGold extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'type_gold';

    protected $fillable = [
        'companies_id',
        'name_vn',
        'name_en',
        'note',
        'type',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'companies_id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'type');
    }
}
