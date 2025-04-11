<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodeResetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('code_resets')->insert([
            'id' => '2',
            'code' => '858260',
            'user_id' => 'US220117082456',
            'date_created' => '2022-06-08 11:30:03'
        ]);
        DB::table('code_resets')->insert([
            'id' => '3',
            'code' => '299976',
            'user_id' => 'US220117082456',
            'date_created' => '2022-06-07 12:22:11'
        ]);
        DB::table('code_resets')->insert([
            'id' => '4',
            'code' => '742365',
            'user_id' => 'US220117082456',
            'date_created' => '2022-06-07 12:30:37'
        ]);
        DB::table('code_resets')->insert([
            'id' => '5',
            'code' => '201044',
            'user_id' => 'US220117082456',
            'date_created' => '2022-06-08 11:17:58'
        ]);
    }
}
