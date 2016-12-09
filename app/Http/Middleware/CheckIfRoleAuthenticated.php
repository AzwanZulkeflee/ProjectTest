<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfRoleAuthenticated
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
        $roles = $this->getRequiredRoleForRoute($request->route());

        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        if($request->user()->hasRole($roles) || !$roles)
        {
            return $next($request);
        }
        return redirect()->guest('/');
    }

    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
            // dd($actions);
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
