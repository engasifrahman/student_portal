<?php

namespace App\Http\Middleware;

use Closure;

class FacultyMemberAuth
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
        if (session()->has('faculty_member')) 
        {
            return $next($request);
        }
        else
        {
            return redirect('/login');
        }
    }
}
