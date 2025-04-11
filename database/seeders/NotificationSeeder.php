<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->insert([
            'notification_id' => 'NTF220211072355',
            'title' => 'PTP Store Thông Báo',
            'body' => 'Đơn hàng của bạn đã được xác nhận, và đang giao',
            'member_id' => 'MB220117032456',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('notifications')->insert([
            'notification_id' => 'NTF220211072405',
            'title' => 'PTP Store Thông Báo',
            'body' => 'Đơn hàng của bạn đã được giao thành công, Vui lòng kiểm tra đơn hàng của bạn',
            'member_id' => 'MB220117032456',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
    }
}
