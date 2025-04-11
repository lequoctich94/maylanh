<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\FavouritesController;
use Illuminate\Http\Request;

class UFavouriteController extends Controller
{
    protected $favourityController;
    public function __construct()
    {
        $this->favourityController = new FavouritesController();
    }
    public function favourite()
    {
        $member = request()->session()->get('member');
        $this->viewData['member'] = $member;
        $favourity_response = $this->favourityController->getAllFavouriteByIdMember($member->member_id);
        if (!is_null($favourity_response['data'])) {
            $this->viewData['favourites'] = $favourity_response['data'];
        }
        return view('user/profile/favourite')->with($this->viewData);
    }
}