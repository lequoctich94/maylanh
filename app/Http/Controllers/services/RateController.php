<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rate;
use Carbon\Carbon;
use App\Http\Resources\RateResource;
use App\Http\Payload;
use App\Http\Controllers\services\ActivityHistoryController;
use Exception;

class RateController extends Controller
{

    public function getRateByIdAndStatus($id, $status)
    {
        $rate = Rate::where([
            ['rate_id', $id],
            ['status', $status]
        ])->first();

        if ($rate == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new RateResource($rate), "Request Successfully", 200);
    }

    public function getAllRateByIdMemberAndStatus($id, $status)
    {
        $rates = Rate::where([
            ['member_id', $id],
            ['status', $status]
        ])->get();
        if ($rates->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(RateResource::collection($rates), "Request Successfully", 200);
    }

    public function getAllRateByIdProductAndStatus($id, $status)
    {
        $rates = Rate::where([
            ['product_id', $id],
            ['status', $status]
        ])->get();
        if ($rates->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(RateResource::collection($rates), "Request Successfully", 200);
    }

    public function getRateByIdMemberAndIdProduct($member_id, $product_id)
    {
        $rate = Rate::where([
            ['member_id', $member_id],
            ['product_id', $product_id]
        ])->first();
        if ($rate == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new RateResource($rate), "Request Successfully", 200);
    }

    public function saveRate(Request $req)
    {
        DB::beginTransaction();
        try {
            $rate = new Rate();
            $rate->fill(
                [
                    'rate_id' => $req->member_id . $req->product_id . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis'),
                    'member_id' => $req->member_id,
                    'product_id' => $req->product_id,
                    'star' => $req->star,
                    'comment' => $req->comment,
                    'date_rate' => Carbon::now()->format('Y-m-d h:m:s'),
                ]

            );

            $rate->save();
            $rate = Rate::where('rate_id', $rate->rate_id)->first();
            $requ = new Request([
                'activity' => "Đánh giá sản phẩm $rate->product_id với $rate->star*",
                'user_id' => $rate->member->user->user_id,
                'object_id' => $rate->rate_id,
                'type' => 1
            ]);

            $reqs = new Request([
                'product_id' => $req->product_id,
                'rate_status' => 1,
                'bill_id' => $req->bill_id
            ]);

            $actHisController = new ActivityHistoryController();
            $billDetailController = new BillDetailController();
            $actHisController->saveActivityHistory($requ);
            $billDetailController->updateRateStatus($reqs);
            DB::commit();
            return Payload::toJson(new RateResource($rate), "Create Successfully", 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateRate(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Rate::where('rate_id', $req->rate_id)
                ->update(
                    [
                        'star' => $req->star,
                        'comment' => $req->comment,
                        'date_rate' => Carbon::now('Asia/Ho_Chi_Minh')
                    ],
                );

            if ($result == 1) {
                $rate = Rate::where('rate_id', $req->rate_id)->first();
                $requ = new Request([
                    'activity' => "Cập nhật đánh giá sản phẩm $rate->product_id",
                    'user_id' => $rate->member->user->user_id,
                    'object_id' => $rate->rate_id,
                    'type' => 1
                ]);

                $actHisController = new ActivityHistoryController();
                $actHisController->saveActivityHistory($requ);
                DB::commit();
                return Payload::toJson(new RateResource($rate), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function likeRate(Request $req)
    {
        DB::beginTransaction();
        try {
            $rate = Rate::where('rate_id', $req->rate_id)->first();
            $rate->like = $rate->like + 1;
            $result = Rate::where('rate_id', $rate->rate_id)
                ->update(['like' => $rate->like]);

            if ($result == 1) {
                $member_id = $rate->member->member_id;

                $requ = new Request([
                    'activity' => "Yêu thích đánh giá của khách hàng $member_id",
                    'user_id' => $rate->member->user->user_id,
                    'object_id' => $rate->rate_id,
                    'type' => 1
                ]);

                $actHisController = new ActivityHistoryController();

                $actHisController->saveActivityHistory($requ);
                DB::commit();
                return Payload::toJson(new RateResource($rate), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function unlikeRate(Request $req)
    {
        DB::beginTransaction();
        try {
            $rate = Rate::where('rate_id', $req->rate_id)->first();
            $rate->like = $rate->like - 1;
            $result = Rate::where('rate_id', $rate->rate_id)
                ->update(['like' => $rate->like]);

            if ($result == 1) {
                $member_id = $rate->member->member_id;

                $requ = new Request([
                    'activity' => "Huỷ yêu thích đánh giá của khách hàng $member_id",
                    'user_id' => $rate->member->user->user_id,
                    'object_id' => $rate->rate_id,
                    'type' => 1
                ]);

                $actHisController = new ActivityHistoryController();

                $actHisController->saveActivityHistory($requ);
                DB::commit();
                return Payload::toJson(new RateResource($rate), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeRate(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Rate::where('rate_id', $req->rate_id)
                ->update(['status' => $req->status]);
            if ($result == 1) {
                $rate = Rate::where('rate_id', $req->rate_id)->first();

                $requ = new Request([
                    'activity' => "Xoá đánh giá $rate->rate_id",
                    'user_id' => $rate->member->user->user_id,
                    'object_id' => $rate->rate_id,
                    'type' => 1
                ]);

                $actHisController = new ActivityHistoryController();

                $actHisController->saveActivityHistory($requ);
                DB::commit();
                return Payload::toJson(new RateResource($rate), "Remove Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Remove", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}