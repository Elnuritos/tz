<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheResponseMiddleware
{
    public function handle(Request $request, Closure $next, $ttl = 60)
    {
        $key = 'response_cache_' . $request->fullUrl();

        if (Cache::has($key)) {
            return response(Cache::get($key));
        }

        $response = $next($request);
        Cache::put($key, $response->getContent(), $ttl);

        return $response;
    }
}
