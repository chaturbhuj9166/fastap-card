<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechProject extends Model
{
    use HasFactory;

    protected $table = 'tech_projects';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_email',
        'client_mobile',
        'service_category',
        'services_required',
        'project_description',
        'budget_range',
        'timeline',
        'technology_preferences',
        'project_status',
        'quoted_amount',
        'contract_signed',
        'milestones',
    ];

    protected $casts = [
        'services_required' => 'array',
        'technology_preferences' => 'array',
        'milestones' => 'array',
        'contract_signed' => 'boolean',
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
