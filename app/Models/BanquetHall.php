<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanquetHall extends Model
{
    use HasFactory;

    protected $table = 'banquet_halls';

    protected $fillable = [
        'customer_id',
        'company_id',
        'hall_name',
        'capacity_min',
        'capacity_max',
        'hall_type',
        'size_sqft',
        'amenities',
        'images',
        'price_per_plate',
        'price_per_day',
        'availability_calendar',
        'is_active',
    ];

    protected $casts = [
        'amenities' => 'array',
        'images' => 'array',
        'availability_calendar' => 'array',
        'price_per_plate' => 'decimal:2',
        'price_per_day' => 'decimal:2',
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
