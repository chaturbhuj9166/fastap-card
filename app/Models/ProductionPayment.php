<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionPayment extends Model
{
    use HasFactory;

    protected $table = 'production_payments';

    protected $fillable = [
        'customer_id',
        'company_id',
        'project_id',
        'payment_stage',
        'amount',
        'payment_mode',
        'payment_status',
        'transaction_id',
        'paid_on',
        'notes',
    ];

    protected $casts = [
        'paid_on' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function project()
    {
        return $this->belongsTo(ProductionProject::class, 'project_id');
    }
}
