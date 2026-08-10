<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticalProfile extends Model
{
    use HasFactory;

    protected $table = 'political_profiles';

    protected $fillable = [
        'customer_id',
        'company_id',
        'party_name',
        'constituency',
        'role_title',
        'biography',
        'manifesto',
        'office_address',
        'office_hours',
        'focus_areas',
        'achievements',
        'is_active',
    ];

    protected $casts = [
        'focus_areas' => 'array',
        'achievements' => 'array',
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
