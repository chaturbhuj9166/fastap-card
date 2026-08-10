<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarProject extends Model
{
    use HasFactory;

    protected $table = 'solar_projects';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'client_email',
        'system_type',
        'capacity_kw',
        'location',
        'quotation_amount',
        'subsidy_amount',
        'net_amount',
        'advance_paid',
        'project_status',
        'installation_start_date',
        'commissioning_date',
        'warranty_end_date',
        'documents',
        'notes',
    ];

    protected $casts = [
        'installation_start_date' => 'date',
        'commissioning_date' => 'date',
        'warranty_end_date' => 'date',
        'documents' => 'array',
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
