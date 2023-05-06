<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permit = null)
    {
        if (!$request->user()->hasRole($role)) {

            abort(404);
        }

        if ($permit !== null && !$request->user()->can($permit)) {

            abort(404);
        }

        return $next($request);
    }
}
