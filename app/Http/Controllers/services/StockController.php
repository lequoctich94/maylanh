<?php

namespace App\Http\Controllers\services;

use App\Http\Payload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Http\Resources\StockResource;
use Exception;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function getAllStockByStatus($status)
    {
        $stocks = Stock::where('status', $status)->get();
        if ($stocks->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(StockResource::collection($stocks), 'Ok', 200);
    }

    public function getStockByIdAndStatus($id, $status)
    {
        $stock = Stock::where([['stock_id', '=', $id], ['status', '=', $status]])->first();
        if ($stock == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new StockResource($stock), 'Ok', 200);
    }

    public function getStockById($id)
    {
        $stock = Stock::where('stock_id', $id)->first();
        return new StockResource($stock);
    }

    public function saveStock(Request $req)
    {
        DB::beginTransaction();
        try {
            $stock = new Stock();
            $stock->fill([
                'stock_id' => $req->stock_id,
                'address' => $req->address,
            ]);
            if ($stock->save() == 1) {
                $stock = $this->getStockById($stock->stock_id);
                DB::commit();
                return Payload::toJson(new StockResource($stock), 'Completed', 201);
            }
            return Payload::toJson(null, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateStock(Request $req)
    {
        DB::beginTransaction();
        try {
            $stock = Stock::where('stock_id', $req->stock_id)
                ->update(['address' => $req->address]);
            DB::commit();
            if ($stock == 1) {
                return Payload::toJson($stock, 'Completed', 200);
            }
            return Payload::toJson(null, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeStock(Request $req)
    {
        DB::beginTransaction();
        try {
            $stock = Stock::where('stock_id', $req->stock_id)
                ->update(['status' => $req->status]);
            DB::commit();
            if ($stock == 1) {
                return Payload::toJson($stock, 'Completed', 200);
            }
            return Payload::toJson(null, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}