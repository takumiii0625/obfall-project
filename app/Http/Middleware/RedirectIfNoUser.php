<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RedirectIfNoUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch (true) {
            case preg_match('/office/', $request->getHost()):
                /*
                    新規登録した管理者 : created_at IS NOT NULL
                    有効中の管理者 : activated_at IS NOT NULL
                    退職済みの管理者 : terminated_at IS NOT NULL
                    削除済みの管理者 : deleted_at IS NOT NULL
                    ログイン後のページにアクセスできるのは[有効中]の管理者のみ
                */
                $admin = DB::table('admins')
                    ->where('id', Auth::guard($guard)->id())
                    ->whereNotNull('activated_at')
                    ->whereNull('terminated_at')
                    ->whereNull('deleted_at')
                    ->first();
                if (! $admin) {
                    Auth::guard($guard)->logout();
                    $request->session()->flush();

                    return redirect()->route('officeLoginInput');
                }
                break;

            default:
                break;
        }

        return $next($request);
    }
}
