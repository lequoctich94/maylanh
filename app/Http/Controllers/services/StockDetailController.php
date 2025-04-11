<?php

namespace App\Http\Controllers\services;

use App\Http\Payload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StockDetail;
use App\Http\Resources\StockDetailResource;
use Exception;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class StockDetailController extends Controller
{
    public function getAllProductDetailInStockByStatus($status)
    {
        $stock_details = StockDetail::where('status', $status)
            ->get();
        if ($stock_details->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(StockDetailResource::collection($stock_details), 'Ok', 200);
    }

    public function getAllProductDetailInStock()
    {
        $stock_details = StockDetail::all();
        if ($stock_details->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(StockDetailResource::collection($stock_details), 'Ok', 200);
    }

    public function getAllProductInStockAndRateAndPayByStatus($status)
    {
        // $stock_details = DB::select("select stock_details.*,products.product_name,SUM(bill_details.quantity) as quantity_pay, count(rates.product_id) as quantity_rate
        // FROM ptpstore.stock_details inner join ptpstore.product_details on stock_details.product_detail_id = product_details.product_detail_id
        // inner join ptpstore.products on product_details.product_id = products.product_id 
        // left join ptpstore.rates on  products.product_id = rates.product_id
        // left join ptpstore.bill_details on product_details.product_detail_id = bill_details.product_detail_id
        // where stock_details.status = $status
        // group by products.product_id"
        // );

        $stock_details = StockDetail::select(DB::raw('stock_details.*, sum(bill_details.quantity) as quantity_pay,0 as quantity_rate, 0 as avg_star'))
            ->join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->join('products', 'products.product_id', '=', 'product_details.product_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->where('stock_details.status', $status)
            ->groupBy('products.product_id')->get();

        $quantityAndAvgRates = DB::select(DB::raw(
            'select rates.product_id, count(rates.product_id) as quantity_rate, avg(rates.star) as avg_star
                    from ptpstore.rates,ptpstore.products where rates.product_id = products.product_id
                    group by rates.product_id'
        ));

        for ($i = 0; $i < count($stock_details); $i++) {
            foreach ($quantityAndAvgRates as $tmp) {
                if ($stock_details[$i]->product_detail->product->product_id == $tmp->product_id) {
                    $stock_details[$i]->quantity_rate = $tmp->quantity_rate;
                    $stock_details[$i]->avg_star = $tmp->avg_star;
                }
            }
        }
        if ($stock_details->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(StockDetailResource::collection($stock_details), 'Ok', 200);
    }


    public function getFirstStockDetailByProductId($product_id)
    {
        $stock_detail = StockDetail::select(DB::raw('stock_details.*, IFNULL(SUM(bill_details.quantity),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star'))
            ->join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->leftJoin('rates', 'rates.product_id', '=', 'product_details.product_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->where([['product_details.product_id', $product_id], ['stock_details.status', 1]])
            ->groupBy('product_details.product_id')->first();
        if ($stock_detail == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new StockDetailResource($stock_detail), 'Ok', 200);
    }

    public function getAllStockDetailByProductIdAndStatus($product_id, $status)
    {
        $stock_details = StockDetail::join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->join('products', 'products.product_id', '=', 'product_details.product_id')
            ->join('colors', 'colors.color_id', '=', 'product_details.color_id')
            ->join('sizes', 'sizes.size_id', '=', 'product_details.size_id')
            ->where([['product_details.product_id', $product_id], ['stock_details.status', $status]])->orderBy('colors.color_name', 'ASC')->orderBy('sizes.size_name', 'ASC')->orderBy('stock_details.price_pay', 'ASC')->get('stock_details.*');
        if ($stock_details->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(StockDetailResource::collection($stock_details), 'Ok', 200);
    }

    public function getAllStockDetailByProductId($product_id)
    {
        $stock_details = StockDetail::join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->join('products', 'products.product_id', '=', 'product_details.product_id')
            ->join('colors', 'colors.color_id', '=', 'product_details.color_id')
            ->join('sizes', 'sizes.size_id', '=', 'product_details.size_id')
            ->where([['product_details.product_id', $product_id]])->orderBy('colors.color_name', 'ASC')->orderBy('sizes.size_name', 'ASC')->orderBy('stock_details.price_pay', 'ASC')->get('stock_details.*');
        if ($stock_details->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(StockDetailResource::collection($stock_details), 'Ok', 200);
    }

    public function getAllStockDetailByProductIdAndColorId($product_id, $color_id)
    {
        $stock_details = StockDetail::join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->join('products', 'products.product_id', '=', 'product_details.product_id')
            ->where([['product_details.product_id', $product_id], ['product_details.color_id', $color_id]])->get('stock_details.*');
        if ($stock_details->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(StockDetailResource::collection($stock_details), 'Ok', 200);
    }

    public function checkQuantityProductDetailInStock($id, $quantity)
    {
        $stock_detail = StockDetail::where([['product_detail_id', $id], ['quantity', '>=', $quantity]])
            ->first();
        if ($stock_detail != null)
            return Payload::toJson(true, 'Ok', 200);
        return Payload::toJson(false, 'Quantity not enough', 400);
    }

    public function getStockDetailByProductIdAndColorIdAndSizeId($product_id, $color_id, $size_id)
    {
        $stock_details = StockDetail::join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->where([['product_details.product_id', $product_id], ['product_details.size_id', $size_id], ['product_details.color_id', $color_id]])->first('stock_details.*');
        if ($stock_details == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new StockDetailResource($stock_details), 'Ok', 200);
    }

    public function getProductDetailInStockByProductDetailIdAndStatus($id, $status)
    {
        $stock_detail = StockDetail::select(DB::raw('stock_details.*, IFNULL(SUM(bill_details.quantity),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star'))
            ->join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->leftJoin('rates', 'rates.product_id', '=', 'product_details.product_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->where([['stock_details.product_detail_id', '=', $id], ['stock_details.status', '=', $status]])
            ->first();
        // dd($stock_detail);
        if ($stock_detail == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new StockDetailResource($stock_detail), 'Ok', 200);
    }

    public function getProductDetailInStockByProductDetailId($id)
    {
        $stock_detail = StockDetail::where('product_detail_id', $id)
            ->first();
        return new StockDetailResource($stock_detail);
    }

    public function saveProductDetailInStock($reqs)
    {
        DB::beginTransaction();
        try {
            $isUpdate = true;
            if (is_array($reqs)) {
                foreach ($reqs as $req) {
                    $stock_detail = StockDetail::where('product_detail_id', $req->product_detail_id)->first();
                    if ($stock_detail != null) {
                        $this->addQuantityProductDetailInStock($req);
                    } else {
                        $stock_detail = new StockDetail();
                        $stock_detail->fill(
                            [
                                'stock_detail_id' => $req->stock_id . $req->product_detail_id,
                                'stock_id' => $req->stock_id,
                                'product_detail_id' => $req->product_detail_id,
                                'price_pay' => $req->price_pay,
                                'quantity' => $req->quantity,
                                'total_price' => ($req->quantity * $req->price_pay),
                            ]
                        );

                        if ($stock_detail->save() != 1) {
                            $isUpdate = false;
                            break;
                        }
                    }
                }
            } else {
                //Order agian
                $this->addQuantityProductDetailInStock($reqs);
            }

            if ($isUpdate) {
                DB::commit();
                return Payload::toJson(true, 'Completed', 201);
            } else {
                return Payload::toJson(false, 'Uncompleted', 500);
            }
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateQuantityProductDetailInStock(Request $req)
    {
        $result = DB::update("update ptpstore.stock_details set quantity = quantity - $req->quantity,total_price = quantity*price_pay where stock_details.product_detail_id = '$req->product_detail_id'");
        if ($result == 1) {
            return Payload::toJson(true, 'Completed', 200);
        }
        return Payload::toJson(false, 'Uncompleted', 500);
    }

    public function addQuantityProductDetailInStock(Request $req)
    {
        DB::beginTransaction();
        try {
            $stock_detail = $this->getProductDetailInStockByProductDetailId($req->product_detail_id);

            $total_price = $req->quantity * $req->price_pay;

            $result = StockDetail::where('product_detail_id', $req->product_detail_id)->update(
                [
                    'quantity' => $stock_detail->quantity + $req->quantity,
                    'total_price' => $stock_detail->total_price + $total_price,
                    'price_pay' => $req->price_pay,
                ],
            );
            if ($result == 1) {
                DB::commit();
                return Payload::toJson($result, 'Completed', 200);
            }
            return Payload::toJson($result, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeProductDetailInStock(Request $req)
    {
        DB::beginTransaction();
        try {
            $sd = StockDetail::where('product_detail_id', $req->product_detail_id)
                ->update(['status' => $req->status]);
            DB::commit();
            if ($sd == 1) {
                return Payload::toJson($sd, 'Completed', 200);
            }
            return Payload::toJson($sd, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeProductInStock(Request $req)
    {
        DB::beginTransaction();
        try {
            $sd = StockDetail::join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
                ->where('product_details.product_id', $req->product_id)
                ->update(['stock_details.status' => $req->status]);

            if ($sd) {
                DB::commit();
                return Payload::toJson($sd, 'Completed', 200);
            }
            return Payload::toJson($sd, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updatePricePayInStock(Request $req)
    {
        DB::beginTransaction();
        try {
            $sd = StockDetail::where('product_detail_id', $req->product_detail_id)
                ->update(['price_pay' => $req->price_pay,'sale_off' => $req->sale_off]);
            DB::commit();
            if ($sd == 1) {
                return Payload::toJson($sd, 'Completed', 200);
            }
            return Payload::toJson($sd, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getAllStockDetailHotFavouriteBySearchKeyword($key)
    {
        $stock_details =  StockDetail::select(
            DB::raw('stock_details.*,count(favourites.favourite_id) as quantity_favourites, sum(bill_details.quantity) as quantity_pay,0 as quantity_rate, 0 as avg_star')
        )
            ->join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->join('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
            ->join('products', 'products.product_id', '=', 'product_details.product_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->whereRaw('products.product_name like "%' . $key . '%"')
            ->groupBy('products.product_id')
            ->orderBy('quantity_favourites', 'DESC')
            ->get();
        if ($stock_details->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(StockDetailResource::collection($stock_details), "Request Successfully", 200);
    }

    public function getAllStockDetailNewProductBySearchKeyword($key)
    {
        $stock_details =  StockDetail::select(
            DB::raw('stock_details.*, sum(bill_details.quantity) as quantity_pay,0 as quantity_rate, 0 as avg_star')
        )
            ->join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->join('products', 'products.product_id', '=', 'product_details.product_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->whereRaw('products.product_name like "%' . $key . '%"')
            ->groupBy('products.product_id')
            ->orderBy('products.created_at', 'DESC')
            ->get();

        if ($stock_details->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(StockDetailResource::collection($stock_details), "Request Successfully", 200);
    }

    public function getAllStockDetailBestSellerBySearchKeyword($key)
    {
        $stock_details =  StockDetail::select(
            DB::raw('stock_details.*, sum(bill_details.quantity) as quantity_pay,0 as quantity_rate, 0 as avg_star')
        )
            ->join('product_details', 'product_details.product_detail_id', '=', 'stock_details.product_detail_id')
            ->join('products', 'products.product_id', '=', 'product_details.product_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->whereRaw('products.product_name like "%' . $key . '%"')
            ->groupBy('products.product_id')
            ->orderBy('quantity_pay', 'DESC')
            ->get();

        if ($stock_details->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(StockDetailResource::collection($stock_details), "Request Successfully", 200);
    }

    public function checkProductDetailIsExistInStock($product_detail_id)
    {
        $stock_detail = StockDetail::where([['product_detail_id', $product_detail_id], ['status', 1]])->first();
        if (!is_null($stock_detail)) {
            return 1;
        }
        return 0;
    }
}