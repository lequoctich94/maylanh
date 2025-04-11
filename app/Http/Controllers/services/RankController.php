<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rank;
use Carbon\Carbon;
use App\Http\Resources\RankResource;
use App\Http\Payload;
use Exception;

class RankController extends Controller
{
    public function getAllRank()
    {
        $ranks = Rank::all();
        if ($ranks->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(RankResource::collection($ranks), "Request Successfully", 200);
    }
    public function getAllRankByStatus($status)
    {
        $ranks = Rank::where([
            ['status', $status]
        ])->orderBy('point', 'ASC')->get();
        if ($ranks->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(RankResource::collection($ranks), "Request Successfully", 200);
    }

    public function getRankByIdAndStatus($id, $status)
    {
        $rank = Rank::where([
            ['rank_id', $id],
            ['status', $status]
        ])->first();
        if ($rank == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new RankResource($rank), "Request Successfully", 200);
    }

    public function getRankById($id)
    {
        $rank = Rank::where('rank_id', $id)->first();
        if ($rank == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new RankResource($rank), "Request Successfully", 200);
    }

    public function getNextRankOfCurrentRankByMemberIdAndStatus($id, $status)
    {
        //this is handle case multi condition in join table
        $rank = Rank::join('members', function ($join) {
            $join->on('members.current_point', '<', 'ranks.point');
            $join->on('members.rank_id', '!=', 'ranks.rank_id');
        })
            ->where([['members.member_id', '=', $id], ['ranks.status', '=', $status]])
            ->orderBy('point', 'ASC')
            ->first('ranks.*');

        if ($rank == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new RankResource($rank), "Request Successfully", 200);
    }

    public function getPreviousRankOfCurrentRankAndStatus($id, $point, $status)
    {
        $rank = Rank::where([["rank_id", "!=", $id], ["point", "<", $point], ["status", "=", $status]])
            ->orderBy("point", "DESC")->first();

        if ($rank == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new RankResource($rank), "Request Successfully", 200);
    }

    public function saveRank(Request $req)
    {
        $rank = new Rank();
        $rank->fill(
            [
                'rank_id' =>  $req->rank_id,
                'rank_name' => $req->rank_name,
                'point' => $req->point,
            ]
        );
        $rank->save();
        $rank = Rank::where('rank_id', $rank->rank_id)->first();
        return Payload::toJson(new RankResource($rank), "Create Successfully", 201);
    }

    public function updateRank(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Rank::where('rank_id', $req->rank_id)
                ->update(
                    [
                        'rank_name' => $req->rank_name,
                        'point' => $req->point
                    ],
                );

            $memberController = new MemberController();
            $member_response = $memberController->getAllMemberByStatus(1);
            $members = $member_response['data'];

            $member_ids = [];
            foreach ($members as $member) {
                if ($member->rank_id == $req->rank_id && $member->current_point < $req->point) {
                    array_push($member_ids, $member->member_id);
                }
            }

            //Update rank member when update point rank
            $memberController->updateRankMembers(new Request([
                'member_ids' => $member_ids,
            ]));
            DB::commit();
            if ($result == 1) {
                $rank = Rank::where('rank_id', $req->rank_id)->first();
                return Payload::toJson(new RankResource($rank), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeRank(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Rank::where('rank_id', $req->rank_id)
                ->update(['status' => $req->status]);
            DB::commit();
            if ($result == 1) {
                $rank = Rank::where('rank_id', $req->rank_id)->first();
                return Payload::toJson(new RankResource($rank), "Remove Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}