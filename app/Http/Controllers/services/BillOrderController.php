<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BillOrder;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Resources\BillOrderResource;
use App\Http\Payload;
use Exception;

class BillOrderController extends Controller
{
    public function getAllBillOrder()
    {
        $billOrders = BillOrder::orderBy('date_order', 'DESC')->get();
        if ($billOrders->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(BillOrderResource::collection($billOrders), 'OK', 200);
    }

    public function getAllBillOrderByIdUser($id)
    {
        $billOrders = BillOrder::where('user_id', $id)->orderBy('date_order', 'DESC')->get();
        if ($billOrders->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(BillOrderResource::collection($billOrders), 'OK', 200);
    }

    public function getAllBillOrderByDate($date)
    {
        $billOrders = BillOrder::where('date_order', $date)->orderBy('date_order', 'DESC')->get();
        if ($billOrders->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(BillOrderResource::collection($billOrders), 'OK', 200);
    }

    public function getBillOrderById($id)
    {
        $billOrder = BillOrder::where('bill_order_id', $id)->first();
        if ($billOrder == null)
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(new BillOrderResource($billOrder), 'OK', 200);
    }

    public function saveBillOrder(Request $req)
    {
        DB::beginTransaction();
        try {
            $billOrder = new BillOrder();
            $billOrder->fill([
                'bill_order_id' => "BO" . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis'),
                'amount' => $req->amount,
                'total_price' => $req->total_price,
                'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
                'stock_id' => $req->stock_id,
                'producer_id' => $req->producer_id,
                'user_id' => $req->user_id,
            ]);
            $billOrder->save();
            $billOrder = BillOrder::where('bill_order_id', $billOrder->bill_order_id)->first();
            DB::commit();
            return Payload::toJson(new BillOrderResource($billOrder), 'Create Successfully', 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}