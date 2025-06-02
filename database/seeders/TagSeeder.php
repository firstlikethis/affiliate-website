<?php
// database/seeders/TagSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create tags
        $tags = [
            'รีวิวสินค้า' => 'review-products',
            'แฟชั่น' => 'fashion',
            'เทคโนโลยี' => 'technology',
            'สมาร์ทโฟน' => 'smartphones',
            'รองเท้า' => 'shoes',
            'กระเป๋า' => 'bags',
            'ความงาม' => 'beauty',
            'ไลฟ์สไตล์' => 'lifestyle',
            'สุขภาพ' => 'health',
            'กีฬา' => 'sports',
            'อาหาร' => 'food',
            'ท่องเที่ยว' => 'travel',
            'การศึกษา' => 'education',
            'การเงิน' => 'finance',
            'เกม' => 'games',
        ];

        foreach ($tags as $tagName => $tagSlug) {
            Tag::create([
                'name' => $tagName,
                'slug' => $tagSlug,
            ]);
        }

        // Attach tags to existing articles
        $articles = Article::all();
        $tagIds = Tag::pluck('id')->toArray();

        foreach ($articles as $article) {
            $randomTagCount = rand(2, 4);
            $randomTagIds = array_rand(array_flip($tagIds), $randomTagCount);
            
            if (!is_array($randomTagIds)) {
                $randomTagIds = [$randomTagIds];
            }
            
            $article->tags()->attach($randomTagIds);
        }
    }
}