<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\services\ColorController as ServicesColorController;
use App\Http\Controllers\services\SizeController as ServicesSizeController;
use App\Http\Controllers\services\CategoryController as ServicesCategoryController;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class SizeAndColorController extends Controller
{
    public function SizeAndColorManagement()
    {
        $colorController = new ServicesColorController();
        $sizeController = new ServicesSizeController();
        $categoryController = new ServicesCategoryController();
        $data_color = $colorController->getAllColor();
        $data_size = $sizeController->getAllSize();
        $data_category = $categoryController->getAllCategoryByStatus(1);

        $colors = [];
        if ($data_color['data'] != null)
            $colors = $data_color['data']->collection;

        $sizes = [];
        if ($data_size['data'] != null)
            $sizes = $data_size['data']->collection;

        $categories = [];
        if ($data_category['data'] != null)
            $categories = $data_category['data']->collection;

        return view('size_and_color_management/size_color', ['colors' => $colors, 'sizes' => $sizes, 'categories' => $categories]);
    }

    public function addColor(Request $req)
    {
        try {
            if ($req->color_name == null) {
                return back()->withErrors(['color_error' => 'Thêm thất bại']);
            }
            $colorController = new ServicesColorController();
            $result = $colorController->saveColor($req);

            if ($result != null)
                return redirect(route('size-and-color-management'));
            return back()->withErrors(['color_error' => 'Thêm thất bại']);
        } catch (Exception $e) {
            return back()->withErrors(['errorColorSave' => 'Thêm thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
        return redirect(route('size-and-color-management'));
    }

    public function updateColor(Request $req)
    {
        try {
            $colorController = new ServicesColorController();
            $result = $colorController->updateColor($req);
            if ($result != null)
                return redirect(route('size-and-color-management'));
            return back()->withErrors(['error' => 'Cập nhật thất bại']);
        } catch (Exception $e) {
            return back()->withErrors(['errorColorUpdate' => 'Cập nhật thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
    }

    public function removeColorManagement(Request $req)
    {
        $colorController = new ServicesColorController();
        dd($req->color_id);
        $result = $colorController->removeColor($req);
        if ($result != null)
            return redirect(route('size-and-color-management'));
        return back()->withErrors(['error' => 'Xoá thất bại']);
    }

    public function addSize(Request $req)
    {
        try {
            $sizeController = new ServicesSizeController();
            $result = $sizeController->saveSize($req);
            if ($result != null)
                return redirect(route('size-and-color-management'));
            return back()->withErrors(['error' => 'Thêm thất bại']);
        } catch (Exception $e) {
            return back()->withErrors(['errorSizeSave' => 'Thêm thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
        return redirect(route('size-and-color-management'));
    }

    public function updateSize(Request $req)
    {
        try {
            $sizeController = new ServicesSizeController();
            $result = $sizeController->updateSize($req);
            if ($result != null)
                return redirect(route('size-and-color-management'));
            return back()->withErrors(['error' => 'Cập nhật thất bại']);
        } catch (Exception $e) {
            return back()->withErrors(['errorSizeUpdate' => 'Cập nhật thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
    }

    public function removeSizeManagement(Request $req)
    {
        $sizeController = new ServicesSizeController();
        $result = $sizeController->removeSize($req);
        if ($result != null)
            return redirect(route('size-and-color-management'));
        return back()->withErrors(['error' => 'Xoá thất bại']);
    }
}