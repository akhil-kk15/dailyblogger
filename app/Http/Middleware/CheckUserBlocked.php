<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and blocked
        if (Auth::check() && Auth::user()->isBlocked()) {
            // Allow admins to access admin panel to manage users (they shouldn't be blocked anyway)
            if (Auth::user()->isAdmin() && $request->is('admin/*')) {
                return $next($request);
            }
            
            // If it's an AJAX request, return JSON response
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Your account has been blocked. Please contact the administrator.',
                    'blocked' => true
                ], 403);
            }
            
            // For regular requests, redirect to blocked access page (keeping user logged in)
            return redirect()->route('blocked.access');
        }

        return $next($request);
    }
}
