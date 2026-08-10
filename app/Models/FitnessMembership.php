<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitnessMembership extends Model
{
    use HasFactory;

    protected $table = 'fitness_memberships';

    protected $fillable = [
        'customer_id',
        'company_id',
        'plan_name',
        'duration_months',
        'session_type',
        'price',
        'features',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
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

    public function subscriptions()
    {
        return $this->hasMany(MemberSubscription::class, 'membership_id');
    }
}
