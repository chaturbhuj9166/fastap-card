<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionTeam extends Model
{
    use HasFactory;

    protected $table = 'production_team';

    protected $fillable = [
        'customer_id',
        'company_id',
        'member_name',
        'role',
        'bio',
        'photo',
        'experience_years',
        'specialization',
        'portfolio_link',
        'display_order',
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
