<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->is_admin) {
            // Return JSON for API/AJAX requests
            if ($request->expectsJson() || $request->is('api/*') || $request->is('admin/api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Accès non autorisé. Droits administrateur requis.'
                ], 403);
            }

            // Redirect to login for web requests
            return redirect()->route('login')->with('error', 'Accès non autorisé. Droits administrateur requis.');
        }

        return $next($request);
    }
}
