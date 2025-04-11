<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\VoucherController;
use App\Http\Controllers\services\VoucherMemberController;
use Illuminate\Http\Request;

class UVoucherController extends Controller
{
    protected $voucherMemberController;

    public function __construct()
    {
        $this->voucherMemberController = new VoucherMemberController();
    }

    public function voucher()
    {
        $member = request()->session()->get('member');
        $this->viewData['member'] = $member;
        $voucher_response = $this->voucherMemberController->getAllVoucherMemberByIdMemberAndStatus($member->member_id, 1);
        if (!is_null($voucher_response['data'])) {
            $this->viewData['voucherMembers'] = $voucher_response['data'];
        }
        return view('user/profile/voucher')->with($this->viewData);
    }
}