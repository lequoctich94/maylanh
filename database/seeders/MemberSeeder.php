<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'member_id' => 'MB220117032456',
            'current_point' => 2883,
            'rank_id' => "GOLD",
            'user_id' => 'US220117082456',
            'date_start_rank' => '2022-06-08',
            'status' => 1,
            'token_devices' => 'cVJLjk5rSWm7zTk0LQZUlz:APA91bHOGItm4swPt4zUzO8QwlSlYtPHfPYr2hHbjoDwz5j6crvANS0eXYRLDcn129-GShGi5ujlwSFsILwtKlyu_9Fm_ar_7QtSFiP-HabKgBb9Zng3SnboXMiAHsMvZ1SHMNhusKf8,dNSPxHDJQfK_ZKzu8Q1W_q:APA91bHrLEJFX2L17knOm_odvMG994VYDWzv9HDWKi44o127KL0Qlf6ICz_4OZpoQgRGVQubGTL9UFv5kbfu9zzyKq6K3Q54nmwNpAA1N5ixxiUxNiPxYQEVn9SNRc7i269CmYeGEfbV,ci5tNDTTQLSP0XH1XQs_pM:APA91bEZEMyLW4fHKqT98jTD8TGIarEWZUobeeotImgQD-Cy_-KQW5U4SGAoz08On2neId25AUJJMEbd1Nl7BsbbAG_oj2oKyV1q43PlIqUGdDCtZdHMgKUxp2cduSS5ufW6qnC9xccV,ftmLRqH0Rxq2tYtK9M--aJ:APA91bFgw2kQBLCxvrXplBJdXJ-DHfbYJDH5IUfiekfUwpOCSrTQUgFkEi34EhMiiS9qs-VO3NRsMldrrgprg_3PigTxca5R4tmMu-w5HXueSRV2TKRp4u3JjG_DbsGw4JaW18_FyBAW,dadq0KmKTrSdfKY8XDo2Up:APA91bG4vildQgA8x7-6XObaxl8ebyhrCQj_Ly19H0GzOVdaEXkyyWNZ-O6mK2CAjJtUbzcpzThdK64c5poAxFtsDWDfM4RGOhYMghmSvYYvWNCDTlHlDiK-hVarqmoXexobJypQ30LK'
        ]);
        DB::table('members')->insert([
            'member_id' => 'MB220117032526',
            'current_point' => 273,
            'rank_id' => "BRONZE",
            'user_id' => 'US220117082526',
            'date_start_rank' => '2022-06-08',
            'status' => 1,
            'token_devices' => 'c9YeZKh6TCucOPZQQ0kLKP:APA91bHkhnnL91ii7the-xZAcbwCNUkCJW9YLz_5sEURI42h5BnGJFG3frWIEVJlYc15R0gVieYxeg9h8K3mLalYWW-CqlMsraHBJSagJCyCu_w10EsEEQLqdQ69_OIx8_g7ef4AvrrT,dNSPxHDJQfK_ZKzu8Q1W_q:APA91bHrLEJFX2L17knOm_odvMG994VYDWzv9HDWKi44o127KL0Qlf6ICz_4OZpoQgRGVQubGTL9UFv5kbfu9zzyKq6K3Q54nmwNpAA1N5ixxiUxNiPxYQEVn9SNRc7i269CmYeGEfbV'
        ]);
        DB::table('members')->insert([
            'member_id' => 'MB220607122535',
            'current_point' => 275,
            'rank_id' => "BRONZE",
            'user_id' => 'US220607052535',
            'date_start_rank' => '2022-06-08',
            'status' => 1,
            'token_devices' => 'dadq0KmKTrSdfKY8XDo2Up:APA91bG4vildQgA8x7-6XObaxl8ebyhrCQj_Ly19H0GzOVdaEXkyyWNZ-O6mK2CAjJtUbzcpzThdK64c5poAxFtsDWDfM4RGOhYMghmSvYYvWNCDTlHlDiK-hVarqmoXexobJypQ30LK'
        ]);
    }
}
