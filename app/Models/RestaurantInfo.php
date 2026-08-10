<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantInfo extends Model
{
    use HasFactory;

    protected $table = 'restaurant_info';

    protected $fillable = [
        'customer_id',
        'company_id',
        'restaurant_type',
        'cuisine_type',
        'cuisine_types',
        'seating_capacity',
        'average_cost',
        'dress_code',
        'accepts_reservations',
        'reservation_link',
        'reservation_phone',
        'delivery_available',
        'takeaway_available',
        'dine_in_available',
        'reservation_available',
        'delivery_radius',
        'minimum_order',
        'delivery_fee',
        'delivery_time',
        'zomato_link',
        'swiggy_link',
        'ubereats_link',
        'operating_hours',
        'special_features',
        'ambiance_images',
        'payment_methods',
    ];

    protected $casts = [
        'operating_hours' => 'array',
        'special_features' => 'array',
        'ambiance_images' => 'array',
        'average_cost' => 'decimal:2',
        'minimum_order' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
    ];

    /**
     * Get the customer this info belongs to
     */
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    /**
     * Get the company this info belongs to
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get cuisines as array
     */
    public function getCuisinesArrayAttribute()
    {
        if ($this->cuisine_types) {
            return explode(',', $this->cuisine_types);
        }
        if ($this->cuisine_type) {
            return explode(',', $this->cuisine_type);
        }
        return [];
    }

    /**
     * Get payment methods as array
     */
    public function getPaymentMethodsArrayAttribute()
    {
        return $this->payment_methods ? explode(',', $this->payment_methods) : [];
    }

    /**
     * Get formatted average cost
     */
    public function getFormattedAverageCostAttribute()
    {
        return '₹' . number_format($this->average_cost, 0) . ' for two';
    }

    /**
     * Check if delivery is available (any platform)
     */
    public function hasDelivery()
    {
        return $this->delivery_available || $this->zomato_link || $this->swiggy_link || $this->ubereats_link;
    }

    /**
     * Get today's operating hours
     */
    public function getTodayHoursAttribute()
    {
        if (!$this->operating_hours) {
            return null;
        }

        $day = strtolower(date('l'));
        return $this->operating_hours[$day] ?? null;
    }

    /**
     * Check if currently open
     */
    public function isOpen()
    {
        $todayHours = $this->today_hours;
        if (!$todayHours || !isset($todayHours['open']) || !isset($todayHours['close'])) {
            return null; // Unknown
        }

        if ($todayHours['closed'] ?? false) {
            return false;
        }

        $now = date('H:i');
        return $now >= $todayHours['open'] && $now <= $todayHours['close'];
    }

    /**
     * Get all delivery platform links
     */
    public function getDeliveryPlatformsAttribute()
    {
        $platforms = [];

        if ($this->zomato_link) {
            $platforms['zomato'] = $this->zomato_link;
        }
        if ($this->swiggy_link) {
            $platforms['swiggy'] = $this->swiggy_link;
        }
        if ($this->ubereats_link) {
            $platforms['ubereats'] = $this->ubereats_link;
        }

        return $platforms;
    }

    /**
     * Get ambiance image URLs
     */
    public function getAmbianceImageUrlsAttribute()
    {
        if (!$this->ambiance_images) {
            return [];
        }

        return array_map(function ($image) {
            return asset('uploads/restaurant/' . $image);
        }, $this->ambiance_images);
    }
}
