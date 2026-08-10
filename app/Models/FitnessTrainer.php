<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitnessTrainer extends Model
{
    use HasFactory;

    protected $table = 'fitness_trainers';

    protected $fillable = [
        'customer_id',
        'company_id',
        'trainer_name',
        'specialization',
        'certifications',
        'experience_years',
        'photo',
        'bio',
        'languages',
        'is_active',
    ];

    protected $casts = [
        'specialization' => 'array',
        'certifications' => 'array',
        'languages' => 'array',
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

    public function programs()
    {
        return $this->hasMany(FitnessProgram::class, 'trainer_id');
    }

    public function classes()
    {
        return $this->hasMany(FitnessClass::class, 'trainer_id');
    }
}
