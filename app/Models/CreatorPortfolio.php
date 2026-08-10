<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorPortfolio extends Model
{
    use HasFactory;

    protected $table = 'creator_portfolio';

    protected $fillable = [
        'customer_id',
        'company_id',
        'content_type',
        'title',
        'brand_name',
        'content_url',
        'thumbnail',
        'views_count',
        'engagement_rate',
        'description',
        'is_featured',
    ];

    protected $casts = [
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
