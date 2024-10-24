<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            Toastr::error('You need to be logged in to access this page');
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        // Ensure the user is an admin
        if (auth()->user()->role_name !== 'admin') {
            auth()->logout();
            Toastr::error('You do not have access to this page');
            return redirect()->route('login');
        }

        // Ensure the user account is active
        if (auth()->user()->status !== 'active') {
            auth()->logout();
            Toastr::error('Your account is inactive');
            return redirect()->route('login');
        }

        // Proceed with the request
        return $next($request);
    }
}
