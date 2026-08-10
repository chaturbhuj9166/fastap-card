<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'category_id',
        'type',
        'price',
        'sale_price',
        'stock_quantity',
        'sku',
        'images',
        'status',
        'is_featured',
        'source',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'approved_at' => 'datetime'
    ];

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);

                // Ensure unique slug
                $count = 1;
                while (static::where('slug', $product->slug)->exists()) {
                    $product->slug = Str::slug($product->name) . '-' . $count;
                    $count++;
                }
            }

            // Auto-set source based on user_id
            if (empty($product->source)) {
                $product->source = $product->user_id ? 'user' : 'admin';
            }
        });
    }

    /**
     * Relationship: Product belongs to a user (seller)
     */
    public function user()
    {
        return $this->belongsTo(customer::class, 'user_id');
    }

    /**
     * Relationship: Product belongs to a category
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /**
     * Relationship: Product has many orders
     */
    public function orders()
    {
        return $this->hasMany(StoreOrder::class, 'product_id');
    }

    /**
     * Check if product is admin product
     */
    public function isAdminProduct()
    {
        return $this->user_id === null || $this->source === 'admin';
    }

    /**
     * Check if product is user product
     */
    public function isUserProduct()
    {
        return $this->user_id !== null && $this->source === 'user';
    }

    /**
     * Get product final price (sale price if available, otherwise regular price)
     */
    public function getFinalPrice()
    {
        return $this->sale_price ?? $this->price;
    }

    /**
     * Check if product is on sale
     */
    public function isOnSale()
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentage()
    {
        if (!$this->isOnSale()) {
            return 0;
        }

        return round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    /**
     * Scope: Active products only
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope: Admin products only
     */
    public function scopeAdminProducts($query)
    {
        return $query->whereNull('user_id')->orWhere('source', 'admin');
    }

    /**
     * Scope: User products only
     */
    public function scopeUserProducts($query)
    {
        return $query->whereNotNull('user_id')->where('source', 'user');
    }

    /**
     * Scope: Featured products
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
}
