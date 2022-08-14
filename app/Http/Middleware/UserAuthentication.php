<?php

namespace App\Http\Middleware;

use Closure;

class UserAuthentication
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
        if (session()->has('system_admin') || session()->has('finance_admin') || session()->has('faculty_member') || session()->has('student')) 
        {
            return $next($request);
        }
        else
        {
            return redirect('/login');
        }
    }
}
