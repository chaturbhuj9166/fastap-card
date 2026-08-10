<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonProduct extends Model
{
    use HasFactory;

    protected $table = 'salon_products';

    protected $fillable = [
        'customer_id',
        'company_id',
        'product_name',
        'category',
        'price',
        'brand',
        'image',
        'description',
        'is_available',
    ];

    protected $casts = [
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
