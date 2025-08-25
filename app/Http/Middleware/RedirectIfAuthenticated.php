<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'office':
                if (Auth::guard('office')->check()) {
                    return redirect()->route('officeNewsIndex');
                }
                break;

            default:
                // code...
                break;
        }

        return $next($request);
    }
}
