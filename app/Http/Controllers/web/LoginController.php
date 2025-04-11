<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\UserController;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $userController;
    public function __construct()
    {
        $this->userController = new UserController();
    }

    public function getLogin()
    {
        $admin = $this->getAdminCurrent();
        if (!is_null($admin)) {
            return redirect()->route('index');
        } else {
            return view('login/login');
        }
    }

    public function postLogin(UserRequest $request)
    {
        $user_response = $this->userController->getUserByUserNameAndPassword($request);
        if (!is_null($user_response['data'])) {
            if ($user_response['data']->role->role_id == "AD") {
                $request->session()->put('admin', $user_response['data']);
                return redirect()->intended('admin/');
            } else {
                return back()->withErrors([
                    'error' => 'Quyền không hợp lệ!',
                ]);
            }
        }
        return back()->withErrors([
            'error' => 'Tài khoản hoặc mật khẩu không hợp lệ',
        ]);
    }

    public function logout(Request $request)
    {
        $admin = $this->getAdminCurrent();
        $this->userController->invalidateToken(new Request(['token' => $admin->token]));
        if (!is_null($admin)) {
            $request->session()->forget('admin');
        }
        return redirect()->route('login');
    }

    private function getAdminCurrent()
    {
        return request()->session()->get('admin');
    }
}