<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ApprovedUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }

        if(!Auth::user()->is_approved)
        {
            Auth::logout();

            return redirect('/login')
                ->with(
                    'error',
                    'Your account is pending admin approval.'
                );
        }

        return $next($request);
    }
}