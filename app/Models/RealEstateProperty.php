<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RealEstateProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'profile_type',
        'title',
        'slug',
        'description',
        'property_type',
        'price',
        'rental_price',
        'deposit_amount',
        'area_sqft',
        'location',
        'contact_number',
        'address',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'parking',
        'status',
        'rera_number',
        'images',
        'features',
        'is_featured',
        'is_active',
        'furnishing',
        'available_from',
        'lease_duration',
        'maintenance_charges',
        'floor_number',
        'total_floors',
        'year_built',
    ];

    protected $casts = [
        'images' => 'array',
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'rental_price' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'area_sqft' => 'decimal:2',
        'maintenance_charges' => 'decimal:2',
        'available_from' => 'date',
    ];

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title);

                // Ensure uniqueness
                $count = 1;
                while (self::where('slug', $property->slug)->exists()) {
                    $property->slug = Str::slug($property->title) . '-' . $count;
                    $count++;
                }
            }
        });
    }

    /**
     * Get the customer that owns the property
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get site visits for this property
     */
    public function siteVisits()
    {
        return $this->hasMany(RealEstateSiteVisit::class, 'property_id');
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        if ($this->price >= 10000000) {
            return '₹' . number_format($this->price / 10000000, 2) . ' Cr';
        } elseif ($this->price >= 100000) {
            return '₹' . number_format($this->price / 100000, 2) . ' Lakhs';
        }
        return '₹' . number_format($this->price, 0);
    }

    /**
     * Get formatted rental price
     */
    public function getFormattedRentalPriceAttribute()
    {
        return $this->rental_price ? '₹' . number_format($this->rental_price, 0) . '/month' : null;
    }

    /**
     * Get first image
     */
    public function getFirstImageAttribute()
    {
        $images = $this->images ?? [];
        return !empty($images) ? $images[0] : null;
    }

    /**
     * Get property type label
     */
    public function getPropertyTypeLabelAttribute()
    {
        $labels = [
            'flat' => 'Flat',
            'villa' => 'Villa',
            'house' => 'House',
            'shop' => 'Shop',
            'office' => 'Office Space',
            'showroom' => 'Showroom',
            'plot' => 'Plot',
            'land' => 'Land',
            'warehouse' => 'Warehouse',
            'apartment' => 'Apartment',
        ];

        return $labels[$this->property_type] ?? $this->property_type;
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'ready' => 'success',
            'under_construction' => 'warning',
            'upcoming' => 'info',
        ];

        return $classes[$this->status] ?? 'secondary';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'ready' => 'Ready to Move',
            'under_construction' => 'Under Construction',
            'upcoming' => 'Upcoming',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Scope: Active properties
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Featured properties
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: By profile type
     */
    public function scopeByProfileType($query, $type)
    {
        return $query->where('profile_type', $type);
    }

    /**
     * Scope: By property type
     */
    public function scopeByPropertyType($query, $type)
    {
        return $query->where('property_type', $type);
    }

    /**
     * Scope: Price range
     */
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
}
