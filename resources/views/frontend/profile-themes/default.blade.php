<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Profile' }} - Fastap</title>

    @php
        $websetting = App\Models\websetting::first();

        // In preview mode, use mock menu. Otherwise query database
        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile' => 1,
                'quali' => 1,
                'service' => 1,
                'thought' => 1,
                'personal' => 1,
                'profess' => 1,
                'videos' => 1,
                'product' => 1,
                'social_link' => 1,
                'upload_file' => 1,
                'client' => 1,
                'menu_section' => 1,
                'reservation_section' => 1,
                'property_listings' => 1,
                'showreel' => 1,
                'team_section' => 1,
                'pricing_section' => 1,
                'booking_section' => 1,
            ];
        } else {
            // For live profiles, get actual menu (note: profile_menu table has no user ID column, needs fixing)
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client','menu_section','reservation_section','property_listings','showreel','team_section','pricing_section','booking_section'], 1);
            }
        }

        $themeColor = $theme->color ?? '#7c3aed';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root { --theme-primary: {{ $themeColor }}; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #1e293b; min-height: 100vh; }

        .profile-hero {
            background: linear-gradient(135deg, var(--theme-primary) 0%, color-mix(in srgb, var(--theme-primary) 70%, #000) 100%);
            padding: 2.5rem 1rem;
            text-align: center;
        }
        .profile-avatar {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 4px solid white;
            margin: 0 auto 1rem;
            overflow: hidden;
            background: white;
        }
        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .profile-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: var(--theme-primary);
            font-size: 3rem;
            font-weight: 700;
        }
        .profile-name { font-size: 1.75rem; font-weight: 700; color: white; margin-bottom: 0.25rem; }
        .profile-title { color: rgba(255,255,255,0.9); font-size: 1rem; margin-bottom: 1rem; }
        .profile-badges { display: flex; justify-content: center; gap: 0.5rem; flex-wrap: wrap; }
        .badge {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            background: rgba(255,255,255,0.15);
            padding: 0.4rem 0.75rem;
            border-radius: 2rem;
            color: white;
            font-size: 0.8rem;
        }

        .action-bar {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            flex-wrap: wrap;
        }
        .action-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            border-radius: 2rem;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .action-btn-primary { background: var(--theme-primary); color: white; }
        .action-btn-primary:hover { opacity: 0.9; }
        .action-btn-outline { background: white; color: #475569; border: 1px solid #e2e8f0; }
        .action-btn-outline:hover { border-color: var(--theme-primary); color: var(--theme-primary); }

        .profile-container { max-width: 700px; margin: 0 auto; padding: 1rem; }

        .profile-card {
            background: white;
            border-radius: 1rem;
            margin-bottom: 1rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }
        .card-header {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .card-header i {
            width: 36px;
            height: 36px;
            border-radius: 0.5rem;
            background: color-mix(in srgb, var(--theme-primary) 10%, transparent);
            color: var(--theme-primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-header h3 { font-size: 1rem; font-weight: 600; }
        .card-body { padding: 1rem; }

        .info-list { display: flex; flex-direction: column; gap: 0.75rem; }
        .info-item {
            display: flex;
            gap: 0.75rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 0.5rem;
        }
        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 0.5rem;
            background: color-mix(in srgb, var(--theme-primary) 15%, transparent);
            color: var(--theme-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .info-content { flex: 1; }
        .info-label { color: #64748b; font-size: 0.75rem; margin-bottom: 0.15rem; }
        .info-value { font-weight: 500; font-size: 0.9rem; }

        .services-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; }
        @media (max-width: 400px) { .services-grid { grid-template-columns: 1fr; } }
        .service-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 0.5rem;
            font-size: 0.85rem;
        }
        .service-item i { color: var(--theme-primary); }

        .social-links { display: flex; justify-content: center; gap: 0.75rem; padding: 1rem; }
        .social-link {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
        }
        .social-link:hover { background: var(--theme-primary); color: white; transform: translateY(-3px); }

        .profile-footer { text-align: center; padding: 1.5rem; color: #94a3b8; font-size: 0.8rem; }
        .profile-footer a { color: var(--theme-primary); text-decoration: none; }

        /* Portfolio Grid */
        .portfolio-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem; }
        .portfolio-item { aspect-ratio: 1; border-radius: 0.5rem; overflow: hidden; }
        .portfolio-item img { width: 100%; height: 100%; object-fit: cover; }

        /* Preview Banner */
        .preview-banner { background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%); color: white; padding: 12px 20px; text-align: center; font-size: 14px; font-weight: 500; box-shadow: 0 2px 8px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        .preview-banner a { color: white; text-decoration: underline; font-weight: 600; margin-left: 8px; }
        .preview-banner a:hover { color: #fbbf24; }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')
    @if($isPreview ?? false)
    <div class="preview-banner"><i class="fas fa-eye"></i> This is a preview. <a href="{{ url('/signin') }}">Sign up</a> to create your own professional profile!</div>
    @endif


    <section class="profile-hero" @if($userdata->banner) style="background-image: linear-gradient(135deg, rgba(15, 23, 42, 0.75) 0%, rgba(15, 23, 42, 0.75) 100%), url('{{ url('public/frontend/user_images', $userdata->banner) }}'); background-size: cover; background-position: center;" @endif>
        <div class="profile-avatar">
            @if($userdata->profile)
                <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
            @else
                <div class="profile-avatar-placeholder">{{ substr($userdata->name, 0, 1) }}</div>
            @endif
        </div>
        <h1 class="profile-name">{{ $userdata->name }}</h1>
        <p class="profile-title">{{ $userdata->desig ?? ($theme->name ?? 'Professional') }}</p>
        <div class="profile-badges">
            @if($userdata->city)
                <span class="badge"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}</span>
            @endif
            @if($theme)
                <span class="badge"><i class="fas {{ $theme->icon }}"></i> {{ $theme->name }}</span>
            @endif
        </div>
    </section>

    <div class="action-bar">
        @if($userdata->mobile)
        <a href="tel:{{ $userdata->mobile }}" class="action-btn action-btn-primary">
            <i class="fas fa-phone"></i> Call
        </a>
        @endif
        @if($social && $social->whatsapp)
        <a href="https://wa.me/{{ $social->whatsapp }}" class="action-btn action-btn-outline">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        @endif
        @if($userdata->email)
        <a href="mailto:{{ $userdata->email }}" class="action-btn action-btn-outline">
            <i class="fas fa-envelope"></i> Email
        </a>
        @endif
    </div>

    <div class="profile-container">
        <!-- Services/Professions -->
        @if($userdata->isFeatureVisible('services') && $professions->count() > 0)
        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-briefcase"></i>
                <h3>Services</h3>
            </div>
            <div class="card-body">
                <div class="services-grid">
                    @foreach($professions as $profession)
                    <div class="service-item">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ $profession->title }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Qualifications -->
        @if($userdata->isFeatureVisible('qualifications') && $qualifications->count() > 0)
        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-graduation-cap"></i>
                <h3>Qualifications</h3>
            </div>
            <div class="card-body">
                <div class="info-list">
                    @foreach($qualifications as $qual)
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-award"></i></div>
                        <div class="info-content">
                            <div class="info-value">{{ $qual->title }}</div>
                            @if($qual->desc)
                            <div class="info-label">{{ $qual->desc }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Portfolio -->
        @if($userdata->isFeatureVisible('portfolio') && $portfolios->count() > 0)
        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-images"></i>
                <h3>Portfolio</h3>
            </div>
            <div class="card-body">
                <div class="portfolio-grid">
                    @foreach($portfolios->take(6) as $portfolio)
                        @php $images = json_decode($portfolio->image, true); @endphp
                        @if($images && count($images) > 0)
                        <div class="portfolio-item">
                            <img src="{{ url('public/frontend/portfolio/' . $images[0]) }}" alt="Portfolio">
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Contact -->
        <div class="profile-card">
            <div class="card-header">
                <i class="fas fa-address-card"></i>
                <h3>Contact</h3>
            </div>
            <div class="card-body">
                <div class="info-list">
                    @if($userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="info-item" style="text-decoration:none;color:inherit;">
                        <div class="info-icon"><i class="fas fa-phone"></i></div>
                        <div class="info-content">
                            <div class="info-label">Phone</div>
                            <div class="info-value">{{ $userdata->mobile }}</div>
                        </div>
                    </a>
                    @endif
                    @if($userdata->email)
                    <a href="mailto:{{ $userdata->email }}" class="info-item" style="text-decoration:none;color:inherit;">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="info-content">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $userdata->email }}</div>
                        </div>
                    </a>
                    @endif
                    @if($userdata->city || $userdata->state)
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="info-content">
                            <div class="info-label">Location</div>
                            <div class="info-value">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Social Links -->
        @if($social)
        <div class="profile-card">
            <div class="social-links">
                @if($social->facebook)<a href="{{ $social->facebook }}" class="social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>@endif
                @if($social->instagram)<a href="{{ $social->instagram }}" class="social-link" target="_blank"><i class="fab fa-instagram"></i></a>@endif
                @if($social->linkedin)<a href="{{ $social->linkedin }}" class="social-link" target="_blank"><i class="fab fa-linkedin-in"></i></a>@endif
                @if($social->twitter)<a href="{{ $social->twitter }}" class="social-link" target="_blank"><i class="fab fa-twitter"></i></a>@endif
                @if($social->youtube)<a href="{{ $social->youtube }}" class="social-link" target="_blank"><i class="fab fa-youtube"></i></a>@endif
            </div>
        </div>
        @endif
    </div>

    <footer class="profile-footer">
        <p>Digital Card by <a href="{{ url('/') }}">Fastap</a></p>
    </footer>
@include('components.profile-location-tracker', ['customerId' => $userdata->id ?? null, 'profileSlug' => $userdata->slug ?? null, 'isPreview' => $isPreview ?? false])
</body>
</html>


