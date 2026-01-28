<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return $this->unauthorized($request, 'Vous devez être connecté.');
        }

        // Super admin bypasses all role checks
        if ($request->user()->isSuperAdmin()) {
            return $next($request);
        }

        if (!$request->user()->hasAnyRole($roles)) {
            return $this->unauthorized($request, 'Vous n\'avez pas le rôle requis pour accéder à cette ressource.');
        }

        return $next($request);
    }

    /**
     * Return unauthorized response
     */
    protected function unauthorized(Request $request, string $message): Response
    {
        if ($request->expectsJson() || $request->is('api/*') || $request->is('admin/api/*')) {
            return response()->json([
                'success' => false,
                'message' => $message
            ], 403);
        }

        return redirect()->route('login')->with('error', $message);
    }
}
