<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $fkey = $request->cookie('fkey') ?? $request->input('fkey');
        if (!$fkey) { abort(404); }
        $secretKey = config('services.secret_key');
        if ($fkey != $secretKey) {
            abort(403);
        }

        // Lưu vào cookie nếu chưa có
        if (!$request->cookie('fkey')) {
            cookie()->queue('fkey', $fkey, 525600); // lưu 1 năm (tính theo phút)
        }
        return $next($request);
    }
} 