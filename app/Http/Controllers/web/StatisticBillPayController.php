<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\BillController as ServicesBillController;
use App\Http\Controllers\services\BillDetailController as ServicesBillDetailController;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticBillPayController extends Controller
{
    public function StatisticBillPayManagement()
    {
        $date_time = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $billController = new ServicesBillController();
        $billDetailController = new ServicesBillDetailController();

        $data_bill_quantity = $billController->getQuantityAllBillInThisMonth();
        $data_bill_total_price = $billController->getTotalPriceAllBillInThisMonth();
        $data_bill_pay = $billController->getAllBillByStatus(1);
        $data_bill_pay_in_this_month = $billController->getAllBillInThisMonthByStatus(1);
        $data_bill_pay_in_this_year = $billController->getAllBillInThisYearByStatus(1);
        $data_bill_detail = $billDetailController->getTopProductPopularByStatus(1);

        $bill_pays = [];
        $bill_pay_month = [];
        $bill_pay_year = [];
        $total = 0;

        if ($data_bill_pay['data'] != null)
            $bill_pays = $data_bill_pay['data']->collection;

        if ($data_bill_pay_in_this_month['data'] != null) {
            $bill_pay_month = $data_bill_pay_in_this_month['data']->collection;
            for ($i = 0; $i < count($bill_pay_month); $i++) {
                $total += $bill_pay_month[$i]->total_price;
            }
        }

        if ($data_bill_pay_in_this_year['data'] != null)
            $bill_pay_year = $data_bill_pay_in_this_year['data']->collection;

        $bill_details = $data_bill_detail['data'];
        $bill_pay_total_quantity = $data_bill_quantity['data'];
        $bill_pay_total_price = $data_bill_total_price['data'];

        return view(
            'statistics_bill_pay_management/statistics_bill_pay',
            [
                'bill_pay_month' => $bill_pay_month,
                'bill_pay_year' => $bill_pay_year,
                'top_product' => $bill_details,
                'bill_pays' => $bill_pays,
                'total_quantity' => $bill_pay_total_quantity,
                'total_price' => $bill_pay_total_price,
                'total' => $total,
                'date_time' => $date_time
            ]
        );
    }
}
