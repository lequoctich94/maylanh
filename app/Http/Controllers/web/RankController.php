<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\RankController as ServicesRankController;
use Exception;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function rankManagement()
    {
        $rankController = new ServicesRankController();
        $data_rank = $rankController->getAllRank();
        $ranks = [];

        if ($data_rank['data'] != null)
            $ranks = $data_rank['data']->collection;
        return view('rank_management/rank', ['ranks' => $ranks]);
    }

    public function addRank(Request $req)
    {
        try {
            $rankController = new ServicesRankController();
            if ($req->rank_id == null || $req->rank_name == null) {
                return back()->withErrors(['error' => 'Tạo thất bại']);
            }
            $result = $rankController->saveRank($req);
            if ($result == null) {
                return back()->withErrors(['error' => 'Tạo thất bại']);
            }
            return redirect(route('rank-management'));
        } catch (Exception $e) {
            return back()->withErrors(['errorRank' => 'Vui lòng kiểm tra lại (Thông tin bị trùng lặp - #DuplicateEntry)']);
        }
        return redirect(route('rank-management'));
    }

    public function updateRank(Request $req)
    {
        $rankController = new ServicesRankController();
        $result = $rankController->updateRank($req);

        if ($result == null) {
            return back()->withErrors(['error' => 'Chỉnh sửa thất bại']);
        }
        return redirect(route('rank-management'));
    }
}
