<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreativePortfolioCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'slug',
        'cover_image',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);

                // Ensure slug uniqueness for this customer
                $count = static::where('customer_id', $category->customer_id)
                              ->where('slug', $category->slug)
                              ->count();

                if ($count > 0) {
                    $category->slug = $category->slug . '-' . (string) Str::uuid();
                }
            }
        });
    }

    /**
     * Get the customer that owns the category
     */
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    /**
     * Scope for active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get cover image URL
     */
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('frontend/creative/portfolio/' . $this->cover_image);
        }
        return asset('frontend/assets/images/placeholder.jpg');
    }

    /**
     * Get image count in this category (placeholder - requires gallery implementation)
     */
    public function getImageCountAttribute()
    {
        // This will be implemented when gallery feature is added
        return 0;
    }
}
