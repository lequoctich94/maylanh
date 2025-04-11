<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\services\ProductController as ServicesProductController;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function productStatistics()
    {
        $productController = new ServicesProductController();
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data_statistics_product = $productController->getAllProductPopulatorByDate($dateNow, $dateNow, 5);
        $data_product_hot_favourite = $productController->getAllProductHotFavourite(5);
        $data_product_hot_rate = $productController->getAllProductHotRateByDate($dateNow, $dateNow, 5);
        $data_rate_of_product = $productController->getAllRateOfProduct();
        $statistics_products = [];
        $product_hot_favourites = [];
        $product_hot_rates = [];
        $total = 0;

        if ($data_statistics_product['data'] != null) {
            $statistics_products = $data_statistics_product['data'];
            for ($i = 0; $i < count($statistics_products); $i++) {
                $total += $statistics_products[$i]['total_sells'];
            }
        }

        if ($data_product_hot_favourite['data'] != null)
            $product_hot_favourites = $data_product_hot_favourite['data'];

        if ($data_product_hot_rate['data'] != null)
            $product_hot_rates = $data_product_hot_rate['data'];

        return view(
            'statistics_product_management/statistics_product',
            [
                'statistics_products' => $statistics_products,
                'product_hot_favourites' => $product_hot_favourites,
                'product_hot_rates' => $product_hot_rates,
                'rate_of_products' => $data_rate_of_product,
                'dateNow' => $dateNow,
                'total' => $total
            ]
        );
    }

    public function statisticsOfProductWithTheHighestTotalSalesByDate($date_start = null, $data_end = null)
    {
        $productController = new ServicesProductController();
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data_statistics_product = $productController->getAllProductPopulatorByDate($date_start, $data_end, 5);
        $statistics_products = [];
        $total = 0;

        if ($data_statistics_product['data'] != null) {
            $statistics_products = $data_statistics_product['data'];
            for ($i = 0; $i < count($statistics_products); $i++) {
                $total += $statistics_products[$i]['total_sells'];
            }
        }
        return view(
            'statistics_product_management/statistics_product_with_the_highest_total_sales_render',
            [
                'statistics_products' => $statistics_products,
                'dateNow' => $dateNow,
                'total' => $total
            ]
        )->render();
    }

    public function statisticsOfProductWithTheHighestTotalSalesByCycle($week = null, $month = null, $year = null)
    {
        $productController = new ServicesProductController();
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data_statistics_product = $productController->getAllProductPopulatorByCycle($week, $month, $year, 5);
        $statistics_products = [];
        $total = 0;

        if ($data_statistics_product['data'] != null) {
            $statistics_products = $data_statistics_product['data'];
            for ($i = 0; $i < count($statistics_products); $i++) {
                $total += $statistics_products[$i]['total_sells'];
            }
        }

        return view(
            'statistics_product_management/statistics_product_with_the_highest_total_sales_render',
            [
                'statistics_products' => $statistics_products,
                'dateNow' => $dateNow,
                'total' => $total
            ]
        )->render();
    }

    public function statisticsOfProductWithTheMostReviewByDate($date_start = null, $data_end = null)
    {
        $productController = new ServicesProductController();
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data_product_hot_rate = $productController->getAllProductHotRateByDate($date_start, $data_end, 5);
        $product_hot_rates = [];
        $total = 0;

        if ($data_product_hot_rate['data'] != null)
            $product_hot_rates = $data_product_hot_rate['data'];

        return view(
            'statistics_product_management/statistics_of_products_with_the_most_review_render',
            [
                'product_hot_rates' => $product_hot_rates,
                'dateNow' => $dateNow,
                'total' => $total
            ]
        )->render();
    }

    public function statisticsOfProductWithTheMostReviewByCycle($week = null, $month = null, $year = null)
    {
        $productController = new ServicesProductController();
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data_product_hot_rate = $productController->getAllProductHotRateByCycle($week, $month, $year);
        $product_hot_rates = [];
        $total = 0;

        if ($data_product_hot_rate['data'] != null)
            $product_hot_rates = $data_product_hot_rate['data'];

        return view(
            'statistics_product_management/statistics_of_products_with_the_most_review_render',
            [
                'product_hot_rates' => $product_hot_rates,
                'dateNow' => $dateNow,
                'total' => $total
            ]
        )->render();
    }
}
