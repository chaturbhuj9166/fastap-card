<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationResult extends Model
{
    use HasFactory;

    protected $table = 'education_results';

    protected $fillable = [
        'customer_id',
        'company_id',
        'exam_year',
        'exam_type',
        'total_students',
        'pass_percentage',
        'toppers',
        'achievements',
    ];

    protected $casts = [
        'toppers' => 'array',
        'achievements' => 'array',
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
