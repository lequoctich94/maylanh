<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_id' => 'PROD20220114045652',
            'product_name' => 'Áo Thun Tay Ngắn GRYMM DC Black',
            'price' => 320000,
            'category_id' => 'CATE20220114152927',
            'producer_id' => 'PDC20220114045527',
            'product_img' => 'PROD2022011404565290.jpg',
            'description' => "Vải thun dệt theo kĩ thuật Knit Jersey với thành phần cotton 94% đan 6% sợi spandex, giúp thấm hút tốt, đứng form, hạn chế nhăn và co dãn được 4 chiều.",
            'status' => 1,
            "created_at" => "2022-01-14 09:56:52",
            "updated_at" => "2022-01-14 09:56:52",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114045948',
            'product_name' => 'Apa:k 01 - Adventure backpack',
            'price' => 470000,
            'category_id' => 'CATE20220114152937',
            'producer_id' => 'PDC20220114045527',
            'product_img' => 'PROD2022011404594819.jpg',
            'description' => "- Balo thiết kế cao cấp, chống nước.\r\n- Dây chất lượng, đẳng cấp",
            'status' => 1,
            "created_at" => "2022-01-14 09:59:48",
            "updated_at" => "2022-01-14 09:59:48",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114050759',
            'product_name' => "Áo PD Gradient Jacket",
            'price' => 270000,
            'category_id' => 'CATE20220114152927',
            'producer_id' => 'PDC20220114050619',
            'product_img' => 'PROD2022011405075929.jpg',
            'description' => "Sản Phẩm áo PlayDirty chất lượng cao\r\nĐược làm từ chất liệu cao cấp",
            'status' => 1,
            "created_at" => "2022-01-14 09:59:48",
            "updated_at" => "2022-01-14 09:59:48",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114051125',
            'product_name' => "Quần Jeans Shade Of Blue Jeans",
            'price' => 290000,
            'category_id' => 'CATE20220114152950',
            'producer_id' => 'PDC20220114050619',
            'product_img' => 'PROD2022011405112524.jpg',
            'description' => "Sản Phẩm Quần Jeans chất lượng cao\r\nGiá ưu đãi cho quý khách hàng thân thiện",
            'status' => 1,
            "created_at" => "2022-01-14 10:11:25",
            "updated_at" => "2022-01-14 10:11:25",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114051402',
            'product_name' => "Áo Saint In Us T-Shirt 3",
            'price' => 280000,
            'category_id' => 'CATE20220114152927',
            'producer_id' => 'PDC20220114050619',
            'product_img' => 'PROD2022011405140250.jpg',
            'description' => "- Chất liệu: 100% từ sợi cotton nhập Mỹ\r\n- Thấm hút mồ hôi tốt",
            'status' => 1,
            "created_at" => "2022-01-14 10:14:02",
            "updated_at" => "2022-01-14 10:14:02",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114051514',
            'product_name' => "Áo Thun Saint In Us T-Shirt 3 Red",
            'price' => 290000,
            'category_id' => 'CATE20220114152927',
            'producer_id' => 'PDC20220114050619',
            'product_img' => 'PROD2022011405140250.jpg',
            'description' => "- Chất liệu: 100% từ sợi cotton nhập Mỹ\r\n- Thấm hút mồ hôi tốt",
            'status' => 1,
            "created_at" => "2022-01-14 10:15:14",
            "updated_at" => "2022-01-14 10:15:14",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114051905',
            'product_name' => "Áo Basic Sweater - Black Cool Ngầu",
            'price' => 200000,
            'category_id' => 'CATE20220114152927',
            'producer_id' => 'PDC20220114051737',
            'product_img' => 'PROD202201140519059.jpg',
            'description' => "Áo có chất liệu vải cực cao cấp\r\nDòng sản phẩm đẳng cấp từ shop",
            'status' => 1,
            "created_at" => "2022-01-14 10:19:05",
            "updated_at" => "2022-01-14 10:19:05",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114052517',
            'product_name' => "Dép Cao Cấp TSUN Slide - Black",
            'price' => 300000,
            'category_id' => 'CATE20220114172039',
            'producer_id' => 'PDC20220114051737',
            'product_img' => 'PROD2022011405251769.jpg',
            'description' => "Dòng Dép Cao Cấp\r\nChất Lượng Cao",
            'status' => 1,
            "created_at" => "2022-01-14 10:25:17",
            "updated_at" => "2022-01-14 10:25:17",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114053351',
            'product_name' => "Giày Thể Thao Nam Biti's Hunter Core Go For Love 2K22",
            'price' => 750000,
            'category_id' => 'CATE20220114172726',
            'producer_id' => 'PDC20220114053057',
            'product_img' => 'PROD2022011405335135.jpg',
            'description' => "Dòng Dép Cao Cấp\r\nChất Lượng Cao",
            'status' => 1,
            "created_at" => "2022-01-14 10:33:51",
            "updated_at" => "2022-01-14 10:33:51",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114053738',
            'product_name' => "Giày Thể Thao Nam Biti's Hunter X Festive Frosty",
            'price' => 800000,
            'category_id' => 'CATE20220114172726',
            'producer_id' => 'PDC20220114053057',
            'product_img' => 'PROD2022011405373830.jpg',
            'description' => "Sản Phẩm quá đẳng cấp khiến chúng tôi không biết mô tả gì thêm, hãy cứ mua đi vì cuộc đời cho phép",
            'status' => 1,
            "created_at" => "2022-01-14 10:37:38",
            "updated_at" => "2022-01-14 10:37:38",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114054031',
            'product_name' => "Dép Xốp Nam Bitis",
            'price' => 190000,
            'category_id' => 'CATE20220114172039',
            'producer_id' => 'PDC20220114053057',
            'product_img' => 'PROD2022011405403135.jpg',
            'description' => "Dòng dép cao cấp, nâng cao bàn chân Việt",
            'status' => 1,
            "created_at" => "2022-01-14 10:40:31",
            "updated_at" => "2022-01-14 10:40:31",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114054900',
            'product_name' => "Áo Khoác Bóng Ma",
            'price' => 1800000,
            'category_id' => 'CATE20220114174728',
            'producer_id' => 'PDC20220114054522',
            'product_img' => 'PROD2022011405490066.jpg',
            'description' => "Áo Khoác Đen Thuần Tuý\r\nBóng Đêm Của Sự Thanh Lịch",
            'status' => 1,
            "created_at" => "2022-01-14 10:49:00",
            "updated_at" => "2022-01-14 10:49:00",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114055359',
            'product_name' => "Áo Thun Ba Bị",
            'price' => 1900000,
            'category_id' => 'CATE20220114152927',
            'producer_id' => 'PDC20220114054522',
            'product_img' => 'PROD2022011405535922.jpg',
            'description' => "Áo Thun Chất Lượng Cao",
            'status' => 1,
            "created_at" => "2022-01-14 10:53:59",
            "updated_at" => "2022-01-14 10:53:59",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114060526',
            'product_name' => "DÉP ADISSAGE",
            'price' => 700000,
            'category_id' => 'CATE20220114172039',
            'producer_id' => 'PDC20220114060208',
            'product_img' => 'PROD2022011406052636.jpg',
            'description' => "Dép Chất Lượng Cao",
            'status' => 1,
            "created_at" => "2022-01-14 11:05:26",
            "updated_at" => "2022-01-14 11:05:26",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114061056',
            'product_name' => "GIÀY ADIDAS ZX 5K BOOST",
            'price' => 3900000,
            'category_id' => 'CATE20220114172726',
            'producer_id' => 'PDC20220114060208',
            'product_img' => 'PROD2022011406105615.jpg',
            'description' => "Quá Đẳng Cấp",
            'status' => 1,
            "created_at" => "2022-01-14 11:10:56",
            "updated_at" => "2022-01-14 11:10:56",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114061939',
            'product_name' => "Nón Dadhat G9 hairdontcare black",
            'price' => 250000,
            'category_id' => 'CATE20220114181559',
            'producer_id' => 'PDC20220114061523',
            'product_img' => 'PROD2022011406193933.jpg',
            'description' => "Nón Chất Lượng Cao Cấp",
            'status' => 1,
            "created_at" => "2022-01-14 11:19:39",
            "updated_at" => "2022-01-14 11:19:39",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114062217',
            'product_name' => "Nón Dadhat G9 hairdontcare BLACK(F0100)",
            'price' => 300000,
            'category_id' => 'CATE20220114181559',
            'producer_id' => 'PDC20220114062054',
            'product_img' => 'PROD2022011406221719.jpg',
            'description' => "Đẳng Cấp Đến Từ Thương Hiệu Caper",
            'status' => 1,
            "created_at" => "2022-01-14 11:22:17",
            "updated_at" => "2022-01-14 11:22:17",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220114083326',
            'product_name' => "Sơ Mi Cổ Danton Thần Cổ Đại Angelo Ver1",
            'price' => 300000,
            'category_id' => 'CATE20220114152927',
            'producer_id' => 'PDC20220114045527',
            'product_img' => 'PROD20220114083326389.jpg',
            'description' => "Sản phẩm đẹp toẹt dời",
            'status' => 1,
            "created_at" => "2022-01-14 01:33:26",
            "updated_at" => "2022-01-14 01:33:26",
        ]);
        DB::table('products')->insert([
            'product_id' => 'PROD20220222024956',
            'product_name' => "Áo khoác lát",
            'price' => 1440000,
            'category_id' => 'CATE20220114174728',
            'producer_id' => 'PDC20220114045527',
            'product_img' => 'PROD202202220249561.jpg',
            'description' => "Sản phẩm rất đẹp, đặt mua đi mọi người",
            'status' => 1,
            "created_at" => "2022-02-22 07:49:56",
            "updated_at" => "2022-02-22 07:49:56",
        ]);
    }
}
