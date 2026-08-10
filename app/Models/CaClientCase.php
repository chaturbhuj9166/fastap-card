<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaClientCase extends Model
{
    use HasFactory;

    protected $table = 'ca_client_cases';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'client_email',
        'pan_number',
        'gstin',
        'service_id',
        'financial_year',
        'case_status',
        'documents_uploaded',
        'filed_returns',
        'due_date',
        'filing_date',
        'case_notes',
    ];

    protected $casts = [
        'documents_uploaded' => 'array',
        'filed_returns' => 'array',
        'due_date' => 'date',
        'filing_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function service()
    {
        return $this->belongsTo(CaService::class, 'service_id');
    }
}
