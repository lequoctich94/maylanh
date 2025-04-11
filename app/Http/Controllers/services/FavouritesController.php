<?php

namespace App\Http\Controllers\services;

use App\Http\Payload;
use Illuminate\Http\Request;
use App\Models\Favourite;
use App\Http\Resources\FavouriteResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\services\ActivityHistoryController;
use Exception;
use Illuminate\Support\Facades\DB;

class FavouritesController extends Controller
{
    public function getAllFavourite()
    {
        $favourites = Favourite::all();
        if ($favourites->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(FavouriteResource::collection($favourites), 'Ok', 200);
    }

    public function getAllFavouriteByIdMember($member_id)
    {
        $favourites = Favourite::where('member_id', $member_id)->get();
        if ($favourites->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        foreach ($favourites as $favourity) {
            $stockDetailController = new StockDetailController();
            $favourity->status = $stockDetailController->checkProductDetailIsExistInStock($favourity->product_detail_id);
        }
        return Payload::toJson(FavouriteResource::collection($favourites), 'Ok', 200);
    }

    public function isProductDetailInFavourites($product_detail_id, $member_id)
    {
        $favourites = Favourite::where([
            ['product_detail_id', '=', $product_detail_id],
            ['member_id', '=', $member_id]
        ])->first();
        if ($favourites == null) {
            return Payload::toJson(false, 'Data Not Found', 404);
        }
        return Payload::toJson(true, 'Ok', 200);
    }

    public function removeFavourite(Request $req)
    {
        DB::beginTransaction();
        try {
            $favourite = Favourite::where('favourite_id', $req->favourite_id)->first();
            if ($favourite == null) {
                return Payload::toJson(1, 'Completed', 202);
            }

            $product_name = $favourite->product_detail->product->product_name;
            $color = $favourite->product_detail->color->color_name;
            $size = $favourite->product_detail->size->size_name;
            $requ = new Request([
                'activity' => "Xoá sản phẩm $product_name màu $color kích thước $size khỏi danh sách yêu thích",
                'user_id' => $favourite->member->user->user_id,
                'object_id' => $favourite->product_detail->product_detail_id,
                'type' => 3
            ]);
            $favourite = Favourite::where('favourite_id', $req->favourite_id)->delete();
            DB::commit();
            if ($favourite == 1) {
                $actHisController = new ActivityHistoryController();

                $actHisController->saveActivityHistory($requ);

                return Payload::toJson($favourite, 'Completed', 202);
            }

            return Payload::toJson($favourite, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function saveFavourite(Request $req)
    {
        $favourite = Favourite::where('favourite_id', $req->favourite_id)->first();
        if ($favourite != null) {
            return Payload::toJson($favourite, 'Completed', 202);
        }
        $favourite = new Favourite();
        $favourite->fill(
            [
                'favourite_id' => $req->member_id . $req->product_detail_id,
                'member_id' => $req->member_id,
                'product_detail_id' => $req->product_detail_id,
            ]
        );
        if ($favourite->save() == 1) {
            $favourite = Favourite::where('favourite_id', $req->member_id . $req->product_detail_id)->first();
            $product_name = $favourite->product_detail->product->product_name;
            $color = $favourite->product_detail->color->color_name;
            $size = $favourite->product_detail->size->size_name;

            $requ = new Request([
                'activity' => "Chọn sản phẩm $product_name màu $color kích thước $size vào danh sách yêu thích",
                'user_id' => $favourite->member->user->user_id,
                'object_id' => $product_name,
                'type' => 3
            ]);

            $actHisController = new ActivityHistoryController();

            $actHisController->saveActivityHistory($requ);

            return Payload::toJson(new FavouriteResource($favourite), 'Completed', 201);
        }
        return Payload::toJson(null, 'Uncompleted', 500);
    }
}