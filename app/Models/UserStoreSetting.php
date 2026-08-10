<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStoreSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_enabled',
        'product_limit',
        'auto_approve',
        'commission_rate'
    ];

    protected $casts = [
        'store_enabled' => 'boolean',
        'auto_approve' => 'boolean',
        'commission_rate' => 'decimal:2'
    ];

    /**
     * Relationship: Setting belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(customer::class, 'user_id');
    }

    /**
     * Check if user can add more products
     */
    public function canAddProducts()
    {
        if (!$this->store_enabled) {
            return false;
        }

        $currentProductCount = Product::where('user_id', $this->user_id)->count();
        return $currentProductCount < $this->product_limit;
    }

    /**
     * Get remaining product slots
     */
    public function getRemainingSlots()
    {
        $currentProductCount = Product::where('user_id', $this->user_id)->count();
        return max(0, $this->product_limit - $currentProductCount);
    }
}
