<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentPortfolio extends Model
{
    use HasFactory;

    protected $table = 'talent_portfolio';

    protected $fillable = [
        'customer_id',
        'talent_type',
        'title',
        'description',
        'media_type',
        'media_url',
        'thumbnail',
        'category',
        'year',
        'sort_order',
        'is_featured',
        'status'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Relationship: Belongs to customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get full media URL
     */
    public function getMediaUrlFullAttribute()
    {
        // If external URL (starts with http), return as is
        if (str_starts_with($this->media_url, 'http')) {
            return $this->media_url;
        }
        // Otherwise, prepend asset path
        return asset('frontend/talent/portfolio/' . $this->media_url);
    }

    /**
     * Get full thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return null;
        }
        if (str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }
        return asset('frontend/talent/portfolio/' . $this->thumbnail);
    }

    /**
     * Get media type icon
     */
    public function getMediaIconAttribute()
    {
        return match($this->media_type) {
            'image' => 'fas fa-image',
            'video' => 'fas fa-video',
            'audio' => 'fas fa-music',
            default => 'fas fa-file'
        };
    }

    /**
     * Scope: Active items only
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope: Featured items
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: By talent type
     */
    public function scopeByTalent($query, $talentType)
    {
        return $query->where('talent_type', $talentType);
    }

    /**
     * Scope: By media type
     */
    public function scopeByMediaType($query, $mediaType)
    {
        return $query->where('media_type', $mediaType);
    }

    /**
     * Scope: Ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Get items by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
