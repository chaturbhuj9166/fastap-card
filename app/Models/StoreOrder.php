<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'buyer_id',
        'seller_id',
        'quantity',
        'amount',
        'commission',
        'seller_payout',
        'payment_status',
        'order_status',
        'transaction_id',
        'buyer_address',
        'buyer_phone'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'commission' => 'decimal:2',
        'seller_payout' => 'decimal:2'
    ];

    /**
     * Relationship: Order belongs to a product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Relationship: Order belongs to a buyer
     */
    public function buyer()
    {
        return $this->belongsTo(customer::class, 'buyer_id');
    }

    /**
     * Relationship: Order belongs to a seller
     */
    public function seller()
    {
        return $this->belongsTo(customer::class, 'seller_id');
    }

    /**
     * Calculate seller payout based on commission
     */
    public function calculatePayouts()
    {
        // Get user store settings to determine commission rate
        $storeSetting = UserStoreSetting::where('user_id', $this->seller_id)->first();

        if ($this->seller_id && $storeSetting) {
            $commissionRate = $storeSetting->commission_rate;
            $this->commission = ($this->amount * $commissionRate) / 100;
            $this->seller_payout = $this->amount - $this->commission;
        } else {
            // Admin product - no commission
            $this->commission = 0;
            $this->seller_payout = 0;
        }

        $this->save();
    }

    /**
     * Scope: Pending orders
     */
    public function scopePending($query)
    {
        return $query->where('order_status', 'pending');
    }

    /**
     * Scope: Paid orders
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }
}
