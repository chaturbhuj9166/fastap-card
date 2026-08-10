<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicEvent extends Model
{
    use HasFactory;

    protected $table = 'public_events';

    protected $fillable = [
        'customer_id',
        'company_id',
        'event_title',
        'event_type',
        'event_date',
        'event_time',
        'location',
        'description',
        'contact_name',
        'contact_mobile',
        'expected_attendees',
        'status',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
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
