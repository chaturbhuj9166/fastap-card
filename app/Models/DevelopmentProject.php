<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentProject extends Model
{
    use HasFactory;

    protected $table = 'development_projects';

    protected $fillable = [
        'customer_id',
        'company_id',
        'project_name',
        'project_category',
        'location',
        'budget_allocated',
        'start_date',
        'completion_date',
        'status',
        'description',
        'images',
        'beneficiaries_count',
        'is_featured',
    ];

    protected $casts = [
        'start_date' => 'date',
        'completion_date' => 'date',
        'images' => 'array',
        'is_featured' => 'boolean',
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
