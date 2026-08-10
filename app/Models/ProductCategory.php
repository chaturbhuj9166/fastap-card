<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
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

                // Ensure unique slug
                $count = 1;
                while (static::where('slug', $category->slug)->exists()) {
                    $category->slug = Str::slug($category->name) . '-' . $count;
                    $count++;
                }
            }
        });
    }

    /**
     * Relationship: Category can have many products
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * Relationship: Category can have a parent category
     */
    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    /**
     * Relationship: Category can have many child categories
     */
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    /**
     * Scope: Active categories only
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope: Parent categories only (no parent_id)
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
}
