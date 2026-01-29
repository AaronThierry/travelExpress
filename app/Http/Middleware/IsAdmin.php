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
        $user = $request->user();

        // Check: user must be logged in AND have admin access
        // Admin access = is_admin flag (legacy) OR has dashboard-view permission (RBAC)
        $hasAccess = $user && ($user->is_admin || $user->hasPermission('dashboard-view'));

        if (!$hasAccess) {
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
