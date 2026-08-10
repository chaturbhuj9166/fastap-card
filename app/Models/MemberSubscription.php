<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberSubscription extends Model
{
    use HasFactory;

    protected $table = 'member_subscriptions';

    protected $fillable = [
        'customer_id',
        'company_id',
        'member_name',
        'member_mobile',
        'member_email',
        'membership_id',
        'start_date',
        'end_date',
        'status',
        'payment_status',
        'auto_renewal',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'auto_renewal' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function membership()
    {
        return $this->belongsTo(FitnessMembership::class, 'membership_id');
    }
}
