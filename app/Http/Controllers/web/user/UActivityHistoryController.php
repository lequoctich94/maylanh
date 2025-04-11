<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\ActivityHistoryController;
use Error;
use Exception;
use Illuminate\Http\Request;

class UActivityHistoryController extends Controller
{
    protected $activityHistoryController;
    public function __construct()
    {
        $this->activityHistoryController = new ActivityHistoryController();
    }
    public function activityHistory(Request $req)
    {
        try {
            $tabActive = 1;
            if (!is_null($req->tab)) {
                $tabActive = $req->tab * 1;
            }
            if ($tabActive < 1 || $tabActive > 6) {
                return view('user/404/404');
            }

            $this->viewData['tabActive'] = $tabActive;

            $member = request()->session()->get('member');
            $this->viewData['member'] = $member;

            //Tab Search
            $activity_search_response = $this->activityHistoryController->getAllActivityHistoryByIdUserAndType($member->user->user_id, 0);
            if (!is_null($activity_search_response['data'])) {
                $this->viewData['activitySearchs'] = $activity_search_response['data'];
            }

            //Tab Rates
            $activity_rate_response = $this->activityHistoryController->getAllActivityHistoryByIdUserAndType($member->user->user_id, 1);
            if (!is_null($activity_search_response['data'])) {
                $this->viewData['activityRates'] = $activity_rate_response['data'];
            }

            //Tab Cart
            $activity_cart_response = $this->activityHistoryController->getAllActivityHistoryByIdUserAndType($member->user->user_id, 2);
            if (!is_null($activity_cart_response['data'])) {
                $this->viewData['activityCarts'] = $activity_cart_response['data'];
            }

            //Tab Favourite
            $activity_favourite_response = $this->activityHistoryController->getAllActivityHistoryByIdUserAndType($member->user->user_id, 3);
            if (!is_null($activity_favourite_response['data'])) {
                $this->viewData['activityFavourites'] = $activity_favourite_response['data'];
            }

            //Tab Order
            $activity_order_response = $this->activityHistoryController->getAllActivityHistoryByIdUserAndType($member->user->user_id, 4);
            if (!is_null($activity_order_response['data'])) {
                $this->viewData['activityOrders'] = $activity_order_response['data'];
            }

            //Tab Session Activity
            $activity_session_response = $this->activityHistoryController->getAllActivityHistoryByIdUserAndType($member->user->user_id, 5);
            if (!is_null($activity_session_response['data'])) {
                $this->viewData['activitySessions'] = $activity_session_response['data'];
            }
            return view('user/profile/activity_histories')->with($this->viewData);
        } catch (Exception $ex) {
            return view('user/404/404');
        } catch (Error $error) {
            return view('user/404/404');
        }
    }
}