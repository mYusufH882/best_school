<?php

namespace Modules\School\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stancl\Tenancy\Tenant;

class EnsureTenantExists
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!tenancy()->initialized) {
            abort(404, 'Tenant not found');
        }

        return $next($request);
    }
}
