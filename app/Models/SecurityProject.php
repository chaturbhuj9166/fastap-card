<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityProject extends Model
{
    use HasFactory;

    protected $table = 'security_projects';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'client_email',
        'project_type',
        'property_type',
        'location',
        'products',
        'installation_charges',
        'total_amount',
        'advance_paid',
        'project_status',
        'installation_date',
        'completion_date',
        'technician_assigned',
        'documents',
        'notes',
    ];

    protected $casts = [
        'products' => 'array',
        'documents' => 'array',
        'installation_date' => 'date',
        'completion_date' => 'date',
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
