<?php

namespace App\Http\Middleware;

use App\Http\Controllers\services\MemberController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasRoleUser
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
        $member = request()->session()->get('member');
        if (!is_null($member)) {
            if ($member->user->role->role_id == "MB") {
                return $next($request);
            } else {
                request()->forget('member');
                return redirect(route('user/login'))->withErrors(["errorUserLogin" => "Quyền không hợp lệ"]);
            }
        }

        return redirect(route('user/login'))->withErrors(['errorUserLogin' => 'Vui lòng đăng nhập tài khoản']);
    }
}