<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\MemberController;
use App\Http\Controllers\services\UserController;
use App\Http\Payload;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class ULoginController extends Controller
{
    protected $memberController;
    protected $userController;
    protected $member;
    public function __construct()
    {
        $this->memberController = new MemberController();
        $this->userController = new UserController();
    }

    public function getLogin()
    {
        $member = $this->getMemberCurrent();
        if (!is_null($member)) {
            return redirect()->route('user/index');
        } else {
            return view('user/login/login');
        }
    }

    public function postLogin(UserRequest $request)
    {
        //Check member login and save activity -> just only Role Member
        $member_response = $this->userController->getUserByUserNameAndPassword($request);
        if (!is_null($member_response['data'])) {
            if ($member_response['data']->user->role->role_id == "MB") {
                $request->session()->put('member', $member_response['data']);
                return redirect()->intended('/');
            }
        }
        return back()->withErrors([
            'errorUserLogin' => 'Tài khoản hoặc mật khẩu không hợp lệ',
        ]);
    }

    public function logout(Request $request)
    {
        $member = $this->getMemberCurrent();
        $this->userController->invalidateToken(new Request(['token' => $member->user->token]));
        if (!is_null($member)) {
            $request->session()->forget('member');
            $request->session()->flush();
        }

        return redirect()->route('user/login');
    }

    private function getMemberCurrent()
    {
        return request()->session()->get('member');
    }
}