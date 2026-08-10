@extends('layouts.redesign.dashboard')

@section('page-title', 'My Qualifications')
@section('breadcrumb', 'Qualifications')

@section('dashboard-content')
<div class="qualifications-page">
    {{-- Page Header --}}
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Qualifications</h1>
            <p>Manage your educational background and certifications</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/addqualification') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Qualification
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    {{-- Stats --}}
    <div class="stats-row fade-up">
        @php
            $totalQualifications = $qualifications ? (is_countable($qualifications) ? count($qualifications) : 0) : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon blue">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalQualifications }}</span>
                <span class="stat-mini-label">Total Qualifications</span>
            </div>
        </div>
    </div>

    {{-- Qualifications Grid --}}
    @if($qualifications && count($qualifications) > 0)
        <div class="items-grid stagger-animation">
            @foreach($qualifications as $qualification)
                <div class="item-card fade-up">
                    <div class="item-card-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="item-card-body">
                        <h4 class="item-title">{{ $qualification->qualifiaction }}</h4>
                        <p class="item-description">{{ Str::limit($qualification->description, 100) }}</p>
                        <p class="item-date">Added {{ $qualification->created_at ? $qualification->created_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="item-card-actions">
                        <a href="{{ url('/editqualification' . $qualification->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/deletequalification' . $qualification->id) }}" class="action-btn danger" title="Delete" onclick="return confirm('Are you sure you want to delete this qualification?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h3>No Qualifications Yet</h3>
            <p>Add your educational background and certifications to showcase on your profile.</p>
            <a href="{{ url('/addqualification') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Qualification
            </a>
        </div>
    @endif
</div>

@include('userdashboard-new.partials.content-page-styles')
@endsection
