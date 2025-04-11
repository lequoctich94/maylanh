<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use Carbon\Carbon;
use App\Http\Payload;
use Exception;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function getAllMemberByStatus($status)
    {
        $members = Member::where('status', $status)
            ->get();
        if ($members->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(MemberResource::collection($members), "Request Successfully", 200);
    }

    public function getMemberById($id)
    {
        return Member::where('member_id', $id)->first();
    }

    public function getAllMember()
    {
        $members = Member::all();
        if ($members->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(MemberResource::collection($members), "Request Successfully", 200);
    }

    public function getBestMembersByMaxCurrentPoint()
    {
        $members = Member::select('*')
            ->orderBy('current_point', 'DESC')
            ->take(5)
            ->get();
        if ($members->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(MemberResource::collection($members), "Request Successfully", 200);
    }

    public function getQuantityMemberOfRank()
    {
        $statistics = Member::select(DB::raw('count(member_id) as quantity_member,rank_id'))
            ->groupBy('rank_id')
            ->get();
        $data = [];
        $i = 0;
        foreach ($statistics as $sts) {
            $data[$i] = ['quantity_member' => $sts->quantity_member, 'rank' => $sts->rank];
            $i++;
        }
        if ($statistics->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($statistics, "Request Successfully", 200);
    }

    public function getMemberByIdAndStatus($id, $status)
    {
        $member = Member::where([
            ['member_id', '=', $id],
            ['status', '=', $status]
        ])->first();
        if ($member == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new MemberResource($member), "Request Successfully", 200);
    }

    public function getMemberByIdUserAndStatus($id, $status)
    {
        $member = Member::where([
            ['user_id', '=', $id],
            ['status', '=', $status]
        ])->first();

        if ($member == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new MemberResource($member), "Request Successfully", 200);
    }

    public function getMemberByMaxCurrentPointInDateAndStatus($date, $status)
    {
        $member = Member::where([
            ['date_start_rank', '>=', $date],
            ['date_end_rank', '>=', $date],
            ['status', '=', $status],
            $maxValue = max('current_point'),
        ])->$maxValue;

        if ($member == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new MemberResource($member), "Request Successfully", 200);
    }

    public function getAllMemberExpirationDateAndStatus($date, $status)
    {
        $members = Member::where([
            ['date_end_rank', '=', $date],
            ['status', '=', $status]
        ])->get();
        if ($members->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(MemberResource::collection($members), "Request Successfully", 200);
    }

    public function saveMember(Request $req)
    {
        DB::beginTransaction();
        try {
            $member = new Member();
            $member->fill(
                [
                    'member_id' => "MB" . Carbon::now('Asia/Ho_Chi_Minh')->format('ymdhis'),
                    'rank_id' => "BRONZE",
                    'user_id' => $req->user_id,
                    'date_start_rank' => Carbon::now('Asia/Ho_Chi_Minh'),
                ],
            );
            $member->save();
            $member = Member::where('member_id', $member->member_id)->first();
            DB::commit();
            return Payload::toJson(new MemberResource($member), "Create Successfully", 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }


    public function updateRankMember(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Member::where('member_id', $req->member_id)
                ->update(
                    [
                        'rank_id' => $req->rank_id,
                        'current_point' => $req->current_point,
                        'date_start_rank' => Carbon::now('Asia/Ho_Chi_Minh'),
                        'date_end_rank' => Carbon::now('Asia/Ho_Chi_Minh')->addYear()
                    ],
                );
            if ($result == 1) {
                $member = Member::where('member_id', $req->member_id)->first();
                DB::commit();
                return Payload::toJson(new MemberResource($member), "Update Successfully", 201);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateRankMembers(Request $req)
    {
        DB::beginTransaction();
        try {

            $result = Member::whereIn('member_id', $req->member_ids)
                ->update(
                    [
                        'rank_id' => $req->rank_id,
                        'date_start_rank' => Carbon::now('Asia/Ho_Chi_Minh'),
                        'date_end_rank' => Carbon::now('Asia/Ho_Chi_Minh')
                    ],
                );
            DB::commit();
            if ($result == 1) {
                return Payload::toJson(true, "Update Successfully", 201);
            }
            return Payload::toJson(false, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateCurrentPointMember(Request $req)
    {
        DB::beginTransaction();
        try {
            $rankController = new RankController();
            $rank = $rankController->getNextRankOfCurrentRankByMemberIdAndStatus($req->member_id, 1)['data'];
            if ($req->current_point >= $rank->point) {
                $reqTmp = new Request([
                    'member_id' => $req->member_id,
                    'rank_id' => $rank->rank_id,
                ]);
                $this->updateRankMember($reqTmp);
            }

            $result = Member::where('member_id', $req->member_id)->update(
                ['current_point' => $req->current_point],
            );
            DB::commit();
            if ($result == 1) {
                $member = Member::where('member_id', $req->member_id)->first();
                return Payload::toJson(new MemberResource($member), "Update Successfully", 201);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeMember(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Member::where('member_id', $req->member_id)
                ->update(['status' => $req->status]);
            DB::commit();
            if ($result == 1) {
                $member = Member::where('member_id', $req->member_id)->first();
                return Payload::toJson(new MemberResource($member), "Remove Successfully", 201);
            }
            return Payload::toJson(null, "Cannot Remove", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateStatusByMemberId(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Member::where('member_id', $req->member_id)
                ->update(['status' => $req->status]);
            DB::commit();
            if ($result == 1) {
                $member = Member::where('member_id', $req->member_id)->first();
                return Payload::toJson(new MemberResource($member), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getTopMembersBuyTheMost($date_start, $date_end)
    {
        $statistics = Member::select(DB::raw('SUM(bills.total_price) AS total_bill, count(bills.member_id) as quantity_bill,members.member_id,members.user_id'))
            ->join('bills', 'bills.member_id', '=', 'members.member_id')
            ->whereRaw("CAST(bills.date_order as DATE) >= '$date_start' and CAST(bills.date_order as DATE) <= '$date_end' and bills.status = 1")
            ->groupBy('members.member_id', 'members.user_id')
            ->orderBy('total_bill', 'DESC')
            ->take(5)
            ->get();
        $data = [];
        $i = 0;
        foreach ($statistics as $sts) {
            $data[$i] = [
                'member_id' => $sts->member_id,
                'user' => $sts->user,
                'total_bill' => $sts->total_bill,
                'quantity_bill' => $sts->quantity_bill
            ];
            $i++;
        }
        if ($data == [])
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($data, "Request Successfully", 200);
    }

    public function getTopMembersBuyTheMostByCycle($week, $month, $year)
    {
        $statistics = Member::select(DB::raw('SUM(bills.total_price) AS total_bill, count(bills.member_id) as quantity_bill,members.member_id,members.user_id'))
            ->join('bills', 'bills.member_id', '=', 'members.member_id')
            ->whereMonth('date_order', $month)
            ->whereYear('date_order', $year)
            ->groupBy('members.member_id', 'members.user_id')
            ->orderBy('total_bill', 'DESC')
            ->take(5)
            ->get();
        $data = [];
        $i = 0;
        foreach ($statistics as $sts) {
            $weekOfMonthStatistics = Carbon::parse($sts->date_order)->weekOfMonth;
            if ($weekOfMonthStatistics == $week) {
                $data[$i] = [
                    'member_id' => $sts->member_id,
                    'user' => $sts->user,
                    'total_bill' => $sts->total_bill,
                    'quantity_bill' => $sts->quantity_bill
                ];
            }
            $i++;
        }
        if ($data == [])
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($data, "Request Successfully", 200);
    }

    public function addOrUpdateTokenDevice(Request $req)
    {
        DB::beginTransaction();
        try {
            $member = Member::where('member_id', $req->member_id)->first();

            if ($member->token_devices != null) {
                if (Str::contains($member->token_devices, $req->token_device)) {
                    return Payload::toJson(true, "Update Successfully", 202);
                }

                $token_devices_new = $member->token_devices . ',' . $req->token_device;
            } else {
                $token_devices_new = $req->token_device;
            }

            $result = Member::where('member_id', $req->member_id)->update(['token_devices' => $token_devices_new]);
            DB::commit();
            if ($result == 1) {
                return Payload::toJson(true, "Update Successfully", 202);
            }
            return Payload::toJson(false, "Cannot Update Token", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}