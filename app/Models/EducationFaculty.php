<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationFaculty extends Model
{
    use HasFactory;

    protected $table = 'education_faculty';

    protected $fillable = [
        'customer_id',
        'company_id',
        'faculty_name',
        'qualification',
        'specialization',
        'experience_years',
        'photo',
        'bio',
        'is_active',
    ];

    protected $casts = [
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
