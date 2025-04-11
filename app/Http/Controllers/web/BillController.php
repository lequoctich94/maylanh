<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\BillController as ServicesBillController;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function billManagement()
    {
        $billController = new ServicesBillController();
        $data_bill_pay = $billController->getAllBillByStatus(-1);
        $bill_pays = [];

        if ($data_bill_pay['data'] != null)
            $bill_pays = $data_bill_pay['data']->collection;

        return view('bill_pay_management/bill_pay', ['bill_pays' => $bill_pays]);
    }
}
