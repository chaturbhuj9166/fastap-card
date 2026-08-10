<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecuritySiteSurvey extends Model
{
    use HasFactory;

    protected $table = 'security_site_surveys';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'client_email',
        'property_type',
        'property_address',
        'area_sqft',
        'number_of_cameras_required',
        'storage_days_required',
        'survey_date',
        'survey_status',
        'site_images',
        'layout_file',
        'recommended_solution',
        'notes',
    ];

    protected $casts = [
        'survey_date' => 'date',
        'site_images' => 'array',
        'recommended_solution' => 'array',
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
