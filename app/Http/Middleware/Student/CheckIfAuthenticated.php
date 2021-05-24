<?php

namespace App\Http\Middleware\Student;

use Closure;
use Illuminate\Http\Request;

class CheckIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth('student')->check()) {
            return redirect('/student/login');
        }
        return $next($request);
    }
}
