<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $table = 'menu_categories';

    protected $fillable = [
        'customer_id',
        'company_id',
        'name',
        'description',
        'icon',
        'image',
        'sort_order',
        'status',
    ];

    /**
     * Get the customer this category belongs to
     */
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    /**
     * Get the company this category belongs to
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get all menu items in this category
     */
    public function items()
    {
        return $this->hasMany(MenuItem::class, 'category_id');
    }

    /**
     * Get active menu items in this category
     */
    public function activeItems()
    {
        return $this->hasMany(MenuItem::class, 'category_id')->where('status', 1)->where('is_available', 1);
    }

    /**
     * Get items count
     */
    public function getItemsCountAttribute()
    {
        return $this->items()->count();
    }

    /**
     * Scope to get only active categories
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
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
