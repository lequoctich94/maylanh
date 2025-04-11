<?php

namespace App\Http\Controllers\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ActivityHistory;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Resources\ActivityHistoryResource;
use App\Http\Payload;
use Exception;

class ActivityHistoryController extends Controller
{
    public function getAllActivityHistory()
    {
        $activityHistories = ActivityHistory::orderBy('date_created', 'DESC')->all();
        if ($activityHistories->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ActivityHistoryResource::collection($activityHistories), 'Ok', 200);
    }

    public function getAllActivityHistoryByIdUserAndDateAndType($id, $date, $type)
    {
        $activityHistories = ActivityHistory::where([
            ['user_id', '=', $id],
            ['date_created', '=', $date],
            ['type', '=', $type]
        ])->orderBy('date_created', 'DESC')->get();
        if ($activityHistories->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ActivityHistoryResource::collection($activityHistories), 'Ok', 200);
    }

    public function getAllActivityHistoryByIdUserAndType($id, $type)
    {
        $activityHistories = ActivityHistory::where([['user_id', $id], ['type', '=', $type]])->orderBy('date_created', 'DESC')->get();
        if ($activityHistories->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ActivityHistoryResource::collection($activityHistories), 'Ok', 200);
    }

    public function getAllActivityHistoryByDate($date)
    {
        $activityHistories = ActivityHistory::where('date_created', $date)->orderBy('date_created', 'DESC')->get();
        if ($activityHistories->isEmpty())
            return Payload::toJson(null, 'Data Not Found', 404);
        return Payload::toJson(ActivityHistoryResource::collection($activityHistories), 'Ok', 200);
    }

    public function saveActivityHistory(Request $req)
    {
        DB::beginTransaction();
        try {
            $activityHistory = new ActivityHistory();
            $activityHistory->fill([
                'activity' => $req->activity,
                'object_id' => $req->object_id,
                'date_created' => Carbon::now('Asia/Ho_Chi_Minh'),
                'user_id' => $req->user_id,
                'type' => $req->type,
            ]);
            $activityHistory->save();
            DB::commit();
            return Payload::toJson(new ActivityHistoryResource($activityHistory), 'Create Successfully', 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
