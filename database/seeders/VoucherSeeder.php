<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vouchers')->insert([
            'code' => 'KHUYENMAIDACBIET-220120050530',
            'sale_off' => 0.50,
            'max_price' => 25000,
            'max_used' => 50,
            'date_start' => '2022-06-08',
            'date_end' => '2022-07-09',
            'status' => 0
        ]);
        DB::table('vouchers')->insert([
            'code' => 'KHUYENMAIDACBIET2-220120050856',
            'sale_off' => 0.50,
            'max_price' => 25000,
            'max_used' => 50,
            'date_start' => '2022-07-09',
            'date_end' => '2022-08-10',
            'status' => 0
        ]);
        DB::table('vouchers')->insert([
            'code' => 'KHUYENMAIDACBIET222-220211123436',
            'sale_off' => 0.70,
            'max_price' => 500000,
            'max_used' => 20,
            'date_start' => '2022-08-11',
            'date_end' => '2022-09-12',
            'status' => 0
        ]);
        DB::table('vouchers')->insert([
            'code' => 'KHUYENMAIDACBIET333-220213080335',
            'sale_off' => 0.80,
            'max_price' => 75000,
            'max_used' => 150,
            'date_start' => '2022-08-11',
            'date_end' => '2022-09-12',
            'status' => 0
        ]);
        DB::table('vouchers')->insert([
            'code' => 'KHUYENMAIDACBIETCONMEO-220213074903',
            'sale_off' => 0.50,
            'max_price' => 10000,
            'max_used' => 3000,
            'date_start' => '2022-08-11',
            'date_end' => '2022-09-12',
            'status' => 0
        ]);
        DB::table('vouchers')->insert([
            'code' => 'KHUYENMAITHANG52022-220513082726',
            'sale_off' => 0.40,
            'max_price' => 30000,
            'max_used' => 100,
            'date_start' => '2022-08-11',
            'date_end' => '2022-09-12',
            'status' => 0
        ]);
    }
}
