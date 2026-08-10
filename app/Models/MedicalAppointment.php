<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MedicalAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'medical_profile_id',
        'profile_type',
        'patient_name',
        'patient_mobile',
        'patient_email',
        'patient_age',
        'patient_gender',
        'service',
        'appointment_date',
        'appointment_time',
        'symptoms',
        'notes',
        'status',
        'payment_status',
        'consultation_fee',
        'payment_transaction_id',
        'reminder_sent',
        'reminder_sent_at',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime:H:i',
        'reminder_sent' => 'boolean',
        'reminder_sent_at' => 'datetime',
        'consultation_fee' => 'decimal:2',
    ];

    /**
     * Relationship: Belongs to Customer (doctor/hospital)
     */
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    /**
     * Relationship: Belongs to Medical Profile
     */
    public function medicalProfile()
    {
        return $this->belongsTo(MedicalProfile::class);
    }

    /**
     * Relationship: Has one payment
     */
    public function payment()
    {
        return $this->hasOne(MedicalPayment::class, 'appointment_id');
    }

    /**
     * Scope: Pending appointments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Confirmed appointments
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope: Today's appointments
     */
    public function scopeToday($query)
    {
        return $query->whereDate('appointment_date', Carbon::today());
    }

    /**
     * Scope: Upcoming appointments
     */
    public function scopeUpcoming($query)
    {
        return $query->where('appointment_date', '>=', Carbon::today())
                     ->whereIn('status', ['pending', 'confirmed'])
                     ->orderBy('appointment_date')
                     ->orderBy('appointment_time');
    }

    /**
     * Check if appointment is paid
     */
    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Check if appointment is confirmed
     */
    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    /**
     * Check if appointment is completed
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Check if appointment is cancelled
     */
    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    /**
     * Get formatted appointment date and time
     */
    public function getFormattedDateTime()
    {
        return $this->appointment_date->format('d M Y') . ' at ' . Carbon::parse($this->appointment_time)->format('h:i A');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass()
    {
        $classes = [
            'pending' => 'badge-warning',
            'confirmed' => 'badge-info',
            'completed' => 'badge-success',
            'cancelled' => 'badge-danger',
            'rescheduled' => 'badge-secondary',
        ];

        return $classes[$this->status] ?? 'badge-secondary';
    }

    /**
     * Get payment status badge class
     */
    public function getPaymentStatusBadgeClass()
    {
        $classes = [
            'unpaid' => 'badge-danger',
            'paid' => 'badge-success',
            'partial' => 'badge-warning',
        ];

        return $classes[$this->payment_status] ?? 'badge-secondary';
    }
}
