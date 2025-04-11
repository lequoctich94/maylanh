<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BillOrderDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillOrderDetailResource;
use App\Http\Payload;
use Exception;

class BillOrderDetailController extends Controller
{
    public function getAllBillOrderDetailByIdBillOrder($id)
    {
        $billOrderDetails = BillOrderDetail::where('bill_order_id', $id)->get();
        if ($billOrderDetails->isEmpty())
            return Payload::toJson(null, 'Data not found', 404);
        return Payload::toJson(BillOrderDetailResource::collection($billOrderDetails), 'OK', 200);
    }

    public function saveBillOrderDetail($reqs)
    {
        DB::beginTransaction();
        $isSave = true;
        try {
            if (is_array($reqs)) {
                foreach ($reqs as $req) {
                    $billOrderDetail = new BillOrderDetail();
                    $billOrderDetail->fill([
                        'bill_order_detail_id' => $req->bill_order_id . $req->product_detail_id,
                        'product_detail_id' => $req->product_detail_id,
                        'bill_order_id' => $req->bill_order_id,
                        'quantity' => $req->quantity,
                        'price_order' => $req->price_order,
                        'total_price' => $req->price_order * $req->quantity,
                        'price_pay' => $req->price_pay,
                    ]);

                    if ($billOrderDetail->save() != 1) {
                        print("Luu hoa don that bai:" + $billOrderDetail->bill_order_detail_id);
                        $isSave = false;
                        break;
                    }
                }
            } else {
                $billOrderDetail = new BillOrderDetail();
                $billOrderDetail->fill([
                    'bill_order_detail_id' => $reqs->bill_order_id . $reqs->product_detail_id,
                    'product_detail_id' => $reqs->product_detail_id,
                    'bill_order_id' => $reqs->bill_order_id,
                    'quantity' => $reqs->quantity,
                    'price_order' => $reqs->price_order,
                    'total_price' => $reqs->price_order * $reqs->quantity,
                    'price_pay' => $reqs->price_pay,
                ]);

                if ($billOrderDetail->save() != 1) {
                    print("Luu hoa don that bai:" + $billOrderDetail->bill_order_detail_id);
                    $isSave = false;
                }
            }


            if ($isSave) {
                DB::commit();
                return Payload::toJson(true, 'Create Successfully', 201);
            } else {
                return Payload::toJson(false, 'Create Fail', 500);
            }
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}