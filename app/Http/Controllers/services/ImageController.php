<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Resources\ImageResource;
use App\Http\Payload;
use Error;
use Exception;
use SebastianBergmann\Environment\Console;

class ImageController extends Controller
{
    public function getAllImageByStatus($status)
    {
        $images =  Image::where('status', $status)->get();
        if ($images->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ImageResource::collection($images), "Request Successfully", 200);
    }

    public function getImageByIdAndStatus($id, $status)
    {
        $image = Image::where([
            ['img_id', '=', $id],
            ['status', '=', $status]
        ])->first();
        if ($image == null)
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(new ImageResource($image), "Request Successfully", 200);
    }

    public function getAllImageByProductIdAndStatus($id, $status) //attributes
    {
        $images = Image::where([
            ['product_id', '=', $id],
            ['status', '=', $status]
        ])->get();
        if ($images->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ImageResource::collection($images), "Request Successfully", 200);
    }

    public function getAllImageByProductIdAndColorIdAndStatus($prod_id, $color_id, $status)
    {
        $images = Image::where([
            ['product_id', '=', $prod_id],
            ['color_id', '=', $color_id],
            ['status', '=', $status]
        ])->get();
        if ($images->isEmpty())
            return Payload::toJson(null, "Data Not Found", 404);
        return Payload::toJson(ImageResource::collection($images), "Request Successfully", 200);
    }

    public function saveImage(Request $req)
    {
        $image = new Image();
        $image->fill(
            [
                'img_id' => "IMG" . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis') . $req->increase,
                'img_name' => $req->img_name,
                'product_id' => $req->product_id,
                'color_id' => $req->color_id,
            ]
        );
        if ($image->save()) {
            $image = Image::where('img_id', $image->img_id)->first();
            DB::commit();
            return Payload::toJson(new ImageResource($image), "Create Successfully", 201);
        }
    }

    public function updateImage(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Image::where('img_id', $req->img_id)
                //Key Value // Get e by array...
                ->update(
                    ['img_name' => $req->img_name],
                );
            DB::commit();
            if ($result == 1) {
                $image = Image::where('img_id', $req->img_id)->first();
                return Payload::toJson(new ImageResource($image), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeImage(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Image::where('img_id', $req->img_id)
                ->update(['status' => $req->status]);
            DB::commit();
            if ($result == 1) {
                $image = Image::where('img_id', $req->img_id)->first();
                return Payload::toJson(new ImageResource($image), "Remove Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Remove", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function addFileImage(Request $req)
    {
        try {
            $file = $req->file('image');
            $path = 'C:/xampp/htdocs/upload/avatar_users';
            $extension = $file->getClientOriginalExtension(); //get extension
            $img_name = $req->member_id . "." . $extension;
            if ($file->move($path, $img_name)) {
                return Payload::toJson(true, "Add File Successfully", 202);
            }
            return Payload::toJson(false, "Add File Fail", 500);
        } catch (Exception $ex) {
            return Payload::toJson(false, "Add File Fail", 500);
        } catch (Error $err) {
            return Payload::toJson(false, "Add File Fail", 500);
        }
    }
}