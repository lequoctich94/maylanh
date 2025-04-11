<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\BillController as ServicesBillController;
use App\Http\Controllers\services\MemberController as ServicesMemberController;
use App\Http\Controllers\services\ProductController as ServicesProductController;

class HomeController extends Controller
{
    public function index()
    {
        $billController = new ServicesBillController();
        $memberController = new ServicesMemberController();
        $productController = new ServicesProductController();
        $data_bill_quantity = $billController->getQuantityAllBillInThisMonth();
        $data_bill_total_price = $billController->getTotalPriceAllBillInThisMonth();
        $data_quantity_member = $memberController->getAllMember();
        $data_rate_of_product = $productController->getAllRateOfProduct();
        $data_product_hot_favourite = $productController->getAllProductHotFavourite(5);

        $bill_pay_total_quantity = 0;
        $quantity_member = 0;
        $product_hot_favourites = [];
        if ($data_bill_quantity['data'] != null) {
            $bill_pay_total_quantity = count($data_bill_quantity['data']);
        }
        if ($data_quantity_member['data'] != null) {
            $quantity_member = count($data_quantity_member['data']);
        }
        if ($data_product_hot_favourite['data'] != null)
            $product_hot_favourites = $data_product_hot_favourite['data'];
        $bill_pay_total_price = $data_bill_total_price['data'];

        return view(
            'home/index',
            [
                'rate_of_products' => $data_rate_of_product,
                'product_hot_favourites' => $product_hot_favourites,
                'quantity_member' => $quantity_member,
                'total_quantity' => $bill_pay_total_quantity,
                'total_price' => $bill_pay_total_price,
            ]
        );
    }
}