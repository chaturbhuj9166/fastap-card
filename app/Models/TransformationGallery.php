<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformationGallery extends Model
{
    use HasFactory;

    protected $table = 'transformation_gallery';

    protected $fillable = [
        'customer_id',
        'company_id',
        'member_name',
        'before_photo',
        'after_photo',
        'duration_months',
        'program_type',
        'weight_lost_kg',
        'testimonial',
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
