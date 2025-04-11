<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = request()->session()->get('admin');
        if (!is_null($admin)) {
            if ($admin->role->role_id != "AD") {
                request()->forget('admin');
                return redirect(route('login'))->withErrors(["errorAdminLogin" => "Quyền không hợp lệ"]);
            } else {
                return $next($request);
            }
        } else {
            return redirect(route('login'))->withErrors(["errorAdminLogin" => "Vui lòng thực hiện đăng nhập"]);
        }
    }
}