<?php

namespace App\Http\Middleware;

use Closure;

class User
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
        $roles = $this->getRequiredRoleForRoute();

        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        if($request->user()->hasRole($roles))
        {
            return $next($request);
        }
        //will make global
        return redirect()->guest('/');

    }
    
    private function getRequiredRoleForRoute()
    {
        return ['user'];
    }
}
