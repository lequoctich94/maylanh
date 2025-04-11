<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Member;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Payload;
use App\Http\Controllers\services\ActivityHistoryController;
use Exception;

class CartController extends Controller
{
    public function getAllCartByIdMember($id)
    {
        $carts = Cart::where('member_id', $id)->get();
        if ($carts->isEmpty()) {
            return Payload::toJson(null, "Data Not Found", 404);
        }
        foreach ($carts as $cart) {
            $stockDetailController = new StockDetailController();
            $cart->status = $stockDetailController->checkProductDetailIsExistInStock($cart->product_detail_id);
        }
        return Payload::toJson(CartResource::collection($carts), "Request Successfully", 200);
    }

    public function getAllCartByCartIds($cart_ids)
    {
        $carts = Cart::whereIn('cart_id', $cart_ids)->get();
        if ($carts->isEmpty()) {
            return Payload::toJson(null, "Data Not Found", 404);
        }
        return Payload::toJson(CartResource::collection($carts), "Request Successfully", 200);
    }

    public function removeCart(Request $req)
    {
        DB::beginTransaction();
        try {
            $cart = Cart::where('cart_id', $req->cart_id)->first();

            if (is_null($cart)) {
                return Payload::toJson(true, "Remove Successfully", 202);
            }

            $product_name = $cart->product_detail->product->product_name;
            $color = $cart->product_detail->color->color_name;
            $size = $cart->product_detail->size->size_name;

            $requ = new Request([
                'activity' => "Xoá sản phẩm $product_name màu $color kích thước $size khỏi giỏ hàng",
                'user_id' => $cart->member->user->user_id,
                'object_id' => $cart->product_detail->product_detail_id,
                'type' => 2
            ]);

            $cart = Cart::where('cart_id', $req->cart_id)->delete();
            $actHisController = new ActivityHistoryController();
            $actHisController->saveActivityHistory($requ);
            DB::commit();
            return Payload::toJson(true, "Remove Successfully", 202);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateQuantityInCart(Request $req)
    {
        DB::beginTransaction();
        try {
            $cart = Cart::where('cart_id', $req->cart_id)->first();
            $stockDetailController = new StockDetailController();
            $isEnough = $stockDetailController->checkQuantityProductDetailInStock($cart->product_detail->product_detail_id, $req->quantity)['data'];
            if ($isEnough == 0) {
                return Payload::toJson(-1, "Quantity In Stock Not Enough", 200);
            }

            $product_name = $cart->product_detail->product->product_name;
            $color = $cart->product_detail->color->color_name;
            $size = $cart->product_detail->size->size_name;

            $requ = new Request([
                'activity' => "Cập nhật số lượng thành $cart->quantity sản phẩm $product_name màu $color kích thước $size vào giỏ hàng",
                'user_id' => $cart->member->user->user_id,
                'object_id' => $cart->product_detail->product_detail_id,
                'type' => 2
            ]);

            $cart = Cart::where('cart_id', $req->cart_id)->update(['quantity' => $req->quantity]);

            DB::commit();
            if ($cart == 1) {
                $actHisController = new ActivityHistoryController();
                $actHisController->saveActivityHistory($requ);
                return Payload::toJson($cart, 'Completed', 202);
            }
            return Payload::toJson($cart, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeAllCart(Request $req)
    {
        DB::beginTransaction();
        try {
            $member = Member::where('member_id', $req->member_id)->first();
            $requ = new Request([
                'activity' => "Xoá tất cả sản phẩm khỏi giỏ hàng",
                'user_id' => $member->user->user_id,
                'object_id' => null,
                'type' => 2
            ]);

            Cart::where('member_id', $member->member_id)->delete();
            $actHisController = new ActivityHistoryController();
            $actHisController->saveActivityHistory($requ);
            DB::commit();
            return Payload::toJson(true, "Remove Successfully", 202);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeCartByIDs(Request $req)
    {
        DB::beginTransaction();
        try {
            $member = Member::where('member_id', $req->member_id)->first();
            $requ = new Request([
                'activity' => "Xoá danh các sản phẩm khỏi giỏ hàng",
                'user_id' => $member->user->user_id,
                'object_id' => null,
                'type' => 2
            ]);

            Cart::whereIn('cart_id', $req->cart_ids)->delete();
            $actHisController = new ActivityHistoryController();
            $actHisController->saveActivityHistory($requ);
            DB::commit();
            return Payload::toJson(true, "Remove Successfully", 202);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function saveCart(Request $req)
    {
        DB::beginTransaction();
        try {
            $cart = new Cart();
            $cart->fill(
                [
                    'cart_id' => $req->product_detail_id . $req->member_id,
                    'product_detail_id' => $req->product_detail_id,
                    'member_id' => $req->member_id,
                    'quantity' => $req->quantity,
                    'price_pay' => $req->price_pay,
                ]
            );
            $cart->save();
            $cart = Cart::where('cart_id', $cart->cart_id)->first();

            $product_name = $cart->product_detail->product->product_name;
            $color = $cart->product_detail->color->color_name;
            $size = $cart->product_detail->size->size_name;
            $requ = new Request([
                'activity' => "Thêm $cart->quantity sản phẩm $product_name màu $color kích thước $size vào giỏ hàng",
                'user_id' => $cart->member->user->user_id,
                'object_id' => $cart->product_detail->product_detail_id,
                'type' => 2
            ]);

            $actHisController = new ActivityHistoryController();
            $actHisController->saveActivityHistory($requ);
            DB::commit();
            return Payload::toJson(new CartResource($cart), "Create Successfully", 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function saveAndUpdateCart(Request $req)
    {
        DB::beginTransaction();
        try {
            $cart_id = $req->product_detail_id . $req->member_id;
            $cartExist = Cart::where('cart_id', $cart_id)->first();
            if ($cartExist != null) {
                //If exist => update quantity cart
                $req['cartExist'] = $cartExist;
                $status = $this->updateCartDB($req);
                $message = "Update Successfully";
                $statusCode = "U";
            } else {
                //If not exist => save cart
                $req['cart_id'] = $req->product_detail_id . $req->member_id;
                $status = $this->saveCartDB($req);
                $message = "Create Successfully";
                $statusCode = "C";
            }
            $cartExist = $req->input('cartExist');

            $product_name = $cartExist->product_detail->product->product_name;
            $color = $cartExist->product_detail->color->color_name;
            $size = $cartExist->product_detail->size->size_name;

            $requ = new Request([
                'activity' => "Thêm $cartExist->quantity sản phẩm $product_name màu $color kích thước $size vào giỏ hàng",
                'user_id' => $cartExist->member->user->user_id,
                'object_id' => $cartExist->product_detail->product_detail_id,
                'type' => 2
            ]);

            DB::commit();

            if ($status != 0) {
                $actHisController = new ActivityHistoryController();
                $actHisController->saveActivityHistory($requ);
                return Payload::toJson(new CartResource($cartExist), $message, $statusCode);
            }
            return Payload::toJson(null, "Uncompleted", "E");
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    private function saveCartDB(Request $req)
    {
        DB::beginTransaction();
        try {
            $cart = new Cart();
            $cart->fill(
                [
                    'cart_id' => $req->cart_id,
                    'product_detail_id' => $req->product_detail_id,
                    'member_id' => $req->member_id,
                    'quantity' => $req->quantity,
                    'price_pay' => $req->price_pay,
                ]
            );
            $status = $cart->save();
            $req['cartExist'] = Cart::where('cart_id', $req->cart_id)->first();
            DB::commit();
            return $status;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    private function updateCartDB(Request $req)
    {
        DB::beginTransaction();
        try {
            $cart = $req->input('cartExist');
            $quantity = $req->quantity + $cart->quantity;
            $status = Cart::where('cart_id', $cart->cart_id)->update(['quantity' => $quantity]);
            $cart->quantity = $quantity;
            $req['cartExist'] = $cart;
            DB::commit();
            return $status;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}