<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'talent_type',
        'client_name',
        'client_email',
        'client_mobile',
        'client_company',
        'event_type',
        'event_description',
        'event_date',
        'event_location',
        'duration_days',
        'budget',
        'requirements',
        'notes',
        'status',
        'payment_status'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Relationship: Belongs to customer (talent)
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'confirmed' => '<span class="badge bg-info">Confirmed</span>',
            'in_progress' => '<span class="badge bg-primary">In Progress</span>',
            'completed' => '<span class="badge bg-success">Completed</span>',
            'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
        ];
        return $badges[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    /**
     * Get payment status badge HTML
     */
    public function getPaymentBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'partial' => '<span class="badge bg-info">Partial</span>',
            'paid' => '<span class="badge bg-success">Paid</span>',
            'refunded' => '<span class="badge bg-danger">Refunded</span>',
        ];
        return $badges[$this->payment_status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    /**
     * Get formatted budget
     */
    public function getFormattedBudgetAttribute()
    {
        if (!$this->budget) {
            return 'Not specified';
        }
        return '₹' . number_format($this->budget, 2);
    }

    /**
     * Get formatted event date
     */
    public function getFormattedEventDateAttribute()
    {
        if (!$this->event_date) {
            return 'Not specified';
        }
        return $this->event_date->format('d M, Y');
    }

    /**
     * Scope: Pending bookings
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Confirmed bookings
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope: Completed bookings
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope: By talent type
     */
    public function scopeByTalent($query, $talentType)
    {
        return $query->where('talent_type', $talentType);
    }

    /**
     * Scope: Recent first
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
