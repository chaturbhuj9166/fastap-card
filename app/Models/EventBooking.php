<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    use HasFactory;

    protected $table = 'event_bookings';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'client_email',
        'event_type',
        'event_date',
        'time_slot',
        'guest_count',
        'venue_area',
        'food_preference',
        'decoration_theme',
        'entertainment',
        'photography_package',
        'catering_menu',
        'total_amount',
        'advance_paid',
        'balance_amount',
        'booking_status',
        'special_requirements',
    ];

    protected $casts = [
        'event_date' => 'date',
        'entertainment' => 'array',
        'catering_menu' => 'array',
        'total_amount' => 'decimal:2',
        'advance_paid' => 'decimal:2',
        'balance_amount' => 'decimal:2',
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
