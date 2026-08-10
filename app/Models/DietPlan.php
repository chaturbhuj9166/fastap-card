<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    use HasFactory;

    protected $table = 'diet_plans';

    protected $fillable = [
        'customer_id',
        'company_id',
        'plan_name',
        'goal',
        'diet_type',
        'daily_calories',
        'meal_plan',
        'instructions',
        'is_active',
    ];

    protected $casts = [
        'meal_plan' => 'array',
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
