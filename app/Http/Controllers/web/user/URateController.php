<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\RateController;
use Illuminate\Http\Request;

class URateController extends Controller
{
    protected $rateController;
    public function __construct()
    {
        $this->rateController = new RateController();
    }

    public function rate()
    {
        $member = request()->session()->get('member');
        $this->viewData['member'] = $member;
        $rate_response = $this->rateController->getAllRateByIdMemberAndStatus($member->member_id, 1);
        if (!is_null($rate_response['data'])) {
            $this->viewData['rates'] = $rate_response['data'];
        }
        return view('user/profile/rate')->with($this->viewData);
    }
}