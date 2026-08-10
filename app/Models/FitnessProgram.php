<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitnessProgram extends Model
{
    use HasFactory;

    protected $table = 'fitness_programs';

    protected $fillable = [
        'customer_id',
        'company_id',
        'program_type',
        'program_name',
        'description',
        'trainer_id',
        'duration_weeks',
        'sessions_per_week',
        'session_duration_minutes',
        'max_participants',
        'price',
        'features',
        'suitable_for',
        'goals',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'suitable_for' => 'array',
        'goals' => 'array',
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

    public function trainer()
    {
        return $this->belongsTo(FitnessTrainer::class, 'trainer_id');
    }
}
