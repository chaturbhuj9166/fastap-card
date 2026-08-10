<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JewelleryProduct extends Model
{
    use HasFactory;

    protected $table = 'jewellery_products';

    protected $fillable = [
        'customer_id',
        'company_id',
        'category',
        'product_name',
        'product_code',
        'description',
        'metal_type',
        'metal_purity',
        'weight_grams',
        'stone_details',
        'making_charges',
        'price',
        'images',
        'video_url',
        'is_bestseller',
        'is_trending',
        'is_available',
        'stock_quantity',
        'certifications',
    ];

    protected $casts = [
        'stone_details' => 'array',
        'images' => 'array',
        'certifications' => 'array',
        'is_bestseller' => 'boolean',
        'is_trending' => 'boolean',
        'is_available' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
