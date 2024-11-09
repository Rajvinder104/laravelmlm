<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{

    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin/login');
        }
        $adminUser = Auth::guard('admin')->user();
        if (!in_array($adminUser->role, $roles)) {
            return redirect()->route('admin/logout');
        }
        return $next($request);
    }
}
