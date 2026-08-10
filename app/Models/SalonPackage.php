<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonPackage extends Model
{
    use HasFactory;

    protected $table = 'salon_packages';

    protected $fillable = [
        'customer_id',
        'company_id',
        'package_name',
        'package_type',
        'services_included',
        'price',
        'discount_price',
        'validity_days',
        'features',
        'is_active',
    ];

    protected $casts = [
        'services_included' => 'array',
        'features' => 'array',
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
