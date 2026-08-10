@extends('frontend.medical.layout')

@section('title', $customer->name . ' - Doctor Profile')

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

        .doctor-profile {
            background: transparent !important;
        }

        /* Page Wrapper with Background SVGs */
        .page-wrapper {
            position: relative;
            min-height: 100vh;
        }

        /* Background SVG Decorations - Same as main medical theme */
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

        /* Profile Info Header */
        .profile-info-header {
            padding: 3rem;
            text-align: center;
            border-bottom: 2px solid #E0F2FE;
        }

        .doctor-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 6px solid var(--medical-cyan);
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(6, 182, 212, 0.25);
            margin: 0 auto 1.5rem;
        }

        .doctor-avatar-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 6px solid var(--medical-cyan);
            background: var(--medical-cyan);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
            box-shadow: 0 10px 30px rgba(6, 182, 212, 0.25);
            margin: 0 auto 1.5rem;
        }

        .doctor-name {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--medical-dark);
            margin-bottom: 0.5rem;
        }

        .doctor-specialization {
            font-size: 1.3rem;
            color: var(--medical-cyan-dark);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .doctor-credentials {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .credential-item {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: rgba(6, 182, 212, 0.08);
            border: 1px solid rgba(6, 182, 212, 0.2);
            border-radius: 50px;
            font-size: 0.95rem;
            color: var(--medical-dark);
        }

        .credential-item i {
            color: var(--medical-cyan);
        }

        /* Quick Actions Bar */
        #quick-actions.card {
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 18px 30px rgba(15, 23, 42, 0.08);
            margin: 2rem 3rem;
        }

        #quick-actions .btn {
            border-radius: 999px;
            font-weight: 600;
            padding: 0.85rem 1.5rem;
        }

        .btn-primary {
            background: var(--medical-cyan) !important;
            border-color: var(--medical-cyan) !important;
        }

        .btn-primary:hover {
            background: var(--medical-cyan-dark) !important;
            border-color: var(--medical-cyan-dark) !important;
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

        /* OPD Timings */
        .opd-timings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
        }

        .timing-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .timing-card:hover {
            background: rgba(6, 182, 212, 0.05);
            border-color: var(--medical-cyan);
        }

        .timing-day {
            font-weight: 700;
            color: var(--medical-dark);
            font-size: 1.05rem;
        }

        .timing-hours {
            color: #64748b;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Fees Cards */
        .fees-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .fee-card {
            background: rgba(6, 182, 212, 0.05);
            border: 2px solid rgba(6, 182, 212, 0.2);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
        }

        .fee-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(6, 182, 212, 0.15);
            border-color: var(--medical-cyan);
        }

        .fee-icon {
            font-size: 2.5rem;
            color: var(--medical-cyan);
            margin-bottom: 1rem;
        }

        .fee-type {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .fee-amount {
            font-size: 2rem;
            font-weight: 800;
            color: var(--medical-cyan);
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

        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.25rem;
        }

        .gallery-item {
            aspect-ratio: 16/10;
            border-radius: 14px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
        }

        .gallery-item:hover {
            border-color: var(--medical-cyan);
            transform: scale(1.03);
            box-shadow: 0 10px 30px rgba(6, 182, 212, 0.2);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-item {
            padding: 2rem;
            background: rgba(6, 182, 212, 0.05);
            border-radius: 16px;
            border: 2px solid rgba(6, 182, 212, 0.15);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--medical-cyan);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #64748b;
            font-weight: 600;
        }

        /* Contact Info */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.25rem;
        }

        .contact-card {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding: 1.5rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s;
        }

        .contact-card:hover {
            background: rgba(6, 182, 212, 0.05);
            border-color: var(--medical-cyan);
            transform: translateX(5px);
            text-decoration: none;
        }

        .contact-icon {
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

        .contact-info {
            flex: 1;
        }

        .contact-label {
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }

        .contact-value {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--medical-dark);
        }

        /* About Section */
        .about-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #475569;
        }

        /* Location Card */
        .location-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1.5rem;
        }

        .location-text {
            font-size: 1.05rem;
            color: var(--medical-dark);
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .location-text i {
            color: var(--medical-cyan);
            font-size: 1.3rem;
            margin-top: 0.2rem;
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

            .profile-info-header {
                padding: 2rem 1.5rem;
            }

            .profile-section {
                padding: 2rem 1.5rem;
            }

            #quick-actions.card {
                margin: 1.5rem;
            }

            .doctor-name {
                font-size: 1.8rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
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
            <!-- Profile Info Header -->
            <div class="profile-info-header">
                @if($customer->profile)
                    <img src="{{ asset('public/frontend/user_images/' . $customer->profile) }}"
                         alt="{{ $customer->name }}"
                         class="doctor-avatar">
                @else
                    <div class="doctor-avatar-placeholder">
                        <i class="fas fa-user-md"></i>
                    </div>
                @endif

                <h1 class="doctor-name">{{ $customer->name }}</h1>

                @if($profile->specialization)
                    <p class="doctor-specialization">{{ $profile->specialization }}</p>
                @endif

                <div class="doctor-credentials">
                    @if($profile->degree)
                        <span class="credential-item">
                            <i class="fas fa-graduation-cap"></i>
                            {{ $profile->degree }}
                        </span>
                    @endif
                    @if($profile->registration_number)
                        <span class="credential-item">
                            <i class="fas fa-id-card"></i>
                            Reg: {{ $profile->registration_number }}
                        </span>
                    @endif
                    @if($profile->experience_years)
                        <span class="credential-item">
                            <i class="fas fa-award"></i>
                            {{ $profile->experience_years }}+ Years
                        </span>
                    @endif
                </div>
            </div>

            <!-- Quick Actions Bar -->
            <div class="card" id="quick-actions">
                <div class="card-body">
                    <div class="row g-2 text-center">
                        <div class="col-md-3">
                            <a href="{{ url($customer->slug . '/medical/book-appointment') }}" class="btn btn-primary w-100">
                                <i class="fas fa-calendar-check me-2"></i>Book Appointment
                            </a>
                        </div>
                        @if($customer->contact)
                            <div class="col-md-3">
                                <a href="tel:{{ $customer->contact }}" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-phone me-2"></i>Call Now
                                </a>
                            </div>
                        @endif
                        @if($customer->whatsapp)
                            <div class="col-md-3">
                                <a href="https://wa.me/{{ $customer->whatsapp }}" target="_blank" class="btn btn-success w-100">
                                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                                </a>
                            </div>
                        @endif
                        <div class="col-md-3">
                            <a href="{{ url($customer->slug . '/medical') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-arrow-left me-2"></i>All Profiles
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- OPD Timings -->
            @if($profile->opd_timings)
                <div class="profile-section" id="opd-timings">
                    <h2 class="section-title">
                        <i class="fas fa-clock"></i>
                        OPD Timings
                    </h2>
                    <div class="opd-timings-grid">
                        @foreach($profile->opd_timings as $day => $timing)
                            <div class="timing-card">
                                <span class="timing-day">{{ ucfirst($day) }}</span>
                                <span class="timing-hours">{{ $timing }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Consultation Fees -->
            <div class="profile-section" id="fees">
                <h2 class="section-title">
                    <i class="fas fa-rupee-sign"></i>
                    Consultation Fees
                </h2>
                <div class="fees-grid">
                    <div class="fee-card">
                        <div class="fee-icon">
                            <i class="fas fa-hospital-user"></i>
                        </div>
                        <div class="fee-type">In-Person Consultation</div>
                        <div class="fee-amount">{{ $profile->getFormattedInpersonFee() }}</div>
                    </div>
                    <div class="fee-card">
                        <div class="fee-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <div class="fee-type">Video Consultation</div>
                        <div class="fee-amount">{{ $profile->getFormattedVideoFee() }}</div>
                    </div>
                </div>
            </div>

            <!-- About -->
            @if($customer->about)
                <div class="profile-section" id="about">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        About
                    </h2>
                    <p class="about-text">{{ $customer->about }}</p>
                </div>
            @endif

            <!-- Clinic Facilities -->
            @if($profile->clinic_facilities)
                <div class="profile-section" id="clinic-facilities">
                    <h2 class="section-title">
                        <i class="fas fa-hospital"></i>
                        Clinic & Facilities
                    </h2>
                    <div class="facilities-grid">
                        @foreach($profile->clinic_facilities as $facility)
                            <div class="facility-item">
                                <i class="fas fa-check-circle facility-icon"></i>
                                <span class="facility-name">{{ $facility }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Gallery -->
            @if($profile->gallery_images && count($profile->gallery_images) > 0)
                <div class="profile-section" id="gallery">
                    <h2 class="section-title">
                        <i class="fas fa-images"></i>
                        Gallery
                    </h2>
                    <div class="gallery-grid">
                        @foreach($profile->gallery_images as $image)
                            @php
                                $imagePath = $image;
                                if ($imagePath) {
                                    if (\Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])) {
                                        $imagePath = $imagePath;
                                    } elseif (\Illuminate\Support\Str::startsWith($imagePath, ['uploads/', 'frontend/', 'storage/'])) {
                                        $imagePath = asset($imagePath);
                                    } else {
                                        $imagePath = asset('storage/' . ltrim($imagePath, '/'));
                                    }
                                }
                            @endphp
                            <div class="gallery-item">
                                <img src="{{ $imagePath }}" alt="Clinic" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Stats -->
            @if($profile->experience_years || $profile->patients_treated)
                <div class="profile-section" id="stats">
                    <h2 class="section-title">
                        <i class="fas fa-chart-line"></i>
                        Statistics
                    </h2>
                    <div class="stats-grid">
                        @if($profile->experience_years)
                            <div class="stat-item">
                                <div class="stat-value">{{ $profile->experience_years }}+</div>
                                <div class="stat-label">Years of Experience</div>
                            </div>
                        @endif
                        @if($profile->patients_treated)
                            <div class="stat-item">
                                <div class="stat-value">{{ number_format($profile->patients_treated) }}+</div>
                                <div class="stat-label">Patients Treated</div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Location -->
            @if($profile->clinic_address || $customer->address)
                <div class="profile-section" id="location">
                    <h2 class="section-title">
                        <i class="fas fa-map-marker-alt"></i>
                        Location
                    </h2>
                    <div class="location-card">
                        <div class="location-text">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $profile->clinic_address ?? $customer->address }}</span>
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
                <div class="contact-grid">
                    @if($customer->contact)
                        <a href="tel:{{ $customer->contact }}" class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-label">Phone</div>
                                <div class="contact-value">{{ $customer->contact }}</div>
                            </div>
                        </a>
                    @endif
                    @if($customer->email)
                        <a href="mailto:{{ $customer->email }}" class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-label">Email</div>
                                <div class="contact-value">{{ $customer->email }}</div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
