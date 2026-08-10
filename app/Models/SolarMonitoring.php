<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarMonitoring extends Model
{
    use HasFactory;

    protected $table = 'solar_monitoring';

    protected $fillable = [
        'customer_id',
        'company_id',
        'project_id',
        'client_mobile',
        'monitoring_platform',
        'daily_generation_kwh',
        'monthly_generation_kwh',
        'performance_ratio',
        'system_uptime_percentage',
        'alerts',
        'last_updated',
    ];

    protected $casts = [
        'alerts' => 'array',
        'last_updated' => 'date',
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
