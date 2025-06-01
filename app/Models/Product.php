<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'image_path',
        'affiliate_link',
        'category_id',
        'is_featured',
        'meta_title',
        'meta_description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The articles that belong to the product.
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_products')
            ->withPivot('position')
            ->orderBy('position');
    }

    /**
     * Get the image URL for the product.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        
        return asset('images/no-image.png');
    }

    /**
     * Get the formatted price for the product.
     */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2) . ' บาท';
    }

    /**
     * Get schema.org JSON-LD markup for the product.
     */
    public function getSchemaMarkupAttribute(): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $this->name,
            'description' => $this->meta_description ?? $this->name,
            'image' => $this->image_url,
            'offers' => [
                '@type' => 'Offer',
                'price' => $this->price,
                'priceCurrency' => 'THB',
                'availability' => 'https://schema.org/InStock',
                'url' => $this->affiliate_link
            ]
        ];

        return json_encode($schema);
    }
}