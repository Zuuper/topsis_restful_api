<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WarungMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->tokenCan('role:warung')){
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'Not Authorized'
        ],401);
    }
}
