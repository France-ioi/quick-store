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
        $prefix = $request->get('prefix');        
        if($prefix) {
            $limits_key = array_search($prefix, config('data_access_limit.special.prefixes')) === false ? 'common' : 'special';
            $limit = config('data_access_limit')[$limits_key];
            if($this->limiter->tooManyAttempts($prefix, $limit['quantity'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many requests'
                ]);
            }
            $this->limiter->hit($prefix, $limit['interval']);
        }
        return $next($request);
    }
}
