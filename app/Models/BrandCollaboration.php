<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCollaboration extends Model
{
    use HasFactory;

    protected $table = 'brand_collaborations';

    protected $fillable = [
        'customer_id',
        'company_id',
        'brand_name',
        'brand_email',
        'brand_mobile',
        'collaboration_type',
        'platform',
        'deliverables',
        'budget',
        'campaign_brief',
        'campaign_start_date',
        'campaign_end_date',
        'status',
        'contract_signed',
        'payment_status',
    ];

    protected $casts = [
        'deliverables' => 'array',
        'campaign_start_date' => 'date',
        'campaign_end_date' => 'date',
        'contract_signed' => 'boolean',
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
