@extends('layouts.redesign.dashboard')

@section('page-title', 'My Thoughts')
@section('breadcrumb', 'Thoughts')

@section('dashboard-content')
<div class="thoughts-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Thoughts</h1>
            <p>Share your insights, quotes, and personal thoughts</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/addthought') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Thought
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        @php
            $totalThoughts = $thoughts ? (is_countable($thoughts) ? count($thoughts) : 0) : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon orange">
                <i class="fas fa-lightbulb"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalThoughts }}</span>
                <span class="stat-mini-label">Total Thoughts</span>
            </div>
        </div>
    </div>

    @if($thoughts && count($thoughts) > 0)
        <div class="items-grid stagger-animation">
            @foreach($thoughts as $thought)
                <div class="item-card thought-card fade-up">
                    <div class="item-card-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="item-card-body">
                        <div class="thought-content">
                            <p class="thought-text">{{ Str::limit($thought->thought, 120) }}</p>
                        </div>
                        <p class="item-date">Added {{ $thought->created_at ? $thought->created_at->format('M d, Y') : 'N/A' }}</p>
                    </div>
                    <div class="item-card-actions">
                        <a href="{{ url('/editthought' . $thought->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/deletethought' . $thought->id) }}" class="action-btn danger" title="Delete" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-lightbulb"></i>
            </div>
            <h3>No Thoughts Yet</h3>
            <p>Share your insights and quotes to display on your profile.</p>
            <a href="{{ url('/addthought') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Thought
            </a>
        </div>
    @endif
</div>

<style>
.thought-card .item-card-icon {
    background: linear-gradient(135deg, var(--warning-color), #f39c12);
}

.thought-text {
    font-style: italic;
    color: var(--text-color);
    line-height: 1.6;
    margin: 0;
}

.stat-mini-icon.orange {
    background: linear-gradient(135deg, var(--warning-color), #f39c12);
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@endsection
