<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id' => 'US220114082734',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'full_name' => 'PTP STORE',
            'email' => 'ptpstore.050914@gmail.com',
            'address' => 'TP HCM',
            'birth_day' => '10/12/2021',
            'phone' => '099999999',
            'role_id' => 'AD',
            'image' => 'admin.png',
            'status' => 1,
            'created_at' => '2022-03-26 00:00:00',
            'updated_at' => '2022-03-26 00:00:00'
        ]);
        DB::table('users')->insert([
            'user_id' => 'US220117082456',
            'username' => '0309090300',
            'password' => bcrypt('member'),
            'full_name' => 'Phạm Tấn Tài',
            'email' => 'phamtantai@gmail.com',
            'address' => 'Vũng Tàu',
            'birth_day' => '09/01/2001',
            'phone' => '0309090300',
            'role_id' => 'MB',
            'image' => 'member.png',
            'status' => 1,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('users')->insert([
            'user_id' => 'US220117082526',
            'username' => '0309030933',
            'password' => bcrypt('member'),
            'full_name' => 'Trần Minh Phường',
            'email' => 'minhphuongk57.coder.it@gmail.com',
            'address' => 'Đồng Tháp',
            'birth_day' => '05/07/2001',
            'phone' => '0309030933',
            'role_id' => 'MB',
            'image' => 'member.png',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('users')->insert([
            'user_id' => 'US220607052535',
            'username' => '0303999999',
            'password' => bcrypt('member'),
            'full_name' => 'Member Example',
            'email' => 'member.example@gmail.com',
            'address' => 'Địa Chỉ',
            'birth_day' => '01/01/2001',
            'phone' => '0303999999',
            'role_id' => 'MB',
            'image' => 'member.png',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
