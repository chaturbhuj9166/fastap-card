<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteriorProject extends Model
{
    use HasFactory;

    protected $table = 'interior_projects';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'client_email',
        'project_type',
        'property_type',
        'area_sqft',
        'location',
        'budget_range',
        'requirements',
        'consultation_date',
        'site_visit_date',
        'design_approval_date',
        'start_date',
        'expected_completion_date',
        'project_status',
        'quoted_amount',
        'advance_paid',
        'design_files',
    ];

    protected $casts = [
        'requirements' => 'array',
        'consultation_date' => 'date',
        'site_visit_date' => 'date',
        'design_approval_date' => 'date',
        'start_date' => 'date',
        'expected_completion_date' => 'date',
        'design_files' => 'array',
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
