<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarSolution extends Model
{
    use HasFactory;

    protected $table = 'solar_solutions';

    protected $fillable = [
        'customer_id',
        'company_id',
        'solution_type',
        'system_capacity_kw',
        'solution_name',
        'description',
        'components',
        'price_per_kw',
        'total_price',
        'features',
        'warranty_years',
        'is_active',
    ];

    protected $casts = [
        'components' => 'array',
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
