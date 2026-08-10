<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorStat extends Model
{
    use HasFactory;

    protected $table = 'creator_stats';

    protected $fillable = [
        'customer_id',
        'company_id',
        'platform',
        'handle',
        'followers_count',
        'avg_reach',
        'avg_engagement_rate',
        'audience_demographics',
        'monthly_views',
        'last_updated',
    ];

    protected $casts = [
        'audience_demographics' => 'array',
        'last_updated' => 'date',
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
