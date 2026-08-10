<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourBooking extends Model
{
    use HasFactory;

    protected $table = 'tour_bookings';

    protected $fillable = [
        'customer_id',
        'company_id',
        'package_id',
        'client_name',
        'client_mobile',
        'client_email',
        'travel_date',
        'return_date',
        'adults',
        'children',
        'room_preference',
        'special_requirements',
        'visa_assistance_needed',
        'insurance_needed',
        'total_amount',
        'advance_paid',
        'booking_status',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'return_date' => 'date',
        'visa_assistance_needed' => 'boolean',
        'insurance_needed' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function package()
    {
        return $this->belongsTo(TourPackage::class, 'package_id');
    }
}
