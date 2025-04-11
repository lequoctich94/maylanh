<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\services\UserController;

class URegisterController extends Controller
{
    public function getRegister()
    {
        return view('user/register/register');
    }
    public function postRegister(Request $req)
    {
        $userController = new UserController();
        $result = $userController->saveUser($req);
        if ($result == null) {
            return back()->withErrors('error', 'Tạo thất bại');
        }
        return redirect(route('user/login'));
    }
}
