<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::guard('user')->check()) {
            return redirect()->route('login');
        }
        $adminUser = Auth::guard('user')->user();
        if (!in_array($adminUser->role, $roles)) {
            return redirect()->route('logout');
        }
        return $next($request);
    }
}
