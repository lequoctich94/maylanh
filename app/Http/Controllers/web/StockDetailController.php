<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\BillOrderController;
use App\Http\Controllers\services\BillOrderDetailController;
use App\Http\Controllers\services\ColorController;
use App\Http\Controllers\services\ImageController;
use App\Http\Controllers\services\ProducerController as ServicesProducerController;
use App\Http\Controllers\services\ProductController;
use App\Http\Controllers\services\ProductDetailController;
use App\Http\Controllers\services\SizeController;
use App\Http\Controllers\services\RateController as ServicesRateController;
use App\Http\Controllers\services\StockDetailController as ServicesStockDetailController;
use Exception;
use Illuminate\Http\Request;
use App\Helper\ProductDetailHelper;

class StockDetailController extends Controller
{
    public function productDetailManagement($product_id)
    {
        $stockDetailController = new ServicesStockDetailController();
        $data_stock_detail = $stockDetailController->getAllStockDetailByProductId($product_id);
        $stock_details = [];
        $image = [];

        if ($data_stock_detail['data'] != null) {
            $stock_details =  $data_stock_detail['data']->collection;
            $product_id = $stock_details[0]->product_detail->product->product_id;
            $imageController = new ImageController();
            $images = $imageController->getAllImageByProductIdAndStatus($product_id, 1)['data'];
            $image = $this->getImageDistinct($images);
        }
        return view('product_management/product_detail', ['stock_details' => $stock_details, 'image' => $image]);
    }

    private function getImageDistinct($images)
    {
        $distinct_color_images = [];
        foreach ($images as $image) {
            $distinct_color_images[$image->color->color_id] = $image; //get ont image of color
        }
        return $distinct_color_images;
    }

    public function productManagement()
    {
        $productController = new ProductController();
        $data_product = $productController->getAllProductInStock(new Request(['status' => 'all']));
        $products = [];

        if ($data_product['data'] != null) {
            $products = $data_product['data']->collection;
        }
        return view('product_management/product', ['products' => $products]);
    }

    public function productRateManagement($product_id)
    {
        $rateController = new ServicesRateController();
        $productController = new ProductController();
        $data_product_rate = $rateController->getAllRateByIdProductAndStatus($product_id, 1);
        $data_product = $productController->getProductByIdAndStatus($product_id, 1);
        $rates = [];
        $product = $data_product['data'];

        if ($data_product_rate['data'] != null) {
            $rates = $data_product_rate['data']->collection;
        }
        return view('product_management/product_rate', ['rates' => $rates, 'product' => $product]);
    }



    private function getDistinct($stock_details, $stock_detail)
    {
        if ($stock_details != null) {
            foreach ($stock_details as $st_dt) {
                if ($st_dt->product_detail->product->product_id == $stock_detail->product_detail->product->product_id && $st_dt->product_detail->color->color_id == $stock_detail->product_detail->color->color_id) {
                    return $stock_details;
                }
            }
        }
        array_push($stock_details, $stock_detail);
        return $stock_details;
    }


    public function addProductManagement(Request $req)
    {
        session()->forget('cart');
        $producersController = new ServicesProducerController();
        $data_producer = $producersController->getAllProducerByStatus(1);
        $producers = [];
        if ($data_producer['data'] != null)
            $producers = $data_producer['data']->collection;

        return view('product_management/add_product', ['producers' => $producers]);
    }

    public function updatePricePayInStock(Request $req)
    {
        if ($req->price_pay == null) {
            return back()->withErrors(['price_pay_error' => 'Thêm thất bại']);
        }
        $stockDetailController = new ServicesStockDetailController();

        $result = $stockDetailController->updatePricePayInStock($req);
        if ($result != null)
            return back()->with('success', 'Cập nhật thành công');
        return back()->withErrors(['error' => 'Cập nhật thất bại']);
    }


    public function removeProductDetailInStockManagement(Request $req)
    {
        $stockDetailController = new ServicesStockDetailController();
        $result = $stockDetailController->removeProductDetailInStock($req);
        if ($result != null)
            return redirect(route('product-management'));
        return back()->withErrors('error', 'Xoá thất bại');
    }

    public function orderProductInStock(Request $req)
    {
        $billOrderController = new BillOrderController();
        $billOrderDetailController = new BillOrderDetailController();
        $stockDetailController = new ServicesStockDetailController();

        $cart = $req->session()->get('cart');
        $producer_id = '';
        $totalPriceOrder = 0;
        $totalQuantity = 0;

        foreach ($cart as $crt) {
            $producer_id = $crt['product_detail']->product->producer->producer_id;
            $totalPriceOrder += $crt['product_detail']->price_produced * $crt['quantity'];
            $totalQuantity += $crt['quantity'];
        }

        $req_bill_order = new Request([
            'user_id' => request()->session()->get("admin")->user_id,
            'stock_id' => 'STOCK01',
            'producer_id' => $producer_id,
            'amount' => $totalQuantity,
            'total_price' => $totalPriceOrder,
        ]);

        $result = $billOrderController->saveBillOrder($req_bill_order);
        if ($result != null) {
            $req_orders = [];
            foreach ($cart as $details) {
                $req_order = new Request([
                    'product_detail_id' => $details['product_detail']->product_detail_id,
                    'bill_order_id' => $result['data']->bill_order_id,
                    'quantity' => $details['quantity'],
                    'price_order' => $details['product_detail']->price_produced,
                    'stock_id' => 'STOCK01',
                    'price_pay' => $details['price_pay'],
                ]);
                array_push($req_orders, $req_order);
            }
            $billOrderDetailController->saveBillOrderDetail($req_orders);
            $stockDetailController->saveProductDetailInStock($req_orders);
            return redirect(route('product-management'));
        }
    }

    public function orderProductAgainInStock(Request $req)
    {

        if ($req->quantity == null) {
            return back()->withErrors(['quantity_error' => 'Thêm thất bại']);
        }

        $productDetailController = new ProductDetailController();
        $productDetail = $productDetailController->getProductDetailById($req->product_detail_id)['data'];
        $billOrderController = new BillOrderController();
        $billOrderDetailController = new BillOrderDetailController();
        $stockDetailController = new ServicesStockDetailController();

        $req_bill_order = new Request([
            'user_id' => request()->session()->get("admin")->user_id,
            'stock_id' => 'STOCK01',
            'producer_id' => $productDetail->product->producer->producer_id,
            'amount' => $req->quantity,
            'total_price' => $req->quantity * $productDetail->price_produced,
        ]);
        $result = $billOrderController->saveBillOrder($req_bill_order);

        if ($result != null) {
            $req_order = new Request([
                'product_detail_id' => $req->product_detail_id,
                'bill_order_id' => $result['data']->bill_order_id,
                'quantity' => $req->quantity,
                'price_order' => $productDetail->price_produced,
                'stock_id' => 'STOCK01',
                'price_pay' => $req->price_pay
            ]);
            $billOrderDetailController->saveBillOrderDetail($req_order);
            $stockDetailController->saveProductDetailInStock($req_order);
        }
        return back()->with('success', 'Nhập hàng thành công');
    }

    public function addProductToCart(Request $req)
    {
       
        $data = $req->data;
        $cart = session()->get('cart');
       //  dd($req->all());
        foreach ($data as $key) {
            $product_detail_id = ProductDetailHelper::createProductDetailId($key["product_id"], $key);
            //dd($product_detail_id);
            $productDetailController = new ProductDetailController();
            $product_detail_response = $productDetailController->getProductDetailById($product_detail_id);
            $product_detail = $product_detail_response['data'];
            $cart = $this->handleCheckAndAddToCart($cart, $product_detail, $key["quantity"], $key["price_pay"]);
        };
        session()->put('cart', $cart);
        return [
            'data' => $cart,
            'quantity' => count($cart),
        ];
    }

    public function removeProductToCart()
    {
        if (session()->has('cart')) {
            session()->forget('cart');
        }
        return true;
    }

    private function handleCheckAndAddToCart($cart, $product_detail, $quantity, $price_pay)
    {
        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $product_detail->product_detail_id => [
                    "product_detail" => $product_detail,
                    "quantity" => $quantity,
                    "price_pay" => $price_pay,
                ]
            ];
        }
        // if cart not empty then check if this product exist then increment quantity
        else if (isset($cart[$product_detail->product_detail_id])) {
            $cart[$product_detail->product_detail_id]['quantity'] +=  $quantity;
        } else {
            // if item not exist in cart then add to cart with quantity = 1
            $cart[$product_detail->product_detail_id] = [
                "product_detail" => $product_detail,
                "quantity" => $quantity,
                "price_pay" => $price_pay,
            ];
        }
        return $cart;
    }

    public function removeProductInStock(Request $req)
    {
        try {
            $stockDetailController = new ServicesStockDetailController();
            $stockDetailController->removeProductInStock($req);
            return  redirect()->route('//product-detail-management/' . $req->product_id);
        } catch (Exception $ex) {
            return back()->withErrors(['error' => 'Xoá thất bại']);
        }
    }
}
