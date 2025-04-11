<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BillDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillDetailResource;
use App\Http\Payload;
use App\Models\Bill;
use Carbon\Carbon;
use Exception;

class BillDetailController extends Controller
{
    public function getAllBillDetailByIDBill($id)
    {
        $bill_details = BillDetail::where('bill_id', $id)->get();
        if ($bill_details->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(BillDetailResource::collection($bill_details), 'OK', 200);
    }

    public function getAllBillDetailByIdMemberAndStatus($id, $status)
    {
        $bill_details = BillDetail::join('bills', 'bills.bill_id', '=', 'bill_details.bill_id')->where([['bills.member_id', $id], ['bills.status', $status]])->get();
        if ($bill_details->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(BillDetailResource::collection($bill_details), 'OK', 200);
    }

    public function getTopProductPopularByStatus($status)
    {
        $month = Carbon::now('Asia/Ho_Chi_Minh')->format('m');
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');
        $bill_details = BillDetail::join('bills', 'bills.bill_id', '=', 'bill_details.bill_id')
            ->join('product_details', 'product_details.product_detail_id', '=', 'bill_details.product_detail_id')
            ->join('products', 'products.product_id', '=', 'product_details.product_id')
            ->select(DB::raw('sum(bills.total_price) as total_bill'), 'products.product_name')
            ->whereMonth('bills.date_order', $month)
            ->whereYear('bills.date_order', $year)
            ->where('products.status', $status)
            ->groupBy('products.product_name')
            ->orderBy('total_bill', 'DESC')
            ->take(1)
            ->get();
        return Payload::toJson($bill_details, 'OK', 200);
    }

    public function saveBillDetail(Request $req)
    {
        DB::beginTransaction();
        try {
            $bill_detail = new BillDetail();
            $bill_detail->fill([
                'bill_detail_id' => $req->product_detail_id . $req->bill_id,
                'product_detail_id' => $req->product_detail_id,
                'bill_id' => $req->bill_id,
                'quantity' => $req->quantity,
                'price' => $req->price,
                'total_price' => $req->quantity * $req->price,
                'price_discount' => $req->price_discount,
            ]);
            $bill_detail->save();
            $bill_detail = BillDetail::where('bill_detail_id', $bill_detail->bill_detail_id)->first();
            DB::commit();
            return Payload::toJson(new BillDetailResource($bill_detail), 'Create Successfully', 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
    public function updateRateStatus(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = BillDetail::join('product_details', 'product_details.product_detail_id', '=', 'bill_details.product_detail_id')
                ->where([['product_details.product_id', $req->product_id], ['bill_details.bill_id', $req->bill_id]])
                ->update([
                    'rate_status' => $req->rate_status
                ]);
            DB::commit();
            if ($result == 1) {
                $bill_detail = BillDetail::where('bill_detail_id', $req->bill_detail_id)->first();
                return Payload::toJson(new BillDetailResource($bill_detail), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}