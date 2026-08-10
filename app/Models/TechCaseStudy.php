<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechCaseStudy extends Model
{
    use HasFactory;

    protected $table = 'tech_case_studies';

    protected $fillable = [
        'customer_id',
        'company_id',
        'title',
        'client_name',
        'industry',
        'summary',
        'results',
        'technology_stack',
        'metrics',
        'images',
        'project_url',
        'is_featured',
    ];

    protected $casts = [
        'technology_stack' => 'array',
        'metrics' => 'array',
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
