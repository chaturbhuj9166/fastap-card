<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    use HasFactory;

    protected $table = 'legal_cases';

    protected $fillable = [
        'customer_id',
        'company_id',
        'case_number',
        'case_type',
        'court_name',
        'client_name',
        'client_mobile',
        'client_email',
        'case_status',
        'filing_date',
        'next_hearing_date',
        'case_details',
        'documents',
        'notes',
    ];

    protected $casts = [
        'filing_date' => 'date',
        'next_hearing_date' => 'date',
        'case_details' => 'array',
        'documents' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function hearings()
    {
        return $this->hasMany(CaseHearing::class, 'case_id');
    }
}
