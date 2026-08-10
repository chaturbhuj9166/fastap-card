<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationBatch extends Model
{
    use HasFactory;

    protected $table = 'education_batches';

    protected $fillable = [
        'customer_id',
        'company_id',
        'course_id',
        'batch_name',
        'start_date',
        'end_date',
        'faculty_id',
        'max_students',
        'enrolled_students',
        'class_schedule',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'class_schedule' => 'array',
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
