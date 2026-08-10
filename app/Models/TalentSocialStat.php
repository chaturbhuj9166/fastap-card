<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentSocialStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'platform',
        'platform_url',
        'platform_username',
        'followers',
        'engagement_rate',
        'total_views',
        'total_posts',
        'is_verified',
        'last_updated'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'last_updated' => 'datetime',
    ];

    /**
     * Relationship: Belongs to customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Platform icons
     */
    public static $platformIcons = [
        'instagram' => 'fab fa-instagram',
        'youtube' => 'fab fa-youtube',
        'facebook' => 'fab fa-facebook',
        'tiktok' => 'fab fa-tiktok',
        'twitter' => 'fab fa-twitter',
        'linkedin' => 'fab fa-linkedin',
        'other' => 'fas fa-globe'
    ];

    /**
     * Platform colors
     */
    public static $platformColors = [
        'instagram' => '#E4405F',
        'youtube' => '#FF0000',
        'facebook' => '#1877F2',
        'tiktok' => '#000000',
        'twitter' => '#1DA1F2',
        'linkedin' => '#0A66C2',
        'other' => '#6c757d'
    ];

    /**
     * Get platform icon
     */
    public function getPlatformIconAttribute()
    {
        return self::$platformIcons[$this->platform] ?? 'fas fa-globe';
    }

    /**
     * Get platform color
     */
    public function getPlatformColorAttribute()
    {
        return self::$platformColors[$this->platform] ?? '#6c757d';
    }

    /**
     * Get formatted followers count
     */
    public function getFormattedFollowersAttribute()
    {
        $followers = $this->followers;

        if ($followers >= 1000000) {
            return number_format($followers / 1000000, 1) . 'M';
        } elseif ($followers >= 1000) {
            return number_format($followers / 1000, 1) . 'K';
        }
        return number_format($followers);
    }

    /**
     * Get formatted views count
     */
    public function getFormattedViewsAttribute()
    {
        $views = $this->total_views;

        if ($views >= 1000000) {
            return number_format($views / 1000000, 1) . 'M';
        } elseif ($views >= 1000) {
            return number_format($views / 1000, 1) . 'K';
        }
        return number_format($views);
    }

    /**
     * Scope: By platform
     */
    public function scopeByPlatform($query, $platform)
    {
        return $query->where('platform', $platform);
    }

    /**
     * Scope: Verified accounts
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Get total followers across all platforms
     */
    public static function getTotalFollowers($customerId)
    {
        return self::where('customer_id', $customerId)->sum('followers');
    }

    /**
     * Get total views across all platforms
     */
    public static function getTotalViews($customerId)
    {
        return self::where('customer_id', $customerId)->sum('total_views');
    }
}
