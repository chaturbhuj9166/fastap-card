<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'talent_type',
        'custom_talent_name',
        'is_active',
        'is_default',
        'display_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    // Talent type labels
    public static $talentTypes = [
        'actor' => 'Actor',
        'model' => 'Model',
        'singer' => 'Singer',
        'dancer' => 'Dancer / Performer',
        'youtuber' => 'YouTuber / Content Creator',
        'music_producer' => 'Music Producer',
        'anchor' => 'Anchor / Host',
        'influencer' => 'Influencer',
        'custom' => 'Custom Talent'
    ];

    // Talent type icons
    public static $talentIcons = [
        'actor' => '🎬',
        'model' => '📸',
        'singer' => '🎤',
        'dancer' => '💃',
        'youtuber' => '📹',
        'music_producer' => '🎧',
        'anchor' => '🎙️',
        'influencer' => '📱',
        'custom' => '⭐'
    ];

    /**
     * Relationship: Belongs to customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relationship: Has many portfolio items
     */
    public function portfolioItems()
    {
        return $this->hasMany(TalentPortfolio::class, 'customer_id', 'customer_id')
                    ->where('talent_type', $this->talent_type);
    }

    /**
     * Relationship: Has many bookings
     */
    public function bookings()
    {
        return $this->hasMany(TalentBooking::class, 'customer_id', 'customer_id')
                    ->where('talent_type', $this->talent_type);
    }

    /**
     * Get talent type label
     */
    public function getTalentLabelAttribute()
    {
        if ($this->talent_type === 'custom' && $this->custom_talent_name) {
            return $this->custom_talent_name;
        }
        return self::$talentTypes[$this->talent_type] ?? 'Unknown';
    }

    /**
     * Get talent icon
     */
    public function getTalentIconAttribute()
    {
        return self::$talentIcons[$this->talent_type] ?? '⭐';
    }

    /**
     * Scope: Active profiles only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Ordered by display order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc');
    }

    /**
     * Set a profile as default
     */
    public function setAsDefault()
    {
        // Remove default from other profiles
        self::where('customer_id', $this->customer_id)->update(['is_default' => false]);
        // Set this as default
        $this->update(['is_default' => true]);
    }

    /**
     * Get active profiles for a customer
     */
    public static function getActiveProfilesForCustomer($customerId)
    {
        return self::where('customer_id', $customerId)
                   ->active()
                   ->ordered()
                   ->get();
    }

    /**
     * Get default profile for a customer
     */
    public static function getDefaultProfile($customerId)
    {
        return self::where('customer_id', $customerId)
                   ->where('is_default', true)
                   ->active()
                   ->first();
    }
}
