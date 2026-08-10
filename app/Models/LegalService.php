<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalService extends Model
{
    use HasFactory;

    protected $table = 'legal_services';

    protected $fillable = [
        'customer_id',
        'company_id',
        'practice_area',
        'description',
        'consultation_fee',
        'court_fee_range',
        'success_rate_percentage',
        'experience_years_in_area',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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
