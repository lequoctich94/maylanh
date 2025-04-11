<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\AddressController;
use App\Http\Controllers\services\BillController;
use App\Http\Controllers\services\BillDetailController;
use App\Http\Controllers\services\CartController;
use App\Http\Controllers\services\DiscountCategoryController;
use App\Http\Controllers\services\VoucherMemberController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UCheckoutStepController extends Controller
{
    protected $cartController;
    protected $voucherMemberController;
    protected $discountCategoryController;
    protected $addressController;
    protected $billController;
    protected $billDetailController;

    public function __construct()
    {
        $this->cartController = new CartController();
        $this->voucherMemberController = new VoucherMemberController();
        $this->discountCategoryController = new DiscountCategoryController();
        $this->addressController = new AddressController();
        $this->billController = new BillController();
        $this->billDetailController = new BillDetailController();
    }

    public function cart()
    {
        $cartData = $this->getCurrentCart();
        if (!is_null($cartData) && "user/cart" != $cartData['currentStep']) {
            return redirect(route($cartData['currentStep']));
        }

        $member = $this->getCurrentMember();
        $cart_response = $this->cartController->getAllCartByIdMember($member->member_id);
        if (!is_null($cart_response['data']) && !empty($cart_response['data']->collection)) {
            $this->viewData['carts'] = $cart_response['data']->collection;
        }

        $voucher_response = $this->voucherMemberController->getAllVoucherMemberByIdMemberAndStatus($member->member_id, 1);

        if (!is_null($voucher_response['data'])) {
            $this->viewData['voucherMembers'] = $voucher_response['data']->collection;
        }

        return view(
            'user/cart/cart',
            $this->viewData
        );
    }

    public function paymentShipping()
    {
        $cartData = $this->getCurrentCart();
        
        if (is_null($cartData)) {
            return redirect(route('user/cart'));
        }
        if ("user/payment-shipping" != $cartData['currentStep']) {
            return redirect(route($cartData['currentStep']));
        }
        $this->viewData['member'] = $this->getCurrentMember();
        $rankId = $this->viewData['member']->rank->rank_id;

        $this->viewData['voucher'] = $cartData['voucher'];
        $cart_response = $this->cartController->getAllCartByCartIds($cartData['cartIdsSelected']);
       
        if (!is_null($cart_response['data'])) {

            $city_response = $this->addressController->getCityInVN();
          
            if (!is_null($city_response['data'])) {
                $this->viewData['cities'] = collect($city_response['data']);
            }

            $this->viewData['carts'] = $cart_response['data']->collection;

            $discountIds = [];
            foreach ($this->viewData['carts'] as $cart) {
                $categoryId = $cart->product_detail->product->category_id;
                if (!in_array($rankId . $categoryId, $discountIds)) {
                    array_push($discountIds, $rankId . $categoryId);
                }
            }
           
            $discount_response = $this->discountCategoryController->getAllDiscountCategoryByIdsAndStatus($discountIds, 1);
            if (!is_null($discount_response['data'])) {
                $discount_map = collect([]);
                foreach ($discount_response['data']->collection as $discount) {
                    $discount_map[$discount->category_id] = $discount;
                }

                $this->viewData['discount_map'] = $discount_map;
                request()->session()->push("cartData.discountIds", $discount_map);
            }
        } else {
            return redirect(route('user/cart'));
        }
       // dd($this->viewData);
        return view(
            'user/payment_shipping/payment_shipping',
            $this->viewData
        );
    }
    public function paymentSuccessfully()
    {
        $cartData = $this->getCurrentCart();
        if (is_null($cartData)) {
            return redirect(route('user/cart'));
        }
        if ("user/payment-successfully" != $cartData['currentStep']) {
            return redirect(route($cartData['currentStep']));
        }
        try {
            $member = $this->getCurrentMember();
            $req = new Request([
                'member_id' => $member->member_id,
                'shipping_address' => $cartData['infoPayer']['shipping_address'],
                'shipping_phone' => $cartData['infoPayer']['shipping_phone'],
                'code' => is_null($cartData['voucher']) ? null : $cartData['voucher']['voucher_id'],
                'receiver' => $cartData['infoPayer']['reveicer'],
                'total_price' => $cartData['totalPrice'],
                'total_quantity' => count($cartData['cartIdsSelected']),
                'payment' => $cartData['payment'],
            ]);
            $bill = $this->billController->saveBill($req)['data'];
            $carts = $this->cartController->getAllCartByCartIds($cartData['cartIdsSelected'])['data']->collection;

            foreach ($carts as $cart) {
                $price_discount = 0;
                if (!empty($cartData['discountIds']) && Arr::has($cartData['discountIds'][0], $cart->product_detail->product->category_id)) {
                    $price_discount = $cartData['discountIds'][0][$cart->product_detail->product->category_id]->percent_price * $cart->price_pay;
                }
                $req = new Request(
                    [
                        'product_detail_id' => $cart->product_detail_id,
                        'bill_id' => $bill->bill_id,
                        'quantity' => $cart->quantity,
                        'price' => $cart->price_pay,
                        'total_price' => $cart->quantity * $cart->price_pay,
                        'price_discount' => $price_discount,
                    ]
                );

                $this->billDetailController->saveBillDetail($req);
            }

            $member = $this->getCurrentMember();
            $req = new Request(
                [
                    'member_id' => $member->member_id,
                    'cart_ids' => $cartData['cartIdsSelected'],
                ]
            );
            $this->cartController->removeCartByIDs($req);
            $this->removeCartSession();
            return view('user/payment_shipping/payment_successfully');
        } catch (Exception $err) {
            return back()->withErrors(['paymentError' => 'Hệ thống đang gián đoạn, vui lòng thử lại sau']);
        }
    }
    public function saveCheckoutStep(Request $req)
    {
        try {
            $cartData = request()->session()->get("cartData");
            if (is_null($cartData)) {
                request()->session()->put("cartData", $req->cartData);
            } else {
                $this->updateCartSession($req->cartData, $cartData);
            }
            return true;
        } catch (Exception $error) {
            return false;
        }
    }

    public function backCheckoutStep(Request $req)
    {
        try {
            request()->session()->forget("cartData");
            return $req->currentStep;
        } catch (Exception $error) {
            return "/";
        }
    }

    private function getCurrentMember()
    {
        return request()->session()->get('member');
    }

    private function getCurrentCart()
    {
        return request()->session()->get("cartData");
    }

    private function removeCartSession()
    {
        request()->session()->forget('cartData');
    }

    private function updateCartSession($request, $cartData)
    {
        if (Arr::has($request, 'currentStep')) {
            $cartData['currentStep'] = $request['currentStep'];
        }

        if (Arr::has($request, 'cartIdsSelected')) {
            $cartData['cartIdsSelected'] = $request['cartIdsSelected'];
        }

        if (Arr::has($request, 'voucher')) {
            $cartData['voucher'] = $request['voucher'];
        }

        if (Arr::has($request, 'infoPayer')) {
            $cartData['infoPayer'] = $request['infoPayer'];
        }

        if (Arr::has($request, 'discountIds')) {
            $cartData['discountIds'] = $request['discountIds'];
        }

        if (Arr::has($request, 'payment')) {
            $cartData['payment'] = $request['payment'];
        }

        if (Arr::has($request, 'totalPrice')) {
            $cartData['totalPrice'] = $request['totalPrice'];
        }
        request()->session()->put("cartData", $cartData);
    }
}
