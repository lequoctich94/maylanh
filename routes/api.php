<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\services\RoleController;
use App\Http\Controllers\services\SizeController;
use App\Http\Controllers\services\StockController;
use App\Http\Controllers\services\StockDetailController;
use App\Http\Controllers\services\UserController;
use App\Http\Controllers\services\VoucherController;
use App\Http\Controllers\services\MemberController;
use App\Http\Controllers\services\ImageController;
use App\Http\Controllers\services\ProductController;
use App\Http\Controllers\services\ProductDetailController;
use App\Http\Controllers\services\RankController;
use App\Http\Controllers\services\RateController;
use App\Http\Controllers\services\BillController;
use App\Http\Controllers\services\CategoryController;
use App\Http\Controllers\services\CartController;
use App\Http\Controllers\services\VoucherMemberController;
use App\Http\Controllers\services\FavouritesController;
use App\Http\Controllers\services\ProducerController;
use App\Http\Controllers\services\ActivityHistoryController;
use App\Http\Controllers\services\AddressController;
use App\Http\Controllers\services\BillDetailController;
use App\Http\Controllers\services\BillOrderController;
use App\Http\Controllers\services\BillOrderDetailController;
use App\Http\Controllers\services\ColorController;
use App\Http\Controllers\services\DiscountCategoryController;
use App\Http\Controllers\services\NotificationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/users'], function () {
    //Check login get token
    Route::post('/get-user-by-username-password', [UserController::class, 'getUserByUserNameAndPassword']);

    //Forgot password
    Route::post('/get-user-by-username-and-status/{status}', [UserController::class, 'getUserByUsernameAndStatus']);

    //Confirm code
    Route::post('/confirm-code', [UserController::class, 'confirmCode']);

    //Create user
    Route::post('/save-user', [UserController::class, 'saveUser']);


    Route::post('/check-email-user-exist', [UserController::class, 'checkEmailUserExist']);


    Route::post('/change-password', [UserController::class, 'changePassword']);
});

// API Size
Route::group(['prefix' => '/sizes'], function () {
    Route::get('/get-all-size-by-id-product-and-id-color-and-status/{size_id}&{color_id}&{status}', [SizeController::class, 'getAllSizeByProductIdAndColorIdAndStatusInStock']);
});

//API COLOR
Route::group(['prefix' => 'colors'], function () {
    Route::get('/get-all-color-by-product-id-and-size-id-and-status-in-stock/{product_id}&{size_id}&{status}', [ColorController::class, 'getAllColorByProductIdAndSizeIdAndStatusInStock']);
});

//API Stock Detail
Route::group(['prefix' => '/stock-details'], function () {
    Route::get('/get-product-detail-in-stock-by-product-detail-id-and-status/{product_detail_id}&{status}', [StockDetailController::class, 'getProductDetailInStockByProductDetailIdAndStatus']);
});

Route::group(
    ['middleware' => 'verifyToken'],
    function () {
        // API Role
        Route::group(['prefix' => '/roles'], function () {
            Route::get('/get-all-role-by-status/{status}', [RoleController::class, 'getAllRoleByStatus']);

            Route::get('/get-role-by-id-and-status/{role_id}&{status}', [RoleController::class, 'getRoleByIdAndStatus']);

            Route::get('/get-role-by-id/{role_id}', [RoleController::class, 'getRoleById']);

            Route::post('/save-role', [RoleController::class, 'saveRole']);

            Route::post('/update-role', [RoleController::class, 'updateRole']);

            Route::post('/remove-role', [RoleController::class, 'removeRole']);
        });

        // API Size
        Route::group(['prefix' => '/sizes'], function () {
            Route::get('/get-all-size-by-status/{status}', [SizeController::class, 'getAllSizeByStatus']);

            Route::get('/get-size-by-id/{size_id}', [SizeController::class, 'getSizeById']);

            Route::get('/get-size-by-id-and-status/{size_id}&{status}', [SizeController::class, 'getSizeByIdAndStatus']);

            Route::get('/get-all-size-by-id-category-and-status/{size_id}&{status}', [SizeController::class, 'getAllSizeByIdCategoryAndStatus']);

            Route::post('/save-size', [SizeController::class, 'saveSize']);

            Route::post('/update-size', [SizeController::class, 'updateSize']);

            Route::post('/remove-size', [SizeController::class, 'removeSize']);
        });

        //API Stock
        Route::group(['prefix' => '/stocks'], function () {
            Route::get('/get-all-stock-by-status/{status}', [StockController::class, 'getAllStockByStatus']);

            Route::get('/get-stock-by-id-and-status/{stock_id}&{status}', [StockController::class, 'getStockByIdAndStatus']);

            Route::post('/save-stock', [StockController::class, 'saveStock']);

            Route::post('/update-stock', [StockController::class, 'updateStock']);

            Route::post('/remove-stock', [StockController::class, 'removeStock']);
        });


        //API Stock Detail
        Route::group(['prefix' => '/stock-details'], function () {

            Route::get('/get-all-product-detail-in-stock-by-status/{status}', [StockDetailController::class, 'getAllProductDetailInStockByStatus']);

            Route::get('/get-all-product-in-stock-and-rate-and-pay-by-status/{status}', [StockDetailController::class, 'getAllProductInStockAndRateAndPayByStatus']);

            Route::get('/get-stock-detail-by-product-id-and-color-id-and-size-id/{product_id}&{color_id}&{size_id}', [StockDetailController::class, 'getStockDetailByProductIdAndColorIdAndSizeId']);

            Route::get('/check-quantity-product-detail-in-stock/{product_detail_id}&{quantity}', [StockDetailController::class, 'checkQuantityProductDetailInStock']);

            Route::get('/get-all-stock-detail-by-product-id-and-color-id/{product_id}&{color_id}', [StockDetailController::class, 'getAllStockDetailByProductIdAndColorId']);

            Route::get('/get-all-stock-detail-by-product-id-and-status/{product_id}&{status}', [StockDetailController::class, 'getAllStockDetailByProductIdAndStatus']);

            Route::get('/get-first-stock-detail-by-product-id/{product_id}', [StockDetailController::class, 'getFirstStockDetailByProductId']);

            Route::post('/save-product-detail-in-stock', [StockDetailController::class, 'saveProductDetailInStock']);

            Route::post('/update-quantity-product-detail-in-stock', [StockDetailController::class, 'updateQuantityProductDetailInStock']);

            Route::post('/add-quantity-product-detail-in-stock', [StockDetailController::class, 'addQuantityProductDetailInStock']);

            Route::post('/remove-product-detail-in-stock', [StockDetailController::class, 'removeProductDetailInStock']);

            Route::post('/remove-product-in-stock', [StockDetailController::class, 'removeProductInStock']);
        });


        //API User
        Route::group(['prefix' => '/users'], function () {
            Route::get(
                '/get-all-user-by-id-role-and-status/{role_id}&{status}',
                [UserController::class, 'getAllUserByIdRoleAndStatus']
            );

            Route::get(
                '/get-user-by-id-and-status/{user_id}&{status}',
                [UserController::class, 'getUserByIdAndStatus']
            );

            Route::post(
                '/get-user-by-email-and-status/{status}',
                [UserController::class, 'getUserByEmailAndStatus']
            );

            Route::post('/update-user', [UserController::class, 'updateUser']);

            Route::post('/reset-password-by-email', [UserController::class, 'resetPasswordByEmail']);

            Route::post('/remove-user', [UserController::class, 'removeUser']);

            Route::post('/invalidate-token', [UserController::class, 'invalidateToken']);
        });

        //API Voucher
        Route::group(['prefix' => '/vouchers'], function () {
            Route::get(
                '/get-all-voucher-by-status/{status}',
                [VoucherController::class, 'getAllVoucherByStatus']
            );

            Route::get(
                '/get-voucher-by-code-and-status/{code}&{status}',
                [VoucherController::class, 'getVoucherByCodeAndStatus']
            );

            Route::get(
                '/get-voucher-by-code/{code}',
                [VoucherController::class, 'getVoucherByCode']
            );

            Route::get(
                '/check-voucher-expiration-date/{date}',
                [VoucherController::class, 'checkVoucherExpirationDate']
            );

            Route::post(
                '/save-voucher',
                [VoucherController::class, 'saveVoucher']
            );

            Route::post(
                '/update-voucher',
                [VoucherController::class, 'updateVoucher']
            );

            Route::post(
                '/remove-voucher',
                [VoucherController::class, 'removeVoucher']
            );
        });

        // API MEMBER
        Route::group(['prefix' => '/members'], function () {

            Route::get('/get-all-member-by-status/{status}', [MemberController::class, 'getAllMemberByStatus']);

            Route::get('/get-member-by-id-and-status/{id}&{status}', [MemberController::class, 'getMemberByIdAndStatus']);

            Route::get('/get-best-members-by-max-current-point', [MemberController::class, 'getBestMembersByMaxCurrentPoint']);

            Route::get('/get-quantity-member-of-rank', [MemberController::class, 'getQuantityMemberOfRank']);

            Route::get('/get-all-bill-member-buy-the-most-by-date/{date_start}&{date_end}', [MemberController::class, 'getTopMembersBuyTheMost']);

            Route::get('/get-all-bill-member-buy-the-most-by-cycle/{week}&{month}&{year}', [MemberController::class, 'getTopMembersBuyTheMostByCycle']);

            Route::get('/get-member-by-id-user-and-status/{user_id}&{status}', [MemberController::class, 'getMemberByIdUserAndStatus']);

            Route::get('/get-member-by-max-current-point-in-date-and-status/{date}&{status}', [MemberController::class, 'getMemberByMaxCurrentPointInDateAndStatus']);

            Route::get('/get-all-member-by-expiration-date-and-status/{date}&{status}', [MemberController::class, 'getAllMemberExpirationDateAndStatus']);

            Route::post('/save-member', [MemberController::class, 'saveMember']);

            Route::post('/update-rank-member', [MemberController::class, 'updateRankMember']);

            Route::post('/update-current-point-member', [MemberController::class, 'updateCurrentPointMember']);

            Route::post('/update-status-by-member-id', [MemberController::class, 'updateStatusByMemberId']);

            Route::post('/remove-member', [MemberController::class, 'removeMember']);

            Route::post('/add-or-update-token-device', [MemberController::class, 'addOrUpdateTokenDevice']);
        });

        //API GROUP IMAGE
        Route::group(['prefix' => '/images'], function () {
            Route::get('/get-all-image-by-status/{status}', [ImageController::class, 'getAllImageByStatus']);

            Route::get('/get-image-by-id-and-status/{img_id}&{status}', [ImageController::class, 'getImageByIdAndStatus']);

            Route::get('/get-all-image-by-id-product-and-status/{product_id}&{status}', [ImageController::class, 'getAllImageByProductIdAndStatus']);

            Route::get('/get-all-image-by-id-product-and-id-color-and-status/{product_id}&{color_id}&{status}', [ImageController::class, 'getAllImageByProductIdAndColorIdAndStatus']);

            Route::post('/save-image', [ImageController::class, 'saveImage']);

            Route::post('/update-image', [ImageController::class, 'updateImage']);

            Route::post('/remove-image', [ImageController::class, 'removeImage']);
        });

        //API GROUP PRODUCT
        Route::group(['prefix' => '/products'], function () {
            Route::get('/get-all-product-by-status/{status}', [ProductController::class, 'getAllProductByStatus']);

            Route::get('/get-product-by-id-and-status/{product_id}&{status}', [ProductController::class, 'getProductByIdAndStatus']);

            Route::get('/get-all-product-by-price-range/{priceRangeStart}&{priceRangeEnd}', [ProductController::class, 'getAllProductByPriceRange']);

            Route::get('/get-all-product-by-id-category-and-status/{id}&{status}', [ProductController::class, 'getAllProductByIdCategoryAndStatus']);

            Route::get('/get-all-product-by-category-id-and-producer-id-status/{category_id}&{producer_id}&{status}', [ProductController::class, 'getAllProductByIdCategoryAndProducerIdStatus']);

            Route::get('/get-all-product-in-stock', [ProductController::class, 'getAllProductInStock']);

            Route::get('/get-all-product-by-id-member-and-status-in-bill', [ProductController::class, 'getAllProductByIdMemberAndStatusInBill']);

            Route::get('/get-all-product-populator-by-date/{date_start}&{date_end}', [ProductController::class, 'getAllProductPopulatorByDate']);

            Route::get('/get-all-product-populator-by-cycle/{week}&{month}&{year}', [ProductController::class, 'getAllProductPopulatorByCycle']);

            Route::get('/get-all-product-hot-favourite', [ProductController::class, 'getAllProductHotFavourite']);

            Route::get('/get-all-product-hot-rate-by-date/{date_start}&{date_end}', [ProductController::class, 'getAllProductHotRateByDate']);

            Route::get('/get-all-product-hot-rate-by-cycle/{week}&{month}&{year}', [ProductController::class, 'getAllProductHotRateByCycle']);

            Route::get('/get-all-statistics-of-product', [ProductController::class, 'getAllStatisticsOfProduct']);

            Route::get('/get-all-product-hot-pay-by-category/{category_id}/{take?}', [ProductController::class, 'getAllProductHotBuyByCategoryId']);

            Route::get('/get-all-product-hot-pay', [ProductController::class, 'getAllProductHotBuy']);

            Route::get('/get-all-stock-detail-by-search-keyword', [ProductController::class, 'getAllProductByKeywordIdInStock']);

            Route::post('/save-product', [ProductController::class, 'saveProduct']);

            Route::post('/update-product', [ProductController::class, 'updateProduct']);

            Route::post('/remove-product', [ProductController::class, 'removeProduct']);

            Route::get('/get-all-stock-detail-hot-favourite-by-search-keyword', [ProductController::class, 'getAllStockDetailHotFavouriteBySearchKeyword']);

            Route::get('/get-all-stock-detail-new-product-by-search-keyword', [ProductController::class, 'getAllStockDetailNewProductBySearchKeyword']);

            Route::get('/get-all-stock-detail-best-seller-by-search-keyword', [ProductController::class, 'getAllStockDetailBestSellerBySearchKeyword']);
        });

        //API GROUP PRODUCTDETAIL
        Route::group(['prefix' => '/product-details'], function () {
            Route::get('/get-product-detail-by-id/{id}', [ProductDetailController::class, 'getProductDetailById']);

            Route::get('/get-all-product-detail-by-id-product/{product_id}', [ProductDetailController::class, 'getAllProductDetailByIdProduct']);

            Route::get('/get-all-product-detail-by-product-id-and-status/{product_id}&{status}', [ProductDetailController::class, 'getAllProductDetailByProductIdAndStatus']);

            Route::get('/get-all-product-detail-by-id-product-and-id-size/{product_id}&{size_id}', [ProductDetailController::class, 'getAllProductDetailByIdProductAndIdSize']);

            Route::get('/get-all-product-detail-by-id-product-and-id-color/{product_id}&{color_id}', [ProductDetailController::class, 'getAllProductDetailByIdProductAndIdColor']);

            Route::get('/get-all-product-detail-by-producer-id/{producer_id}', [ProductDetailController::class, 'getAllProductDetailByProducerId']);

            Route::post('/save-product-detail', [ProductDetailController::class, 'saveProductDetail']);

            Route::post('/remove-product-detail', [ProductDetailController::class, 'removeProductDetail']);
        });

        //API GROUP RANK
        Route::group(['prefix' => '/ranks'], function () {
            Route::get('/get-all-rank-by-status/{status}', [RankController::class, 'getAllRankByStatus']);

            Route::get('/get-rank-by-id-and-status/{id}&{status}', [RankController::class, 'getRankByIdAndStatus']);

            Route::get('/get-rank-by-id/{id}', [RankController::class, 'getRankById']);

            Route::get('/get-next-rank-of-current-rank-by-member-id-and-status/{id}&{status}', [RankController::class, 'getNextRankOfCurrentRankByMemberIdAndStatus']);

            Route::get('/get-previous-rank-of-current-rank-by-point-and-status/{id}&{point}&{status}', [RankController::class, 'getPreviousRankOfCurrentRankAndStatus']);


            Route::post('/save-rank', [RankController::class, 'saveRank']);

            Route::post('/update-rank', [RankController::class, 'updateRank']);

            Route::post('/remove-rank', [RankController::class, 'removeRank']);
        });

        //API GROUP RATE
        Route::group(['prefix' => '/rates'], function () {
            Route::get('/get-all-rate-by-id-member-and-status/{member_id}&{status}', [RateController::class, 'getAllRateByIdMemberAndStatus']);

            Route::get('/get-all-rate-by-id-product-and-status/{product_id}&{status}', [RateController::class, 'getAllRateByIdProductAndStatus']);

            Route::get('/get-rate-by-id-member-and-id-product/{member_id}&{product_id}', [RateController::class, 'getRateByIdMemberAndIdProduct']);

            Route::post('/save-rate', [RateController::class, 'saveRate']);

            Route::post('/update-rate', [RateController::class, 'updateRate']);

            Route::post('/like-rate', [RateController::class, 'likeRate']);

            Route::post('/unlike-rate', [RateController::class, 'unlikeRate']);

            Route::post('/remove-rate', [RateController::class, 'removeRate']);
        });

        //API BILL
        Route::group(['prefix' => 'bills'], function () {

            Route::get('/get-all-bill-by-status/{status}', [BillController::class, 'getAllBillByStatus']);

            Route::get('/get-bill-by-id-and-status/{bill_id}&{status}', [BillController::class, 'getBillByIdAndStatus']);

            Route::get('/get-all-bill-by-id-member-and-status/{member_id}&{status}', [BillController::class, 'getAllBillByIdMemberAndStatus']);

            Route::get('/get-bill-by-id/{bill_id}', [BillController::class, 'getBillById']);

            Route::get('/get-all-bill-by-date-and-status/{date}&{status}', [BillController::class, 'getAllBillByDateAndStatus']);

            Route::get('/get-quantity-all-bill-in-this-month-belong-status', [BillController::class, 'getQuantityAllBillInThisMonthBelongStatus']);

            Route::get('/get-all-bill-in-this-month-by-status/{status}', [BillController::class, 'getAllBillInThisMonthByStatus']);

            Route::get('/get-all-bill-in-this-year-by-status/{status}', [BillController::class, 'getAllBillInThisYearByStatus']);

            Route::get('/get-all-bill-between-date-to-date-and-status/{date_start}&{date_end}&{status}', [BillController::class, 'getAllBillBetweenDateToDateAndStatus']);

            Route::get('/get-quantity-all-bill-chart-belong-status-by-month-and-year/{month}&{year}', [BillController::class, 'getQuantityAllBillChartBelongStatusByMonthAndYear']);

            Route::get('/get-all-bill-when-choose-by-status/{week}&{month}&{year}&{status}', [BillController::class, 'getAllBillWhenChooseByStatus']);

            Route::post('/save-bill', [BillController::class, 'saveBill']);

            Route::post('/update-status-bill', [BillController::class, 'updateStatusBill']);
        });


        //API ACTIVITY HISTORY
        Route::group(['prefix' => 'activity-histories'], function () {

            Route::get('/get-all-activity-history', [ActivityHistoryController::class, 'getAllActivityHistory']);

            Route::get('/get-all-activity-history-by-id-user-and-date-and-type/{user_id}&{date}&{type}', [ActivityHistoryController::class, 'getAllActivityHistoryByIdUserAndDateAndType']);

            Route::get('/get-all-activity-history-by-id-user-and-type/{user_id}&{type}', [ActivityHistoryController::class, 'getAllActivityHistoryByIdUserAndType']);

            Route::get('/get-all-activity-history-by-date/{date}', [ActivityHistoryController::class, 'getAllActivityHistoryByDate']);

            Route::post('/save-activity-history', [ActivityHistoryController::class, 'saveActivityHistory']);
        });

        //API BILL DETAIL
        Route::group(['prefix' => 'bill-details'], function () {

            Route::get('/get-all-bill-detail-by-id-bill/{bill_id}', [BillDetailController::class, 'getAllBillDetailByIDBill']);

            Route::get('/get-all-bill-detail-by-id-member-and-status/{member_id}&{status}', [BillDetailController::class, 'getAllBillDetailByIdMemberAndStatus']);

            Route::get('/get-top-product-popular-by-status/{status}', [BillDetailController::class, 'getTopProductPopularByStatus']);

            Route::post('/save-bill-detail', [BillDetailController::class, 'saveBillDetail']);
        });

        //API CATEGORY
        Route::group(['prefix' => 'categories'], function () {

            Route::get('/get-all-category-by-status/{status}', [CategoryController::class, 'getAllCategoryByStatus']);

            Route::get('/get-category-by-id-and-status/{cate_id}&{status}', [CategoryController::class, 'getCategoryByIdAndStatus']);

            Route::get('/get-category-by-id/{cate_id}', [CategoryController::class, 'getCategoryById']);

            Route::get('/get-all-category-in-stock', [CategoryController::class, 'getAllCategoryInStock']);

            Route::get('/get-all-category-by-producer-id/{producer_id}', [CategoryController::class, 'getAllCategoryByProducerId']);

            Route::post('/remove-category', [CategoryController::class, 'removeCategory']);

            Route::post('/update-category', [CategoryController::class, 'updateCategory']);

            Route::post('/save-category', [CategoryController::class, 'saveCategory']);
        });

        //API COLOR
        Route::group(['prefix' => 'colors'], function () {

            Route::get('/get-all-color-by-status/{status}', [ColorController::class, 'getAllColorByStatus']);

            Route::get('/get-color-by-id-and-status/{color_id}&{status}', [ColorController::class, 'getColorByIdAndStatus']);

            Route::get('/get-color-by-id/{color_id}', [ColorController::class, 'getColorById']);

            Route::get('/get-color-by-product-id-and-status/{product_id}&{status}', [ColorController::class, 'getColorByProductIdAndStatus']);

            Route::get('/get-all-color-by-product-id-and-status-in-stock/{product_id}&{status}', [ColorController::class, 'getAllColorByProductIdAndStatusInStock']);

            Route::post('/remove-color', [ColorController::class, 'removeColor']);

            Route::post('/update-color', [ColorController::class, 'updateColor']);

            Route::post('/save-color', [ColorController::class, 'saveColor']);
        });

        //API DISCOUNT CATEGORY
        Route::group(['prefix' => 'discount-categories'], function () {

            Route::get('/get-all-discount-category-by-status/{status}', [DiscountCategoryController::class, 'getAllDiscountCategoryByStatus']);

            Route::get('/get-discount-category-by-id-and-status/{discount_id}&{status}', [DiscountCategoryController::class, 'getDiscountCategoryByIdAndStatus']);

            Route::get('/get-discount-category-by-id/{discount_id}', [DiscountCategoryController::class, 'getDiscountCategoryById']);

            Route::get('/get-all-discount-category-by-id-rank-and-status/{rank_id}&{status}', [DiscountCategoryController::class, 'getAllDiscountCategoryByIdRankAndStatus']);

            Route::get('/get-all-discount-category-by-id-category-and-status/{cate_id}&{status}', [DiscountCategoryController::class, 'getAllDiscountCategoryByIdCategoryAndStatus']);

            Route::post('/remove-discount-category', [DiscountCategoryController::class, 'removeDiscountCategory']);

            Route::post('/update-discount-category', [DiscountCategoryController::class, 'updateDiscountCategory']);

            Route::post('/save-discount-category', [DiscountCategoryController::class, 'saveDiscountCategory']);
        });


        //API Cart
        Route::group(['prefix' => '/carts'], function () {
            Route::get(
                '/get-all-cart-by-id-member/{member_id}',
                [CartController::class, 'getAllCartByIdMember']
            );

            Route::post('/update-quantity-in-cart', [CartController::class, 'updateQuantityInCart']);

            Route::post(
                '/save-cart',
                [CartController::class, 'saveCart']
            );

            Route::post(
                '/save-and-update-cart',
                [CartController::class, 'saveAndUpdateCart']
            );


            Route::post(
                '/remove-cart',
                [CartController::class, 'removeCart']
            );

            Route::post(
                '/remove-all-cart',
                [CartController::class, 'removeAllCart']
            );
        });

        //API Voucher Member
        Route::group(['prefix' => '/voucher-members'], function () {
            Route::get(
                '/get-all-voucher-member-by-id-member/{id}',
                [VoucherMemberController::class, 'getAllVoucherMemberByIdMember']
            );

            Route::get(
                '/get-all-voucher-member-by-id-member-and-status/{id}&{status}',
                [VoucherMemberController::class, 'getAllVoucherMemberByIdMemberAndStatus']
            );

            Route::post(
                '/update-status-voucher-member-by-id-member-and-code',
                [VoucherMemberController::class, 'updateStatusVoucherMemberByIdMemberAndCode']
            );

            Route::post(
                '/save-voucher-member',
                [VoucherMemberController::class, 'saveVoucherMember']
            );
        });
        //Các CN update nhớ sau này xử lý kiểm tra id trên route với id cụ thể
        //API BILL ORDER
        Route::group(['prefix' => 'bill-orders'], function () {
            Route::get('/get-all-bill-order', [BillOrderController::class, 'getAllBillOrder']);

            Route::get('/get-all-bill-order-by-id-user/{user_id}', [BillOrderController::class, 'getAllBillOrderByIdUser']);

            Route::get('/get-all-bill-order-by-date/{date}', [BillOrderController::class, 'getAllBillOrderByDate']);

            Route::get('/get-bill-order-by-id/{bill_order_id}', [BillOrderController::class, 'getBillOrderById']);

            Route::post('/save-bill-order', [BillOrderController::class, 'saveBillOrder']);
            // Route::post('/update-bill-order/{id}',[BillOrderController::class,'updateBillOrder']
        });

        //API BILL ORDER DETAIL
        Route::group(['prefix' => 'bill-order-details'], function () {
            Route::get('/get-all-bill-order-detail-by-id-bill-order/{bill_order_id}', [BillOrderDetailController::class, 'getAllBillOrderDetailByIdBillOrder']);

            Route::post('/save-bill-order-detail', [BillOrderDetailController::class, 'saveBillOrderDetail']);
        });

        //API FAVOURITE
        Route::group(['prefix' => 'favourites'], function () {
            Route::get('/get-all-favourite', [FavouritesController::class, 'getAllFavourite']);

            Route::get('/is-product-detail-in-favourites/{product_detail_id}&{member_id}', [FavouritesController::class, 'isProductDetailInFavourites']);

            Route::get('/get-all-favourite-by-id-member/{member_id}', [FavouritesController::class, 'getAllFavouriteByIdMember']);

            Route::post('/remove-favourite', [FavouritesController::class, 'removeFavourite']);

            Route::post('/save-favourite', [FavouritesController::class, 'saveFavourite']);
        });

        //API PRODUCER
        Route::group(['prefix' => 'producers'], function () {
            Route::get('/get-all-producer-by-status/{status}', [ProducerController::class, 'getAllProducerByStatus']);

            Route::get('/get-producer-by-id-and-status/{producer_id}&{status}', [ProducerController::class, 'getProducerByIdAndStatus']);

            Route::get('/get-producer-by-id/{producer_id}', [ProducerController::class, 'getProducerById']);

            Route::post('/remove-producer', [ProducerController::class, 'removeProducer']);

            Route::post('/save-producer', [ProducerController::class, 'saveProducer']);
        });

        //API NOTIFICATION
        Route::group(['prefix' => 'notifications'], function () {
            Route::get('/get-all-notification-by-member-id/{member_id}', [NotificationController::class, 'getAllNotificationByMemberId']);

            Route::get('/get-all-notification-by-member-id-and-status/{member_id}&{status}', [NotificationController::class, 'getAllNotificationByMemberIdAndStatus']);

            Route::post('/update-status-notification', [NotificationController::class, 'updateStatusNotification']);

            Route::post('/update-all-status-notification', [NotificationController::class, 'updateAllStatusNotification']);

            Route::post('/push-notification-by-member', [NotificationController::class, 'pushNotificationByMember']);
        });

        //API ADDRESS
        Route::group(['prefix' => 'addresses'], function () {
            Route::get('/get-all-address-by-member-id/{member_id}', [AddressController::class, 'getAllAddressByMemberId']);
            Route::get('/get-all-address-by-member-id-and-status/{member_id}&{status}', [AddressController::class, 'getAllAddressByMemberIdAndStatus']);
            Route::get('/get-all-city-vn', [AddressController::class, 'getCityInVN']);
            Route::get('/get-all-district-vn-by-city-id/{city_id}', [AddressController::class, 'getDistrictByCityIdVN']);
            Route::get('/get-all-commune-vn-by-district-id/{district_id}', [AddressController::class, 'getCommuneByDistrictIdVN']);
            Route::post('/save-address', [AddressController::class, 'saveAddress']);
            Route::post('/update-address', [AddressController::class, 'updateAddress']);
            Route::post('/remove-address', [AddressController::class, 'removeAddress']);
        });
    }
);