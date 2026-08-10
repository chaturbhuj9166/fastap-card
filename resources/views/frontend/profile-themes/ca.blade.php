<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'CA Services' }} - Chartered Accountant</title>

    @php
        $websetting = App\Models\websetting::first();

        if (isset($isPreview) && $isPreview) {
            $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client'], 1);
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client'], 1);
            }
        }

        $themeColor = $theme->color ?? '#0ea5e9';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --ca-primary: {{ $themeColor }};
            --ca-secondary: #0f766e;
            --ca-light: #e0f2fe;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #0f172a; }

        .ca-hero {
            background: linear-gradient(135deg, var(--ca-primary) 0%, var(--ca-secondary) 100%);
            padding: 2.5rem 1rem;
            text-align: center;
            position: relative;
        }
        .ca-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top, rgba(255,255,255,0.3) 0%, transparent 60%);
        }
        .ca-avatar {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 4px solid #fff;
            margin: 0 auto 1rem;
            overflow: hidden;
            background: #fff;
            position: relative;
            z-index: 1;
        }
        .ca-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .ca-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--ca-light);
            color: var(--ca-primary);
            font-size: 3rem;
        }
        .ca-name { font-size: 1.8rem; font-weight: 700; color: #fff; margin-bottom: 0.25rem; position: relative; z-index: 1; }
        .ca-title { color: rgba(255,255,255,0.95); font-size: 1rem; margin-bottom: 0.75rem; position: relative; z-index: 1; }
        .ca-badges {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(255,255,255,0.2);
            padding: 0.4rem 0.75rem;
            border-radius: 2rem;
            color: #fff;
            font-size: 0.8rem;
            backdrop-filter: blur(8px);
        }

        .action-bar {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem;
            background: #fff;
            flex-wrap: wrap;
            border-bottom: 1px solid #e2e8f0;
        }
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.2rem;
            border-radius: 0.6rem;
            text-decoration: none;
            font-weight: 600;
            background: var(--ca-light);
            color: var(--ca-primary);
        }
        .action-btn:hover { background: #bae6fd; }

        .profile-container { max-width: 760px; margin: 0 auto; padding: 1rem; }
        .profile-card {
            background: #fff;
            border-radius: 1rem;
            margin-bottom: 1rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(15,23,42,0.08);
        }
        .card-header {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 600;
        }
        .card-header i {
            width: 36px;
            height: 36px;
            border-radius: 0.5rem;
            background: var(--ca-light);
            color: var(--ca-primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-body { padding: 1rem; }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }
        .service-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1rem;
        }
        .service-title { font-weight: 600; margin-bottom: 0.3rem; }
        .service-meta { color: #64748b; font-size: 0.8rem; margin-bottom: 0.4rem; }
        .service-price { font-weight: 700; color: var(--ca-primary); }

        .info-list { display: grid; gap: 0.75rem; }
        .info-item {
            display: flex;
            gap: 0.75rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 0.6rem;
        }
        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 0.5rem;
            background: var(--ca-light);
            color: var(--ca-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
        }
        .stat-item {
            text-align: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 0.75rem;
        }
        .stat-number { font-size: 1.4rem; font-weight: 700; color: var(--ca-primary); }
        .stat-label { color: #64748b; font-size: 0.75rem; margin-top: 0.25rem; }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem;
        }
        .social-link {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--ca-light);
            color: var(--ca-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .social-link:hover { background: var(--ca-primary); color: #fff; }

        .preview-banner {
            background: linear-gradient(135deg, #0f766e 0%, #0ea5e9 100%);
            color: #fff;
            padding: 12px 20px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .preview-banner a { color: #fff; text-decoration: underline; font-weight: 600; margin-left: 8px; }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')
    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> This is a preview. <a href="{{ url('/signin') }}">Sign up</a> to create your own professional profile!
    </div>
    @endif

    <section class="ca-hero" @if($userdata->banner) style="background-image: linear-gradient(135deg, rgba(15, 23, 42, 0.75) 0%, rgba(15, 23, 42, 0.75) 100%), url('{{ url('public/frontend/user_images', $userdata->banner) }}'); background-size: cover; background-position: center;" @endif>
        @if($userdata->isFeatureVisible('profile_photo'))
        <div class="ca-avatar">
            @if($userdata->profile)
                <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}" alt="{{ $userdata->name }}">
            @else
                <div class="ca-avatar-placeholder"><i class="fas fa-file-invoice"></i></div>
            @endif
        </div>
        @endif
        @if($userdata->isFeatureVisible('name'))
        <h1 class="ca-name">{{ $userdata->name }}</h1>
        @endif
        @if($userdata->isFeatureVisible('designation') && $userdata->desig)
        <p class="ca-title">{{ $userdata->desig }}</p>
        @endif
        <div class="ca-badges">
            <span class="badge"><i class="fas fa-shield"></i> Trusted Compliance</span>
            @if($userdata->city)
                <span class="badge"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}</span>
            @endif
            <span class="badge"><i class="fas fa-award"></i> Certified CA</span>
        </div>
    </section>

    <div class="action-bar">
        @if(isset($isPreview) && $isPreview)
        <span class="action-btn" style="opacity: 0.6; pointer-events: none;">
            <i class="fas fa-calendar-check"></i> Book Consultation
        </span>
        @elseif(!empty($userdata->slug))
        <a href="{{ url($userdata->slug . '/ca-consultation') }}" class="action-btn">
            <i class="fas fa-calendar-check"></i> Book Consultation
        </a>
        @endif

        @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
        <a href="tel:{{ $userdata->mobile }}" class="action-btn">
            <i class="fas fa-phone"></i> Call
        </a>
        @endif

        @if($userdata->isFeatureVisible('whatsapp_chat') && $social && $social->whatsapp)
        <a href="https://wa.me/{{ $social->whatsapp }}" class="action-btn">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        @endif
    </div>

    <div class="profile-container">
        @if($userdata->isFeatureVisible('bio') && $userdata->about_us)
        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </div>
            <div class="card-body">
                <p style="color: #475569; line-height: 1.6;">{{ $userdata->about_us }}</p>
            </div>
        </div>
        @endif

        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-briefcase"></i>
                <span>Services</span>
            </div>
            <div class="card-body">
                @if(isset($caServices) && $caServices->count() > 0)
                <div class="service-grid">
                    @foreach($caServices->take(6) as $service)
                    <div class="service-card">
                        <div class="service-title">{{ $service->service_name }}</div>
                        <div class="service-meta">
                            {{ $service->service_category ?? 'Service' }}
                            @if($service->turnaround_time_days)
                                • {{ $service->turnaround_time_days }} days
                            @endif
                        </div>
                        @if($service->description)
                        <div class="service-meta">{{ Str::limit($service->description, 80) }}</div>
                        @endif
                        @if($service->base_price)
                        <div class="service-price">Rs {{ number_format($service->base_price) }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <p style="color: #64748b;">Service details will be shared during consultation.</p>
                @endif
            </div>
        </div>

        @if(isset($caConsultations) && $caConsultations->count() > 0)
        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-user-clock"></i>
                <span>Upcoming Consultations</span>
            </div>
            <div class="card-body">
                <div class="info-list">
                    @foreach($caConsultations->take(3) as $consultation)
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-calendar"></i></div>
                        <div>
                            <div style="font-weight: 600;">{{ $consultation->client_name ?? 'Consultation' }}</div>
                            <div style="color: #64748b; font-size: 0.85rem;">
                                {{ $consultation->consultation_type ?? 'Consultation' }}
                                @if($consultation->appointment_date)
                                    • {{ $consultation->appointment_date->format('d M Y') }}
                                @endif
                                @if($consultation->appointment_time)
                                    • {{ $consultation->appointment_time }}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if(isset($caDeadlines) && $caDeadlines->count() > 0)
        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-calendar-check"></i>
                <span>Key Deadlines</span>
            </div>
            <div class="card-body">
                <div class="info-list">
                    @foreach($caDeadlines->take(3) as $deadline)
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-bell"></i></div>
                        <div>
                            <div style="font-weight: 600;">{{ $deadline->compliance_type ?? 'Compliance' }}</div>
                            <div style="color: #64748b; font-size: 0.85rem;">
                                {{ $deadline->financial_year ?? 'FY' }}
                                @if($deadline->due_date)
                                    • Due {{ $deadline->due_date->format('d M Y') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-chart-line"></i>
                <span>Our Track Record</span>
            </div>
            <div class="card-body">
                @php
                    $caseCount = isset($caCases) ? $caCases->count() : 0;
                    $serviceCount = isset($caServices) ? $caServices->count() : 0;
                    $consultCount = isset($caConsultations) ? $caConsultations->count() : 0;
                @endphp
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">{{ $serviceCount }}</div>
                        <div class="stat-label">Services</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $caseCount }}</div>
                        <div class="stat-label">Active Cases</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $consultCount }}</div>
                        <div class="stat-label">Consultations</div>
                    </div>
                </div>
            </div>
        </div>

        @if($userdata->isFeatureVisible('contact_number') || $userdata->isFeatureVisible('email') || $userdata->isFeatureVisible('address'))
        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-address-book"></i>
                <span>Contact</span>
            </div>
            <div class="card-body">
                <div class="info-list">
                    @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-phone"></i></div>
                        <div>{{ $userdata->mobile }}</div>
                    </div>
                    @endif
                    @if($userdata->isFeatureVisible('email') && $userdata->email)
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div>{{ $userdata->email }}</div>
                    </div>
                    @endif
                    @if($userdata->isFeatureVisible('address') && ($userdata->address || $userdata->city))
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>{{ $userdata->address ?? ($userdata->city . ($userdata->state ? ', ' . $userdata->state : '')) }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    @if($userdata->isFeatureVisible('social_media'))
    <div class="profile-card" style="margin: 0 1rem 1.5rem;">
        <div class="social-links">
            @if($userdata->isFeatureVisible('facebook') && isset($social->facebook) && $social->facebook)
            <a href="{{ $social->facebook }}" target="_blank" class="social-link"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if($userdata->isFeatureVisible('instagram') && isset($social->instagram) && $social->instagram)
            <a href="{{ $social->instagram }}" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
            @endif
            @if($userdata->isFeatureVisible('linkedin') && isset($social->linkedin) && $social->linkedin)
            <a href="{{ $social->linkedin }}" target="_blank" class="social-link"><i class="fab fa-linkedin-in"></i></a>
            @endif
            @if(isset($social->youtube) && $social->youtube)
            <a href="{{ $social->youtube }}" target="_blank" class="social-link"><i class="fab fa-youtube"></i></a>
            @endif
        </div>
    </div>
    @endif
@include('components.profile-location-tracker', ['customerId' => $userdata->id ?? null, 'profileSlug' => $userdata->slug ?? null, 'isPreview' => $isPreview ?? false])
</body>
</html>
