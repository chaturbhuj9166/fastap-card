@extends('frontend.medical.layout')

@section('title', $customer->name . ' - Medical Profile')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --medical-cyan: #06B6D4;
        --medical-cyan-dark: #0891B2;
        --medical-teal: #14B8A6;
        --medical-bg: #F0FDFA;
        --medical-dark: #134E4A;
        --medical-white: #FFFFFF;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--medical-bg) !important;
        margin: 0;
        padding: 0;
    }

    /* Page Wrapper with Background SVGs */
    .page-wrapper {
        position: relative;
        min-height: 100vh;
    }

    /* Background SVG Decorations */
    .bg-decoration {
        position: fixed;
        opacity: 0.15;
        z-index: 0;
        pointer-events: none;
    }
    .bg-decoration.top-left {
        top: 150px;
        left: 2%;
        width: 220px;
        height: 220px;
    }
    .bg-decoration.bottom-right {
        bottom: 100px;
        right: 2%;
        width: 200px;
        height: 200px;
    }

    /* Banner Section */
    .medical-banner {
        width: 100%;
        height: 500px;
        background: linear-gradient(135deg, #06B6D4 0%, #0891B2 50%, #0E7490 100%);
        position: relative;
        overflow: hidden;
        margin: 0;
    }

    /* ECG Wave */
    .ecg-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        opacity: 0.3;
    }

    /* Profile Card */
    .profile-selector-card {
        max-width: 1100px;
        margin: -80px auto 3rem;
        padding: 0 2rem;
        position: relative;
        z-index: 100;
    }

    .selector-main-card {
        background: var(--medical-white);
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(6, 182, 212, 0.15);
        border-left: 5px solid var(--medical-cyan);
    }

    /* Header Section */
    .profile-header-section {
        text-align: center;
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #E0F2FE;
    }

    .profile-image-wrapper {
        margin-bottom: 1.5rem;
    }

    .profile-img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 6px solid var(--medical-cyan);
        object-fit: cover;
        box-shadow: 0 10px 30px rgba(6, 182, 212, 0.25);
    }

    .profile-img-placeholder {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 6px solid var(--medical-cyan);
        background: var(--medical-cyan);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3.5rem;
        box-shadow: 0 10px 30px rgba(6, 182, 212, 0.25);
    }

    .profile-name {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--medical-dark);
        margin-bottom: 0.5rem;
    }

    .profile-designation {
        font-size: 1.2rem;
        color: var(--medical-cyan-dark);
        font-weight: 600;
    }

    /* Section Title */
    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--medical-dark);
        text-align: center;
        margin-bottom: 2.5rem;
    }

    /* Profile Type Cards */
    .profile-types-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .profile-type-card {
        background: linear-gradient(135deg, #F0FDFA 0%, #CCFBF1 100%);
        border-radius: 18px;
        padding: 2rem;
        border: 2px solid #A7F3D0;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
        position: relative;
        overflow: hidden;
    }

    .profile-type-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(6,182,212,0.1) 0%, transparent 70%);
    }

    .profile-type-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 45px rgba(6, 182, 212, 0.2);
        border-color: var(--medical-cyan);
        text-decoration: none;
    }

    .profile-type-card.default {
        border-color: var(--medical-cyan);
        border-width: 3px;
    }

    .profile-icon {
        font-size: 3.5rem;
        color: var(--medical-cyan);
        margin-bottom: 1rem;
        text-align: center;
    }

    .profile-type-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--medical-dark);
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .default-badge {
        display: inline-block;
        background: var(--medical-cyan);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .view-details-btn {
        display: inline-block;
        background: var(--medical-cyan);
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .view-details-btn:hover {
        background: var(--medical-cyan-dark);
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #64748B;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    /* Quick Actions */
    .quick-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.9rem 1.8rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .action-btn-primary {
        background: var(--medical-cyan);
        color: white;
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
    }

    .action-btn-primary:hover {
        background: var(--medical-cyan-dark);
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }

    .action-btn-success {
        background: #10b981;
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .action-btn-success:hover {
        background: #059669;
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }

    /* Legacy Link */
    .legacy-link {
        text-align: center;
        margin-top: 1.5rem;
    }

    .legacy-link a {
        color: var(--medical-cyan);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
    }

    .legacy-link a:hover {
        color: var(--medical-cyan-dark);
        transform: translateX(3px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .medical-banner {
            height: 240px;
        }
        .profile-selector-card {
            margin-top: -60px;
            padding: 0 1rem;
        }
        .selector-main-card {
            padding: 2rem 1.5rem;
        }
        .profile-name {
            font-size: 2rem;
        }
        .section-title {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="page-wrapper">
    <!-- Background SVG Decorations -->
    <div class="bg-decoration top-left">
        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="100" cy="100" r="80" stroke="#06B6D4" stroke-width="3" fill="none"/>
            <path d="M100 40 L100 160 M40 100 L160 100" stroke="#06B6D4" stroke-width="8" stroke-linecap="round"/>
        </svg>
    </div>

    <div class="bg-decoration bottom-right">
        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Stethoscope -->
            <!-- Ear tubes -->
            <path d="M50 30 Q40 35 40 45 L40 80" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <path d="M150 30 Q160 35 160 45 L160 80" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <!-- Y-junction -->
            <path d="M40 80 Q70 90 100 100" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <path d="M160 80 Q130 90 100 100" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <!-- Tube to chest piece -->
            <path d="M100 100 L100 140" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <!-- Chest piece (diaphragm) -->
            <circle cx="100" cy="155" r="25" stroke="#06B6D4" stroke-width="5" fill="none"/>
            <circle cx="100" cy="155" r="20" stroke="#06B6D4" stroke-width="2" fill="none"/>
            <!-- Ear tips -->
            <circle cx="50" cy="25" r="8" fill="#06B6D4"/>
            <circle cx="150" cy="25" r="8" fill="#06B6D4"/>
        </svg>
    </div>

    <!-- Banner -->
    <section class="medical-banner">
        <svg class="ecg-wave" viewBox="0 0 1200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 50 L150 50 L165 40 L175 20 L185 60 L195 75 L205 50 L250 50 L265 45 L275 55 L285 50 L450 50 L465 40 L475 20 L485 60 L495 75 L505 50 L550 50 L565 45 L575 55 L585 50 L750 50 L765 40 L775 20 L785 60 L795 75 L805 50 L850 50 L865 45 L875 55 L885 50 L1050 50 L1065 40 L1075 20 L1085 60 L1095 75 L1105 50 L1200 50"
                  stroke="white" stroke-width="3" fill="none"/>
        </svg>
    </section>

    <!-- Profile Selector Card -->
    <div class="profile-selector-card">
        <div class="selector-main-card">
            <!-- Header Section -->
            <div class="profile-header-section">
                <div class="profile-image-wrapper">
                    @if($customer->profile)
                        <img src="{{ asset('public/frontend/user_images/' . $customer->profile) }}"
                             alt="{{ $customer->name }}"
                             class="profile-img">
                    @else
                        <div class="profile-img-placeholder">
                            <i class="fas fa-user-md"></i>
                        </div>
                    @endif
                </div>
                <h2 class="profile-name">{{ $customer->name }}</h2>
                @if($customer->designation)
                    <p class="profile-designation">{{ $customer->designation }}</p>
                @endif
            </div>

            <!-- Section Title -->
            <h4 class="section-title">Select Profile Type</h4>

            <!-- Profile Type Cards -->
            @if($profiles->count() > 0)
                <div class="profile-types-grid">
                    @foreach($profiles as $profile)
                        <a href="{{ url($customer->slug . '/medical/' . $profile->profile_type) }}"
                           class="profile-type-card @if($profile->is_default) default @endif">
                            <div style="text-align: center;">
                                <div class="profile-icon">
                                    {!! $profile->getProfileTypeIcon() !!}
                                </div>
                                @if($profile->is_default)
                                    <div style="margin-bottom: 1rem;">
                                        <span class="default-badge">Default</span>
                                    </div>
                                @endif
                                <h5 class="profile-type-title">{{ $profile->getProfileTypeLabel() }}</h5>
                                <div style="margin-top: 1.5rem;">
                                    <button class="view-details-btn">View Details</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-info-circle"></i>
                    <p>No medical profiles available yet.</p>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="quick-actions">
                @if($customer->contact)
                    <a href="tel:{{ $customer->contact }}" class="action-btn action-btn-primary">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                @endif
                @if($customer->whatsapp)
                    <a href="https://wa.me/{{ $customer->whatsapp }}" target="_blank" class="action-btn action-btn-success">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                @endif
            </div>

            <!-- Legacy View Option -->
            <div class="legacy-link">
                <a href="{{ url($customer->slug . '?legacy=1') }}">
                    <i class="fas fa-eye"></i> View Traditional Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
