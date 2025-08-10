<?php

namespace Botble\Base\Http\Middleware;

use Botble\Base\Supports\Core;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureLicenseHasBeenActivated
{
    public function __construct(private Core $core)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $whitelistRoutes = [
            'unlicensed',
            'unlicensed.skip',
            'settings.license.activate',
        ];

        if ($request->routeIs($whitelistRoutes)) {
            return redirect()->route('dashboard.index');
        }

        return $next($request);
    }
}
