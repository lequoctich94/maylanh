<?php

namespace App\Providers;

use App\Http\Controllers\services\CartController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\services\CategoryController;
use App\Http\Controllers\services\FavouritesController;
use App\Http\Controllers\services\MemberController;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{

    protected $cartController;
    protected $favourityController;
    protected $memberController;
    protected $categoryController;
    protected $dataView = [];

    public function __construct()
    {
        $this->categoryController = new CategoryController();
        $this->cartController = new CartController();
        $this->favourityController = new FavouritesController();
        $this->memberController = new MemberController;
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // URL::forceScheme('https');
        JsonResource::withoutWrapping();

        View::composer('user.layouts', function ($view) {
            $member = request()->session()->get('member');
            $this->dataView['member'] = $member;
            if (!is_null($member)) {
                $this->dataView['member'] = $member;

                $cart_response = $this->cartController->getAllCartByIdMember($member->member_id);
                if (!is_null($cart_response['data'])) {
                    $this->dataView['carts'] = $cart_response['data'];
                }
            }

            $category_response = $this->categoryController->getAllCategoryInStock();
            if (!is_null($category_response['data'])) {
                $this->dataView['categories'] = $category_response['data']->collection;
            }

            $view->with($this->dataView);
        });

        View::composer('layouts', function ($view) {
            $admin = request()->session()->get('admin');
            $this->dataView['admin'] = $admin;
            $view->with($this->dataView);
        });
    }
}
