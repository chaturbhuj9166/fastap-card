<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaService extends Model
{
    use HasFactory;

    protected $table = 'ca_services';

    protected $fillable = [
        'customer_id',
        'company_id',
        'service_category',
        'service_name',
        'description',
        'pricing_type',
        'base_price',
        'turnaround_time_days',
        'required_documents',
        'is_active',
    ];

    protected $casts = [
        'required_documents' => 'array',
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
