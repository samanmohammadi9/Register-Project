<?php

namespace App\Http\Middleware\Teacher;

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
        if (!auth('teacher')->check()) {
            return redirect('/teacher/login');
        }
        return $next($request);
    }
}
