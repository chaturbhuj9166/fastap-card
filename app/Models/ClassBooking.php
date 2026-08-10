<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassBooking extends Model
{
    use HasFactory;

    protected $table = 'class_bookings';

    protected $fillable = [
        'customer_id',
        'company_id',
        'class_id',
        'member_name',
        'member_mobile',
        'booking_date',
        'booking_status',
        'is_trial',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'is_trial' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function fitnessClass()
    {
        return $this->belongsTo(FitnessClass::class, 'class_id');
    }
}
