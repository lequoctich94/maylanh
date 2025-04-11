<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\BillDetailController as ServicesBillDetailController;
use App\Http\Controllers\services\StockController as ServicesStockController;
use Illuminate\Http\Request;

class BillDetailController extends Controller
{
    public function billDetailManagement($bill_id)
    {
        $billDetailController = new ServicesBillDetailController();
        $stockController = new ServicesStockController();
        $data_bill_pay_detail = $billDetailController->getAllBillDetailByIDBill($bill_id);
        $data_stock = $stockController->getStockByIdAndStatus('STOCK01', 1);
        $this->viewData['admin'] = request()->session()->get('admin');
        if ($data_bill_pay_detail['data'] != null)
            $this->viewData['bill_pay_details'] = $data_bill_pay_detail['data']->collection;

        if ($data_stock['data'] != null)
            $this->viewData['stock'] = $data_stock['data'];
        return view('bill_pay_management/bill_pay_detail')->with($this->viewData);
    }
}