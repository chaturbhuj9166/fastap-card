<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitnessClass extends Model
{
    use HasFactory;

    protected $table = 'fitness_classes';

    protected $fillable = [
        'customer_id',
        'company_id',
        'class_name',
        'class_type',
        'trainer_id',
        'schedule_day',
        'start_time',
        'end_time',
        'max_capacity',
        'is_online',
        'is_active',
    ];

    protected $casts = [
        'is_online' => 'boolean',
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

    public function bookings()
    {
        return $this->hasMany(ClassBooking::class, 'class_id');
    }
}
