<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bills')->insert([
            'bill_id' => '220214_103710',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032456',
            'shipping_address' => '2 đường 6 quận 6  phường 13 TP HCM',
            'shipping_phone' => '0123456789',
            'receiver' => 'Tài Phạm',
            'total_price' => 1200000,
            'total_quantity' => 3,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220213_115627',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032456',
            'shipping_address' => '2 đường 6 quận 6  phường 13 TP HCM',
            'shipping_phone' => '0123456789',
            'receiver' => 'Tài Phạm',
            'total_price' => 1600000,
            'total_quantity' => 5,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220213_030246',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032456',
            'shipping_address' => '2 đường 6 quận 6  phường 13 TP HCM',
            'shipping_phone' => '0123456789',
            'receiver' => 'Tài Phạm',
            'total_price' => 350000,
            'total_quantity' => 1,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220213_025219',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032456',
            'shipping_address' => '2 đường 6 quận 6  phường 13 TP HCM',
            'shipping_phone' => '0828781519',
            'receiver' => 'Tài Phạm',
            'total_price' => 1400000,
            'total_quantity' => 2,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220213_015458',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032526',
            'shipping_address' => 'TP HCM',
            'shipping_phone' => '0123456788',
            'receiver' => 'Nguyen Van A',
            'total_price' => 350000,
            'total_quantity' => 2,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220212_081848',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032526',
            'shipping_address' => 'TP HCM',
            'shipping_phone' => '0123456789',
            'receiver' => 'Tài Phạm',
            'total_price' => 4300000,
            'total_quantity' => 2,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220212_042607',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032456',
            'shipping_address' => 'Tiền Giang',
            'shipping_phone' => '0123456789',
            'receiver' => 'Tài Phạm',
            'total_price' => 500000,
            'total_quantity' => 2,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220212_025746',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032526',
            'shipping_address' => 'TP HCM',
            'shipping_phone' => '0123456788',
            'receiver' => 'Nguyen Van A',
            'total_price' => 1400000,
            'total_quantity' => 2,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220212_025245',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032526',
            'shipping_address' => 'TP HCM',
            'shipping_phone' => '0123456788',
            'receiver' => 'Nguyen Van A',
            'total_price' => 350000,
            'total_quantity' => 2,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220212_025128',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032526',
            'shipping_address' => 'TP HCM',
            'shipping_phone' => '0123456788',
            'receiver' => 'Nguyen Van A',
            'total_price' => 1000000,
            'total_quantity' => 1,
            'payment' => 1,
            'status' => 1,
        ]);
        DB::table('bills')->insert([
            'bill_id' => '220212_023224',
            'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
            'date_confirm' => '2022-06-08 12:00:00',
            'member_id' => 'MB220117032456',
            'shipping_address' => 'TP HCM',
            'shipping_phone' => '0123456789',
            'receiver' => 'Tài Phạm',
            'total_price' => 500000,
            'total_quantity' => 1,
            'payment' => 1,
            'status' => 1,
        ]);
    }
}
