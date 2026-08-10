<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionApplication extends Model
{
    use HasFactory;

    protected $table = 'admission_applications';

    protected $fillable = [
        'customer_id',
        'company_id',
        'student_name',
        'parent_name',
        'mobile',
        'email',
        'course_id',
        'class_standard',
        'documents',
        'entrance_test_date',
        'entrance_test_score',
        'admission_status',
        'seat_allocated',
        'notes',
    ];

    protected $casts = [
        'documents' => 'array',
        'entrance_test_date' => 'date',
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
