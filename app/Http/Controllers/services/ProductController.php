<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\PaginationConvert;
use App\Models\Product;
use Carbon\Carbon;
use App\Http\Resources\ProductResource;
use App\Http\Payload;
use App\Models\Pagination;
use Exception;

class ProductController extends Controller
{
    public function getAllProductByStatus($status)
    {
        $products =  Product::where('status', $status)->get();
        if ($products->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductResource::collection($products), "Request Successfully", 200);
    }

    public function getProductByIdAndStatus($id, $status)
    {
        $product = Product::where([
            ['product_id', '=', $id],
            ['status', '=', $status]
        ])->first();
        if ($product == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new ProductResource($product), "Request Successfully", 200);
    }

    public function getProductById($id)
    {
        $product = Product::where([
            ['product_id', '=', $id]
        ])->first();
        if ($product == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new ProductResource($product), "Request Successfully", 200);
    }

    public function getAllProductByProducerId($producer_id)
    {
        $products = Product::where([
            ['producer_id', '=', $producer_id],
        ])->orderBy("created_at", "DESC")->get();
        if ($products->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductResource::collection($products), "Request Successfully", 200);
    }

    public function getAllProductByPriceRange($product_price1, $product_price2)
    {
        // $collection = Product::range($product_price1, $product_price2);
        // $collection->all();
        // return $collection;
        $products = Product::where(
            [
                ['price', '>=', $product_price1],
                ['price', '<=', $product_price2],
            ]
        )->get();
        if ($products->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductResource::collection($products), "Request Successfully", 200);
    }

    public function getAllProductByIdCategoryAndStatus($id, $status)
    {
        $products = Product::where([
            ['category_id', '=', $id],
            ['status', '=', $status]
        ])->get();
        if ($products->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductResource::collection($products), "Request Successfully", 200);
    }

    public function getAllProductByIdCategoryAndProducerIdStatus($category_id, $producer_id, $status)
    {
        $products = Product::where([
            ['category_id', '=', $category_id],
            ['producer_id', '=', $producer_id],
            ['status', '=', $status]
        ])->get();
        if ($products->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ProductResource::collection($products), "Request Successfully", 200);
    }

    public function getAllProductInStock(Request $request)
    {
        if ($request->has("status")) {
            $products = Product::select(DB::raw('products.*, stock_details.price_pay, IFNULL(SUM(case when bills.status = 1 then bill_details.quantity end),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star, count(favourite_id) as quantity_favourites'))
                ->join('categories', 'categories.category_id', '=', 'products.category_id')
                ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
                ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('rates', 'rates.product_id', '=', 'products.product_id')
                ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
                ->distinct()->groupBy('products.product_id')->inRandomOrder()->get();
        } else {
            $products = Product::select(DB::raw('products.*, stock_details.price_pay, IFNULL(SUM(case when bills.status = 1 then bill_details.quantity end),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star, count(favourite_id) as quantity_favourites'))
                ->join('categories', 'categories.category_id', '=', 'products.category_id')
                ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
                ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('rates', 'rates.product_id', '=', 'products.product_id')
                ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
                ->where("stock_details.status", 1)
                ->distinct()->groupBy('products.product_id')->inRandomOrder()->get();
        }

        if ($request->take != null && $request->currentPage != null && !$request->has("status")) {
            return $this->handlePaginationProduct($products, $request);
        }

        if ($products->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ProductResource::collection($products), 'OK', 200);
    }

    public function getAllProductByCategoryIdInStock(Request $request)
    {
        $searchID = $request->input('searchID');
        $products = Product::select(DB::raw('products.*, stock_details.price_pay, IFNULL(SUM(case when bills.status = 1 then bill_details.quantity end),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star, count(favourite_id) as quantity_favourites'))
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('rates', 'rates.product_id', '=', 'products.product_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
            ->where('categories.category_id', $searchID)
            ->distinct()->groupBy('products.product_id')->orderBy('product_name', 'ASC')->get();

        if ($request->all() != null) {
            return $this->handlePaginationProduct($products, $request);
        }

        if ($products == null)
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ProductResource::collection($products), 'OK', 200);
    }

    public function getAllProductByKeywordIdInStock(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::select(DB::raw('products.*, stock_details.price_pay, IFNULL(SUM(case when bills.status = 1 then bill_details.quantity end),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star, count(favourite_id) as quantity_favourites'))
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('rates', 'rates.product_id', '=', 'products.product_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
            ->FullTextSearch($keyword)
            ->distinct()->groupBy('products.product_id')->orderBy('product_name', 'ASC')->get();

        if (!is_null($request->user_id) && $keyword != '') {
            $requ = new Request([
                'activity' => 'Tìm kiếm từ khoá "' . $keyword . '"',
                'user_id' => $request->user_id,
                'object_id' => $keyword,
                'type' => 0
            ]);
            $actHisController = new ActivityHistoryController();

            $actHisController->saveActivityHistory($requ);
        }

        if ($request->all() != null && $request->status != 'all') {
            return $this->handlePaginationProduct($products, $request);
        }

        if ($products == null)
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ProductResource::collection($products), 'OK', 200);
    }

    public function saveProduct(Request $req)
    {
        DB::beginTransaction();
        try {
            $product = new Product();
            $product->fill(
                [
                    'product_id' => "PROD" . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis'),
                    'product_name' => $req->product_name,
                    'category_id' => $req->category_id,
                    'producer_id' => $req->producer_id,
                    'product_img' => $req->product_img,
                    'description' => $req->description,
                ]
            );
            $product->save();
            $product = Product::where('product_id', $product->product_id)->first();
            DB::commit();
            return Payload::toJson(new ProductResource($product), "Create Successfully", 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateProduct(Request $req)
    {
        DB::beginTransaction();
        try {
            $product = Product::where('product_id', $req->product_id)
                ->update(
                    ['product_name' => $req->product_name],
                    ['description' => $req->description],
                );
            DB::commit();
            if ($product == 1) {
                $product = Product::where('product_id', $req->product_id)->first();
                return Payload::toJson(new ProductResource($product), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeProduct(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Product::where('product_id', $req->product_id)
                ->update(['status' => $req->status]);
            if ($result) {
                $productDetailController = new ProductDetailController();
                $productDetailController->removeProductDetailByProductId($req);
                DB::commit();
                return Payload::toJson(true, "Remove Successfully", 202);
            }
            return Payload::toJson(false, "Cannot Remove", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getAllProductHotBuy($take = null)
    {
        if ($take != null) {
            $products = Product::select(DB::raw('products.*, stock_details.price_pay, IFNULL(SUM(bill_details.quantity),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star, count(favourite_id) as quantity_favourites'))
                ->join('categories', 'categories.category_id', '=', 'products.category_id')
                ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
                ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('rates', 'rates.product_id', '=', 'products.product_id')
                ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->join('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
                ->where([['bills.status', 1], ['stock_details.status', 1]])
                ->distinct()->groupBy('products.product_id')->orderBy('product_name', 'ASC')->take($take)->get();
        } else {
            $products = Product::select(DB::raw('products.*, stock_details.price_pay, IFNULL(SUM(bill_details.quantity),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star, count(favourite_id) as quantity_favourites'))
                ->join('categories', 'categories.category_id', '=', 'products.category_id')
                ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
                ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('rates', 'rates.product_id', '=', 'products.product_id')
                ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->join('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
                ->where([['bills.status', 1], ['stock_details.status', 1]])
                ->distinct()->groupBy('products.product_id')->orderBy('product_name', 'ASC')->get();
        }

        if (empty($products))
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ProductResource::collection($products), 'OK', 200);
    }

    public function getAllProductHotBuyByCategoryId($category_id, $take = null)
    {
        if ($take != null) {
            $products = Product::select(DB::raw('products.*, stock_details.price_pay, IFNULL(SUM(bill_details.quantity),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star, count(favourite_id) as quantity_favourites'))
                ->join('categories', 'categories.category_id', '=', 'products.category_id')
                ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
                ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('rates', 'rates.product_id', '=', 'products.product_id')
                ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->join('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
                ->where([['bills.status', '1'], ['categories.category_id', $category_id]])
                ->distinct()->groupBy('products.product_id')->orderBy('product_name', 'ASC')->take($take)->get();
        } else {
            $products = Product::select(DB::raw('products.*, stock_details.price_pay, IFNULL(SUM(bill_details.quantity),0) as quantity_pay, count(rates.product_id) as quantity_rate, IFNULL(avg(rates.star),0) as avg_star, count(favourite_id) as quantity_favourites'))
                ->join('categories', 'categories.category_id', '=', 'products.category_id')
                ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
                ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('rates', 'rates.product_id', '=', 'products.product_id')
                ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->join('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
                ->where('bills.status', '1')
                ->distinct()->groupBy('products.product_id')->orderBy('product_name', 'ASC')->get();
        }

        if (empty($products))
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ProductResource::collection($products), 'OK', 200);
    }

    public function getAllProductPopulatorByDate($date_start, $date_end, $take)
    {
        $statistics = Product::select(DB::raw("sum(bill_details.quantity) as quantity_sells,sum(bill_details.total_price) as total_sells,products.product_id,products.product_img,products.product_name,products.category_id,products.producer_id,bill_details.price"))
            ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
            ->join('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->join('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
            ->whereRaw("CAST(bills.date_order as DATE) >= '$date_start' and CAST(bills.date_order as DATE) <= '$date_end' and bills.status=1")
            ->groupBy('products.product_id', 'products.product_img', 'products.product_name', 'products.category_id', 'products.producer_id')
            ->orderBy('total_sells', 'DESC')
            ->take($take)
            ->get();

        $data = [];
        $i = 0;
        foreach ($statistics as $sts) {
            $data[$i] = [
                'product_id' => $sts->product_id,
                'product_img' => $sts->product_img,
                'product_name' => $sts->product_name,
                'category' => $sts->category,
                'producer' => $sts->producer,
                'price' => $sts->price,
                'quantity_sells' => $sts->quantity_sells,
                'total_sells' => $sts->total_sells
            ];
            $i++;
        }
        if ($data == [])
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($data, "Request Successfully", 200);
    }

    public function getAllProductPopulatorByCycle($week, $month, $year, $take)
    {
        $statistics = Product::select(DB::raw("sum(bill_details.quantity) as quantity_sells,sum(bill_details.total_price) as total_sells,products.product_id,products.product_img,products.product_name,products.category_id,products.producer_id"))
            ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
            ->join('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->join('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
            ->whereMonth('date_order', $month)
            ->whereYear('date_order', $year)
            ->groupBy('products.product_id', 'products.product_img', 'products.product_name', 'products.category_id', 'products.producer_id')
            ->orderBy('total_sells', 'DESC')
            ->take($take)
            ->get();

        $data = [];
        $i = 0;
        foreach ($statistics as $sts) {
            $weekOfMonthStatistics = Carbon::parse($sts->date_order)->weekOfMonth;
            if ($weekOfMonthStatistics == $week) {
                $data[$i] = [
                    'product_id' => $sts->product_id,
                    'product_img' => $sts->product_img,
                    'product_name' => $sts->product_name,
                    'category' => $sts->category,
                    'producer' => $sts->producer,
                    'quantity_sells' => $sts->quantity_sells,
                    'total_sells' => $sts->total_sells
                ];
            }
            $i++;
        }
        if ($data == [])
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($data, "Request Successfully", 200);
    }

    public function getAllProductHotFavourite($take = null)
    {
        if ($take != null) {
            $product_hot_favourites =  Product::select(DB::raw('count(favourite_id) as quantity_favourites,products.product_id,products.product_img,products.product_name,products.category_id,products.producer_id'))
                ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
                ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->join('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
                ->where('stock_details.status', 1)
                ->groupBy('products.product_id', 'products.product_img', 'products.product_name', 'products.category_id', 'products.producer_id')
                ->orderBy('quantity_favourites', 'DESC')
                ->take($take)
                ->get();
        } else {
            $product_hot_favourites =  Product::select(DB::raw('products.*, stock_details.price_pay,IFNULL(SUM(bill_details.quantity),0) as quantity_pay, count(favourite_id) as quantity_favourites'))
                ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
                ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->join('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
                ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
                ->where('stock_details.status', 1)
                ->groupBy('products.product_id', 'products.product_img', 'products.product_name', 'products.category_id', 'products.producer_id')
                ->orderBy('quantity_favourites', 'DESC')
                ->get();

            if ($product_hot_favourites == null)
                return Payload::toJson(null, 'Data Not Found', 404);
            return Payload::toJson(ProductResource::collection($product_hot_favourites), 'OK', 200);
        }

        $data = [];
        $i = 0;
        foreach ($product_hot_favourites as $phf) {
            $data[$i] = [
                'product_id' => $phf->product_id,
                'product_img' => $phf->product_img,
                'product_name' => $phf->product_name,
                'category' => $phf->category,
                'producer' => $phf->producer,
                'quantity_favourites' => $phf->quantity_favourites
            ];
            $i++;
        }
        if ($data == [])
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($data, "Request Successfully", 200);
    }

    public function getAllProductHotRateByDate($date_start = null, $date_end = null, $take = null)
    {
        if ($date_start != null && $date_end != null) {
            $product_hot_rates =  Product::select(DB::raw('count(rates.rate_id) as quantity_rates,products.product_id,products.product_img,products.product_name,products.category_id,products.producer_id'))
                ->join('rates', 'rates.product_id', '=', 'products.product_id')
                ->whereBetween('rates.date_rate', [$date_start, $date_end])
                ->groupBy('products.product_id', 'products.product_img', 'products.product_name', 'products.category_id', 'products.producer_id')
                ->orderBy('quantity_rates', 'DESC')
                ->take($take)
                ->get();
        } else {
            $product_hot_rates =  Product::select(DB::raw('count(rates.rate_id) as quantity_rates,products.product_id,products.product_img,products.product_name,products.category_id,products.producer_id'))
                ->join('rates', 'rates.product_id', '=', 'products.product_id')
                ->groupBy('products.product_id', 'products.product_img', 'products.product_name', 'products.category_id', 'products.producer_id')
                ->orderBy('quantity_rates', 'DESC')
                ->take($take)
                ->get();
        }

        $data = [];
        $i = 0;
        foreach ($product_hot_rates as $phr) {
            $data[$i] = [
                'product_id' => $phr->product_id,
                'product_img' => $phr->product_img,
                'product_name' => $phr->product_name,
                'category' => $phr->category,
                'producer' => $phr->producer,
                'quantity_rates' => $phr->quantity_rates
            ];
            $i++;
        }
        if ($data == [])
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($data, "Request Successfully", 200);
    }

    public function getAllProductHotRateByCycle($week, $month, $year)
    {
        $product_hot_rates =  Product::select(DB::raw('count(rates.rate_id) as quantity_rates,products.product_id,products.product_img,products.product_name,products.category_id,products.producer_id'))
            ->join('rates', 'rates.product_id', '=', 'products.product_id')
            ->whereMonth('rates.date_rate', $month)
            ->whereYear('rates.date_rate', $year)
            ->groupBy('products.product_id', 'products.product_img', 'products.product_name', 'products.category_id', 'products.producer_id')
            ->orderBy('quantity_rates', 'DESC')
            ->take(5)
            ->get();
        $data = [];
        $i = 0;
        foreach ($product_hot_rates as $phr) {
            $weekOfMonthPHR = Carbon::parse($phr->date_rate)->weekOfMonth;
            if ($weekOfMonthPHR == $week) {
                $data[$i] = [
                    'product_id' => $phr->product_id,
                    'product_img' => $phr->product_img,
                    'product_name' => $phr->product_name,
                    'category' => $phr->category,
                    'producer' => $phr->producer,
                    'quantity_rates' => $phr->quantity_rates
                ];
            }
            $i++;
        }
        if ($data == [])
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($data, "Request Successfully", 200);
    }

    public function getQuantitySellsByYear($year)
    {
        $quantitySells = DB::table('bills')->select(DB::raw('sum(total_quantity) as quantity_sells'))->whereYear('date_order', $year)->first();
        if ($quantitySells->quantity_sells == null) {
            return 0;
        }
        return $quantitySells->quantity_sells;
    }

    public function getInputAmountByYear($year)
    {
        $inputAmount = DB::table('bill_orders')
            ->selectRaw('sum(amount) as total_quantity')
            ->whereYear('date_order', $year)
            ->first();
        if ($inputAmount->total_quantity == null) {
            return 0;
        }
        return $inputAmount->total_quantity;
    }

    public function getAllStatisticsOfProduct()
    {
        $yearNow = Carbon::now()->format('Y');
        $sixYearAgo = $yearNow - 6;
        $arrQuantitySells = [];
        $arrQuantityInStocks = [];
        $j = 0;
        for ($i = $sixYearAgo; $i <= $yearNow; $i++) {
            $arrQuantitySells[$j] = $this->getQuantitySellsByYear($i);
            $arrQuantityInStocks[$j] = $this->getInputAmountByYear($i);
            $j++;
        }
        $data = [];
        $data[0] = $arrQuantitySells;
        $data[1] = $arrQuantityInStocks;
        return $data;
    }

    public function getAllRateOfProduct()
    {
        $arrRateOfNumberStar = [
            '5' => ['star' => 5, 'quantity_rates' => 0, 'percent' => 0],
            '4' => ['star' => 4, 'quantity_rates' => 0, 'percent' => 0],
            '3' => ['star' => 3, 'quantity_rates' => 0, 'percent' => 0],
            '2' => ['star' => 2, 'quantity_rates' => 0, 'percent' => 0],
            '1' => ['star' => 1, 'quantity_rates' => 0, 'percent' => 0]
        ];
        $dataRateOfNumberStar = DB::table('rates')
            ->selectRaw('count(rate_id) as quantity_rate, star')->groupBy('star')->get();
        $quantityAvgRates = DB::table('rates')->avg('star');
        $quantityAllRates = DB::table('rates')->count('rate_id');
        foreach ($dataRateOfNumberStar as $drons) {
            if ($drons->star == 5) {
                $arrRateOfNumberStar['5']['quantity_rates'] = $drons->quantity_rate;
                $arrRateOfNumberStar['5']['percent'] = (int)((int)(($drons->quantity_rate / $quantityAllRates) * 100) / 10) * 10;
            }
            if ($drons->star == 4) {
                $arrRateOfNumberStar['4']['quantity_rates'] = $drons->quantity_rate;
                $arrRateOfNumberStar['4']['percent'] = (int)((int)(($drons->quantity_rate / $quantityAllRates) * 100) / 10) * 10;
            }
            if ($drons->star == 3) {
                $arrRateOfNumberStar['3']['quantity_rates'] = $drons->quantity_rate;
                $arrRateOfNumberStar['3']['percent'] = (int)((int)(($drons->quantity_rate / $quantityAllRates) * 100) / 10) * 10;
            }
            if ($drons->star == 2) {
                $arrRateOfNumberStar['2']['quantity_rates'] = $drons->quantity_rate;
                $arrRateOfNumberStar['2']['percent'] = (int)((int)(($drons->quantity_rate / $quantityAllRates) * 100) / 10) * 10;
            }
            if ($drons->star == 1) {
                $arrRateOfNumberStar['1']['quantity_rates'] = $drons->quantity_rate;
                $arrRateOfNumberStar['1']['percent'] = (int)((int)(($drons->quantity_rate / $quantityAllRates) * 100) / 10) * 10;
            }
        }
        $data = [
            'quantityAvgRates' => number_format($quantityAvgRates, 1),
            'quantityAllRates' => $quantityAllRates,
            'arrRateOfNumberStar' => $arrRateOfNumberStar
        ];
        return $data;
    }

    protected function handlePaginationProduct($products, Request $request)
    {
        $take = $request->input('take');
        if (is_null($take)) {
            $take = 12;
        }

        $currentPage = (int)$request->input('currentPage');
        if ($currentPage != null) {
            $skip = ($currentPage - 1) * $take;
        } else {
            $skip = 0;
            $currentPage = 1;
        }
        $productPagination = $products->skip($skip)->take($take);
        $pagination = new Pagination($productPagination->count());
        $pagination->totalSearchResult = $products->count();
        $data = ProductResource::collection($productPagination);
        return Payload::toJson(PaginationConvert::convert($data, $pagination), 'OK', 200);
    }

    public function getAllStockDetailHotFavouriteBySearchKeyword(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::select(DB::raw('products.*, stock_details.price_pay, count(favourite_id) as quantity_favourites'))
            ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('favourites', 'favourites.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->FullTextSearch($keyword)
            ->distinct()->groupBy('products.product_id')->orderBy('quantity_favourites', 'DESC')->get();

        if ($products == null)
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ProductResource::collection($products), 'OK', 200);
    }

    public function getAllStockDetailNewProductBySearchKeyword(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::select(DB::raw('products.*, stock_details.price_pay'))
            ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->FullTextSearch($keyword)
            ->distinct()->groupBy('products.product_id')->orderBy('products.created_at', 'DESC')->get();

        if ($products == null)
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ProductResource::collection($products), 'OK', 200);
    }


    public function getAllStockDetailBestSellerBySearchKeyword(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::select(DB::raw('products.*, stock_details.price_pay, IFNULL(SUM(case when bills.status = 1 then bill_details.quantity end),0) as quantity_pay'))
            ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('bill_details', 'bill_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->leftJoin('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
            ->FullTextSearch($keyword)
            ->distinct()->groupBy('products.product_id')->orderBy('quantity_pay', 'DESC')->get();

        if ($products == null)
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ProductResource::collection($products), 'OK', 200);
    }
}