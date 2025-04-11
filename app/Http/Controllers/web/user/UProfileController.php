<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\ImageController;
use App\Http\Controllers\services\UserController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UProfileController extends Controller
{
    protected $userController;
    protected $imageController;

    public function __construct()
    {
        $this->userController = new UserController();
        $this->imageController = new ImageController();
    }

    public function profile()
    {
        $member = request()->session()->get("member");
        $this->viewData['member'] = $member;
        return view("user/profile/profile")->with($this->viewData);
    }
    public function changeProfile()
    {
        $member = request()->session()->get("member");
        $this->viewData['member'] = $member;
        return view("user/profile/change_profile")->with($this->viewData);
    }
    public function changePassword()
    {
        $member = request()->session()->get("member");
        $this->viewData['member'] = $member;
        return view("user/profile/change_password")->with($this->viewData);
    }

    public function updateProfile(Request $req)
    {
        try {
            $result = $this->userController->updateUser($req);
            $member = $result['data'];
            $member->user->token = request()->session()->get("member")->user->token;
            request()->session()->put('member', $member);
            return 1;
        } catch (Exception $ex) {
            print($ex);
            return -1;
        }
    }

    public function updatePassword(Request $req)
    {
        try {
            $confirmPassword = $this->userController->getUserByUserNameAndPassword(new Request([
                'username' => $req->username,
                'password' => $req->confirmPassword
            ]));
            if (!is_null($confirmPassword['data'])) {
                $this->userController->changePassword(new Request([
                    'username' => $req->username,
                    'password' => $req->newPassword
                ]));
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            print($ex);
            return -1;
        }
    }

    public function changeAvatar(Request $req)
    {
        if ($file = $req->file('image')) {
            $allowedfileExtension = ['jpg', 'png']; //extension file allowed
            $extension = $file->getClientOriginalExtension(); //get extension
            if (in_array($extension, $allowedfileExtension)) { //check extension
                $member = request()->session()->get("member");
                $req['member_id'] = $member->member_id;
                $response = $this->imageController->addFileImage($req); //Update image to server
                if ($response['data'] == true) {
                    $image = $req->member_id . "." . $extension;
                    if ($member->user->image == "member.png") {
                        //If first change avatar => update field image into DB
                        $status = 4;
                    } else {
                        //ELse just update activity history not update field image 
                        $status = -1;
                    }
                    return $this->updateProfile(new Request([
                        'image' => $image,
                        'is_checked' => $status,
                        'username' => $member->user->username
                    ]));
                } else {
                    return 0;
                }
            } else {
                return -1;
            }
        }
    }
}