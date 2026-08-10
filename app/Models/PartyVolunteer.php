<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyVolunteer extends Model
{
    use HasFactory;

    protected $table = 'party_volunteers';

    protected $fillable = [
        'customer_id',
        'company_id',
        'volunteer_name',
        'volunteer_mobile',
        'volunteer_email',
        'role',
        'area',
        'joined_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'joined_date' => 'date',
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
