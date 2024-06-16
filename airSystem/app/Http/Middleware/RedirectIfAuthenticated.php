<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($request->path() === 'register' && !Auth::guard($guard)->check()) {
                    $user = Auth::guard($guard)->user();
                    if ($user && $user->hasRole('admin')) {
                        return $next($request);
                    } else {
                        return response()->json(['message' => 'Access denied'], 403);
                }
            }
        }
//        $routeName = $request->path();
//        if ($routeName !== null) {
//            error_log('Current route: ' . $routeName);
//        } else {
//            error_log('Current route is not named');
//        }
        return $next($request);
    }
}
