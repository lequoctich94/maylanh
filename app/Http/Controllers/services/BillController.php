<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Resources\BillResource;
use App\Http\Payload;
use App\Http\Controllers\services\ActivityHistoryController;
use App\Http\Controllers\services\VoucherMemberController;
use App\Models\Notification;
use Exception;

class BillController extends Controller
{
    public function getAllBill()
    {
        $bills = Bill::orderBy('date_order', 'DESC')->get();

        if ($bills->isEmpty())
            return Payload::toJson(null, 'Data not found', 404);

        return Payload::toJson(BillResource::collection($bills), 'OK', 200);
    }

    public function getQuantityAllBillInThisMonth()
    {
        $month = Carbon::now('Asia/Ho_Chi_Minh')->format('m');
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');

        $total_quantity = Bill::whereMonth('date_order', $month)
            ->whereYear('date_order', $year)->where('status', '1')->orderBy('date_order', 'DESC')->get();

        return Payload::toJson($total_quantity, 'OK', 200);
    }

    public function getQuantityAllBillInThisMonthBelongStatus()
    {
        $month = Carbon::now('Asia/Ho_Chi_Minh')->format('m');
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');

        $statistic_quantity_belong_status = DB::table('bills')
            ->select(DB::raw('count(bill_id) as quantity_bill, status'))
            ->whereMonth('date_order', $month)
            ->whereYear('date_order', $year)
            ->groupBy('status')
            ->orderBy('date_order', 'DESC')
            ->get();

        if ($statistic_quantity_belong_status->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($statistic_quantity_belong_status, "Request Successfully", 200);
    }

    public function getQuantityAllBillChartBelongStatusByMonthAndYear($month, $year)
    {
        $statistic_quantity_belong_status = DB::table('bills')
            ->select(DB::raw('count(bill_id) as quantity_bill, status'))
            ->whereMonth('date_order', $month)
            ->whereYear('date_order', $year)
            ->groupBy('status')
            ->orderBy('date_order', 'DESC')
            ->get();

        if ($statistic_quantity_belong_status->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson($statistic_quantity_belong_status, "Request Successfully", 200);
    }


    public function getTotalPriceAllBillInThisMonth()
    {
        $month = Carbon::now('Asia/Ho_Chi_Minh')->format('m');
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');

        $total_price = Bill::whereMonth('date_order', $month)
            ->whereYear('date_order', $year)
            ->sum('bills.total_price');

        return Payload::toJson($total_price, 'OK', 200);
    }

    public function getAllBillInThisMonthByStatus($status)
    {
        $month = Carbon::now('Asia/Ho_Chi_Minh')->format('m');
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');

        $bills = Bill::whereMonth('date_order', $month)
            ->whereYear('date_order', $year)
            ->where('status', $status)
            ->orderBy('date_order', 'DESC')
            ->get();

        if ($bills->isEmpty())
            return Payload::toJson(null, 'Data not found', 404);

        return Payload::toJson(BillResource::collection($bills), 'OK', 200);
    }

    public function getAllBillWhenChooseByStatus($week, $month, $year, $status)
    {

        $billsOfMonthAndYear = Bill::whereMonth('date_order', $month)
            ->whereYear('date_order', $year)
            ->where('status', $status)
            ->orderBy('date_order', 'DESC')
            ->get();
        $bills = [];
        foreach ($billsOfMonthAndYear as $bill) {
            $weekOfMonthBill = Carbon::parse($bill->date_order)->weekOfMonth;
            if ($weekOfMonthBill == $week) {
                array_push($bills, $bill);
            }
        }

        if ($bills == null)
            return Payload::toJson(null, 'Data not found', 404);

        return Payload::toJson(BillResource::collection($bills), 'OK', 200);
    }

    public function getAllBillInThisYearByStatus($status)
    {
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');

        $bills = Bill::whereYear('date_order', $year)
            ->where('status', $status)
            ->orderBy('date_order', 'DESC')
            ->get();

        if ($bills->isEmpty())
            return Payload::toJson(null, 'Data not found', 404);

        return Payload::toJson(BillResource::collection($bills), 'OK', 200);
    }

    public function getAllBillByStatus($status)
    {
        $bills = Bill::where([['status', '=', $status]])->orderBy('date_order', 'DESC')->get();

        if ($bills->isEmpty())
            return Payload::toJson(null, 'Data not found', 404);

        return Payload::toJson(BillResource::collection($bills), 'OK', 200);
    }

    public function getBillByIdAndStatus($id, $status)
    {
        $bill = Bill::where([['bill_id', '=', $id], ['status', '=', $status]])->first();
        if ($bill == null)
            return Payload::toJson(null, 'Data not found', 404);

        return Payload::toJson(new BillResource($bill), 'OK', 200);
    }

    public function getAllBillByIdMemberAndStatus($id, $status)
    {
        $bills = Bill::where([['member_id', '=', $id], ['status', '=', $status]])->orderBy('date_order', 'DESC')->get();
        if ($bills->isEmpty())
            return Payload::toJson(null, 'Data not found', 404);

        return Payload::toJson(BillResource::collection($bills), 'OK', 200);
    }


    public function getBillById($id)
    {
        $bill = Bill::where([['bill_id', '=', $id]])->first();
        if ($bill == null)
            return null;

        return new BillResource($bill);
    }

    public function getAllBillByDateAndStatus($date, $status)
    {
        $bills = Bill::where([
            ['date_order', '=', $date],
            ['status', '=', $status]
        ])->orderBy('date_order', 'DESC')->get();
        if ($bills->isEmpty())
            return Payload::toJson(null, 'Data not found', 404);

        return Payload::toJson(BillResource::collection($bills), 'OK', 200);
    }

    public function getAllBillBetweenDateToDateAndStatus($date_start, $date_end, $status)
    {

        $date_end = Carbon::parse($date_end);
        $bills = Bill::whereRaw("CAST(bills.date_order as DATE) >= '$date_start' 
        and CAST(bills.date_order as DATE) <= '$date_end'")
            ->where('status', $status)
            ->orderBy('date_order', 'ASC')->get();
        if ($bills->isEmpty())
            return Payload::toJson(null, 'Data not found', 404);

        return Payload::toJson(BillResource::collection($bills), 'OK', 200);
    }

    public function saveBill(Request $req)
    {
        DB::beginTransaction();
        try {
            $bill = new Bill();
            $bill->fill([
                'bill_id' => Carbon::now('Asia/Ho_Chi_Minh')->format('ymd_his'),
                'member_id' => $req->member_id,
                'shipping_address' => $req->shipping_address,
                'shipping_phone' => $req->shipping_phone,
                'code' => $req->code,
                'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
                'receiver' => $req->receiver,
                'total_price' => $req->total_price,
                'total_quantity' => $req->total_quantity,
                'payment' => $req->payment,
            ]);

            $bill->save();

            $bill = Bill::where('bill_id', $bill->bill_id)->first();

            $actHisController = new ActivityHistoryController();

            if ($bill->code != null) {
                $requ = new Request([
                    'activity' => "Áp dụng voucher khuyến mãi $bill->code vào hoá đơn $bill->bill_id",
                    'user_id' => $bill->member->user->user_id,
                    'object_id' => $bill->code,
                    'type' => 4
                ]);
                $actHisController->saveActivityHistory($requ);
                $voucherMemberController = new VoucherMemberController();
                $req_voucher = new Request([
                    'member_id' => $bill->member->member_id,
                    'code' => $bill->code,
                    'status' => 0,
                ]);

                $voucherMemberController->updateStatusVoucherMemberByIdMemberAndCode($req_voucher);
            }
            $requ = new Request([
                'activity' => "Thanh toán hoá đơn $bill->bill_id thành công",
                'user_id' => $bill->member->user->user_id,
                'object_id' => $bill->bill_id,
                'type' => 4,
            ]);

            $actHisController->saveActivityHistory($requ);
            DB::commit();
            return Payload::toJson(new BillResource($bill), 'Create Successfully', 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateStatusBill(Request $req)
    {
        DB::beginTransaction();
        try {
            //Đang giao
            if ($req->status == 0) {
                $result = Bill::where('bill_id', $req->bill_id)->update(['status' => $req->status, 'date_delivery' => Carbon::now('Asia/Ho_Chi_Minh')]);
                //Từ chối - huỷ đơn
            } else if ($req->status == -2 || $req->status == -4) {
                $result = Bill::where('bill_id', $req->bill_id)->update(['status' => $req->status, 'message' => $req->message, 'date_cancel' => Carbon::now('Asia/Ho_Chi_Minh')]);
                //Chuẩn bị hàng
            } else if ($req->status == 2) {
                $result = Bill::where('bill_id', $req->bill_id)->update(['status' => $req->status, 'date_confirm' => Carbon::now('Asia/Ho_Chi_Minh')]);
                //Đã giao
            } else if ($req->status == 1) {
                $result = Bill::where('bill_id', $req->bill_id)->update(['status' => $req->status, 'date_receipt' => Carbon::now('Asia/Ho_Chi_Minh')]);
            }

            $bill = $this->getBillById($req->bill_id);

            $memberController = new MemberController();

            $member = $memberController->getMemberById($bill->member->member_id);

            $bill_details_controller = new BillDetailController();
            $stock_detail_controller = new StockDetailController();

            $bill_details = $bill_details_controller->getAllBillDetailByIDBill($req->bill_id)['data'];
            if ($req->status == 0) {
                foreach ($bill_details as $bill_detail) {
                    $reqTmp = new Request([
                        'quantity' => $bill_detail->quantity,
                        'product_detail_id' => $bill_detail->product_detail_id,
                    ]);
                    $stock_detail_controller->updateQuantityProductDetailInStock($reqTmp);
                }
            }

            if ($req->status == 2) {
                $notificationController = new NotificationController();

                $req->title = "PTP Store Thông Báo";
                $req->body = "Đơn hàng của bạn đã được duyệt và đang chuẩn bị hàng";
                $req->member_id = $member->member_id;

                $notificationController->pushNotificationByMember($req);
            } else if ($req->status == -4) {
                $notificationController = new NotificationController();

                $req->title = "PTP Store Thông Báo";
                $req->body = "Đơn hàng của bạn đã bị từ chối";
                $req->member_id = $member->member_id;

                $notificationController->pushNotificationByMember($req);
            } else if ($req->status == -2) {
                $requ = new Request([
                    'activity' => "Bạn đã huỷ đơn hàng $bill->bill_id thành công",
                    'user_id' => $bill->member->user->user_id,
                    'object_id' => $bill->bill_id,
                    'type' => 4,
                ]);
                $actHisController = new ActivityHistoryController();
                $actHisController->saveActivityHistory($requ);
            } else if ($req->status == 0) {
                $notificationController = new NotificationController();

                $req->title = "PTP Store Thông Báo";
                $req->body = "Đơn hàng của bạn đã được lấy và vận chuyển";
                $req->member_id = $member->member_id;

                $notificationController->pushNotificationByMember($req);
            } else if ($req->status == 1) {
                $point_of_bill = $bill->total_price;

                $current_point = $point_of_bill +  $member->current_point;

                $reqTmp = new Request([
                    'member_id' => $bill->member->member_id,
                    'current_point' => $current_point,
                ]);

                $memberController->updateCurrentPointMember($reqTmp);
                $notificationController = new NotificationController();
                $req->title = "PTP Store Thông Báo";
                $req->body = "Đơn hàng của bạn đã được giao thành công, Vui lòng kiểm tra đơn hàng của bạn";
                $req->member_id = $member->member_id;
                $notificationController->pushNotificationByMember($req);
            }

            DB::commit();
            if ($result == 1) {
                return Payload::toJson(new BillResource($bill), 'Update Successfully', 202);
            }

            return Payload::toJson(null, 'Cannot Update', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}