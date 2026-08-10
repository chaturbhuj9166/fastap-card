<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateSiteVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'customer_id',
        'visitor_name',
        'visitor_mobile',
        'visitor_email',
        'visit_date',
        'visit_time',
        'status',
        'notes',
        'visitor_message',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'visit_time' => 'datetime:H:i',
    ];

    /**
     * Get the property for this visit
     */
    public function property()
    {
        return $this->belongsTo(RealEstateProperty::class, 'property_id');
    }

    /**
     * Get the customer (property owner)
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'pending' => 'warning',
            'confirmed' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
        ];

        return $classes[$this->status] ?? 'secondary';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute()
    {
        return $this->visit_date ? $this->visit_date->format('d M, Y') : null;
    }

    /**
     * Get formatted time
     */
    public function getFormattedTimeAttribute()
    {
        return $this->visit_time ? date('h:i A', strtotime($this->visit_time)) : null;
    }

    /**
     * Scope: Pending visits
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Confirmed visits
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope: Upcoming visits
     */
    public function scopeUpcoming($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed'])
                     ->where('visit_date', '>=', now()->toDateString());
    }

    /**
     * Scope: Past visits
     */
    public function scopePast($query)
    {
        return $query->where('visit_date', '<', now()->toDateString());
    }
}
