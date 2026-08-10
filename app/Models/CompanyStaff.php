<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyStaff extends Model
{
    use HasFactory;

    protected $table = 'company_staff';

    protected $fillable = [
        'company_id',
        'customer_id',
        'employee_id',
        'name',
        'email',
        'phone',
        'designation',
        'department',
        'profile_image',
        'role',
        'card_enabled',
        'card_expiry',
        'visibility_settings',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'visibility_settings' => 'array',
        'card_expiry' => 'date',
    ];

    /**
     * Get the company this staff belongs to
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get the customer record linked to this staff
     */
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    /**
     * Check if the card is active and enabled
     */
    public function isCardActive()
    {
        if (!$this->card_enabled || !$this->status) {
            return false;
        }

        if ($this->card_expiry && $this->card_expiry->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Scope to get only active staff
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1)->where('card_enabled', 1);
    }

    /**
     * Scope to order by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the profile image URL
     */
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image
            ? asset('uploads/staff/' . $this->profile_image)
            : asset('images/default-avatar.png');
    }

    /**
     * Check if a specific section is visible
     */
    public function isSectionVisible($section)
    {
        if (!$this->visibility_settings) {
            return true; // Default: all visible
        }

        return $this->visibility_settings[$section] ?? true;
    }
}
