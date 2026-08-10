<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';

    protected $fillable = [
        'customer_id',
        'company_id',
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'discounted_price',
        'currency',
        'dietary_type',
        'spice_level',
        'is_bestseller',
        'is_chefs_special',
        'is_new',
        'is_available',
        'allergens',
        'nutrition_info',
        'variants',
        'preparation_time',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'nutrition_info' => 'array',
        'variants' => 'array',
        'price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
    ];

    /**
     * Get the customer this item belongs to
     */
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    /**
     * Get the company this item belongs to
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get the category this item belongs to
     */
    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    /**
     * Get the display price (discounted or regular)
     */
    public function getDisplayPriceAttribute()
    {
        return $this->discounted_price ?? $this->price;
    }

    /**
     * Check if item has a discount
     */
    public function hasDiscount()
    {
        return $this->discounted_price && $this->discounted_price < $this->price;
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentAttribute()
    {
        if (!$this->hasDiscount()) {
            return 0;
        }
        return round((($this->price - $this->discounted_price) / $this->price) * 100);
    }

    /**
     * Get formatted price with currency
     */
    public function getFormattedPriceAttribute()
    {
        $symbol = $this->currency === 'INR' ? '₹' : $this->currency;
        return $symbol . number_format($this->display_price, 2);
    }

    /**
     * Check if item is vegetarian
     */
    public function isVeg()
    {
        return in_array($this->dietary_type, ['veg', 'vegan']);
    }

    /**
     * Get allergens as array
     */
    public function getAllergensArrayAttribute()
    {
        return $this->allergens ? explode(',', $this->allergens) : [];
    }

    /**
     * Scope to get only available items
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1)->where('status', 1);
    }

    /**
     * Scope to filter by dietary type
     */
    public function scopeVeg($query)
    {
        return $query->whereIn('dietary_type', ['veg', 'vegan']);
    }

    /**
     * Scope to filter non-veg
     */
    public function scopeNonVeg($query)
    {
        return $query->whereIn('dietary_type', ['non-veg', 'eggetarian']);
    }

    /**
     * Scope to get bestsellers
     */
    public function scopeBestsellers($query)
    {
        return $query->where('is_bestseller', 1);
    }

    /**
     * Scope to get chef's specials
     */
    public function scopeChefsSpecial($query)
    {
        return $query->where('is_chefs_special', 1);
    }

    /**
     * Scope to order by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('uploads/menu/' . $this->image) : null;
    }
}
