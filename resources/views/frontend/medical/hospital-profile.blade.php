@extends('frontend.medical.layout')

@section('title', $customer->name . ' - Hospital Profile')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--medical-bg) !important;
        }

        .hospital-profile {
            background: transparent !important;
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
        .profile-header {
            width: 100%;
            height: 500px;
            background: linear-gradient(135deg, #06B6D4 0%, #0891B2 50%, #0E7490 100%) !important;
            position: relative;
            overflow: hidden;
            padding: 0 !important;
            margin: 0;
        }

        .profile-header::after {
            content: none;
        }

        /* ECG Wave in Banner */
        .ecg-wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            opacity: 0.3;
        }

        /* Profile Content */
        .profile-content-wrapper {
            max-width: 1200px;
            margin: -120px auto 3rem;
            padding: 0 2rem;
            position: relative;
            z-index: 100;
        }

        .profile-card-container {
            background: var(--medical-white);
            border-radius: 24px;
            padding: 0;
            box-shadow: 0 20px 60px rgba(6, 182, 212, 0.15);
            border-left: 5px solid var(--medical-cyan);
            overflow: hidden;
        }

        /* Hospital Header */
        .hospital-header {
            padding: 3rem;
            text-align: center;
            border-bottom: 2px solid #E0F2FE;
        }

        .hospital-name {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--medical-dark);
            margin-bottom: 1.5rem;
        }

        .hospital-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            background: rgba(6, 182, 212, 0.08);
            border: 2px solid rgba(6, 182, 212, 0.2);
            border-radius: 16px;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--medical-dark);
        }

        .stat-badge i {
            color: var(--medical-cyan);
            font-size: 1.5rem;
        }

        .stat-badge .stat-number {
            color: var(--medical-cyan);
            font-size: 1.3rem;
            font-weight: 800;
        }

        /* Emergency Contact Bar */
        .emergency-bar {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            padding: 1.5rem 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .emergency-text {
            color: white;
            font-size: 1.15rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .emergency-text i {
            font-size: 1.8rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .emergency-contact-btn {
            background: white;
            color: #dc2626;
            padding: 0.9rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.15rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s;
        }

        .emergency-contact-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            color: #dc2626;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            padding: 2rem 3rem;
            border-bottom: 1px solid #E0F2FE;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 1rem 1.5rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .action-btn-primary {
            background: var(--medical-cyan);
            color: white;
        }

        .action-btn-primary:hover {
            background: var(--medical-cyan-dark);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        .action-btn-outline {
            background: white;
            color: var(--medical-cyan);
            border-color: var(--medical-cyan);
        }

        .action-btn-outline:hover {
            background: var(--medical-cyan);
            color: white;
            text-decoration: none;
        }

        /* Section Styles */
        .profile-section {
            padding: 2.5rem 3rem;
            border-bottom: 1px solid #E0F2FE;
        }

        .profile-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--medical-dark);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: var(--medical-cyan);
            font-size: 1.4rem;
        }

        /* Departments Grid */
        .departments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
        }

        .department-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            background: rgba(6, 182, 212, 0.05);
            border: 2px solid rgba(6, 182, 212, 0.15);
            border-radius: 14px;
            transition: all 0.3s;
        }

        .department-card:hover {
            transform: translateY(-3px);
            border-color: var(--medical-cyan);
            background: rgba(6, 182, 212, 0.1);
            box-shadow: 0 8px 20px rgba(6, 182, 212, 0.15);
        }

        .department-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            background: var(--medical-cyan);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .department-name {
            font-weight: 700;
            color: var(--medical-dark);
            font-size: 1.05rem;
        }

        /* Facilities Grid */
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .facility-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }

        .facility-item:hover {
            background: rgba(6, 182, 212, 0.05);
            border-color: var(--medical-cyan);
        }

        .facility-icon {
            font-size: 1.3rem;
            color: var(--medical-teal);
        }

        .facility-name {
            font-weight: 600;
            color: var(--medical-dark);
        }

        /* Insurance Grid */
        .insurance-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .insurance-badge {
            padding: 0.7rem 1.2rem;
            background: rgba(6, 182, 212, 0.1);
            border: 2px solid rgba(6, 182, 212, 0.25);
            border-radius: 50px;
            font-weight: 600;
            color: var(--medical-dark);
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .insurance-badge:hover {
            background: rgba(6, 182, 212, 0.15);
            border-color: var(--medical-cyan);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-header {
                height: 280px;
            }

            .profile-content-wrapper {
                margin-top: -80px;
                padding: 0 1rem;
            }

            .hospital-header {
                padding: 2rem 1.5rem;
            }

            .hospital-name {
                font-size: 2rem;
            }

            .profile-section {
                padding: 2rem 1.5rem;
            }

            .emergency-bar {
                padding: 1.25rem 1.5rem;
                flex-direction: column;
                text-align: center;
            }

            .quick-actions {
                padding: 1.5rem;
                grid-template-columns: 1fr;
            }

            .hospital-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .stat-badge {
                width: 100%;
                justify-content: center;
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
            <path d="M50 30 Q40 35 40 45 L40 80" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <path d="M150 30 Q160 35 160 45 L160 80" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <path d="M40 80 Q70 90 100 100" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <path d="M160 80 Q130 90 100 100" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <path d="M100 100 L100 140" stroke="#06B6D4" stroke-width="5" stroke-linecap="round"/>
            <circle cx="100" cy="155" r="25" stroke="#06B6D4" stroke-width="5" fill="none"/>
            <circle cx="100" cy="155" r="20" stroke="#06B6D4" stroke-width="2" fill="none"/>
            <circle cx="50" cy="25" r="8" fill="#06B6D4"/>
            <circle cx="150" cy="25" r="8" fill="#06B6D4"/>
        </svg>
    </div>

    <!-- Header Section -->
    <div class="profile-header">
        <!-- ECG Wave -->
        <svg class="ecg-wave" viewBox="0 0 1200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 50 L150 50 L165 40 L175 20 L185 60 L195 75 L205 50 L250 50 L265 45 L275 55 L285 50 L450 50 L465 40 L475 20 L485 60 L495 75 L505 50 L550 50 L565 45 L575 55 L585 50 L750 50 L765 40 L775 20 L785 60 L795 75 L805 50 L850 50 L865 45 L875 55 L885 50 L1050 50 L1065 40 L1075 20 L1085 60 L1095 75 L1105 50 L1200 50"
                  stroke="white" stroke-width="3" fill="none"/>
        </svg>
    </div>

    <!-- Profile Content -->
    <div class="profile-content-wrapper">
        <div class="profile-card-container">
            <!-- Hospital Header -->
            <div class="hospital-header">
                <h1 class="hospital-name">{{ $profile->hospital_name ?? $customer->name }}</h1>

                <div class="hospital-stats">
                    @if($profile->bed_capacity)
                        <div class="stat-badge">
                            <i class="fas fa-bed"></i>
                            <span><span class="stat-number">{{ $profile->bed_capacity }}</span> Beds</span>
                        </div>
                    @endif
                    @if($profile->ambulance_service)
                        <div class="stat-badge">
                            <i class="fas fa-ambulance"></i>
                            <span>24/7 Ambulance</span>
                        </div>
                    @endif
                    @if($profile->emergency_service)
                        <div class="stat-badge">
                            <i class="fas fa-hospital-alt"></i>
                            <span>Emergency Care</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Emergency Contact Bar -->
            @if($profile->emergency_contact)
                <div class="emergency-bar">
                    <div class="emergency-text">
                        <i class="fas fa-phone-volume"></i>
                        <span>24/7 Emergency Services Available</span>
                    </div>
                    <a href="tel:{{ $profile->emergency_contact }}" class="emergency-contact-btn">
                        <i class="fas fa-phone-alt"></i>
                        {{ $profile->emergency_contact }}
                    </a>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="{{ url($customer->slug . '/medical/book-appointment') }}" class="action-btn action-btn-primary">
                    <i class="fas fa-calendar-check"></i>
                    Book Appointment
                </a>
                @if($customer->contact)
                    <a href="tel:{{ $customer->contact }}" class="action-btn action-btn-outline">
                        <i class="fas fa-phone"></i>
                        Call Hospital
                    </a>
                @endif
                @if($customer->whatsapp)
                    <a href="https://wa.me/{{ $customer->whatsapp }}" target="_blank" class="action-btn action-btn-outline">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                    </a>
                @endif
                <a href="{{ url($customer->slug . '/medical') }}" class="action-btn action-btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    All Profiles
                </a>
            </div>

            <!-- Departments -->
            @if($profile->departments)
                <div class="profile-section" id="departments">
                    <h2 class="section-title">
                        <i class="fas fa-hospital"></i>
                        Medical Departments
                    </h2>
                    <div class="departments-grid">
                        @foreach($profile->departments as $dept)
                            <div class="department-card">
                                <div class="department-icon">
                                    <i class="fas fa-clinic-medical"></i>
                                </div>
                                <span class="department-name">{{ $dept }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Facilities -->
            @if($profile->facilities)
                <div class="profile-section" id="facilities">
                    <h2 class="section-title">
                        <i class="fas fa-notes-medical"></i>
                        Hospital Facilities
                    </h2>
                    <div class="facilities-grid">
                        @foreach($profile->facilities as $facility)
                            <div class="facility-item">
                                <i class="fas fa-check-circle facility-icon"></i>
                                <span class="facility-name">{{ $facility }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Insurance Accepted -->
            @if($profile->insurance_accepted)
                <div class="profile-section" id="insurance">
                    <h2 class="section-title">
                        <i class="fas fa-shield-alt"></i>
                        Insurance Plans Accepted
                    </h2>
                    <div class="insurance-grid">
                        @foreach($profile->insurance_accepted as $insurance)
                            <span class="insurance-badge">{{ $insurance }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- About -->
            @if($customer->about)
                <div class="profile-section" id="about">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        About Hospital
                    </h2>
                    <p style="font-size: 1.05rem; line-height: 1.8; color: #475569;">{{ $customer->about }}</p>
                </div>
            @endif

            <!-- Location -->
            @if($profile->hospital_address || $customer->address)
                <div class="profile-section" id="location">
                    <h2 class="section-title">
                        <i class="fas fa-map-marker-alt"></i>
                        Location
                    </h2>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 1.5rem;">
                        <div style="font-size: 1.05rem; color: var(--medical-dark); font-weight: 600; display: flex; align-items: flex-start; gap: 0.75rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--medical-cyan); font-size: 1.3rem; margin-top: 0.2rem;"></i>
                            <span>{{ $profile->hospital_address ?? $customer->address }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Contact Info -->
            <div class="profile-section" id="contact">
                <h2 class="section-title">
                    <i class="fas fa-address-book"></i>
                    Contact Information
                </h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem;">
                    @if($customer->contact)
                        <a href="tel:{{ $customer->contact }}" style="display: flex; align-items: center; gap: 1.25rem; padding: 1.5rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; text-decoration: none; color: inherit; transition: all 0.3s;">
                            <div style="width: 55px; height: 55px; border-radius: 12px; background: var(--medical-cyan); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Phone</div>
                                <div style="font-size: 1.05rem; font-weight: 700; color: var(--medical-dark);">{{ $customer->contact }}</div>
                            </div>
                        </a>
                    @endif
                    @if($customer->email)
                        <a href="mailto:{{ $customer->email }}" style="display: flex; align-items: center; gap: 1.25rem; padding: 1.5rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; text-decoration: none; color: inherit; transition: all 0.3s;">
                            <div style="width: 55px; height: 55px; border-radius: 12px; background: var(--medical-cyan); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Email</div>
                                <div style="font-size: 1.05rem; font-weight: 700; color: var(--medical-dark);">{{ $customer->email }}</div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
