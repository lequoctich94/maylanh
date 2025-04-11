<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\MemberController as ServicesMemberController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function memberManagement()
    {
        $memberController = new ServicesMemberController();
        $data_members = $memberController->getAllMember();
        $members = [];
        if ($data_members['data'] != null) {
            $members = $data_members['data']->collection;
        }
        return view('member_management/member', ['members' => $members]);
    }

    public function memberStatistics()
    {
        $memberController = new ServicesMemberController();
        $dateNow = Carbon::now()->format('Y-m-d');
        $data_members = $memberController->getBestMembersByMaxCurrentPoint();
        $data_bills = $memberController->getTopMembersBuyTheMost($dateNow, $dateNow);
        $members = [];
        $top_member_bills = [];
        $total = 0;
        if ($data_members['data'] != null) {
            $members = $data_members['data']->collection;
        }
        if ($data_bills['data'] != null) {
            $top_member_bills = $data_bills['data'];
            for ($i = 0; $i < count($top_member_bills); $i++) {
                $total += $top_member_bills[$i]['total_bill'];
            }
        }

        return view(
            'statistics_member_management/statistics_member',
            [
                'members' => $members,
                'topMembers' => $top_member_bills,
                'dateNow' => $dateNow,
                'total' => $total
            ]
        );
    }

    public function memberStatisticsBuyTheMostByDate($date_start, $date_end)
    {
        $memberController = new ServicesMemberController();
        $dateNow = Carbon::now()->format('Y-m-d');
        $data_members = $memberController->getBestMembersByMaxCurrentPoint();
        $data_bills = $memberController->getTopMembersBuyTheMost($date_start, $date_end);
        $members = [];
        $top_member_bills = [];
        $total = 0;
        if ($data_members['data'] != null) {
            $members = $data_members['data']->collection;
        }
        if ($data_bills['data'] != null) {
            $top_member_bills = $data_bills['data'];
            for ($i = 0; $i < count($top_member_bills); $i++) {
                $total += $top_member_bills[$i]['total_bill'];
            }
        }

        return view(
            'statistics_member_management/statistics_of_member_buy_the_most_render',
            [
                'members' => $members,
                'topMembers' => $top_member_bills,
                'dateNow' => $dateNow,
                'total' => $total
            ]
        )->render();
    }

    public function memberStatisticsBuyTheMostByCycle($week, $month, $year)
    {
        $memberController = new ServicesMemberController();
        $dateNow = Carbon::now()->format('Y-m-d');
        $data_members = $memberController->getBestMembersByMaxCurrentPoint();
        $data_bills = $memberController->getTopMembersBuyTheMostByCycle($week, $month, $year);
        $members = [];
        $top_member_bills = [];
        $total = 0;
        if ($data_members['data'] != null) {
            $members = $data_members['data']->collection;
        }
        if ($data_bills['data'] != null) {
            $top_member_bills = $data_bills['data'];
            for ($i = 0; $i < count($top_member_bills); $i++) {
                $total += $top_member_bills[$i]['total_bill'];
            }
        }

        return view(
            'statistics_member_management/statistics_of_member_buy_the_most_render',
            [
                'members' => $members,
                'topMembers' => $top_member_bills,
                'dateNow' => $dateNow,
                'total' => $total
            ]
        )->render();
    }
}
