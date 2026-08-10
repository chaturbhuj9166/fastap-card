<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionService extends Model
{
    use HasFactory;

    protected $table = 'production_services';

    protected $fillable = [
        'customer_id',
        'company_id',
        'category',
        'service_name',
        'description',
        'pricing_type',
        'base_price',
        'features',
        'sample_work',
        'turnaround_time',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'sample_work' => 'array',
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
