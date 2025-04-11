<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DiscountCategory;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Resources\DiscountResource;
use App\Http\Payload;
use Exception;

class DiscountCategoryController extends Controller
{
    public function getAllDiscountCategoryByStatus($status)
    {
        $discounts = DiscountCategory::where('status', $status)->get();
        if ($discounts->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(DiscountResource::collection($discounts), 'OK', 200);
    }

    public function getDiscountCategoryByIdAndStatus($id, $status)
    {
        $discount = DiscountCategory::where([['discount_id', '=', $id], ['status', '=', $status]])->first();
        if ($discount == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new DiscountResource($discount), 'OK', 200);
    }

    public function getDiscountCategoryById($id)
    {
        $discount = DiscountCategory::where([['discount_id', '=', $id]])->first();
        if ($discount == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new DiscountResource($discount), 'OK', 200);
    }

    public function getAllDiscountCategoryByIdsAndStatus($ids, $status)
    {
        $discount = DiscountCategory::whereIn('discount_id', $ids)
            ->where('status', '=', $status)->get();
        if ($discount->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(DiscountResource::collection($discount), 'OK', 200);
    }

    public function getAllDiscountCategoryByIdRankAndStatus($id, $status)
    {
        $discounts = DiscountCategory::where([['rank_id', '=', $id], ['status', '=', $status]])->get();
        if ($discounts->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(DiscountResource::collection($discounts), 'OK', 200);
    }

    public function getAllDiscountCategoryByIdRank($id)
    {
        $discounts = DiscountCategory::where('rank_id', $id)->get();
        if ($discounts->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(DiscountResource::collection($discounts), 'OK', 200);
    }

    public function getAllDiscountCategoryByIdCategoryAndStatus($id, $status)
    {
        $discounts = DiscountCategory::where([['category_id', '=', $id], ['status', '=', $status]])->get();
        if ($discounts->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(DiscountResource::collection($discounts), 'OK', 200);
    }

    public function removeDiscountCategory(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = DiscountCategory::where('discount_id', $req->discount_id)->update(['status' => $req->status]);
            DB::commit();
            if ($result == 1) {
                $discount = DiscountCategory::where('discount_id', $req->discount_id)->first();
                return Payload::toJson(new DiscountResource($discount), 'Remove Succefully', 202);
            }

            return Payload::toJson(null, 'Cannot Remove', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateDiscountCategory(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = DiscountCategory::where('discount_id', $req->discount_id)->update(
                [
                    'percent_price' => $req->percent_price,
                    'rank_id' => $req->rank_id,
                    'category_id' => $req->category_id
                ]
            );
            DB::commit();
            if ($result == 1) {
                $discount = DiscountCategory::where('discount_id', $req->discount_id)->first();
                return Payload::toJson(new DiscountResource($discount), 'Update Succefully', 202);
            }
            return Payload::toJson(null, 'Cannot Update', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function saveDiscountCategory(Request $req)
    {
        DB::beginTransaction();
        try {
            $discount = new DiscountCategory();
            $discount->fill(
                [
                    'discount_id' => $req->rank_id . $req->category_id,
                    'percent_price' => $req->percent_price,
                    'rank_id' => $req->rank_id,
                    'category_id' => $req->category_id,
                ]
            );
            $discount->save();
            $discount = DiscountCategory::where([['discount_id', '=', $discount->discount_id]])->first();
            DB::commit();
            return Payload::toJson(new DiscountResource($discount), 'Create Succefully', 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}