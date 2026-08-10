<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonService extends Model
{
    use HasFactory;

    protected $table = 'salon_services';

    protected $fillable = [
        'customer_id',
        'company_id',
        'service_category',
        'service_name',
        'description',
        'duration_minutes',
        'price',
        'images',
        'is_available',
    ];

    protected $casts = [
        'images' => 'array',
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
