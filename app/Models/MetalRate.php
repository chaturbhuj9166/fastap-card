<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetalRate extends Model
{
    use HasFactory;

    protected $table = 'metal_rates';

    protected $fillable = [
        'customer_id',
        'company_id',
        'metal_type',
        'purity',
        'rate_per_gram',
        'rate_date',
        'city',
    ];

    protected $casts = [
        'rate_date' => 'date',
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
