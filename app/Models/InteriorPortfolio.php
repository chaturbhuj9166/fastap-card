<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteriorPortfolio extends Model
{
    use HasFactory;

    protected $table = 'interior_portfolio';

    protected $fillable = [
        'customer_id',
        'company_id',
        'project_title',
        'project_category',
        'room_type',
        'style',
        'area_sqft',
        'before_images',
        'after_images',
        'design_render_images',
        'video_url',
        'project_description',
        'is_featured',
    ];

    protected $casts = [
        'before_images' => 'array',
        'after_images' => 'array',
        'design_render_images' => 'array',
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
