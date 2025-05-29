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
        $fkey = $request->session()->get('fkey') ?? $request->input('fkey');
        if (!$fkey) {abort(404);}
        $secretKey = env('SECRET_KEY');
        echo $secretKey;
        if ($fkey != $secretKey) {
            abort(403);
        }

        // Store fkey in session before proceeding
        $request->session()->put('fkey', $fkey);
        
        return $next($request);
    }
} 