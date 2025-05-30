<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannedIp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'banned_ips';

    protected $fillable = [
        'ip',
        'active',
    ];
}
