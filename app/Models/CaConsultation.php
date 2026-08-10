<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaConsultation extends Model
{
    use HasFactory;

    protected $table = 'ca_consultations';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'consultation_type',
        'service_category',
        'appointment_date',
        'appointment_time',
        'consultation_fee',
        'payment_status',
        'status',
        'meeting_link',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
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
