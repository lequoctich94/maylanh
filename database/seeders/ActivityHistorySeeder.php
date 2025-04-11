<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity_histories')->insert([
            'id' => 1,
            'activity' => 'Tạo tài khoản',
            'date_created' => '2022-03-25 00:00:00',
            'user_id' => 'US220117082456',
            'type' => 5
        ]);

        DB::table('activity_histories')->insert([
            'id' => 2,
            'activity' => 'Đăng nhập vào chương trình',
            'date_created' => '2022-03-25 12:00:00',
            'user_id' => 'US220117082456',
            'type' => 5
        ]);
    }
}
