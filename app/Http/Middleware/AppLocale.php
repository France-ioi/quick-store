<?php

namespace App\Http\Middleware;

use Closure;
use App;

class AppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->session()->get('locale');
        if(!$locale) {
            $locale = config('app.locale');
        }
        App::setLocale($locale);
        return $next($request);
    }
}
