<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('voucher_members')->insert([
            'id' => 1,
            'code' => 'KHUYENMAIDACBIET-220120050530',
            'member_id' => 'MB220117032456',
            'status' => 0,
        ]);
        DB::table('voucher_members')->insert([
            'id' => 2,
            'code' => 'KHUYENMAIDACBIET-220120050530',
            'member_id' => 'MB220117032526',
            'status' => 0,
        ]);
        DB::table('voucher_members')->insert([
            'id' => 3,
            'code' => 'KHUYENMAIDACBIET2-220120050856',
            'member_id' => 'MB220117032456',
            'status' => 0,
        ]);
        DB::table('voucher_members')->insert([
            'id' => 4,
            'code' => 'KHUYENMAIDACBIET222-220211123436',
            'member_id' => 'MB220117032456',
            'status' => 0,
        ]);
        DB::table('voucher_members')->insert([
            'id' => 5,
            'code' => 'KHUYENMAIDACBIETCONMEO-220213074903',
            'member_id' => 'MB220117032456',
            'status' => 0,
        ]);
        DB::table('voucher_members')->insert([
            'id' => 6,
            'code' => 'KHUYENMAIDACBIET333-220213080335',
            'member_id' => 'MB220117032456',
            'status' => 0,
        ]);
    }
}
