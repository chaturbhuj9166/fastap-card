<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'type',
        'name',
        'price',
        'duration',
        'deliverables',
        'features',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Get the customer that owns the package
     */
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    /**
     * Get bookings for this package
     */
    public function bookings()
    {
        return $this->hasMany(CreativeBooking::class, 'package_id');
    }

    /**
     * Scope for active packages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for photography packages
     */
    public function scopePhotography($query)
    {
        return $query->where('type', 'photography');
    }

    /**
     * Scope for event packages
     */
    public function scopeEvent($query)
    {
        return $query->where('type', 'event');
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return $this->price ? '₹' . number_format($this->price, 0) : 'Contact for price';
    }

    /**
     * Get features as array
     */
    public function getFeaturesListAttribute()
    {
        return is_array($this->features) ? $this->features : [];
    }
}
