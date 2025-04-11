<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\VoucherMemberController as ServicesVoucherMemberController;
use Illuminate\Http\Request;

class VoucherMemberController extends Controller
{
    public function voucherMemberManagement($code)
    {
        $voucherMemberController = new ServicesVoucherMemberController();
        $data_voucher_member = $voucherMemberController->getAllVoucherMemberByCode($code);
        $voucher_members = $data_voucher_member['data']->collection;
        return View('voucher_management/voucher_member', ['voucher_members' => $voucher_members]);
    }
}