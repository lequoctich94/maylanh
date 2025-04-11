<?php

namespace App\Http\Controllers\services;

use App\Http\Payload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Http\Resources\VoucherResource;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function getAllVoucher()
    {
        $vouchers = Voucher::orderBy('date_start', 'DESC')->get();
        if ($vouchers->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(VoucherResource::collection($vouchers), 'Ok', 200);
    }

    public function getAllVoucherByStatus($status)
    {
        $vouchers = Voucher::where('status', $status)->orderBy('date_start', 'DESC')->get();
        if ($vouchers->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(VoucherResource::collection($vouchers), 'Ok', 200);
    }

    public function getVoucherByCodeAndStatus($code)
    {
        $voucher = Voucher::where('code', $code)->first();
        if ($voucher == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new VoucherResource($voucher), 'Ok', 200);
    }

    public function getVoucherByCode($code)
    {
        $voucher = Voucher::where('code', $code)->first();
        return new VoucherResource($voucher);
    }

    public function checkVoucherExpirationDate($date)
    {
        $vouchers = Voucher::where(
            [
                ['date_start', '<=', $date], //2021-12-08<=2021-12-12
                ['date_end', '>=', $date],
            ] //2021-12-13>=2021-12-12
        )->get();
        if ($vouchers->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(VoucherResource::collection($vouchers), 'Ok', 200);
    }

    public function saveVoucher(Request $req)
    {
        DB::beginTransaction();
        try {
            $voucher = new VouCher();

            $voucher->fill(
                [
                    'code' => $req->code . '-' . Carbon::now()->format('ymdhis'),
                    'max_price' => $req->max_price,
                    'max_used' => $req->max_used,
                    'sale_off' => $req->sale_off,
                    'date_start' => $req->date_start,
                    'date_end' => $req->date_end,
                ]
            );
            if ($voucher->save() == 1) {
                $voucher = $this->getVoucherByCode($voucher->code);
                DB::commit();
                return Payload::toJson(new VoucherResource($voucher), 'Completed', 201);
            }
            return Payload::toJson(null, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function updateVoucher(Request $req)
    {
        DB::beginTransaction();
        try {
            $voucher = Voucher::where('code', $req->code)
                ->update(
                    [
                        'max_price' => $req->max_price,
                        'max_used' => $req->max_used,
                        'sale_off' => $req->sale_off,
                        'date_start' => $req->date_start,
                        'date_end' => $req->date_end
                    ]
                );
            DB::commit();
            if ($voucher == 1) {
                return Payload::toJson($voucher, 'Completed', 200);
            }
            return Payload::toJson($voucher, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function removeVoucher(Request $req)
    {
        DB::beginTransaction();
        try {
            $voucher = Voucher::where('code', $req->code)
                ->update(['status' => $req->status]);
            if ($voucher == 1) {
                $voucherMember = new VoucherMemberController();
                $result = $voucherMember->updateStatusVoucherMemberByCode($req);
                DB::commit();
                if ($result == true) {
                    return Payload::toJson($voucher, 'Completed', 200);
                }
            }
            return Payload::toJson($voucher, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}