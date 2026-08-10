<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'profile_type',
        'is_active',
        'is_default',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    /**
     * Get the customer that owns the profile
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get properties for this profile type
     */
    public function properties()
    {
        return $this->hasMany(RealEstateProperty::class, 'customer_id', 'customer_id')
                    ->where('profile_type', $this->profile_type);
    }

    /**
     * Get active profiles for a customer
     */
    public static function getActiveProfiles($customerId)
    {
        return self::where('customer_id', $customerId)
                   ->where('is_active', true)
                   ->orderBy('display_order')
                   ->get();
    }

    /**
     * Get default profile for a customer
     */
    public static function getDefaultProfile($customerId)
    {
        return self::where('customer_id', $customerId)
                   ->where('is_default', true)
                   ->first();
    }

    /**
     * Get profile type label
     */
    public function getProfileTypeLabel()
    {
        $labels = [
            'residential' => 'Residential Property',
            'commercial' => 'Commercial Property',
            'plot' => 'Plot / Land',
            'rental' => 'Rental Property',
            'builder' => 'Builder / Project',
        ];

        return $labels[$this->profile_type] ?? $this->profile_type;
    }

    /**
     * Get profile type icon
     */
    public function getProfileTypeIcon()
    {
        $icons = [
            'residential' => '🏠',
            'commercial' => '🏬',
            'plot' => '🌳',
            'rental' => '🏘️',
            'builder' => '🏗️',
        ];

        return $icons[$this->profile_type] ?? '🏢';
    }

    /**
     * Set as default profile
     */
    public function setAsDefault()
    {
        // Remove default from other profiles
        self::where('customer_id', $this->customer_id)
            ->update(['is_default' => false]);

        // Set this as default
        $this->is_default = true;
        $this->save();
    }

    /**
     * Scope: Active profiles only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
