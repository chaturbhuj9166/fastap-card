@extends('layouts.redesign.dashboard')

@section('page-title', 'Reviews & Ratings')
@section('breadcrumb', 'Reviews')

@section('dashboard-content')
<div class="reviews-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Reviews & Ratings</h1>
            <p>Approve, feature, and manage reviews from patients</p>
        </div>
    </div>

    <div class="stats-row stagger-animation">
        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon purple">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ number_format($averageRating, 1) }}</span>
                <span class="stat-mini-label">Average Rating</span>
            </div>
        </div>
        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon blue">
                <i class="fas fa-comments"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalReviews }}</span>
                <span class="stat-mini-label">Total Reviews</span>
            </div>
        </div>
        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon orange">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $pendingCount }}</span>
                <span class="stat-mini-label">Pending</span>
            </div>
        </div>
    </div>

    <div class="table-section fade-up">
        <div class="table-header">
            <h3><i class="fas fa-list"></i> Review Queue</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="margin: 0 var(--space-lg) var(--space-md);">{{ session('success') }}</div>
        @endif

        @php
            $statusMap = [
                'pending' => 'warning',
                'approved' => 'success',
                'rejected' => 'danger',
            ];
        @endphp

        @if($reviews->count())
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reviewer</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Profile Type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td>#{{ $review->id }}</td>
                                <td>
                                    <strong>{{ $review->reviewer_name }}</strong>
                                    @if($review->reviewer_mobile)
                                        <br><span class="text-muted">{{ $review->reviewer_mobile }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="stars">{!! $review->getStarRatingHtml() !!}</div>
                                    <span class="text-muted">{{ $review->rating }}/5</span>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $review->getShortReview(50) }}</p>
                                    @if($review->is_featured)
                                        <span class="status-badge info">Featured</span>
                                    @endif
                                </td>
                                <td>{{ ucfirst($review->profile_type) }}</td>
                                <td>
                                    <span class="status-badge {{ $statusMap[$review->status] ?? 'secondary' }}">
                                        {{ ucfirst($review->status) }}
                                    </span>
                                </td>
                                <td>{{ $review->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="table-actions">
                                        @if($review->status === 'pending')
                                            <form action="{{ route('user.medical.review.approve', $review->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="action-btn success" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('user.medical.review.reject', $review->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="action-btn danger" title="Reject">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if($review->status === 'approved')
                                            <form action="{{ route('user.medical.review.toggleFeatured', $review->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="action-btn warning" title="Toggle Featured">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('user.medical.review.delete', $review->id) }}" method="POST" onsubmit="return confirm('Delete this review?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(method_exists($reviews, 'links'))
                <div class="table-footer">
                    {{ $reviews->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3>No reviews yet</h3>
                <p>Patient reviews will appear here once submitted.</p>
            </div>
        @endif
    </div>
</div>
@include('userdashboard-new.partials.content-page-styles')
@include('userdashboard-new.partials.table-page-styles')
@endsection
