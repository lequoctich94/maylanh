<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Resources\ColorResource;
use App\Http\Payload;
use Exception;

class ColorController extends Controller
{
    public function getColorById($id)
    {
        $color = Color::where('color_id', $id)->first();
        if ($color == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(new ColorResource($color), 'OK', 200);
    }
    public function getAllColorByStatus($status)
    {
        $colors = Color::where('status', $status)->get();
        if ($colors->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(ColorResource::collection($colors), 'OK', 200);
    }

    public function getColorByProductIdAndStatus($product_id, $status)
    {
        $colors = Color::join('images', 'images.color_id', '=', 'colors.color_id')->where([['images.status', $status], ['images.product_id', $product_id]])->distinct()->get('colors.*');
        if ($colors->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(ColorResource::collection($colors), 'OK', 200);
    }

    public function getAllColorByProductIdAndStatusInStock($product_id, $status)
    {
        $colors = Color::join('product_details', 'product_details.color_id', '=', 'colors.color_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->where([['product_details.product_id', $product_id], ['colors.status', $status], ['stock_details.status', $status]])->distinct()->get('colors.*');
        if ($colors->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(ColorResource::collection($colors), 'OK', 200);
    }

    public function getAllColorByProductIdAndSizeIdAndStatusInStock($product_id, $size_id, $status)
    {
        $colors = Color::join('product_details', 'product_details.color_id', '=', 'colors.color_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->where([['product_details.product_id', $product_id], ['product_details.size_id', $size_id], ['colors.status', $status], ['stock_details.status', $status]])->distinct()->get('colors.*');
        if ($colors->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(ColorResource::collection($colors), 'OK', 200);
    }

    public function getAllColor()
    {
        $colors = Color::all();
        if ($colors->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(ColorResource::collection($colors), 'OK', 200);
    }

    public function getColorByIdAndStatus($id, $status)
    {
        $color = Color::where([['color_id', $id], ['status', $status]])->first();
        if ($color == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }

        return Payload::toJson(new ColorResource($color), 'OK', 200);
    }

    public function removeColor(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Color::where('color_id', $req->color_id)->update(['status' => $req->status]);

            if ($result == 1) {
                $color = $this->getColorById($req->color_id)['data'];
                DB::commit();
                return Payload::toJson(new ColorResource($color), 'Removed Successfully', 202);
            }
            return Payload::toJson(null, 'Cannot Remove', 404);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateColor(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Color::where('color_id', $req->color_id)->update(['color_name' => $req->color_name]);
            DB::commit();
            if ($result == 1) {
                $color = $this->getColorById($req->color_id)['data'];
                return Payload::toJson(new ColorResource($color), 'Updated Successfully', 202);
            }
            return Payload::toJson(null, 'Cannot Update', 404);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function saveColor(Request $req)
    {
        DB::beginTransaction();
        try {
            $color = new Color();
            $color->fill([
                'color_id' => "CL" . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis'),
                'color_name' => $req->color_name,
            ]);
            $color->save();
            $color = $this->getColorById($color->color_id)['data'];
            DB::commit();
            return Payload::toJson(new ColorResource($color), 'Created Successfully', 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}