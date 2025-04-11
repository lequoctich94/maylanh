<?php

//Administrator
use App\Http\Controllers\web\BillController;
use App\Http\Controllers\web\BillDetailController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\BillOrderController;
use App\Http\Controllers\web\BillOrderDetailController;
use App\Http\Controllers\web\DiscountCategoryController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LoginController;
use App\Http\Controllers\web\MemberController;
use App\Http\Controllers\web\RoleController;
use App\Http\Controllers\web\RankController;
use App\Http\Controllers\web\ProducerController;
use App\Http\Controllers\web\ProductController;
use App\Http\Controllers\web\SizeAndColorController;
use App\Http\Controllers\web\StockDetailController;
use App\Http\Controllers\web\VoucherController;
use App\Http\Controllers\web\VoucherMemberController;
use App\Http\Controllers\web\StatisticBillPayController;
use App\Http\Controllers\web\user\UCartController;
//User
use App\Http\Controllers\web\user\UHomeController;
use App\Http\Controllers\web\user\UProductController;
use App\Http\Controllers\web\user\UProductDetailController;
use App\Http\Controllers\web\user\ULoginController;
use App\Http\Controllers\web\user\URegisterController;
use App\Http\Controllers\web\user\UProfileController;
use App\Http\Controllers\web\user\UActivityHistoryController;
use App\Http\Controllers\web\user\UCheckoutStepController;
use App\Http\Controllers\web\user\URateController;
use App\Http\Controllers\web\user\UVoucherController;
use App\Http\Controllers\web\user\UFavouriteController;
use App\Http\Controllers\web\user\UForgotPasswordController;
use App\Http\Controllers\web\user\UPaymentShippingController;
use App\Http\Controllers\web\user\URankController;
use App\Http\Controllers\web\user\UPurchaseHistoryController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//User
Route::post('/login', [ULoginController::class, 'postLogin'])->name('user/login');
Route::get('/login', [ULoginController::class, 'getLogin'])->name('user/login');

Route::get('/', [UHomeController::class, 'index'])->name('user/index');
Route::get('/not-found', [UHomeController::class, 'notFound'])->name('user/not-found');

Route::get('/register', [URegisterController::class, 'getRegister'])->name('user/register');
Route::post('/register', [URegisterController::class, 'postRegister'])->name('user/register');
Route::get('/forgot-password', [UForgotPasswordController::class, 'userForgotPassword'])->name('user/forgot-password');
Route::post('/reset-password', [UForgotPasswordController::class, 'userResetPassword'])->name('user/reset-password');
Route::post('/update-password', [UForgotPasswordController::class, 'updatePassword'])->name('user/update-password');
Route::get('/introduce', [UHomeController::class, 'introduce'])->name('user/introduce');
Route::get('/about-us', [UHomeController::class, 'aboutUs'])->name('user/about-us');
Route::get('/contact', [UHomeController::class, 'contact'])->name('user/contact');
Route::get('/news', [UHomeController::class, 'news'])->name('user/news');
Route::get('/policy', [UHomeController::class, 'policy'])->name('user/policy');
Route::get('/shopping-guide', [UHomeController::class, 'shoppingGuide'])->name('user/shopping-guide');
Route::get('/trading-guide', [UHomeController::class, 'tradingGuide'])->name('user/trading-guide');
Route::get('/delivery-and-exchange', [UHomeController::class, 'deliveryAndExchange'])->name('user/delivery-and-exchange');
Route::get('/product', [UProductController::class, 'product'])->name('user/product');
Route::get('/product-render', [UProductController::class, 'productTableRender']);
Route::get('/product-detail/{product_name}.html', [UProductDetailController::class, 'productDetail'])->name('user/product-detail');
Route::get('/product-hot-buy-by-category/{category_id}/{take?}', [UHomeController::class, 'loadViewProductPopulator']);
/*-----------------------------------------------------------*/

Route::group(['middleware' => ['hasRoleUser']], function () {
    Route::get('/cart', [UCheckoutStepController::class, 'cart'])->name('user/cart');
    Route::post('/save-checkout-step', [UCheckoutStepController::class, 'saveCheckoutStep']);
    Route::post('/back-checkout-step', [UCheckoutStepController::class, 'backCheckoutStep']);
    Route::get('/profile', [UProfileController::class, 'profile'])->name('user/profile');
    Route::get('/change-profile', [UProfileController::class, 'changeProfile'])->name('user/change-profile');
    Route::post('/change-profile', [UProfileController::class, 'updateProfile'])->name('user/change-profile');
    Route::post('/change-avatar', [UProfileController::class, 'changeAvatar'])->name('user/change-avatar');
    Route::get('/change-password', [UProfileController::class, 'changePassword'])->name('user/change-password');
    Route::post('/change-password', [UProfileController::class, 'updatePassword'])->name('user/change-password');
    Route::get('/payment-shipping', [UCheckoutStepController::class, 'paymentShipping'])->name('user/payment-shipping');
    Route::get('/payment-successfully', [UCheckoutStepController::class, 'paymentSuccessfully'])->name('user/payment-successfully');
    Route::get('/order-check', [UHomeController::class, 'orderCheck'])->name('user/order-check');
    Route::post('/logout', [ULoginController::class, 'logout'])->name('user/logout');
    Route::get('/activity-history', [UActivityHistoryController::class, 'activityHistory'])->name('user/activity-history');
    Route::get('/rank', [URankController::class, 'rank'])->name('user/rank');
    Route::get('/rate', [URateController::class, 'rate'])->name('user/rate');
    Route::get('/voucher', [UVoucherController::class, 'voucher'])->name('user/voucher');
    Route::get('/favourite', [UFavouriteController::class, 'favourite'])->name('user/favourite');
    Route::get('/purchase-history', [UPurchaseHistoryController::class, 'purchaseHistory'])->name('user/purchase-history');
    Route::get('/purchase-history-render', [UPurchaseHistoryController::class, 'purchaseHistoryByStatus']);
    Route::get('/purchase-history-detail-render', [UPurchaseHistoryController::class, 'purchaseHistoryDetail']);
});



Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('login');

    //Administrator
    Route::group(['middleware' => ['hasRoleAdmin']], function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        //Index
        Route::get('/', [HomeController::class, 'index'])->name('index');

        //Product
        Route::get('/product-management', [StockDetailController::class, 'productManagement'])->name('product-management');

        Route::get('/product-detail-management/{product_id}', [StockDetailController::class, 'productDetailManagement'])->name('product-detail-management');

        Route::get('/product-management/add-product-management', [StockDetailController::class, 'addProductManagement'])->name('add-product-management');

        Route::get('/product-management/product-rate-management/{product_id}', [StockDetailController::class, 'productRateManagement'])->name('product-rate-management');

        Route::post('/remove-product', [StockDetailController::class, 'removeProductDetailInStockManagement'])->name('remove-product');

        Route::post('/update-product', [StockDetailController::class, 'updatePricePayInStock'])->name('update-product');

        Route::post('/order-product', [StockDetailController::class, 'orderProductInStock'])->name('order-product-in-stock');

        Route::post('/order-product-again', [StockDetailController::class, 'orderProductAgainInStock'])->name('order-product-again-in-stock');

        Route::post('/add-product-to-cart', [StockDetailController::class, 'addProductToCart'])->name(' add-product-to-cart');

        Route::post('/remove-product-to-cart', [StockDetailController::class, 'removeProductToCart']);

        Route::post('/remove-product-in-stock', [StockDetailController::class, 'removeProductInStock'])->name('remove-product-in-stock');

        //Member
        Route::get('/member-management', [MemberController::class, 'memberManagement'])->name('member-management');

        //Voucher
        Route::get('/voucher-management', [VoucherController::class, 'voucherManagement'])->name('voucher-management');

        Route::post('/add-voucher', [VoucherController::class, 'addVoucher'])->name('add-voucher-member');

        Route::post('/update-voucher', [VoucherController::class, 'updateVoucher'])->name('update-voucher-member');

        Route::get('/voucher-member-management/{code}', [VoucherMemberController::class, 'voucherMemberManagement'])->name('voucher-member-management');

        //Producer
        Route::get('/producer-management', [ProducerController::class, 'producerManagement'])->name('producer-management');

        Route::get('/producer-detail/{producer_id}', [ProducerController::class, 'producerDetail'])->name('producer-detail');

        Route::get('/producer-product-detail/{product_id}', [ProducerController::class, 'producerProductDetail'])->name('producer-product-detail');

        Route::post('/add-producer', [ProducerController::class, 'addProducer'])->name('add-producer');

        Route::post('/add-producer-product-detail/{product_id}', [ProducerController::class, 'addProducerProductDetail'])->name('add-producer-product-detail');

       // Route::post('/update-price-produced-producer-product-detail/{product_id}', [ProducerController::class, 'updatePriceProduced'])->name('update-price-produced-producer-product-detail');

        //Size
        //Route::post('/add-size-of-producer-product-detail/{product_id}', [ProducerController::class, 'addSizeOfProducerProductDetail'])->name('add-size-of-producer-product-detail');

        Route::post('/edit-image-producer-product-detail/{product_id}', [ProducerController::class, 'editImageProducerProductDetail'])->name('edit-image-producer-product-detail');

        Route::post('/update-producer', [ProducerController::class, 'updateProducer'])->name('update-producer');

        Route::post('/remove-producer', [ProducerController::class, 'removeProducer'])->name('remove-producer');

        Route::post('/add-product', [ProducerController::class, 'addProduct'])->name('add-product'); //Add Product From Producer

        //Bill Pay
        Route::get('/bill-pay-management', [BillController::class, 'billManagement'])->name('bill-pay-management');

        //Bill Pay Detail
        Route::get('/bill-pay-detail-management/{bill_id}', [BillDetailController::class, 'billDetailManagement'])->name('bill-pay-detail-management');

        //Size And Color
        Route::get('/size-and-color-management', [SizeAndColorController::class, 'SizeAndColorManagement'])->name('size-and-color-management');

        //Color
        Route::post('/add-color', [SizeAndColorController::class, 'addColor'])->name('add-color');

        Route::post('/update-color', [SizeAndColorController::class, 'updateColor'])->name('update-color');

        Route::post('/remove-color', [SizeAndColorController::class, 'removeColorManagement'])->name('remove-color');

        //Size
        Route::post('/add-size', [SizeAndColorController::class, 'addSize'])->name('add-size');

        Route::post('/update-size', [SizeAndColorController::class, 'updateSize'])->name('update-size');

        Route::post('/remove-size', [SizeAndColorController::class, 'removeSizeManagement'])->name('remove-size');

        //Bill Order
        Route::get('/bill-order-management', [BillOrderController::class, 'BillOrderManagement'])->name('bill-order-management');

        Route::get('/bill-order-detail-management/{bill_order_id}', [BillOrderDetailController::class, 'BillOrderDetailManagement'])->name('bill-order-detail-management');

        //Category
        Route::get('/category-management', [CategoryController::class, 'categoryManagement'])->name('category-management');

        Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('add-category');

        Route::post('/remove-category', [CategoryController::class, 'removeCategory'])->name('remove-category');

        Route::post('/update-category', [CategoryController::class, 'updateCategory'])->name('update-category');

        //Rank
        Route::get('/rank-management', [RankController::class, 'rankManagement'])->name('rank-management');

        Route::post('/add-rank', [RankController::class, 'addRank'])->name('add-rank');

        Route::post('/update-rank', [RankController::class, 'updateRank'])->name('update-rank');

        //Role
        Route::get('/role-management', [RoleController::class, 'roleManagement'])->name('role-management');

        Route::post('/add-role', [RoleController::class, 'addRole'])->name('add-role');

        Route::post('/update-role', [RoleController::class, 'updateRole'])->name('update-role');

        //Discount Category
        Route::post('/add-discount-category', [DiscountCategoryController::class, 'addDiscountCategory'])->name('add-discount-category');

        Route::post('/update-discount-category', [DiscountCategoryController::class, 'updateDiscountCategory'])->name('update-discount-category');

        Route::get('/discount-category-management/{rank_id}', [DiscountCategoryController::class, 'discountCategoryManagement'])->name('discount-category-management');

        //Statistics Bill Pay
        Route::get('/statistic-bill-pay-management', [StatisticBillPayController::class, 'statisticBillPayManagement'])->name('statistic-bill-pay-management');

        //Statistics Product
        Route::get('/statistics-product-management', [ProductController::class, 'productStatistics'])->name('statistics-product-management');

        Route::get('/statistics-of-product-with-the-highest-total-sales-by-date/{data_start}&{date_end}', [ProductController::class, 'statisticsOfProductWithTheHighestTotalSalesByDate'])->name('statistics-of-product-with-the-highest-total-sales-by-date');

        Route::get('/statistics-of-product-with-the-highest-total-sales-by-cycle/{week}&{month}&{year}', [ProductController::class, 'statisticsOfProductWithTheHighestTotalSalesByCycle'])->name('statistics-of-product-with-the-highest-total-sales-by-cycle');

        Route::get('/statistics-of-product-with-the-most-review-by-date/{data_start}&{date_end}', [ProductController::class, 'statisticsOfProductWithTheMostReviewByDate'])->name('statistics-of-product-with-the-most-review-by-date');

        Route::get('/statistics-of-product-with-the-most-review-by-cycle/{week}&{month}&{year}', [ProductController::class, 'statisticsOfProductWithTheMostReviewByCycle'])->name('statistics-of-product-with-the-most-review-by-cycle');

        //Statistics Member
        Route::get('/statistics-member', [MemberController::class, 'memberStatistics'])->name('statistics-member');

        Route::get('/statistics-of-member-buy-the-most-by-date/{data_start}&{date_end}', [MemberController::class, 'memberStatisticsBuyTheMostByDate'])->name('statistics-of-member-buy-the-most-by-date');

        Route::get('/statistics-of-member-buy-the-most-by-cycle/{week}&{month}&{year}', [MemberController::class, 'memberStatisticsBuyTheMostByCycle'])->name('statistics-of-member-buy-the-most-by-cycle');

        //Statistics Member
        // Route::get('/statistics-member',function(){ return view('statistics_member_management/statistics_member');
        // })->name('statistics-member');
    });
});