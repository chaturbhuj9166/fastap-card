<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationCourse extends Model
{
    use HasFactory;

    protected $table = 'education_courses';

    protected $fillable = [
        'customer_id',
        'company_id',
        'course_name',
        'course_category',
        'board_exam',
        'class_standard',
        'subjects',
        'batch_type',
        'mode',
        'duration_months',
        'fee_structure',
        'description',
        'is_active',
    ];

    protected $casts = [
        'subjects' => 'array',
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
