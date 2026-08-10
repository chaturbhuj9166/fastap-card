<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityProduct extends Model
{
    use HasFactory;

    protected $table = 'security_products';

    protected $fillable = [
        'customer_id',
        'company_id',
        'product_category',
        'product_name',
        'brand',
        'model',
        'description',
        'specifications',
        'price',
        'images',
        'datasheet_url',
        'is_active',
    ];

    protected $casts = [
        'specifications' => 'array',
        'images' => 'array',
        'is_active' => 'boolean',
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
