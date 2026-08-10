<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonArtist extends Model
{
    use HasFactory;

    protected $table = 'salon_artists';

    protected $fillable = [
        'customer_id',
        'company_id',
        'artist_name',
        'specialization',
        'photo',
        'experience_years',
        'certifications',
        'is_available',
    ];

    protected $casts = [
        'specialization' => 'array',
        'is_available' => 'boolean',
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
