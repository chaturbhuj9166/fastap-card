<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarSiteSurvey extends Model
{
    use HasFactory;

    protected $table = 'solar_site_surveys';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'client_email',
        'property_type',
        'property_address',
        'roof_area_sqft',
        'monthly_power_consumption_units',
        'current_electricity_bill',
        'google_map_location',
        'roof_images',
        'shadow_analysis_file',
        'survey_date',
        'survey_status',
        'recommended_capacity_kw',
        'estimated_generation_monthly',
        'estimated_savings_yearly',
        'notes',
    ];

    protected $casts = [
        'roof_images' => 'array',
        'survey_date' => 'date',
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
