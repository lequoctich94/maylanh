<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VoucherMember;
use App\Http\Resources\VoucherMemberResource;
use App\Http\Payload;
use Exception;

class VoucherMemberController extends Controller
{
    public function getAllVoucherMemberByIdMember($member_id)
    {
        $voucher_members = VoucherMember::where(
            'member_id',
            '=',
            $member_id
        )->get();
        if ($voucher_members->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(VoucherMemberResource::collection($voucher_members), "Request Successfully", 200);
    }


    public function getAllVoucherMemberByIdMemberAndStatus($id, $status)
    {
        $voucher_members = VoucherMember::where([
            ['member_id', '=', $id],
            ['status', '=', $status]
        ])->get();
        if ($voucher_members->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(VoucherMemberResource::collection($voucher_members), "Request Successfully", 200);
    }

    public function getAllVoucherMemberByCode($code)
    {
        $voucher_members = VoucherMember::where([
            ['code', '=', $code],
        ])->get();
        if ($voucher_members->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(VoucherMemberResource::collection($voucher_members), "Request Successfully", 200);
    }

    public function saveVoucherMember(Request $req)
    {
        DB::beginTransaction();
        try {
            $voucher_member = new VoucherMember();
            $voucher_member->fill(
                [
                    'member_id' => $req->member_id,
                    'code' => $req->code
                ]
            );
            $voucher_member->save();
            DB::commit();
            return Payload::toJson(new VoucherMemberResource($voucher_member), "Save Successfully", 201);
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function updateStatusVoucherMemberByIdMemberAndCode(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = VoucherMember::where([['member_id', $req->member_id], ['code', $req->code]])
                ->update(
                    ['status' => $req->status]
                );

            $voucher_members = VoucherMember::where([
                ['code', '=', $req->code], ['status', '=', 0],
            ])->get();

            if (!$voucher_members->isEmpty() && ($voucher_members->count() == $voucher_members[0]->voucher->max_used)) {
                $voucherController = new VoucherController();
                $voucherController->removeVoucher(new Request([
                    'code' => $req->code,
                    'status' => 0
                ]));
            }

            if ($result == 1) {
                $voucher_member = VoucherMember::where([['member_id', $req->member_id], ['code', $req->code]])->first();
                DB::commit();
                return Payload::toJson(new VoucherMemberResource($voucher_member), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function updateStatusVoucherMemberByCode(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = VoucherMember::where([['code', $req->code]])->update(['status' => $req->status]);
            DB::commit();
            if ($result == 1) {
                return Payload::toJson(true, "Update Successfully", 202);
            }
            return Payload::toJson(false, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}