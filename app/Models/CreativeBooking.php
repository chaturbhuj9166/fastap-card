<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativeBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'package_id',
        'client_name',
        'client_mobile',
        'client_email',
        'service_type',
        'event_date',
        'event_time',
        'event_type',
        'guest_count',
        'budget',
        'venue',
        'special_requirements',
        'status',
        'payment_status',
        'payment_amount',
        'notes',
    ];

    protected $casts = [
        'event_date' => 'date',
        'budget' => 'decimal:2',
        'payment_amount' => 'decimal:2',
    ];

    /**
     * Get the customer that owns the booking
     */
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    /**
     * Get the package for this booking
     */
    public function package()
    {
        return $this->belongsTo(CreativePackage::class, 'package_id');
    }

    /**
     * Scope for pending bookings
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for confirmed bookings
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope for completed bookings
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for upcoming bookings
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->toDateString())
                    ->orderBy('event_date', 'asc');
    }

    /**
     * Get formatted event date
     */
    public function getFormattedEventDateAttribute()
    {
        return $this->event_date ? $this->event_date->format('d M Y') : null;
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'confirmed' => '<span class="badge bg-success">Confirmed</span>',
            'completed' => '<span class="badge bg-info">Completed</span>',
            'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }
}
