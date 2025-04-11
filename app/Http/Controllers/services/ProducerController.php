<?php

namespace App\Http\Controllers\services;

use Illuminate\Http\Request;
use App\Models\Producer;
use App\Http\Controllers\Controller;
use App\Http\Payload;
use App\Http\Resources\ProducerResource;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class ProducerController extends Controller
{
    public function getAllProducerByStatus($status)
    {
        $producers = Producer::where('status', $status)->get();
        if ($producers->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(ProducerResource::collection($producers), 'Ok', 200);
    }

    public function getAllProducer()
    {
        $producers = Producer::all();
        if ($producers->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(ProducerResource::collection($producers), 'Ok', 200);
    }

    public function getProducerByIdAndStatus($id, $status)
    {
        $producer = Producer::where([['producer_id', '=', $id], ['status', '=', $status]])->first();
        if ($producer == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new ProducerResource($producer), 'Ok', 200);
    }

    public function getProducerById($id)
    {
        $producer = Producer::where('producer_id', $id)->first();
        return new ProducerResource($producer);
    }

    public function removeProducer(Request $req)
    {
        $producer = Producer::where('producer_id', $req->producer_id)->update(['status' => $req->status]);
        if ($producer == 1) {
            return Payload::toJson($producer, 'Completed', 200);
        }
        return Payload::toJson($producer, 'Uncompleted', 500);
    }

    public function saveProducer(Request $req)
    {
        DB::beginTransaction();
        try {
            $producer = new Producer();
            $producer->fill(
                [
                    'producer_id' => "PDC" . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis'),
                    'producer_name' => $req->producer_name,
                    'phone' => $req->phone,
                    'address' => $req->address,
                ]
            );
            DB::commit();
            if ($producer->save() == 1) {
                $producer = $this->getProducerById($producer->producer_id);
                return Payload::toJson(new ProducerResource($producer), 'Completed', 201);
            }
            return Payload::toJson($producer, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateProducer(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Producer::where('producer_id', $req->producer_id)
                ->update(
                    [
                        'producer_name' => $req->producer_name,
                        'phone' => $req->phone,
                        'address' => $req->address,
                    ],
                );
            DB::commit();
            if ($result == 1) {
                $producer = Producer::where('producer_id', $req->producer_id)->first();
                return Payload::toJson(new ProducerResource($producer), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}