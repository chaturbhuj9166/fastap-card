<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicService extends Model
{
    use HasFactory;

    protected $table = 'public_services';

    protected $fillable = [
        'customer_id',
        'company_id',
        'service_name',
        'service_category',
        'description',
        'eligibility',
        'required_documents',
        'contact_details',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'required_documents' => 'array',
        'is_active' => 'boolean',
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
