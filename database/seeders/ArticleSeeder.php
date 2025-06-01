<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => '10 รองเท้าวิ่งที่ดีที่สุดในปี 2025',
                'slug' => 'best-running-shoes-2025',
                'content' => '<p>รองเท้าวิ่งที่ดีที่สุดในปี 2025 มาพร้อมกับเทคโนโลยีล่าสุดที่ช่วยให้การวิ่งของคุณมีประสิทธิภาพมากขึ้น</p>
                <p>นี่คือรายชื่อรองเท้าวิ่งที่ดีที่สุดในปี 2025:</p>
                <h2>1. Nike Air Max 2025</h2>
                <p>รองเท้าวิ่งรุ่นใหม่ล่าสุดจาก Nike ที่มาพร้อมเทคโนโลยี Air Max ล่าสุด ให้ความรู้สึกนุ่มสบายและตอบสนองได้ดีเยี่ยม</p>
                <h2>2. Adidas Ultraboost 5.0</h2>
                <p>รองเท้าวิ่งรุ่นใหม่ล่าสุดจาก Adidas ที่มาพร้อมเทคโนโลยี Boost ที่ให้พลังในการวิ่งและความสบายระดับสูงสุด</p>',
                'thumbnail' => 'images/articles/best-running-shoes-2025.jpg',
                'meta_title' => '10 รองเท้าวิ่งที่ดีที่สุดในปี 2025 | รีวิวและรายละเอียด',
                'meta_description' => 'รวมรายชื่อรองเท้าวิ่งที่ดีที่สุดในปี 2025 พร้อมรีวิวและรายละเอียดเพื่อช่วยให้คุณเลือกรองเท้าวิ่งที่เหมาะกับความต้องการของคุณ',
                'schema_markup' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'headline' => '10 รองเท้าวิ่งที่ดีที่สุดในปี 2025',
                    'description' => 'รวมรายชื่อรองเท้าวิ่งที่ดีที่สุดในปี 2025 พร้อมรีวิวและรายละเอียด',
                    'image' => 'https://example.com/images/articles/best-running-shoes-2025.jpg',
                    'datePublished' => '2025-01-15T08:00:00+07:00',
                    'dateModified' => '2025-01-15T08:00:00+07:00',
                    'author' => [
                        '@type' => 'Person',
                        'name' => 'Admin User'
                    ]
                ]),
            ],
            [
                'title' => 'เปรียบเทียบสมาร์ทโฟนเรือธงปี 2025: iPhone vs Samsung vs Google',
                'slug' => 'flagship-smartphones-comparison-2025',
                'content' => '<p>สมาร์ทโฟนเรือธงในปี 2025 มาพร้อมกับเทคโนโลยีล้ำสมัยและฟีเจอร์ใหม่ๆ มากมาย</p>
                <p>มาดูการเปรียบเทียบระหว่าง iPhone 15 Pro, Samsung Galaxy S25 Ultra และ Google Pixel 9 Pro กัน</p>
                <h2>1. Apple iPhone 15 Pro</h2>
                <p>iPhone 15 Pro มาพร้อมชิป A16 ที่ทรงพลัง กล้องระดับโปร และระบบปฏิบัติการ iOS ที่เสถียรและปลอดภัย</p>
                <h2>2. Samsung Galaxy S25 Ultra</h2>
                <p>Samsung Galaxy S25 Ultra โดดเด่นด้วยกล้องความละเอียดสูง จอ Dynamic AMOLED ที่สวยงาม และปากกา S Pen ที่ใช้งานได้หลากหลาย</p>',
                'thumbnail' => 'images/articles/flagship-smartphones-comparison-2025.jpg',
                'meta_title' => 'เปรียบเทียบสมาร์ทโฟนเรือธงปี 2025 | iPhone vs Samsung vs Google',
                'meta_description' => 'เปรียบเทียบสมาร์ทโฟนเรือธงในปี 2025 ระหว่าง iPhone 15 Pro, Samsung Galaxy S25 Ultra และ Google Pixel 9 Pro ทั้งด้านสเปค ประสิทธิภาพ และกล้อง',
                'schema_markup' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'headline' => 'เปรียบเทียบสมาร์ทโฟนเรือธงปี 2025: iPhone vs Samsung vs Google',
                    'description' => 'เปรียบเทียบสมาร์ทโฟนเรือธงในปี 2025 ระหว่าง iPhone 15 Pro, Samsung Galaxy S25 Ultra และ Google Pixel 9 Pro',
                    'image' => 'https://example.com/images/articles/flagship-smartphones-comparison-2025.jpg',
                    'datePublished' => '2025-02-20T10:00:00+07:00',
                    'dateModified' => '2025-02-20T10:00:00+07:00',
                    'author' => [
                        '@type' => 'Person',
                        'name' => 'Admin User'
                    ]
                ]),
            ],
        ];

        foreach ($articles as $article) {
            $article['created_at'] = now();
            $article['updated_at'] = now();
            DB::table('articles')->insert($article);
        }

        // เพิ่มความสัมพันธ์ระหว่างบทความและสินค้า
        $articleProducts = [
            [
                'article_id' => 1, // บทความรองเท้าวิ่ง
                'product_id' => 1, // Nike Air Max 2025
                'position' => 1,
            ],
            [
                'article_id' => 1, // บทความรองเท้าวิ่ง
                'product_id' => 2, // Adidas Ultraboost 5.0
                'position' => 2,
            ],
            [
                'article_id' => 2, // บทความสมาร์ทโฟน
                'product_id' => 5, // iPhone 15 Pro
                'position' => 1,
            ],
            [
                'article_id' => 2, // บทความสมาร์ทโฟน
                'product_id' => 6, // Samsung Galaxy S25 Ultra
                'position' => 2,
            ],
        ];

        foreach ($articleProducts as $ap) {
            $ap['created_at'] = now();
            $ap['updated_at'] = now();
            DB::table('article_products')->insert($ap);
        }
    }
}