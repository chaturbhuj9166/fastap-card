<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;

    protected $table = 'tour_packages';

    protected $fillable = [
        'customer_id',
        'company_id',
        'package_name',
        'package_type',
        'destination',
        'duration_days',
        'itinerary',
        'inclusions',
        'exclusions',
        'price_per_person',
        'group_discount',
        'images',
        'video_url',
        'best_time_to_visit',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'itinerary' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
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

    public function bookings()
    {
        return $this->hasMany(TourBooking::class, 'package_id');
    }
}
