<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsidyApplication extends Model
{
    use HasFactory;

    protected $table = 'subsidy_applications';

    protected $fillable = [
        'customer_id',
        'company_id',
        'project_id',
        'client_name',
        'scheme_name',
        'system_capacity_kw',
        'subsidy_amount',
        'application_date',
        'application_number',
        'status',
        'documents',
    ];

    protected $casts = [
        'application_date' => 'date',
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
