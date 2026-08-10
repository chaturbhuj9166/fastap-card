<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonAppointment extends Model
{
    use HasFactory;

    protected $table = 'salon_appointments';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'appointment_date',
        'appointment_time',
        'services',
        'artist_id',
        'location',
        'home_address',
        'total_amount',
        'advance_paid',
        'status',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'services' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function artist()
    {
        return $this->belongsTo(SalonArtist::class, 'artist_id');
    }
}
