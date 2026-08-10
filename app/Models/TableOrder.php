<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOrder extends Model
{
    use HasFactory;

    protected $table = 'table_orders';

    protected $fillable = [
        'customer_id',
        'company_id',
        'table_id',
        'order_number',
        'items',
        'total_amount',
        'order_status',
        'order_time',
        'served_time',
        'payment_status',
        'payment_mode',
        'notes',
    ];

    protected $casts = [
        'items' => 'array',
        'total_amount' => 'decimal:2',
        'order_time' => 'datetime',
        'served_time' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'table_id');
    }

    public function orderItems()
    {
        return $this->hasMany(RestaurantOrderItem::class, 'order_id')->where('order_type', 'table');
    }
}
