<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next, $allowedRoles) {
        if (!Auth::check()) {
            return redirect('/login'); // Redirect pengguna yang belum login
        }

        $user = Auth::user();
        $allowedRoles = explode(',', $allowedRoles);

        if (in_array($user->role, $allowedRoles)) {
            return $next($request);
        }

        return redirect('/home');
    }
}
