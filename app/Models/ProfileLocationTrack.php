<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLocationTrack extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'profile_slug',
        'theme_id',
        'tap_source',
        'location_status',
        'latitude',
        'longitude',
        'accuracy_m',
        'ip_address',
        'user_agent',
        'referrer',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'accuracy_m' => 'integer',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }
}
