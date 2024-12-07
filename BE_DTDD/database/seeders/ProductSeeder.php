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
        // Dữ liệu sản phẩm cho tất cả các category
        DB::table('products')->insert([
            // Category: iPhone (id_cate = 1)
            ['name' => 'iPhone 15 Pro', 'price' => 999, 'img' => 'https://cdn.viettelstore.vn/Images/Product/ProductImage/509196509.jpeg', 'rating' => 4.5, 'reviews' => 120, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'iPhone 14', 'price' => 899, 'img' => 'https://shopdunk.com/images/thumbs/0008734_iphone-14-pro-128gb.png', 'rating' => 4.3, 'reviews' => 98, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'iPhone 13', 'price' => 799, 'img' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/1/1/11_3_12_2_1_6.jpg', 'rating' => 4.2, 'reviews' => 150, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'iPhone SE 2022', 'price' => 499, 'img' => 'https://cdn.xtmobile.vn/vnt_upload/product/07_2024/thumbs/600_iphone_se_2022_do_xtmobile.png', 'rating' => 4.0, 'reviews' => 60, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'iPhone 12 Mini', 'price' => 599, 'img' => 'https://cdn.xtmobile.vn/vnt_upload/product/06_2023/thumbs/600_iphone_12_mini_64gb.jpg', 'rating' => 4.4, 'reviews' => 85, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'iPhone 12 Pro Max', 'price' => 1099, 'img' => 'https://techspace.vn/wp-content/uploads/2022/09/1_pro_2f30589686674a5cb922f0c9bf17d539-1-1.jpg', 'rating' => 4.6, 'reviews' => 200, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'iPhone 11', 'price' => 699, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/153856/iphone-11-trang-600x600.jpg', 'rating' => 4.1, 'reviews' => 110, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'iPhone XR', 'price' => 649, 'img' => 'https://muabandienthoai24h.vn/storage/images/SrDbHpe06E_1682413271.jpg', 'rating' => 4.3, 'reviews' => 130, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'iPhone 8', 'price' => 399, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/114113/iphone-8-64gb-hh-600x600.jpg', 'rating' => 4.0, 'reviews' => 70, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'iPhone 7 Plus', 'price' => 350, 'img' => 'https://product.hstatic.net/1000198144/product/7_09be005433b544e8879f3f8008cc7891_master.jpg', 'rating' => 3.9, 'reviews' => 40, 'id_cate' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Category: Samsung (id_cate = 2)
            ['name' => 'Samsung Galaxy S23', 'price' => 1099, 'img' => 'https://cdn.xtmobile.vn/vnt_upload/product/02_2023/thumbs/(600x600)_crop_galaxy-s23-plus-8gb-256gb.jpg', 'rating' => 4.7, 'reviews' => 190, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy Note 20', 'price' => 950, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/218355/samsung-galaxy-note-20-062220-122200-fix-600x600.jpg', 'rating' => 4.4, 'reviews' => 130, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy S22 Ultra', 'price' => 1199, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-600x600.jpg', 'rating' => 4.8, 'reviews' => 250, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy Z Fold 4', 'price' => 1799, 'img' => 'https://cdn11.dienmaycholon.vn/filewebdmclnew/DMCL21/Picture//Apro/Apro_product_31151/samsung-galaxy-_main_779_1020.png.webp', 'rating' => 4.9, 'reviews' => 100, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy A54', 'price' => 499, 'img' => 'https://cdn.viettablet.com/images/detailed/59/samsung-galaxy-a54-5g_0rs7-04.jpg', 'rating' => 4.2, 'reviews' => 65, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy A14', 'price' => 299, 'img' => 'https://cdn.mediamart.vn/images/product/din-thoi-samsung-galaxy-a14-5g-a146p-4128g-d_08454000.jpg', 'rating' => 4.1, 'reviews' => 85, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy Z Flip 4', 'price' => 999, 'img' => 'https://clickbuy.com.vn/uploads/product-variant/samsung-galaxy-z-flip4-5g-128gb-cu-dep-graphite-black-181762-1900.png', 'rating' => 4.6, 'reviews' => 180, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy S21', 'price' => 799, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/236128/samsung-galaxy-s21-plus-256gb-bac-600x600-600x600.jpg', 'rating' => 4.3, 'reviews' => 120, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy A73', 'price' => 450, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/246195/samsung-galaxy-a73-1-600x600.jpg', 'rating' => 4.4, 'reviews' => 110, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy M32', 'price' => 350, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/237634/samsung-galaxy-m32-1-600x600.jpg', 'rating' => 4.0, 'reviews' => 70, 'id_cate' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Category: Xiaomi (id_cate = 3)
            ['name' => 'Xiaomi 13 Pro', 'price' => 899, 'img' => 'https://clickbuy.com.vn/uploads/product-variant/xiaomi-13-pro-8gb-128gb-white-197429-4123.png', 'rating' => 4.7, 'reviews' => 140, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi 12T', 'price' => 650, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/279065/xiaomi-12t-thumb-bac-1-600x600.jpg', 'rating' => 4.3, 'reviews' => 95, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi Redmi Note 12', 'price' => 349, 'img' => 'https://dienthoaihay.vn/images/products/2023/03/21/large/note-12-den_1679381732.jpg', 'rating' => 4.1, 'reviews' => 80, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi Mi 11 Ultra', 'price' => 799, 'img' => 'https://viostore.vn/wp-content/uploads/2023/09/20.png', 'rating' => 4.6, 'reviews' => 150, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi Poco F4', 'price' => 479, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/271539/xiaomi-poco-f4-gt-600x600.jpg', 'rating' => 4.2, 'reviews' => 60, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi Redmi K40', 'price' => 499, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/229010/redmi-k40-600x600-600x600.jpg', 'rating' => 4.4, 'reviews' => 75, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi Mi 10T Pro', 'price' => 599, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/228136/xiaomi-mi-10t-pro-den-600x600.jpg', 'rating' => 4.3, 'reviews' => 90, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi Mi 11', 'price' => 699, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/226264/xiaomi-mi-11-xanhduong-600x600-600x600.jpg', 'rating' => 4.0, 'reviews' => 110, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi Redmi 9', 'price' => 249, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/217308/xiaomi-redmi-9-tim-new-600x600-600x600.jpg', 'rating' => 4.2, 'reviews' => 60, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi Poco X3', 'price' => 399, 'img' => 'https://cdn.tgdd.vn/Products/Images/42/227900/xiaomi-poco-x3-nfc-xam-600x600.jpg', 'rating' => 4.5, 'reviews' => 120, 'id_cate' => 3, 'created_at' => now(), 'updated_at' => now()],

            // // Category: Redmi (id_cate = 4)
            // ['name' => 'Redmi Note 10 Pro', 'price' => 399, 'img' => 'redmi_note_10_pro.jpg', 'rating' => 4.3, 'reviews' => 110, 'id_cate' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Redmi 10A', 'price' => 249, 'img' => 'redmi_10a.jpg', 'rating' => 4.1, 'reviews' => 80, 'id_cate' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Redmi 9C', 'price' => 199, 'img' => 'redmi_9c.jpg', 'rating' => 4.2, 'reviews' => 60, 'id_cate' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Redmi 10 Prime', 'price' => 249, 'img' => 'redmi_10_prime.jpg', 'rating' => 4.0, 'reviews' => 50, 'id_cate' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Redmi Note 11', 'price' => 359, 'img' => 'redmi_note_11.jpg', 'rating' => 4.3, 'reviews' => 90, 'id_cate' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Redmi Note 9S', 'price' => 299, 'img' => 'redmi_note_9s.jpg', 'rating' => 4.2, 'reviews' => 70, 'id_cate' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Redmi 9', 'price' => 179, 'img' => 'redmi_9.jpg', 'rating' => 4.0, 'reviews' => 40, 'id_cate' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Redmi Note 8 Pro', 'price' => 259, 'img' => 'redmi_note_8_pro.jpg', 'rating' => 4.1, 'reviews' => 65, 'id_cate' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

