<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProgress extends Model
{
    use HasFactory;

    protected $table = 'member_progress';

    protected $fillable = [
        'customer_id',
        'company_id',
        'member_mobile',
        'assessment_date',
        'weight_kg',
        'height_cm',
        'bmi',
        'body_fat_percentage',
        'measurements',
        'progress_photos',
        'goals',
        'notes',
    ];

    protected $casts = [
        'assessment_date' => 'date',
        'measurements' => 'array',
        'progress_photos' => 'array',
        'goals' => 'array',
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
