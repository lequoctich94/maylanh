<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Resources\CategoryResource;
use App\Http\Payload;
use Exception;

class CategoryController extends Controller
{
    public function getAllCategoryByStatus($status)
    {
        $categories = Category::where('status', $status)->get();
        if ($categories->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(CategoryResource::collection($categories), 'OK', 200);
    }

    public function getAllCategory()
    {
        $categories = Category::all();
        if ($categories->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(CategoryResource::collection($categories), 'OK', 200);
    }

    public function getCategoryByIdAndStatus($id, $status)
    {
        $category = Category::where([
            ['category_id', '=', $id],
            ['status', '=', $status]
        ])->first();
        if ($category == null)
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(new CategoryResource($category), 'OK', 200);
    }

    public function getCategoryById($id)
    {
        $category = Category::where([['category_id', '=', $id]])->first();
        if ($category == null)
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(new CategoryResource($category), 'OK', 200);
    }

    public function getAllCategoryByProducerId($id)
    {
        $category = Category::join('products', 'products.category_id', '=', 'categories.category_id')
            ->where([['products.producer_id', $id]])->distinct()->get('categories.*');

        if ($category->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(CategoryResource::collection($category), 'OK', 200);
    }


    public function getAllCategoryInStock($status = 1)
    {

        $categories = Category::join('products', 'products.category_id', '=', 'categories.category_id')
            ->join('product_details', 'product_details.product_id', '=', 'products.product_id')
            ->join('stock_details', 'stock_details.product_detail_id', '=', 'product_details.product_detail_id')
            ->where('categories.status', $status)
            ->distinct()->get('categories.*');

        // $category = Category::where([['category_id','=',$id],
        // ['status','=',$status]])->first();
        if ($categories->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(CategoryResource::collection($categories), 'OK', 200);
    }

    public function removeCategory(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Category::where('category_id', $req->category_id)->update(['status' => $req->status]);

            DB::commit();
            if ($result == 1) {
                $category = Category::where('category_id', $req->category_id)->first();
                return Payload::toJson(new CategoryResource($category), "Remove Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Remove", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateCategory(Request $req)
    {
        DB::beginTransaction();
        try {
            if ($req->suffix_img == null) {
                $result = Category::where('category_id', $req->category_id)->update(['category_name' => $req->category_name]);
            } else {
                $result = Category::where('category_id', $req->category_id)->update(['category_name' => $req->category_name, 'suffix_img' => $req->suffix_img]);
            }
            DB::commit();
            if ($result == 1) {
                $category = Category::where('category_id', $req->category_id)->first();
                return Payload::toJson(new CategoryResource($category), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function saveCategory(Request $req)
    {
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->fill(
                [
                    'category_id' => "CATE" . Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHis'),
                    'category_name' => $req->category_name,
                    'suffix_img' => $req->suffix_img
                ]
            );
            $category->save();
            $category = Category::where('category_id', $category->category_id)->first();
            DB::commit();
            return Payload::toJson(new CategoryResource($category), 'Create Successfully', 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}