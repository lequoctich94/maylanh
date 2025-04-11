<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\BillController;
use App\Http\Controllers\services\BillDetailController;
use Error;
use Exception;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class UPurchaseHistoryController extends Controller
{
    protected $billController;
    public function __construct()
    {
        $this->billController = new BillController();
        $this->billDetailController = new BillDetailController();
    }

    public function purchaseHistory(Request $req)
    {
        try {
            $status = -1;
            if (!is_null($req->status)) {
                $status = $req->status * 1;
            }
            if ($status < -4 || $status > 2) {
                return view('user/404/404');
            }
            $this->viewData['status'] = $status;

            $member = request()->session()->get('member');
            $this->viewData['member'] = $member;

            $bill_response = $this->billController->getAllBillByIdMemberAndStatus($member->member_id, $status);
            if (!is_null($bill_response['data'])) {
                $this->viewData['bills'] = $bill_response['data'];
            }
            return view('user/profile/purchase_history')->with($this->viewData);
        } catch (Exception $ex) {
            return view('user/404/404');
        } catch (Error $err) {
            return view('user/404/404');
        }
    }

    public function purchaseHistoryByStatus(Request $req)
    {
        $this->viewData['status'] = $req->status;
        $member = request()->session()->get('member');
        $this->viewData['member'] = $member;
        $bill_response = $this->billController->getAllBillByIdMemberAndStatus($member->member_id, $req->status);
        if (!is_null($bill_response['data'])) {
            $this->viewData['bills'] = $bill_response['data'];
        }

        return view(
            'user/profile/purchase_history_render'
        )->with($this->viewData)->render();
    }

    public function purchaseHistoryDetail(Request $req)
    {
        $member = request()->session()->get('member');
        $this->viewData['member'] = $member;
        $bill_detail_response = $this->billDetailController->getAllBillDetailByIDBill($req->bill_id);
        if (!is_null($bill_detail_response['data'])) {
            $bill_distinct_map = [];

            foreach ($bill_detail_response['data'] as $bill_detail) {
                $bill_distinct_map[$bill_detail->product_detail->product_id][] = $bill_detail;
            }

            $this->viewData['bill_detail_maps'] = $bill_distinct_map;
        }

        return view(
            'user/profile/purchase_history_detail_render'
        )->with($this->viewData)->render();
    }
}