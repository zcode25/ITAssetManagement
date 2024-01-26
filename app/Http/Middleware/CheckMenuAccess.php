<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $menuKey)
    {
        $jsonData = auth()->user()->permission;
        $menuData = json_decode($jsonData, true);

        if (isset($menuData[$menuKey]['index']) && $menuData[$menuKey]['index'] === false) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
