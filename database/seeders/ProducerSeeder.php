<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('producers')->insert([
            'producer_id' => 'PDC20220114045527',
            'producer_name' => 'CÔNG TY GRYMM DC',
            'phone' => '098 841 9102',
            'address' => '13c/9 Kỳ Đồng phường 9 quận 3',
            'status' => 1
        ]);
        DB::table('producers')->insert([
            'producer_id' => 'PDC20220114050619',
            'producer_name' => 'CÔNG TY PLAY DIRTY',
            'phone' => '0397753958',
            'address' => 'TP HCM',
            'status' => 1
        ]);
        DB::table('producers')->insert([
            'producer_id' => 'PDC20220114051737',
            'producer_name' => 'Công Ty Local Brand The Shirt You Need',
            'phone' => '093 407 63 42',
            'address' => 'TP HCM',
            'status' => 1
        ]);
        DB::table('producers')->insert([
            'producer_id' => 'PDC20220114053057',
            'producer_name' => 'BITIS HUNTER NÂNG CAO BÀN CHÂN VIỆT',
            'phone' => '028.37555.158',
            'address' => 'TP HCM',
            'status' => 1
        ]);
        DB::table('producers')->insert([
            'producer_id' => 'PDC20220114054522',
            'producer_name' => 'CÔNG TY MOIDIEN CUNG CẤP SẢN PHẨM CHÍNH HÃNG',
            'phone' => '090999900',
            'address' => 'TP HCM',
            'status' => 1
        ]);
        DB::table('producers')->insert([
            'producer_id' => 'PDC20220114060208',
            'producer_name' => 'CÔNG TY GIÀY DÉP CHÍNH HÃNG ADIDAS',
            'phone' => '0909001993',
            'address' => 'TP HCM',
            'status' => 1
        ]);
        DB::table('producers')->insert([
            'producer_id' => 'PDC20220114061523',
            'producer_name' => 'CÔNG TY NÓN PREMIER 3LX',
            'phone' => '02835146676',
            'address' => 'TP HCM',
            'status' => 1
        ]);
        DB::table('producers')->insert([
            'producer_id' => 'PDC20220114062054',
            'producer_name' => 'CÔNG TY NÓN CAPER',
            'phone' => '0966594999',
            'address' => 'TP HCM',
            'status' => 1
        ]);
    }
}
