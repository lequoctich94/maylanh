<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\AbstractController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\services\ColorController;
use App\Http\Controllers\services\FavouritesController;
use App\Http\Controllers\services\ImageController;
use App\Http\Controllers\services\SizeController;
use App\Http\Controllers\services\StockDetailController;
use App\Http\Controllers\services\RateController;
use Error;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class UProductDetailController extends Controller
{
    protected $stockDetailController;
    protected $imageProductController;
    protected $favourityController;
    protected $colorController;
    protected $sizeController;
    protected $rateController;

    public function __construct()
    {
        $this->stockDetailController = new StockDetailController();
        $this->imageProductController = new ImageController();
        $this->favourityController = new FavouritesController();
        $this->colorController = new ColorController();
        $this->sizeController = new SizeController();
        $this->rateController = new RateController();
    }

    public function productDetail(Request $request)
    {
        try {
            $product_id = $request->input('searchID');
            if (!is_null($product_id)) {
                $stock_detail_response = $this->stockDetailController->getFirstStockDetailByProductId($product_id);
                if (!is_null($stock_detail_response['data'])) {
                    //---- STOCK DETAIL START ----
                    $this->viewData['stock_detail'] = $stock_detail_response['data'];
                    //---- STOCK DETAIL START ----

                    // ---- IMAGE START ----
                    $this->viewData['images'] = $stock_detail_response['data']->product_detail->product->images;
                    // ---- IMAGE END ----

                    // ---- COLOR START ----
                    $color_response = $this->colorController->getAllColorByProductIdAndStatusInStock($product_id, 1);
                    if (!empty($color_response['data']->collection)) {
                        $this->viewData['colors'] = $color_response['data']->collection;
                    }
                    // ---- COLOR END ----

                    // ---- SIZE START ----
                    $size_response = $this->sizeController->getAllSizeByProductIdAndStatusInStock($product_id, 1);
                    if (!empty($size_response['data']->collection)) {
                        $this->viewData['sizes'] = $size_response['data']->collection;
                    }
                    // ---- SIZE END ----

                    // ---- RATE START ----
                    $rate_response = $this->rateController->getAllRateByIdProductAndStatus($product_id, 1);
                    if (!empty($rate_response['data']->collection)) {
                        $this->viewData['rates'] = $rate_response['data']->collection;
                    }
                    // ---- RATE END ----

                    // ---- IS FAVOURITY START ----
                    $member = $request->session()->get('member');
                    if (!is_null($member)) {
                        $isFavourity = $this->favourityController->isProductDetailInFavourites($stock_detail_response['data']->product_detail->product_detail_id, $member->member_id);
                        $this->viewData['isFavourity'] = $isFavourity['data'];
                        $this->viewData['member'] = $member;
                    }
                    // ---- IS FAVOURITY START ----
                } else {
                    return redirect()->route("user/index");
                }
            }
            return view(
                'user/product_detail/product_detail',
                $this->viewData
            );
        } catch (Exception $ex) {
            return redirect()->route("user/index");
        } catch (Error $err) {
            return redirect()->route("user/index");
        }
    }
}