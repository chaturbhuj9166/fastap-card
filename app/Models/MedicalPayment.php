<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MedicalPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'appointment_id',
        'patient_name',
        'patient_mobile',
        'patient_email',
        'service_type',
        'amount',
        'discount',
        'final_amount',
        'payment_mode',
        'upi_transaction_id',
        'payment_gateway_transaction_id',
        'payment_screenshot',
        'status',
        'paid_at',
        'receipt_number',
        'receipt_url',
        'invoice_details',
        'gst_number',
        'gst_amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'invoice_details' => 'array',
    ];

    /**
     * Boot method to generate receipt number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (empty($payment->receipt_number)) {
                $payment->receipt_number = 'RCP-' . strtoupper(Str::random(10));
            }
        });
    }

    /**
     * Relationship: Belongs to Customer (doctor/hospital)
     */
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    /**
     * Relationship: Belongs to Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(MedicalAppointment::class, 'appointment_id');
    }

    /**
     * Scope: Completed payments only
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope: Pending payments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Check if payment is completed
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Check if payment is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payment is failed
     */
    public function isFailed()
    {
        return $this->status === 'failed';
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmount()
    {
        return '₹' . number_format($this->amount, 2);
    }

    /**
     * Get formatted final amount
     */
    public function getFormattedFinalAmount()
    {
        return '₹' . number_format($this->final_amount, 2);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass()
    {
        $classes = [
            'pending' => 'badge-warning',
            'completed' => 'badge-success',
            'failed' => 'badge-danger',
            'refunded' => 'badge-info',
        ];

        return $classes[$this->status] ?? 'badge-secondary';
    }

    /**
     * Generate receipt PDF
     */
    public function generateReceipt()
    {
        // This method can be extended to generate PDF receipt
        // For now, return receipt details as array
        return [
            'receipt_number' => $this->receipt_number,
            'date' => $this->paid_at ? $this->paid_at->format('d M Y, h:i A') : now()->format('d M Y, h:i A'),
            'patient_name' => $this->patient_name,
            'service_type' => $this->service_type,
            'amount' => $this->getFormattedAmount(),
            'discount' => '₹' . number_format($this->discount, 2),
            'final_amount' => $this->getFormattedFinalAmount(),
            'payment_mode' => ucfirst($this->payment_mode),
            'transaction_id' => $this->upi_transaction_id ?? $this->payment_gateway_transaction_id ?? 'N/A',
        ];
    }
}



