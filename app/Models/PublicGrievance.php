<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicGrievance extends Model
{
    use HasFactory;

    protected $table = 'public_grievances';

    protected $fillable = [
        'customer_id',
        'company_id',
        'complainant_name',
        'complainant_mobile',
        'complainant_email',
        'issue_category',
        'issue_description',
        'location',
        'images',
        'priority',
        'status',
        'ticket_number',
        'assigned_to',
        'resolution_notes',
        'resolved_date',
    ];

    protected $casts = [
        'images' => 'array',
        'resolved_date' => 'date',
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
