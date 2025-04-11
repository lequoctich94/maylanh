<?php

namespace App\Http\Controllers\services;

use App\Http\Payload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Size;
use Carbon\Carbon;
use App\Http\Resources\SizeResource;
use Exception;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{
    public function getAllSizeByStatus($status)
    {
        $sizes = Size::where('status', $status)
            ->get();
        if ($sizes->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(SizeResource::collection($sizes), 'Ok', 200);
    }

    public function getAllSize()
    {
        $sizes = Size::all();
        if ($sizes->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(SizeResource::collection($sizes), 'Ok', 200);
    }

    public function getSizeByIdAndStatus($id, $status)
    {
        $size = Size::where([['size_id', '=', $id], ['status', '=', $status]])
            ->first();
        if ($size == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new SizeResource($size), 'Ok', 200);
    }

    public function getSizeById($id)
    {
        $size = Size::where('size_id', '=', $id)
            ->first();
        if ($size == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new SizeResource($size), 'Ok', 200);
    }

    public function getAllSizeByIdCategoryAndStatus($id, $status)
    {
        $size = Size::where([['category_id', '=', $id], ['status', '=', $status]])
            ->get();
        if ($size->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(SizeResource::collection($size), 'Ok', 200);
    }

    public function getAllSizeByProductIdAndColorIdAndStatusInStock($productId, $colorId, $status)
    {
        $sizes = Size::join('product_details', 'product_details.size_id', '=', 'sizes.size_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->where([['product_details.product_id', '=', $productId], ['product_details.color_id', '=', $colorId], ['sizes.status', '=', $status], ['stock_details.status', $status]])->distinct()
            ->get('sizes.*');
        if ($sizes->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(SizeResource::collection($sizes), 'Ok', 200);
    }

    public function getAllSizeByProductIdAndStatusInStock($productId, $status)
    {
        $sizes = Size::join('product_details', 'product_details.size_id', '=', 'sizes.size_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->where([['product_details.product_id', '=', $productId], ['sizes.status', '=', $status], ['stock_details.status', $status]])->distinct()
            ->get('sizes.*');
        if ($sizes->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(SizeResource::collection($sizes), 'Ok', 200);
    }


    public function saveSize(Request $req)
    {
        DB::beginTransaction();
        try {
            $size = new Size();
            $size->fill(
                [
                    'size_id' => "SIZE" . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis'),
                    'category_id' => $req->category_id,
                    'size_name' => $req->size_name,
                ]
            );
            if ($size->save() == 1) {
                $size = $this->getSizeById($size->size_id);
                DB::commit();
                return Payload::toJson(new SizeResource($size), 'Completed', 201);
            }
            return Payload::toJson(null, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateSize(Request $req)
    {
        DB::beginTransaction();
        try {
            $size = Size::where('size_id', $req->size_id)
                ->update(['size_name' => $req->size_name]);
            DB::commit();
            if ($size == 1) {
                return Payload::toJson($size, 'Completed', 200);
            }
            return Payload::toJson($size, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeSize(Request $req)
    {
        DB::beginTransaction();
        try {
            $size = Size::where('size_id', $req->size_id)
                ->update(['status' => $req->status]);
            DB::commit();
            if ($size == 1) {
                return Payload::toJson($size, 'Completed', 200);
            }
            return Payload::toJson($size, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}