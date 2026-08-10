<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomServiceOrder extends Model
{
    use HasFactory;

    protected $table = 'room_service_orders';

    protected $fillable = [
        'customer_id',
        'company_id',
        'room_id',
        'guest_name',
        'service_type',
        'order_details',
        'priority',
        'status',
        'requested_time',
        'completed_time',
        'staff_assigned',
        'notes',
    ];

    protected $casts = [
        'order_details' => 'array',
        'requested_time' => 'datetime',
        'completed_time' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function room()
    {
        return $this->belongsTo(HotelRoom::class, 'room_id');
    }

    public function orderItems()
    {
        return $this->hasMany(RestaurantOrderItem::class, 'order_id')->where('order_type', 'room');
    }
}
