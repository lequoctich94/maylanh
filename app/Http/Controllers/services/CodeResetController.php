<?php

namespace App\Http\Controllers\services;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\CodeReset;
use Exception;
use Illuminate\Support\Facades\DB;

class CodeResetController extends Controller
{
    public function getCodeByUserId($user_id)
    {
        $code = CodeReset::where('user_id', $user_id)->first();
        return $code;
    }

    public function removeCode($code)
    {
        DB::beginTransaction();
        try {
            $code = CodeReset::where('code', $code)->delete();
            DB::commit();
            return $code;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function saveCode(Request $req)
    {
        DB::beginTransaction();
        try {
            $code = CodeReset::updateOrCreate(
                ['user_id' => $req->user_id],
                ['code' => $req->code, 'date_created' => Carbon::now('Asia/Ho_Chi_Minh')]
            );
            DB::commit();
            return $code;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}