<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Cache\RateLimiter;

class DataAccessMiddleware
{


    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $limit = config('data_access_limit');
        
        if($limit['interval'] && $limit['quantity']) {
            $prefix = $request->get('prefix');
            $this->limiter->hit($prefix, $limit['interval']);
            if($this->limiter->attempts($prefix) > $limit['quantity']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many requests'
                ]);
            }
        }
        return $next($request);
    }
}
