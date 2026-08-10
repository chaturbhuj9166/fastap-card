<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechService extends Model
{
    use HasFactory;

    protected $table = 'tech_services';

    protected $fillable = [
        'customer_id',
        'company_id',
        'service_category',
        'service_name',
        'description',
        'pricing_model',
        'base_price',
        'features',
        'delivery_time',
        'technology_stack',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'technology_stack' => 'array',
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
