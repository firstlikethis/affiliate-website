<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // รองเท้า
        $shoes = [
            [
                'name' => 'Nike Air Max 2025',
                'price' => 4500.00,
                'image_path' => 'images/products/nike-air-max-2025.jpg',
                'affiliate_link' => 'https://www.lazada.co.th/products/nike-i123456789.html',
                'category_id' => 1, // รองเท้า
                'is_featured' => true,
                'meta_title' => 'Nike Air Max 2025 | รองเท้าวิ่งรุ่นใหม่ล่าสุด',
                'meta_description' => 'Nike Air Max 2025 รองเท้าวิ่งรุ่นใหม่ล่าสุดจาก Nike ที่มาพร้อมเทคโนโลยี Air Max ล่าสุด',
            ],
            [
                'name' => 'Adidas Ultraboost 5.0',
                'price' => 5200.00,
                'image_path' => 'images/products/adidas-ultraboost-5.jpg',
                'affiliate_link' => 'https://www.lazada.co.th/products/adidas-i987654321.html',
                'category_id' => 1, // รองเท้า
                'is_featured' => true,
                'meta_title' => 'Adidas Ultraboost 5.0 | รองเท้าวิ่งรุ่นใหม่ล่าสุด',
                'meta_description' => 'Adidas Ultraboost 5.0 รองเท้าวิ่งรุ่นใหม่ล่าสุดจาก Adidas ที่มาพร้อมเทคโนโลยี Boost',
            ],
        ];

        // เสื้อผ้า
        $clothing = [
            [
                'name' => 'เสื้อยืด Uniqlo U Oversize',
                'price' => 590.00,
                'image_path' => 'images/products/uniqlo-u-tshirt.jpg',
                'affiliate_link' => 'https://www.lazada.co.th/products/uniqlo-i111222333.html',
                'category_id' => 2, // เสื้อผ้า
                'is_featured' => false,
                'meta_title' => 'เสื้อยืด Uniqlo U Oversize | เสื้อยืดคุณภาพดี',
                'meta_description' => 'เสื้อยืด Uniqlo U Oversize ทรง Oversize สีพื้น ผลิตจากผ้าฝ้าย 100% คุณภาพดี',
            ],
            [
                'name' => 'กางเกงยีนส์ Levi\'s 501 Original',
                'price' => 2990.00,
                'image_path' => 'images/products/levis-501.jpg',
                'affiliate_link' => 'https://www.lazada.co.th/products/levis-i444555666.html',
                'category_id' => 2, // เสื้อผ้า
                'is_featured' => true,
                'meta_title' => 'กางเกงยีนส์ Levi\'s 501 Original | ยีนส์คลาสสิก',
                'meta_description' => 'กางเกงยีนส์ Levi\'s 501 Original รุ่นคลาสสิกที่ได้รับความนิยมมาอย่างยาวนาน',
            ],
        ];

        // อุปกรณ์อิเล็กทรอนิกส์
        $electronics = [
            [
                'name' => 'Apple iPhone 15 Pro 256GB',
                'price' => 42900.00,
                'image_path' => 'images/products/iphone-15-pro.jpg',
                'affiliate_link' => 'https://www.lazada.co.th/products/apple-i777888999.html',
                'category_id' => 3, // อุปกรณ์อิเล็กทรอนิกส์
                'is_featured' => true,
                'meta_title' => 'Apple iPhone 15 Pro 256GB | สมาร์ทโฟนรุ่นล่าสุด',
                'meta_description' => 'Apple iPhone 15 Pro 256GB สมาร์ทโฟนรุ่นล่าสุดจาก Apple ที่มาพร้อมชิป A16 และกล้องระดับโปร',
            ],
            [
                'name' => 'Samsung Galaxy S25 Ultra',
                'price' => 38900.00,
                'image_path' => 'images/products/samsung-s25-ultra.jpg',
                'affiliate_link' => 'https://www.lazada.co.th/products/samsung-i000111222.html',
                'category_id' => 3, // อุปกรณ์อิเล็กทรอนิกส์
                'is_featured' => true,
                'meta_title' => 'Samsung Galaxy S25 Ultra | สมาร์ทโฟน Android รุ่นล่าสุด',
                'meta_description' => 'Samsung Galaxy S25 Ultra สมาร์ทโฟน Android รุ่นล่าสุดจาก Samsung ที่มาพร้อมกล้องความละเอียดสูงและจอ Dynamic AMOLED',
            ],
        ];

        // รวมสินค้าทั้งหมด
        $products = array_merge($shoes, $clothing, $electronics);

        foreach ($products as $product) {
            $product['created_at'] = now();
            $product['updated_at'] = now();
            DB::table('products')->insert($product);
        }
    }
}