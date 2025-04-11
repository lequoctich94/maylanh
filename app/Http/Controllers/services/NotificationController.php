<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
use App\Http\Payload;
use App\Http\Resources\NotificationResource;
use App\Models\Member;
use App\Models\Notification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function getAllNotificationByMemberId($member_id)
    {
        $notifications = Notification::where('member_id', $member_id)->get();

        if ($notifications->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(NotificationResource::collection($notifications), 'Ok', 200);
    }

    public function getAllNotificationByMemberIdAndStatus($member_id, $status)
    {
        $notifications = Notification::where([['member_id', $member_id], ['status', $status]])->get();

        if ($notifications->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(NotificationResource::collection($notifications), 'Ok', 200);
    }


    public function updateStatusNotification(Request $req)
    {
        DB::beginTransaction();
        try {
            $result = Notification::where([['notification_id', $req->notification_id], ['member_id', $req->member_id]])
                ->update(['status' => $req->status]);
            DB::commit();
            if ($result == 1) {
                $notification = Notification::where('notification_id', $req->notification_id)->first();
                return Payload::toJson(new NotificationResource($notification), "Update Successfully", 202);
            }
            return Payload::toJson(null, "Cannot Update", 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateAllStatusNotification(Request $req)
    {
        DB::beginTransaction();
        try {
            Notification::where('member_id', $req->member_id)
                ->update(['status' => $req->status]);
            $notifications = Notification::where('member_id', $req->member_id)->get();
            DB::commit();
            return Payload::toJson(NotificationResource::collection($notifications), "Update Successfully", 202);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }


    public function pushNotificationByMember(Request $req)
    {
        DB::beginTransaction();
        try {
            $notification = new Notification();
            $member = Member::where('member_id', $req->member_id)->first();
            $notification->fill([
                'notification_id' => "NTF" . Carbon::now('Asia/Ho_Chi_Minh')->format('ymdhis'),
                'title' => $req->title,
                'body' => $req->body,
                'member_id' => $req->member_id,
            ]);

            if (!$notification->save()) {
                return "Cannot Not Save";
            }

            // $notification = Notification::where('notification_id',$notification->notification_id)->first();
            $token_devices = explode(',', $member->token_devices);
            $url = 'https://fcm.googleapis.com/fcm/send';
            $key = "AAAAsWjTAPU:APA91bEbVGmc1rXSLS8mNnHUoe-rFW4QirQ40WuLIeVAsnZVXvIHASkp25mHVp9PPEmsF5evfE9DzUrwkkgA14WEekigVY27topv5E9qNiR7H17cpfHUBOvjOfcBWMWLSJ2QVsh3h_nx";
            $body = [
                'registration_ids' => $token_devices,
                'notification' => [
                    'title' => $req->title,
                    'body' => $req->body,
                ],
                'data' => [
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                ]
            ];
            $response = Http::withHeaders([
                'Authorization' => 'key=' . $key,
                'Content-Type' => 'application/json'
            ])->post($url, $body);
            $result = $response['success'];
            DB::commit();
            if (!$result)
                return "Cannot Send Notification";

            return Payload::toJson(new NotificationResource($notification), "Create Successfully", 201);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}