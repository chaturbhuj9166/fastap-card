<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionPortfolio extends Model
{
    use HasFactory;

    protected $table = 'production_portfolios';

    protected $fillable = [
        'customer_id',
        'company_id',
        'category',
        'project_title',
        'client_name',
        'project_type',
        'thumbnail_image',
        'video_url',
        'images',
        'description',
        'production_date',
        'is_featured',
        'view_count',
    ];

    protected $casts = [
        'images' => 'array',
        'production_date' => 'date',
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
