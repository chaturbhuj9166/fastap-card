<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenOrderStatus extends Model
{
    use HasFactory;

    protected $table = 'kitchen_order_statuses';

    protected $fillable = [
        'customer_id',
        'company_id',
        'order_type',
        'order_id',
        'status',
        'assigned_to',
        'updated_by',
        'notes',
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
