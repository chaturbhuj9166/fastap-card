<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonPortfolio extends Model
{
    use HasFactory;

    protected $table = 'salon_portfolio';

    protected $fillable = [
        'customer_id',
        'company_id',
        'category',
        'title',
        'before_image',
        'after_image',
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
