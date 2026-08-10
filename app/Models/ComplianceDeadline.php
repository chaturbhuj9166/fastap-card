<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplianceDeadline extends Model
{
    use HasFactory;

    protected $table = 'compliance_deadlines';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_mobile',
        'compliance_type',
        'financial_year',
        'due_date',
        'reminder_sent',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
        'reminder_sent' => 'boolean',
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
