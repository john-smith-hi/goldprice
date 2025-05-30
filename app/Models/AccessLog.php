<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessLog extends Model
{
    /** @use HasFactory<\Database\Factories\AccessLogFactory> */
    use HasFactory, SoftDeletes;

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

    protected $casts = [
        'accessed_at' => 'datetime',
    ];

    private static function ip_in_range($ip, $cidr) {
        list($subnet, $mask) = explode('/', $cidr);
        $ip_decimal = ip2long($ip);
        $subnet_decimal = ip2long($subnet);
        $mask_decimal = ~((1 << (32 - $mask)) - 1);
        return ($ip_decimal & $mask_decimal) === ($subnet_decimal & $mask_decimal);
    }

    public static function saveRequest()
    {
        $request = request();

        $cfCidrs = [
            '173.245.48.0/20', '103.21.244.0/22', '103.22.200.0/22', '103.31.4.0/22',
            '141.101.64.0/18', '108.162.192.0/18', '190.93.240.0/20', '188.114.96.0/20',
            '197.234.240.0/22', '198.41.128.0/17', '162.158.0.0/15', '104.16.0.0/13',
            '104.24.0.0/14', '172.64.0.0/13', '131.0.72.0/22'
        ];

        $remoteIp = $request->ip();
        $isCloudflare = false;

        foreach ($cfCidrs as $cidr) {
            if (self::ip_in_range($remoteIp, $cidr)) {
                $isCloudflare = true;
                break;
            }
        }

        if ($isCloudflare) {
            $ip = $request->header('CF-Connecting-IP') ?? $request->header('X-Forwarded-For') ?? $remoteIp;
            if (strpos($ip, ',') !== false) {
                $ip = trim(explode(',', $ip)[0]);
            }
        } else {
            $ip = $remoteIp;
        }

        $exists = self::where('ip_address', $ip)
            ->where('user_agent', $request->header('User-Agent'))
            ->where('device', $request->header('Sec-CH-UA-Platform') ?? '')
            ->where('created_at', '>=', now()->subMinutes(10))
            ->exists();

        if (!$exists) {
            self::create([
            'ip_address'   => $ip,
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
