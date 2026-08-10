<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;

    protected $table = 'hotel_rooms';

    protected $fillable = [
        'customer_id',
        'company_id',
        'profile_id',
        'room_number',
        'room_type',
        'floor',
        'qr_code_path',
        'status',
        'max_occupancy',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function profile()
    {
        return $this->belongsTo(RestaurantProfile::class, 'profile_id');
    }

    public function orders()
    {
        return $this->hasMany(RoomServiceOrder::class, 'room_id');
    }
}
