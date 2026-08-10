<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstroClientData extends Model
{
    use HasFactory;

    protected $table = 'astro_client_data';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_mobile',
        'client_name',
        'birth_date',
        'birth_time',
        'birth_place',
        'kundli_data',
        'reports',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'kundli_data' => 'array',
        'reports' => 'array',
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
