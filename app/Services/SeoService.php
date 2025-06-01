<?php

namespace App\Services;

class SeoService
{
    /**
     * Generate SEO meta tags for a given model.
     *
     * @param object $model The model containing SEO data
     * @param string $modelType The type of model (product, category, article)
     * @return array
     */
    public function generateMetaTags($model, $modelType = 'page')
    {
        // Base meta tags
        $meta = [
            'title' => $model->meta_title ?? $model->title ?? $model->name ?? config('app.name'),
            'description' => $model->meta_description ?? substr(strip_tags($model->description ?? $model->content ?? ''), 0, 160),
            'canonical' => request()->url(),
            'og_type' => 'website',
            'twitter_card' => 'summary_large_image',
        ];

        // Add image if available
        if (isset($model->image_url) || isset($model->thumbnail_url)) {
            $meta['og_image'] = $model->image_url ?? $model->thumbnail_url;
            $meta['twitter_image'] = $model->image_url ?? $model->thumbnail_url;
        }

        // Type-specific meta tags
        switch ($modelType) {
            case 'product':
                $meta['og_type'] = 'product';
                $meta['product_price'] = $model->price;
                $meta['product_currency'] = 'THB';
                break;

            case 'article':
                $meta['og_type'] = 'article';
                $meta['article_published_time'] = $model->created_at->toIso8601String();
                $meta['article_modified_time'] = $model->updated_at->toIso8601String();
                break;

            case 'category':
                $meta['og_type'] = 'website';
                break;
        }

        // Schema.org JSON-LD
        if (isset($model->schema_markup)) {
            $meta['schema_markup'] = $model->schema_markup;
        } elseif (method_exists($model, 'getSchemaMarkupAttribute')) {
            $meta['schema_markup'] = $model->schema_markup;
        }

        return $meta;
    }
}