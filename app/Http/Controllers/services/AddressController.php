<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
use App\Http\Payload;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function getAllAddressByMemberId($member_id)
    {
        $addresses = Address::where("member_id", $member_id)->get();

        if ($addresses->isEmpty()) {
            return Payload::toJson(null, "Data not found", 404);
        }
        return Payload::toJson(AddressResource::collection($addresses), "OK", 200);
    }

    public function getAllAddressByMemberIdAndStatus($member_id, $status)
    {
        $addresses = Address::where([["member_id", $member_id], ['status', $status]])->get();

        if ($addresses->isEmpty()) {
            return Payload::toJson(null, "Data not found", 404);
        }
        return Payload::toJson(AddressResource::collection($addresses), "OK", 200);
    }

    public function saveAddress(Request $req)
    {
        DB::beginTransaction();
        try {
            $address = new Address();
            $address->fill([
                'info_detail' => $req->info_detail,
                'city' => $req->city,
                'district' => $req->district,
                'commune' => $req->commune,
                'member_id' => $req->member_id,
            ]);
            $address->save();
            DB::commit();
            return Payload::toJson(true, 'Created Successfully', 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateAddress(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Address::where([['id', $req->id], ['member_id', $req->member_id]])->update([
                'info_detail' => $req->info_detail,
                'city' => $req->city,
                'district' => $req->district,
                'commune' => $req->commune
            ]);
            DB::commit();
            if ($result != 1) {
                return Payload::toJson(false, "Update fail", 202);
            }
            return Payload::toJson(true, "Update success", 202);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeAddress(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Address::where([['id', $req->id], ['member_id', $req->member_id]])->update([
                'status' => 0
            ]);
            DB::commit();
            if ($result != 1) {
                return Payload::toJson(false, "Remove fail", 202);
            }
            return Payload::toJson(true, "Remove success", 202);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getCityInVN()
    {
        $response = Http::get('https://sheltered-anchorage-60344.herokuapp.com/province');
        return Payload::toJson(json_decode($response->body()), "Call success", 200);
    }

    public function getDistrictByCityIdVN($city_id)
    {
        $response = Http::get('https://sheltered-anchorage-60344.herokuapp.com/district?idProvince=' . $city_id);
        return Payload::toJson(json_decode($response->body()), "Call success", 200);
    }

    public function getCommuneByDistrictIdVN($district_id)
    {
        $response = Http::get('https://sheltered-anchorage-60344.herokuapp.com/commune?idDistrict=' . $district_id);
        return Payload::toJson(json_decode($response->body()), "Call success", 200);
    }
}