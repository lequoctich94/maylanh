<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductDetail;
use Carbon\Carbon;
use App\Http\Resources\ProductDetailResource;
use App\Http\Payload;
use Exception;
use App\Helper\ProductDetailHelper;

class ProductDetailController extends Controller
{
    public function getProductDetailById($id)
    {
        $product_detail = ProductDetail::where([
            ['product_detail_id', $id]
        ])->first();
        if ($product_detail == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new ProductDetailResource($product_detail), "Request Successfully", 200);
    }

    public function getAllProductDetailByIdProduct($id)
    {
        $product_details = ProductDetail::where([
            ['product_id', '=', $id],
        ])->with('size')->get();
        if ($product_details->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductDetailResource::collection($product_details), "Request Successfully", 200);
    }

    public function getFirstProductDetailByProductIdAndStatus($id, $status)
    {
        $product_details = ProductDetail::where([
            ['product_id', '=', $id],
            ['status', '=', $status],
        ])->first();

        if (is_null($product_details))
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new ProductDetailResource($product_details), "Request Successfully", 200);
    }

    public function getAllProductDetailByProductIdAndStatus($id, $status)
    {
        $product_details = ProductDetail::where([
            ['product_id', '=', $id],
            ['status', '=', $status],
        ])->get();
        if ($product_details->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductDetailResource::collection($product_details), "Request Successfully", 200);
    }

    public function getAllProductDetailByIdProductAndIdSize($product_id, $size_id)
    {
        $product_details = ProductDetail::where([
            ['product_id', '=', $product_id],
            ['size_id', '=', $size_id],
        ])->get();
        if ($product_details->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductDetailResource::collection($product_details), "Request Successfully", 200);
    }

    public function getAllProductDetailByIdProductAndIdColor($product_id, $color_id)
    {
        $product_details = ProductDetail::where([
            ['product_details.product_id', '=', $product_id],
            ['product_details.color_id', '=', $color_id],
            ['product_details.status', 1]
        ])->get();
        if ($product_details->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductDetailResource::collection($product_details), "Request Successfully", 200);
    }

    public function getAllProductDetailByProducerId($product_id)
    {
        $product_details = ProductDetail::join('products', 'products.product_id', 'product_details.product_id')->where([['producer_id', '=', $product_id]])->get();
        if ($product_details->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductDetailResource::collection($product_details), "Request Successfully", 200);
    }


    //cu bo
    public function saveProductDetail(Request $req)
    {
        DB::beginTransaction();
        try {
            //Case select muiltiple
            if (is_array($req->size_id)) {
                $reqNew = new Request([
                    'product_id' => $req->product_id,
                    'price_produced' => $req->price_produced,
                    'color_id' => $req->color_id,
                    'power' => $req->power,
                    'power_unit' => $req->power_unit,
                ]);
                foreach ($req->size_id as $size_id) {
                    $reqNew['product_detail_id'] = ProductDetailHelper::createProductDetailId($reqNew->product_id, $reqNew);
                    $reqNew['size_id'] = $size_id;
                    $product_detail = $this->buildProductDetail($reqNew);
                    $product_detail->save();
                }
            } else {
                $product_detail = $this->buildProductDetail($req);
                $product_detail->save();
            }
            DB::commit();
            return Payload::toJson(true, "Create Successfully", 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    private function buildProductDetail($req)
    {
        $product_detail = new ProductDetail();
        $product_detail->fill(
            [
                'product_detail_id' => ProductDetailHelper::createProductDetailId($req->product_id, $req),
                'product_id' => $req->product_id,
                'size_id' => $req->size_id,
                'status' => 1,
                'color_id' => $req->color_id,
                'price_produced' => $req->price_produced,
                'power' => $req->power,
                'power_unit' => $req->power_unit,
                //'price_produced_for_sale' => $req->price_produced_for_sale
            ]
        );
        return $product_detail;
    }

    public function updatePriceProductDetail(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = ProductDetail::where('product_detail_id', $req->product_detail_id)
                ->update(['price_produced' => $req->price_produced]);
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

    public function removeProductDetail(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = ProductDetail::where('product_detail_id', $req->product_detail_id)
                ->update(['status' => $req->status]);
            DB::commit();
            if ($result == 1) {
                $product_detail = ProductDetail::where('product_detail_id', $req->product_detail_id)->first();
                return Payload::toJson(new ProductDetailResource($product_detail), "Remove Successfully", 201);
            }
            return Payload::toJson(null, "Cannot Remove", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeProductDetailByProductId($req)
    {
        DB::beginTransaction();
        try {
            $result = ProductDetail::where('product_id', $req->product_id)
                ->update(['status' => $req->status]);
            if ($result) {
                DB::commit();
                return Payload::toJson(true, "Remove Successfully", 201);
            }
            return Payload::toJson(null, "Cannot Remove", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}