<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        if (session('level') === 'cashier') {
          
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
