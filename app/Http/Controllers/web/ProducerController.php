<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\CategoryController;
use App\Http\Controllers\services\ColorController;
use App\Http\Controllers\services\ImageController;
use App\Http\Controllers\services\ProducerController as ServicesProducerController;
use App\Http\Controllers\services\ProductController;
use App\Http\Controllers\services\ProductDetailController as ServicesProductDetailController;
use App\Http\Controllers\services\SizeController;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Helper\ProductDetailHelper;

class ProducerController extends Controller
{
    public function producerManagement()
    {
        $producerController = new ServicesProducerController();
        $data_producers = $producerController->getAllProducer();
        $producers = [];

        if ($data_producers['data'] != null)
            $producers = $data_producers['data']->collection;
        return view('producer_management/producer', ['producers' => $producers]);
    }

    public function addProducer(Request $req)
    {
        try {
            $producerController = new ServicesProducerController();
            $result =  $producerController->saveProducer($req);

            if ($result == null) {
                return back()->withErrors(['error' => 'Thêm Thất Bại']);
            }
            return redirect(route('producer-management'));
        } catch (Exception $e) {
            return back()->withErrors(['errorProducerSave' => 'Thêm thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
    }

    public function updateProducer(Request $req)
    {
        try {
            $producerController = new ServicesProducerController();
            $result =  $producerController->updateProducer($req);

            if ($result == null) {
                return back()->withErrors(['error' => 'Sửa Thất Bại']);
            }
            return redirect(route('producer-management'));
        } catch (Exception $e) {
            return back()->withErrors(['errorProducerUpdate' => 'Cập nhật thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
        return redirect(route('producer-management'));
    }

    public function producerDetail($producer_id)
    {
        $colorController = new ColorController();
        $sizeController = new SizeController();
        $categoryController = new CategoryController();
        $productController = new ProductController();
        $data_color = $colorController->getAllColorByStatus(1);
        $data_size = $sizeController->getAllSizeByStatus(1);
        $data_category = $categoryController->getAllCategoryByStatus(1);
        $data_product = $productController->getAllProductByProducerId($producer_id);
        $colors = [];
        $sizes = [];
        $categories = [];
        $products = [];

        if ($data_color['data'] != null)
            $colors = $data_color['data']->collection;

        if ($data_size['data'] != null)
            $sizes = $data_size['data']->collection;

        if ($data_category['data'] != null)
            $categories = $data_category['data']->collection;

        if ($data_product['data'] != null)
            $products = $data_product['data']->collection;
        
        return view('producer_management/producer_detail', ['producer_id' => $producer_id, 'products' => $products, 'colors' => $colors, 'sizes' => $sizes, 'categories' => $categories]);
    }

    public function producerProductDetail($product_id)
    {
        $productDetailController = new ServicesProductDetailController();
        $productController = new ProductController();
        $colorController = new ColorController();
        $sizeController = new SizeController();
        $data_product_detail = $productDetailController->getAllProductDetailByIdProduct($product_id);
        $product_response = $productController->getProductById($product_id);
        $data_color = $colorController->getAllColorByStatus(1);
        $product_details_distinct = [];
        $product_details = [];
        $colors = [];
        $sizes = [];
        $category_id = $product_response['data']->category->category_id;
        $data_size = $sizeController->getAllSizeByIdCategoryAndStatus($category_id, 1);
        //$data_size = $sizeController->getAllSize();
        if ($data_size['data'] != null)
            $sizes = $data_size['data']->collection;

        if ($data_product_detail['data'] != null) {
            //$prd_dts = $data_product_detail['data']->collection;
            $product_details = $data_product_detail['data']->collection;
            //lay product_detail_distinct,  $this->getDistinct($product_details_distinct, $prd_dt); ko biet de lam gi
            // foreach ($prd_dts as $prd_dt) {
            //     $product_details_distinct = $this->getDistinct($product_details_distinct, $prd_dt);
            // }
            $product_details_distinct = $product_details;
        }

        if ($data_color['data'] != null)
            $colors = $data_color['data']->collection;
        //dd($product_details_distinct);
        return view('producer_management/producer_product_detail', ['product_details_distincts' => $product_details_distinct, 'product_details' => $product_details, 'colors' => $colors, 'sizes' => $sizes, 'product' => $product_response['data']]);
    }

    private function getDistinct($product_details, $product_detail)
    {
        if ($product_details != null) {
            foreach ($product_details as $prd_dt) {
                if ($prd_dt->product->product_id == $product_detail->product->product_id && $prd_dt->color->color_id == $product_detail->color->color_id) {
                    return $product_details;
                }
            }
        }

        array_push($product_details, $product_detail);
        return $product_details;
    }

    //Remove Producer
    public function removeProducer(Request $req)
    {
        $producerController = new ServicesProducerController();
        $result = $producerController->removeProducer($req);
        if ($result != null)
            return redirect(route('producer_management'));
        return back()->withErrors(['error' => 'Xoá thất bại']);
    }

    //Add Producer Product Detail
    public function addProducerProductDetail(Request $req, $prod_id)
    {
        try {
            // dd($req);
            if ($files = $req->file('images')) {
                $allowedfileExtension = ['jpg', 'png']; //extension file allowed
                foreach ($files as $file_1) {
                    //Check file until valid. 
                    $extension = $file_1->getClientOriginalExtension(); //get extension
                    if (in_array($extension, $allowedfileExtension)) { //check extension
                        //create image name
                        $increase = 1;
                        $product_img = 'PROD' . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis') . $increase . '.' . $file_1->getClientOriginalExtension();
                        $req->product_img = $product_img; //set image name
                        $req->product_id = $prod_id;
                        $productDetailController = new ServicesProductDetailController();
                        $productDetailController->saveProductDetail($req);
                        foreach ($files as $file_2) {
                            $extension = $file_2->getClientOriginalExtension();
                            $check = in_array($extension, $allowedfileExtension);
                            if ($check) {
                                if ($file_2 == $file_1) { //check file 2 equal file 1, get image name exsits
                                    $img_name = $product_img;
                                } else { //create new image name
                                    $img_name = 'PROD' . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis') . $increase . '.' . $file_2->getClientOriginalExtension();
                                }
                                $path = 'upload/products/' . $req->product_id;
                                //move file to dic path
                                if ($file_2->move($path, $img_name)) {
                                    $imageController = new ImageController();
                                    $req->img_name =  $img_name;
                                    $req->increase = $increase;
                                    $imageController->saveImage($req);
                                    $increase++;
                                }
                            } else {
                                return back()->withErrors(['errorProducerProductDetailSave' => "Xin Lỗi! File không đúng dịnh dạng (PNG, JPG)"]);
                            }
                        }
                        return redirect(route('producer-product-detail', ['product_id' => $prod_id]));
                    }
                }
            }
        } catch (Exception $e) {
            return back()->withErrors(['errorProducerProductDetailSave' => 'Thêm thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
    }

    private function prepareDataProductDetail( $req)
    {
       $data = [];
       if($req->color_id){
            $data['color_id'] = $req->color_id;
       }
       if($req->size_id){
            $data['size_id'] = $req->size_id;
       }
       if($req->price_produced){
            $data['price_produced'] = $req->price_produced;
       }
       
       return $data;
    }

    //Add Producer Product Detail
    public function editImageProducerProductDetail(Request $req, $detail_product_id)
    {
 
        $product_detail = ProductDetail::where('product_detail_id', $detail_product_id)->first();

        $prod_id = $product_detail->product_id; 
        $dataUpdate = $this->prepareDataProductDetail($req);
        $new_product_detail_id = ProductDetailHelper::createProductDetailId($prod_id, $req);
        $dataUpdate['product_detail_id'] = $new_product_detail_id;
        $dataUpdate['product_id'] = $prod_id;
        //delete
        ProductDetail::where('product_detail_id', $detail_product_id)->delete(); 
        //create new
        ProductDetail::create($dataUpdate);

        if ($files = $req->file('images')) {
            $allowedfileExtension = ['jpg', 'png']; //extension file allowed
            foreach ($files as $file_1) {  //Check file until valid. 
                $extension = $file_1->getClientOriginalExtension(); //get extension
                if (in_array($extension, $allowedfileExtension)) { //check extension
                    $req->product_id =  $prod_id;
                    $increase = 1;
                    foreach ($files as $file_2) {
                        $extension = $file_2->getClientOriginalExtension();
                        $check = in_array($extension, $allowedfileExtension);

                        if ($check) {
                            $img_name = 'PROD' . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis') . $increase . '.' . $file_2->getClientOriginalExtension();
                            $path = 'upload/products/' . $req->product_id;
                            //move file to dic path
                            if ($file_2->move($path, $img_name)) {
                                $imageController = new ImageController();
                                $req->img_name =  $img_name;
                                $req->increase = $increase;
                                $imageController->saveImage($req);
                                $increase++;
                            }
                        } else {
                            return back()->withErrors(['error' => "Xin Lỗi! File không đúng dịnh dạng (PNG, JPG)"]);
                        }
                    }
                    return redirect(route('producer-product-detail', ['product_id' => $prod_id]));
                }
            }
        }
        return back()->withErrors(['error' => "Không thể cập nhật thông tin"]);
    }

    //Add Product
    public function addProduct(Request $req)
    { 
        //dd($req->all());
        if($req->file('images')){
            $files = $req->file('images');
            $file_1 = $files[0];
            $allowedfileExtension = ['jpg', 'png']; //extension file allowed
            //Check file until valid. 
            $extension = $file_1->getClientOriginalExtension(); //get extension
            $product_img = '';
            if (in_array($extension, $allowedfileExtension)) { //check extension
                //create image name
                $increase = 1;
                $product_img = 'PROD' . Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis') . $increase . '.' . $file_1->getClientOriginalExtension();
                
            }
        }
       
        $productController = new ProductController();
        $req->product_img = $product_img; //set image name
        $result = $productController->saveProduct($req); //save product
        if ($result != null) { //check status save
            $req->product_id = $result['data']->product_id;
            $productDetailController = new ServicesProductDetailController();
            $result_prod = $productDetailController->saveProductDetail($req);
            if (!$result_prod['data']) {
                return back()->withErrors(['error' => "Thêm chi tiết sản phẩm " + $req->product_id + " thất bại"]);
            }
        } else {
            return back()->withErrors(['error' => "Thêm sản phẩm thất bại"]);
        }

        if($req->file('images')){
            $path = 'upload/products/' . $req->product_id; 
            //move file to dic path
            if ($file_1->move($path, $product_img)) {
                $imageController = new ImageController();
                $req->img_name =  $product_img;
                $req->increase = $increase;
                
                $imageController->saveImage($req);
            }
        }
        return redirect(route('producer-detail', ['producer_id' => $req->producer_id]));  
    }
}