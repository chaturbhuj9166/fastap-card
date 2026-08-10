@extends('frontend.medical.layout')

@section('title', 'Reviews - ' . $customer->name)

@section('content')
<div class="medical-reviews py-5" style="background: #f8f9fa; min-height: 100vh;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h2 class="mb-3">Patient Reviews & Ratings</h2>
                        <div class="rating-summary mb-4">
                            <h1 class="display-3 mb-0">{{ number_format($averageRating, 1) }}</h1>
                            <div class="stars mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($averageRating))
                                        <i class="fas fa-star text-warning" style="font-size: 24px;"></i>
                                    @else
                                        <i class="far fa-star text-warning" style="font-size: 24px;"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-muted">Based on {{ $totalReviews }} reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#writeReviewModal">
                <i class="fas fa-edit me-2"></i>Write a Review
            </button>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @forelse($reviews as $review)
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1">{{ $review->reviewer_name }}</h5>
                                    <div class="stars mb-2">{!! $review->getStarRatingHtml() !!}</div>
                                </div>
                                <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                            </div>
                            <p class="mb-2">{{ $review->review_text }}</p>
                        </div>
                    </div>
                @empty
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center text-muted py-5">
                            <i class="fas fa-comments fa-3x mb-3"></i>
                            <p>No reviews yet. Be the first to write a review!</p>
                        </div>
                    </div>
                @endforelse
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="writeReviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('medical.review.store') }}" method="POST">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Your Name *</label>
                        <input type="text" name="reviewer_name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rating *</label>
                            <select name="rating" class="form-select" required>
                                <option value="5">5 Stars - Excellent</option>
                                <option value="4">4 Stars - Very Good</option>
                                <option value="3">3 Stars - Good</option>
                                <option value="2">2 Stars - Fair</option>
                                <option value="1">1 Star - Poor</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Profile Type *</label>
                            <select name="profile_type" class="form-select" required>
                                <option value="doctor">Doctor</option>
                                <option value="hospital">Hospital</option>
                                <option value="daycare">Day Care</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Your Review *</label>
                        <textarea name="review_text" class="form-control" rows="4" required minlength="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
