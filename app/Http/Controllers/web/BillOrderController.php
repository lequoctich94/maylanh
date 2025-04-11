<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\services\BillOrderController as ServicesBillOrderController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillOrderController extends Controller
{
    public function BillOrderManagement()
    {
        $billOrderController = new ServicesBillOrderController();
        $data_bill_order = $billOrderController->getAllBillOrder();
        $bill_orders = [];

        if ($data_bill_order['data'] != null)
            $bill_orders = $data_bill_order['data']->collection;

        return view('bill_order_management/bill_order', ['bill_orders' => $bill_orders]);
    }
}
