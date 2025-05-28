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
        $apiKey = $request->input('fkey');
        $secretKey = env('SECRET_KEY');

        if (!$apiKey || $apiKey !== $secretKey) {
            abort(404);
        }

        return $next($request);
    }
} 