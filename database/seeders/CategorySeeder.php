<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'รองเท้า',
                'slug' => 'shoes',
                'description' => 'รองเท้าแบรนด์ดังราคาพิเศษ',
                'meta_title' => 'รองเท้าแบรนด์ดังราคาพิเศษ | ส่วนลดพิเศษ',
                'meta_description' => 'ช้อปรองเท้าแบรนด์ดังหลากหลายรุ่นในราคาพิเศษ พร้อมโปรโมชั่นส่วนลดมากมาย รับประกันของแท้ 100%',
            ],
            [
                'name' => 'เสื้อผ้า',
                'slug' => 'clothing',
                'description' => 'เสื้อผ้าแฟชั่นล่าสุดจากแบรนด์ชั้นนำ',
                'meta_title' => 'เสื้อผ้าแฟชั่นล่าสุด | แบรนด์ชั้นนำราคาพิเศษ',
                'meta_description' => 'อัพเดทแฟชั่นล่าสุดกับเสื้อผ้าจากแบรนด์ชั้นนำในราคาพิเศษ พร้อมส่วนลดและโปรโมชั่นพิเศษมากมาย',
            ],
            [
                'name' => 'อุปกรณ์อิเล็กทรอนิกส์',
                'slug' => 'electronics',
                'description' => 'อุปกรณ์อิเล็กทรอนิกส์ล่าสุดจากแบรนด์ชั้นนำ',
                'meta_title' => 'อุปกรณ์อิเล็กทรอนิกส์ล่าสุด | สมาร์ทโฟน แกดเจ็ต และอื่นๆ',
                'meta_description' => 'ช้อปอุปกรณ์อิเล็กทรอนิกส์ล่าสุด สมาร์ทโฟน แกดเจ็ต และอื่นๆ จากแบรนด์ชั้นนำในราคาพิเศษ',
            ],
            [
                'name' => 'กระเป๋า',
                'slug' => 'bags',
                'description' => 'กระเป๋าแบรนด์ดังราคาพิเศษ',
                'meta_title' => 'กระเป๋าแบรนด์ดัง | ส่วนลดพิเศษ',
                'meta_description' => 'ช้อปกระเป๋าแบรนด์ดังหลากหลายรุ่นในราคาพิเศษ พร้อมโปรโมชั่นส่วนลดมากมาย รับประกันของแท้ 100%',
            ],
            [
                'name' => 'ความงาม',
                'slug' => 'beauty',
                'description' => 'ผลิตภัณฑ์ความงามจากแบรนด์ชั้นนำ',
                'meta_title' => 'ผลิตภัณฑ์ความงาม | แบรนด์ชั้นนำราคาพิเศษ',
                'meta_description' => 'ช้อปผลิตภัณฑ์ความงามจากแบรนด์ชั้นนำในราคาพิเศษ พร้อมส่วนลดและโปรโมชั่นพิเศษมากมาย',
            ],
        ];

        foreach ($categories as $category) {
            $category['created_at'] = now();
            $category['updated_at'] = now();
            DB::table('categories')->insert($category);
        }
    }
}