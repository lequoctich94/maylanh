<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\DiscountCategoryController;
use App\Http\Controllers\services\RankController;
use Illuminate\Http\Request;

class URankController extends Controller
{
    protected $rankController;
    protected $discountCategoryController;

    public function __construct()
    {
        $this->rankController = new RankController();
        $this->discountCategoryController = new DiscountCategoryController();
    }

    public function rank()
    {
        $member = request()->session()->get('member');
        $this->viewData['member'] = $member;
        $rank_response = $this->rankController->getAllRankByStatus(1);
        if (!is_null($rank_response['data'])) {
            $this->viewData['ranks'] = $rank_response['data'];
        }
        $next_rank_response = $this->rankController->getNextRankOfCurrentRankByMemberIdAndStatus($member->member_id, 1);
        if (!is_null($next_rank_response['data'])) {
            $this->viewData['next_rank'] = $next_rank_response['data'];
        }
        return view('user/profile/rank')->with($this->viewData);
    }
}