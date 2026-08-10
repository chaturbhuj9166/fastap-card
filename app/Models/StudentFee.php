<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;

    protected $table = 'student_fees';

    protected $fillable = [
        'customer_id',
        'company_id',
        'student_name',
        'student_mobile',
        'batch_id',
        'total_fee',
        'discount_amount',
        'amount_paid',
        'amount_due',
        'payment_history',
        'next_due_date',
    ];

    protected $casts = [
        'payment_history' => 'array',
        'next_due_date' => 'date',
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
