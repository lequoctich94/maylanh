<?php

namespace App\Http\Controllers\services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\services\MemberController;
use App\Http\Controllers\services\CodeResetController;
use App\Models\User;
use App\Models\Member;
use App\Http\Payload;
use App\Http\Resources\UserResource;
use App\Http\Resources\MemberResource;
use App\Http\Controllers\services\ActivityHistoryController;
use Carbon\Carbon;
use App\Mail\SendMail;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    // protected $memberController;
    // public function __construct(MemberController $memberController)
    // {
    //     $this->memberController = $memberController;
    // }
    public function getAllUserByIdRoleAndStatus($id, $status)
    {
        $users = User::where([['role_id', '=', $id], ['status', '=', $status]])
            ->get();
        if ($users->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(UserResource::collection($users), 'Ok', 200);
    }

    public function getUserByIdAndStatus($id, $status)
    {
        $user = User::where([['user_id', '=', $id], ['status', '=', $status]])
            ->first();
        if ($user == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new UserResource($user), 'Ok', 200);
    }

    public function getUserById($id)
    {
        $users = User::where('user_id', $id)
            ->first();
        return new UserResource($users);
    }

    public function checkEmailUserExist(Request $req)
    {
        $user = User::where('email', $req->email)
            ->first();

        if ($user == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        $token = JWTAuth::fromUser($user);
        if ($user->role->role_id == "MB") {
            $member = Member::where('user_id', $user->user_id)->first();

            $requ = new Request([
                'activity' => "Đăng nhập vào chương trình",
                'user_id' => $member->user->user_id,
                'object_id' => null,
                'type' => 5
            ]);
            $actHisController = new ActivityHistoryController();

            $actHisController->saveActivityHistory($requ);
            $member->user->token = $token;

            return Payload::toJson(new MemberResource($member), "Found Successfully", 202);
        }
        return Payload::toJson(null, 'Data Not Found', 404);
    }

    //Checked
    public function getUserByUsernameAndStatus(Request $req, $status)
    {
        try {
            $username = $req->username;
            $user = User::where([['username', '=', $username], ['status', '=', $status]])
                ->first();

            if ($user == null) {
                return Payload::toJson(null, 'Data Not Found', 404);
            }

            $requ = new Request([
                'code' => rand(100000, 999999),
                'user_id' => $user->user_id,
            ]);

            $code_controller = new CodeResetController();
            $code_reset = $code_controller->saveCode($requ);
            if ($code_reset == null) {
                return Payload::toJson(null, 'Cannot Request Server', 500);
            }

            $data = [
                'title' => "MÃ XÁC NHẬN",
                'full_name' => $user->full_name,
                'code' => $requ->code,
                'date_time' => $code_reset->date_created->addMinutes(10),
            ];

            Mail::to($user->email)->send(new SendMail($data));
            $member = Member::where('user_id', $user->user_id)->first();

            $requ = new Request([
                'activity' => "Gửi mã xác nhận lấy mật khẩu",
                'user_id' => $member->user->user_id,
                'object_id' => null,
                'type' => 5
            ]);

            $actHisController = new ActivityHistoryController();
            $actHisController->saveActivityHistory($requ);

            return Payload::toJson(new MemberResource($member), "Found Successfully", 202);
        } catch (Exception $ex) {
            return Payload::toJson(null, "Cannot Send Mail From Server", 500);
        }
    }

    public function getUserByEmailAndStatus(Request $req, $status)
    {
        $user = User::where([['email', '=', $req->email], ['status', '=', $status]])
            ->first();
        if ($user == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new UserResource($user), 'Ok', 200);
    }

    public function getUserByUserNameAndPassword(Request $req)
    {
        $token = JWTAuth::attempt(['username' => $req->username, 'password' => $req->password]);
        if ($token) {
            $member = Member::where('user_id', JWTAuth::user()->user_id)->first();
            if (!is_null($member)) {
                $requ = new Request([
                    'activity' => "Đăng nhập vào chương trình",
                    'user_id' => $member->user->user_id,
                    'object_id' => null,
                    'type' => 5
                ]);

                $actHisController = new ActivityHistoryController();

                $actHisController->saveActivityHistory($requ);
                $member->user->token = $token;
                return Payload::toJson(new MemberResource($member), "Found Successfully", 202);
            } else {
                JWTAuth::user()->token = $token;
                return Payload::toJson(new UserResource(JWTAuth::user()), "Found Successfully", 202);
            }
        } else {
            return Payload::toJson(null, "Data Not Found", 404);
        }
    }

    //Add session to black-list
    public function invalidateToken(Request $req)
    {
        try {
            return Payload::toJson(JWTAuth::setToken($req->token)->invalidate(), "Logout success", 202);
        } catch (Exception $ex) {
            return Payload::toJson(null, "Token invalid", 500);
        }
    }

    //Checked
    public function saveUser(Request $req)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->fill([
                'user_id' => "US" . Carbon::now()->format('ymdhis'),
                'role_id' => $req->role_id ?? "MB",
                'username' => $req->phone,
                'password' => bcrypt($req->password),
                'full_name' => $req->full_name,
                'email' => $req->email,
                'address' => $req->address,
                'birth_day' => $req->birth_day,
                'phone' => $req->phone,
                'image' => "member.png"
            ]);

            if ($user->save() == 1) {
                $user = $this->getUserById($user->user_id);
                $requ = new Request(['user_id' => $user->user_id]);

                // $requ->request->add(['user_id' => $user->user_id]);
                $member_controller = new MemberController();
                $member_controller->saveMember($requ);

                $requ = new Request([
                    'activity' => "Tạo tài khoản",
                    'user_id' => $user->user_id,
                    'object_id' => null,
                    'type' => 5
                ]);

                $actHisController = new ActivityHistoryController();

                $actHisController->saveActivityHistory($requ);

                DB::commit();
                return Payload::toJson(new UserResource($user), 'Completed', 201);
            }
            return Payload::toJson(null, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    //Checked
    public function updateUser(Request $req)
    {

        DB::beginTransaction();
        try {
            switch ($req->is_checked) {
                case (0): {
                        $result = User::where('username', $req->username)->update(
                            ['full_name' => $req->full_name]
                        );
                        break;
                    }
                case (1): {
                        $result = User::where('username', $req->username)->update(
                            ['email' => $req->email]
                        );
                        break;
                    }
                case (2): {
                        $result = User::where('username', $req->username)->update(
                            ['birth_day' => $req->birth_day]
                        );
                        break;
                    }
                case (3): {
                        $result = User::where('username', $req->username)->update(
                            ['address' => $req->address]
                        );
                        break;
                    }
                case (4): {
                        $result = User::where('username', $req->username)->update(
                            ['image' => $req->image]
                        );
                        break;
                    }
                case (5): {
                        $result = User::where('username', $req->username)->update(
                            [
                                'full_name' => $req->full_name,
                                'email' => $req->email,
                                'birth_day' => $req->birth_day,
                                'address' => $req->address
                            ]
                        );
                        break;
                    }
                default: {
                        $result = 1;
                    }
            }
            if ($result == 1) {
                $user  = User::where('username', $req->username)->first();

                $requ = new Request([
                    'activity' => "Cập nhật thông tin tài khoản",
                    'user_id' => $user->user_id,
                    'object_id' => null,
                    'type' => 5
                ]);

                $actHisController = new ActivityHistoryController();

                $actHisController->saveActivityHistory($requ);
                DB::commit();
                if ($user->role->role_id == "MB") {
                    $member = Member::where('user_id', $user->user_id)->first();
                    return Payload::toJson(new MemberResource($member), "Found Successfully", 202);
                } else {
                    return Payload::toJson(new UserResource($user), "Found Successfully", 202);
                }
            }

            return Payload::toJson($result, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function changePassword(Request $req)
    {
        DB::beginTransaction();
        try {
            $user = User::where('username', $req->username)->update([
                'password' => bcrypt($req->password),
            ]);
            if ($user == 1) {
                $user  = User::where('username', $req->username)->first();
                $requ = new Request([
                    'activity' => "Thay đổi mật khẩu",
                    'user_id' => $user->user_id,
                    'object_id' => null,
                    'type' => 5
                ]);

                $actHisController = new ActivityHistoryController();

                $actHisController->saveActivityHistory($requ);
                DB::commit();
                return Payload::toJson($user, 'Comppleted', 202);
            }
            return Payload::toJson($user, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function confirmCode(Request $req)
    {
        try {
            $user = User::where('username', '=', $req->username)->first();

            $code_controller = new CodeResetController();

            //Get code by user id
            $code_reset = $code_controller->getCodeByUserId($user->user_id);

            //Get time expired of code - note add location ('Asia/Ho_Chi_Minh')
            $expiration_time = Carbon::parse($code_reset->date_created, 'Asia/Ho_Chi_Minh')->addMinutes(10);

            //Get current date time
            $current_dateTime = Carbon::now('Asia/Ho_Chi_Minh');

            if ($code_reset->code == $req->code) {
                if ($expiration_time->lessThanOrEqualTo($current_dateTime)) {
                    $code_controller->removeCode($code_reset->code);
                    return Payload::toJson(0, 'Code Expiration Time', 401);
                } else {
                    $code_controller->removeCode($code_reset->code);

                    $requ = new Request([
                        'activity' => "Xác nhận mã OTP thành công",
                        'user_id' => $user->user_id,
                        'object_id' => null,
                        'type' => 5
                    ]);

                    $actHisController = new ActivityHistoryController();

                    $actHisController->saveActivityHistory($requ);

                    return Payload::toJson(1, 'Code Successfully', 202);
                }
            }
            return Payload::toJson(-1, 'Code Invalid', 404);
        } catch (Exception $ex) {
            return Payload::toJson(null, 'Cannot Request Server', 500);
        }
    }

    public function removeUser(Request $req)
    {
        DB::beginTransaction();
        try {
            $user = User::where('user_id', $req->user_id)
                ->update(['status' => $req->status]);
            if ($user == 1) {
                $requ = new Request([
                    'activity' => "Khoá tài khoản Member($req->member_id)",
                    'user_id' => $req->user_id,
                    'object_id' => $req->member_id,
                    'type' => 5
                ]);

                $actHisController = new ActivityHistoryController();

                $actHisController->saveActivityHistory($requ);
                DB::commit();
                return Payload::toJson($user, 'Comppleted', 202);
            }
            return Payload::toJson($user, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}