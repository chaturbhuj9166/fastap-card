<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityAmc extends Model
{
    use HasFactory;

    protected $table = 'security_amc';

    protected $fillable = [
        'customer_id',
        'company_id',
        'project_id',
        'amc_type',
        'amc_start_date',
        'amc_end_date',
        'visit_frequency',
        'amc_amount',
        'services_included',
        'next_visit_date',
        'visit_history',
    ];

    protected $casts = [
        'amc_start_date' => 'date',
        'amc_end_date' => 'date',
        'next_visit_date' => 'date',
        'services_included' => 'array',
        'visit_history' => 'array',
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
