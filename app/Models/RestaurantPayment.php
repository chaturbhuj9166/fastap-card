<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantPayment extends Model
{
    use HasFactory;

    protected $table = 'restaurant_payments';

    protected $fillable = [
        'customer_id',
        'company_id',
        'order_id',
        'order_type',
        'payment_mode',
        'amount',
        'tax_amount',
        'tip_amount',
        'total_amount',
        'payment_status',
        'transaction_id',
        'receipt_number',
        'invoice_path',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'tip_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
