<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstroConsultation extends Model
{
    use HasFactory;

    protected $table = 'astro_consultations';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'consultation_mode',
        'service_id',
        'appointment_date',
        'appointment_time',
        'birth_details',
        'property_details',
        'consultation_fee',
        'payment_status',
        'status',
        'meeting_link',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'birth_details' => 'array',
        'property_details' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function service()
    {
        return $this->belongsTo(AstroService::class, 'service_id');
    }
}
