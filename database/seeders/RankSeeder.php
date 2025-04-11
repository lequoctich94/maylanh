<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranks')->insert([
            'rank_id' => 'BRONZE',
            'rank_name' => 'Đồng',
            'point' => 0,
            'status' => 1,
            'created_at' => '2022-01-14 08:28:37',
            'updated_at' => '2022-01-14 08:28:37',
        ]);
        DB::table('ranks')->insert([
            'rank_id' => 'SLIVER',
            'rank_name' => 'Bạc',
            'point' => 500,
            'status' => 1,
            'created_at' => '2022-01-14 08:28:37',
            'updated_at' => '2022-01-14 08:28:37',
        ]);
        DB::table('ranks')->insert([
            'rank_id' => 'GOLD',
            'rank_name' => 'Vàng',
            'point' => 1200,
            'status' => 1,
            'created_at' => '2022-01-14 08:28:37',
            'updated_at' => '2022-01-14 08:28:37',
        ]);
        DB::table('ranks')->insert([
            'rank_id' => 'PLATINUM',
            'rank_name' => 'Bạch Kim',
            'point' => 1800,
            'status' => 1,
            'created_at' => '2022-01-14 08:28:37',
            'updated_at' => '2022-01-14 08:28:37',
        ]);
        DB::table('ranks')->insert([
            'rank_id' => 'DIAMOND',
            'rank_name' => 'Kim Cương',
            'point' => 3500,
            'status' => 1,
            'created_at' => '2022-01-14 08:28:37',
            'updated_at' => '2022-01-14 08:28:37',
        ]);
        DB::table('ranks')->insert([
            'rank_id' => 'LEGENDARY',
            'rank_name' => 'Huyền Thoại',
            'point' => 5000,
            'status' => 1,
            'created_at' => '2022-02-15 03:06:20',
            'updated_at' => '2022-03-26 03:06:20',
        ]);
        DB::table('ranks')->insert([
            'rank_id' => 'CHAMPION',
            'rank_name' => 'Quán Quân',
            'point' => 10000,
            'status' => 1,
            'created_at' => '2022-01-14 08:28:37',
            'updated_at' => '2022-01-14 08:28:37',
        ]);
    }
}
