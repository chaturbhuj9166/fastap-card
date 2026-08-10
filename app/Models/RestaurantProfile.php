<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantProfile extends Model
{
    use HasFactory;

    protected $table = 'restaurant_profiles';

    protected $fillable = [
        'customer_id',
        'company_id',
        'profile_type',
        'profile_name',
        'is_active',
        'is_default',
        'display_order',
        'profile_settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'profile_settings' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function tables()
    {
        return $this->hasMany(RestaurantTable::class, 'profile_id');
    }

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class, 'profile_id');
    }
}
