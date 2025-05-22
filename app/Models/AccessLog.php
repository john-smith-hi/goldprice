<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    /** @use HasFactory<\Database\Factories\AccessLogFactory> */
    use HasFactory;

    protected $table = 'access_logs';

    protected $fillable = [
        'ip_address',
        'user_agent',
        'device',
        'resolution',
        'language',
        'url',
        'accessed_at',
    ];
}
