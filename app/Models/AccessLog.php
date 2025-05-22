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

    public static function saveRequest()
    {
        $request = request();
        $exists = self::where('ip_address', $request->ip())
            ->where('user_agent', $request->header('User-Agent'))
            ->where('device', $request->header('Sec-CH-UA-Platform') ?? '')
            ->where('created_at', '>=', now()->subMinutes(10))
            ->exists();

        if (!$exists) {
            self::create([
            'ip_address'   => $request->ip(),
            'user_agent'   => $request->header('User-Agent'),
            'device'       => $request->header('Sec-CH-UA-Platform') ?? '',
            'resolution'   => $request->header('X-Resolution') ?? '',
            'language'     => $request->header('Accept-Language'),
            'url'          => $request->fullUrl(),
            'accessed_at'  => now(),
            ]);
        }
    }
}
