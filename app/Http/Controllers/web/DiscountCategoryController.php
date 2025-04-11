<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\DiscountCategoryController as ServicesDiscountCategoryController;
use App\Http\Controllers\services\CategoryController as ServicesCategoryController;
use Illuminate\Http\Request;

class DiscountCategoryController extends Controller
{
    public function discountCategoryManagement($rank_id)
    {

        $discountCategoryController = new ServicesDiscountCategoryController;
        $categoryController = new ServicesCategoryController();

        $data_discount_category = $discountCategoryController->getAllDiscountCategoryByIdRank($rank_id);
        $data_category = $categoryController->getAllCategoryByStatus(1);

        $discount_categories = [];
        $categories = [];

        if ($data_discount_category['data'] != null)
            $discount_categories = $data_discount_category['data']->collection;
        if ($data_category['data'] != null)
            $categories = $data_category['data']->collection;

        return view('rank_management/discount_category', ['rank_id' => $rank_id, 'discount_categories' => $discount_categories, 'categories' => $categories]);
    }

    public function addDiscountCategory(Request $req)
    {
        $discountCategoryController = new ServicesDiscountCategoryController;
        $result = $discountCategoryController->saveDiscountCategory($req);

        if ($result == null) {
            return back()->withErrors(['error' => 'Tạo thất bại']);
        }
        return redirect(route('discount-category-management', ['rank_id' => $req->rank_id]));
    }

    public function updateDiscountCategory(Request $req)
    {
        $discountCategoryController = new ServicesDiscountCategoryController;
        $result = $discountCategoryController->updateDiscountCategory($req);

        if ($result == null) {
            return back()->withErrors(['error' => 'Chỉnh sửa thất bại']);
        }
        return redirect(route('discount-category-management', ['rank_id' => $req->rank_id]));
    }
}
