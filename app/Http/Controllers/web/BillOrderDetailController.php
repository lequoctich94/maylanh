<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\services\BillOrderDetailController as ServicesBillOrderDetailController;
use App\Http\Controllers\services\BillOrderController as ServicesBillOrderController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillOrderDetailController extends Controller
{
    public function BillOrderDetailManagement($id)
    {
        $billOrderDetailController = new ServicesBillOrderDetailController();
        $data_bill_order_detail = $billOrderDetailController->getAllBillOrderDetailByIdBillOrder($id);
        $bill_order_details = [];

        if ($data_bill_order_detail['data'] != null)
            $bill_order_details = $data_bill_order_detail['data']->collection;

        return view('bill_order_management/bill_order_detail', ['bill_order_details' => $bill_order_details]);
    }
}
