<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\CategoryController;
use App\Http\Controllers\services\ProductController;
use Illuminate\Http\Request;

class UHomeController extends Controller
{
    protected $productController;
    protected $categoryController;

    public function __construct()
    {
        $this->productController = new ProductController();
        $this->categoryController = new CategoryController();
    }

    public function index()
    {
        // ===== PRODUCT START ===== 
        $product_response = $this->productController->getAllProductInStock(new Request());
        if (!is_null($product_response['data'])) {
            $this->viewData['products'] = $product_response['data']->collection;
        }

        $product_hot_favourite_response = $this->productController->getAllProductHotFavourite();
        if ($product_hot_favourite_response['data'] != null) {
            $this->viewData['product_hot_favourites'] = $product_hot_favourite_response['data'];
        }
        $product_hot_buy_response = $this->productController->getAllProductHotBuy(6);
        if ($product_hot_buy_response['data'] != null) {
            $this->viewData['product_hot_buys'] = $product_hot_buy_response['data']->collection;
        }
        // ===== PRODUCT END ===== 

        // ===== CATEGORY START =====

        $category_response = $this->categoryController->getAllCategoryInStock();
        $this->viewData['categories'] = [];
        if ($category_response['data'] != null) {
            $this->viewData['categories'] = $category_response['data']->collection;
        }
        // ===== CATEGORY END ===== 

        return view('user/home/index', $this->viewData);
    }

    public function loadViewProductPopulator($category_id, $take)
    {
        if ($category_id == 'all') {
            $product_hot_buy_response = $this->productController->getAllProductHotBuy($take);
        } else {
            $product_hot_buy_response = $this->productController->getAllProductHotBuyByCategoryId($category_id, $take);
        }
        if ($product_hot_buy_response['data'] != null) {
            $this->viewData['product_hot_buys'] = $product_hot_buy_response['data']->collection;
        }
        return view('user.home.product_hot_buy_render', $this->viewData)->render();
    }

    public function orderCheck()
    {
        return view(
            'user/order_check/order_check',
        );
    }


    public function userRegister()
    {
        return view(
            'user/register/register',
        );
    }

    public function introduce()
    {
        return view(
            'user/introduce/introduce',
        );
    }
    public function aboutUs()
    {
        return view(
            'user/introduce/about_us',
        );
    }
    public function contact()
    {
        return view(
            'user/contact/contact',
        );
    }
    public function news()
    {
        return view(
            'user/news/news',
        );
    }
    public function policy()
    {
        return view(
            'user/policy/policy',
        );
    }
    public function shoppingGuide()
    {
        return view(
            'user/shopping_guide/shopping_guide',
        );
    }
    public function tradingGuide()
    {
        return view(
            'user/trading_guide/trading_guide',
        );
    }
    public function deliveryAndExchange()
    {
        return view(
            'user/delivery_and_exchange/delivery_and_exchange',
        );
    }
    public function notFound()
    {
        return view(
            'user/404/404',
        );
    }
}