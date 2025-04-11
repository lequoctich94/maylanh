<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\CategoryController as ServicesCategoryController;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function categoryManagement()
    {
        $categoryController = new ServicesCategoryController();
        $data_category = $categoryController->getAllCategory();
        $categories = [];

        if ($data_category['data'] != null)
            $categories = $data_category['data']->collection;
        return view('category_management/category', ['cats' => $categories]);
    }

    public function addCategory(Request $req)
    {
        try {
            if ($req->category_name == null) {
                return back()->withErrors(['category_error' => 'Thêm loại sản phẩm thất bại']);
            }

            $categoryController = new ServicesCategoryController();

            if ($file = $req->file('image')) {
                $allowedfileExtension = ['jpg', 'png'];
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $name = 'CATE' . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis') . '.' . $file->getClientOriginalExtension();
                    $path = public_path('/upload/categories/');
                    if ($file->move($path, $name)) {
                        $req->suffix_img = $name;
                        $result = $categoryController->saveCategory($req);
                        if ($result != null)
                            return redirect(route('category-management'));
                    }
                } else {
                    return back()->withErrors(['error' => 'Xin lỗi! định dạng không hợp lệ (PNG,JPG)']);
                }
            }
            return back()->withErrors(['error' => 'Vui lòng chọn hình ảnh.']);
        } catch (Exception $e) {
            return back()->withErrors(['errorCategorySave' => 'Thêm thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
    }

    public function removeCategory(Request $req)
    {
        $categoryController = new ServicesCategoryController();
        $result = $categoryController->removeCategory($req);

        if ($result != null)
            return redirect(route('category-management'));
        return back()->withErrors(['error' => 'Thêm thất bại']);
    }

    public function updateCategory(Request $req)
    {
        try {
            if ($req->category_name == null) {
                return back()->withErrors(['category_error' => 'Thêm loại sản phẩm thất bại']);
            }

            $categoryController = new ServicesCategoryController();

            if ($req->image != null) {
                $name = 'CATE' . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis') . '.' . $req->image->getClientOriginalExtension();
                $req->suffix_img = $name;
                $result = $categoryController->updateCategory($req);
                $path = 'C:/xampp/htdocs/upload/categories/';
                $req->image->move($path, $name);
                if (File::exists($path . $req->img))
                    File::delete($path . $req->img);
            } else {
                $result = $categoryController->updateCategory($req);
            }

            if ($result != null) {
                return redirect(route('category-management'));
            }

            return back()->withErrors(['error' => 'Cập nhật thất bại']);
        } catch (Exception $e) {
            return back()->withErrors(['errorCategoryUpdate' => 'Cập nhật thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
    }
}
