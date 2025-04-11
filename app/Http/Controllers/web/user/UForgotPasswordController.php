<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\UserController;
use Illuminate\Http\Request;

class UForgotPasswordController extends Controller
{
    protected $userController;

    public function __construct()
    {
        $this->userController = new UserController();
    }
    public function userForgotPassword()
    {
        return view(
            'user/forgot_password/forgot_password',
        );
    }

    public function userResetPassword(Request $req)
    {
        request()->session()->put("username", $req->username);
        return view(
            'user/forgot_password/reset_password',
        );
    }

    public function updatePassword(Request $req)
    {
        $this->userController->changePassword(new Request([
            'username' => request()->session()->get("username"),
            'password' => $req->password
        ]));
        session()->flash('success', 'Cập nhật mật khẩu thành công');
        return redirect()->route("user/login");
    }
}