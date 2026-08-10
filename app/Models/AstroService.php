<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstroService extends Model
{
    use HasFactory;

    protected $table = 'astro_services';

    protected $fillable = [
        'customer_id',
        'company_id',
        'service_category',
        'service_name',
        'description',
        'consultation_duration_minutes',
        'consultation_fee',
        'is_online_available',
        'is_active',
    ];

    protected $casts = [
        'is_online_available' => 'boolean',
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
