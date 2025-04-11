<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\services\ProductController;
use App\Http\Controllers\services\CategoryController;

class UProductController extends Controller
{
    protected $productController;

    public function __construct()
    {
        $this->productController = new ProductController();
    }

    private function setDefaultPagination(Request $request)
    {
        if ($request->input('currentPage') == null) {
            $request['currentPage'] = 1;
        }
        if ($request->input('take') == null) {
            $request['take'] = 12;
        }
    }

    public function product(Request $request)
    {
        $this->setDefaultPagination($request);

        $searchID = $request->input('searchID');
        $keyword = $request->input("keyword");
        $product_results = [];
        $product_pagination = null;
        $category_name = null;
        $keyword_search = null;

        if ($keyword != null && $searchID == null) {
            $request['user_id'] = request()->session()->has("member") ? request()->session()->get("member")->user_id : null;
            $product_response = $this->productController->getAllProductByKeywordIdInStock($request);
            $keyword_search = $keyword;
        } else if ($searchID != null) {
            $product_response = $this->productController->getAllProductByCategoryIdInStock($request);
        } else {
            $product_response = $this->productController->getAllProductInStock($request);
        }

        if ($product_response['data']['result'] != null && !$product_response['data']['result']->collection->isEmpty()) {
            $product_pagination = $product_response['data']['pagination'];
            $product_results = $product_response['data']['result']->collection;
            //Show category name in header
            if ($searchID != null) {
                $indexFirst = $product_pagination->indexFrom - 1;
                $category_name = $product_results[$indexFirst]->category->category_name;
            }
        }

        $categoryController = new CategoryController();
        $category_response = $categoryController->getAllCategoryInStock();
        $category_result = [];
        if ($category_response['data'] != null) {
            $category_result = $category_response['data']->collection;
        }

        $product_hot_buy_response = $this->productController->getAllProductHotBuy(6);
        $product_hot_buy_results = [];
        if ($product_hot_buy_response['data'] != null) {
            $product_hot_buy_results = $product_hot_buy_response['data'];
        }

        return view(
            'user/product/product',
            ['searchID' => $searchID, 'keyword_search' => $keyword_search, 'category_name' => $category_name, 'product_hots' => $product_hot_buy_results, 'categories' => $category_result, 'products' => $product_results, 'pagination' => $product_pagination]
        );
    }

    public function productTableRender(Request $request)
    {
        $this->setDefaultPagination($request);

        $searchID = $request->input('searchID');
        $keyword = $request->input("keyword");

        if ($keyword != null && $searchID == null) {
            $request['user_id'] = request()->session()->get("member")->user_id;
            $product_response = $this->productController->getAllProductByKeywordIdInStock($request);
        } else if ($searchID != null) {
            $product_response = $this->productController->getAllProductByCategoryIdInStock($request);
        } else {
            $product_response = $this->productController->getAllProductInStock($request);
        }

        $product_results = [];
        $product_pagination = null;
        if ($product_response['data']['result'] != null && !$product_response['data']['result']->collection->isEmpty()) {
            $product_results = $product_response['data']['result']->collection;
        }
        $product_pagination = $product_response['data']['pagination'];
        return view(
            'user/product/product-render-table',
            ['products' => $product_results, 'pagination' => $product_pagination]
        )->render();
    }
}
