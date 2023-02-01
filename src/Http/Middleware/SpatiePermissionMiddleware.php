<?php

namespace Alijumaan\LaravelPermissionEditor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SpatiePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Schema::hasTable('roles') || !Schema::hasTable('permissions')) {
            throw new \Exception('Spatie Laravel Permission package is not configured: missing roles/permissions DB tables');
        }

        return $next($request);
    }
}
