<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JewelleryCustomOrder extends Model
{
    use HasFactory;

    protected $table = 'jewellery_custom_orders';

    protected $fillable = [
        'customer_id',
        'company_id',
        'client_name',
        'client_mobile',
        'client_email',
        'order_type',
        'category',
        'reference_images',
        'budget_range',
        'metal_preference',
        'stone_preference',
        'timeline_required',
        'special_requirements',
        'quoted_amount',
        'advance_paid',
        'order_status',
        'design_files',
        'progress_updates',
        'appointment_date',
        'appointment_time',
    ];

    protected $casts = [
        'reference_images' => 'array',
        'design_files' => 'array',
        'progress_updates' => 'array',
        'appointment_date' => 'date',
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
