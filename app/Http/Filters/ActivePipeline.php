<?php


namespace App\Http\Filters;

use Closure;

class ActivePipeline
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('status')) {
            return $next($request);
        }

        return $next($request)->where('status', request()->status);
    }
}
