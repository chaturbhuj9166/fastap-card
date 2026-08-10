@extends('layouts.redesign.dashboard')

@section('page-title', 'My Services')
@section('breadcrumb', 'Services')

@section('dashboard-content')
<div class="professions-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Services</h1>
            <p>Manage your professional services and expertise</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/addprofessions') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Service
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        @php
            $totalProfessions = $professions ? (is_countable($professions) ? count($professions) : 0) : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon purple">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalProfessions }}</span>
                <span class="stat-mini-label">Total Services</span>
            </div>
        </div>
    </div>

    @if($professions && count($professions) > 0)
        <div class="items-grid stagger-animation">
            @foreach($professions as $profession)
                <div class="item-card fade-up">
                    <div class="item-card-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="item-card-body">
                        <h4 class="item-title">{{ $profession->profession }}</h4>
                        @if($profession->email)
                            <p class="item-meta"><i class="fas fa-envelope"></i> {{ $profession->email }}</p>
                        @endif
                        @if($profession->description)
                            <p class="item-description">{{ Str::limit($profession->description, 80) }}</p>
                        @endif
                        <p class="item-date">Added {{ $profession->created_at ? $profession->created_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="item-card-actions">
                        <a href="{{ url('/editprofessions' . $profession->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/deleteprofessions' . $profession->id) }}" class="action-btn danger" title="Delete" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <h3>No Services Yet</h3>
            <p>Add your professional services to showcase on your profile.</p>
            <a href="{{ url('/addprofessions') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Service
            </a>
        </div>
    @endif
</div>
@include('userdashboard-new.partials.content-page-styles')
@endsection
