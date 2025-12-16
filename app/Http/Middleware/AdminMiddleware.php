<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Login required to access the admin panel.');
        }

        
        if (!Auth::user()->is_admin) {
            return redirect('/')
                ->with('error', 'You do not have access to the admin panel. Contact the system administrator.');
        }

        return $next($request);
    }
}
