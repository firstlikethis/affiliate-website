<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'meta_title',
        'meta_description',
        'schema_markup',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'schema_markup' => 'array',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The products that belong to the article.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'article_products')
            ->withPivot('position')
            ->orderBy('position');
    }

    /**
     * Get the URL for the article.
     */
    public function getUrlAttribute(): string
    {
        return route('article.show', $this->slug);
    }

    /**
     * Get the thumbnail URL for the article.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        
        return asset('images/no-image.png');
    }

    /**
     * Get the formatted created date.
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d M Y');
    }

    /**
     * The tags that belong to the article.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    
    /**
     * Increment the view count for this article.
     */
    public function incrementViewCount(): void
    {
        $this->increment('views');
    }
}