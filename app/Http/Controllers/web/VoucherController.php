<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\MemberController as ServicesMemberController;
use App\Http\Controllers\services\VoucherController as ServicesVoucherController;
use App\Http\Controllers\services\VoucherMemberController as ServicesVoucherMemberController;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function voucherManagement()
    {
        $voucherController = new ServicesVoucherController();
        $memberController = new ServicesMemberController();
        $data_voucher = $voucherController->getAllVoucher();
        $vouchers = [];
        if ($data_voucher['data'] != null)
            $vouchers = $data_voucher['data']->collection;

        $data_member = $memberController->getAllMemberByStatus(1);
        $members = [];
        if ($data_member['data'] != null)
            $members = $data_member['data']->collection;
        return view('voucher_management/voucher', ['vouchers' => $vouchers, 'members' => $members]);
    }

    public function addVoucher(Request $req)
    {
        $voucherController = new ServicesVoucherController();
        $req->date_start = Carbon::parse($req->date_start, 'Asia/Ho_Chi_Minh');
        $req->date_end = Carbon::parse($req->date_end, 'Asia/Ho_Chi_Minh');
        if ($req->isCheckedElement == null) {
            return back()->withErrors(['error' => 'Vui lòng chọn khách hàng']);
        }

        $result = $voucherController->saveVoucher($req);
        if ($result == null) {
            return back()->withErrors(['error' => 'Tạo thất bại']);
        }

        foreach ($req->isCheckedElement as $memberId) {
            $voucherMemberController = new ServicesVoucherMemberController();
            $req = new Request(
                [
                    'member_id' => $memberId,
                    'code' => $result['data']->code,
                ]
            );
            $voucherMemberController->saveVoucherMember($req);
        }
        return redirect(route('voucher-management'));
    }

    public function updateVoucher(Request $req)
    {
        $voucherController = new ServicesVoucherController();
        $req->date_start = Carbon::parse($req->date_start, 'Asia/Ho_Chi_Minh');
        $req->date_end = Carbon::parse($req->date_end, 'Asia/Ho_Chi_Minh');
        $result = $voucherController->updateVoucher($req);
        if ($result == null) {
            return back()->withErrors(['error' => 'Tạo thất bại']);
        }
        if ($req->isCheckedElement != null) {
            foreach ($req->isCheckedElement as $memberId) {
                $voucherMemberController = new ServicesVoucherMemberController();
                $req = new Request(
                    [
                        'member_id' => $memberId,
                        'code' => $result['data']->code,
                    ]
                );
                $voucherMemberController->saveVoucherMember($req);
            }
        }
        return redirect(route('voucher-management'));
    }
}
