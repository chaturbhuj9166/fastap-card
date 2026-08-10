<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'medical_profile_id',
        'profile_type',
        'reviewer_name',
        'reviewer_email',
        'reviewer_mobile',
        'rating',
        'review_text',
        'visit_date',
        'treatment_type',
        'status',
        'approved_at',
        'is_featured',
        'google_review_url',
        'is_google_review',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'approved_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_google_review' => 'boolean',
    ];

    /**
     * Relationship: Belongs to Customer (doctor/hospital)
     */
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    /**
     * Relationship: Belongs to Medical Profile
     */
    public function medicalProfile()
    {
        return $this->belongsTo(MedicalProfile::class);
    }

    /**
     * Scope: Approved reviews only
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope: Pending reviews
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Featured reviews
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('status', 'approved');
    }

    /**
     * Scope: Filter by rating
     */
    public function scopeRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Check if review is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if review is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Get star rating as HTML
     */
    public function getStarRatingHtml()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<i class="fas fa-star text-warning"></i>';
            } else {
                $stars .= '<i class="far fa-star text-warning"></i>';
            }
        }
        return $stars;
    }

    /**
     * Get short review text (truncated)
     */
    public function getShortReview($length = 100)
    {
        return strlen($this->review_text) > $length
            ? substr($this->review_text, 0, $length) . '...'
            : $this->review_text;
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass()
    {
        $classes = [
            'pending' => 'badge-warning',
            'approved' => 'badge-success',
            'rejected' => 'badge-danger',
        ];

        return $classes[$this->status] ?? 'badge-secondary';
    }

    /**
     * Calculate average rating for a customer
     */
    public static function averageRatingFor($customerId)
    {
        return self::where('customer_id', $customerId)
                   ->where('status', 'approved')
                   ->avg('rating') ?? 0;
    }

    /**
     * Get total reviews count for a customer
     */
    public static function totalReviewsFor($customerId)
    {
        return self::where('customer_id', $customerId)
                   ->where('status', 'approved')
                   ->count();
    }

    /**
     * Get rating distribution for a customer
     */
    public static function ratingDistributionFor($customerId)
    {
        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $distribution[$i] = self::where('customer_id', $customerId)
                                   ->where('status', 'approved')
                                   ->where('rating', $i)
                                   ->count();
        }
        return $distribution;
    }
}
