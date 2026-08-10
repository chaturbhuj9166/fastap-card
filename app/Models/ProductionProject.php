<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionProject extends Model
{
    use HasFactory;

    protected $table = 'production_projects';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'client_email',
        'service_category',
        'service_ids',
        'project_type',
        'shoot_date',
        'shoot_duration',
        'location',
        'budget_range',
        'requirements',
        'reference_files',
        'quoted_amount',
        'advance_paid',
        'project_status',
        'delivery_date',
        'final_deliverables',
        'notes',
    ];

    protected $casts = [
        'service_ids' => 'array',
        'requirements' => 'array',
        'reference_files' => 'array',
        'final_deliverables' => 'array',
        'shoot_date' => 'date',
        'delivery_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function payments()
    {
        return $this->hasMany(ProductionPayment::class, 'project_id');
    }
}
