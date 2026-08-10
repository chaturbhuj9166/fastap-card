<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Profile' }} - Fastap</title>

    @php
        $websetting = App\Models\websetting::first();
        $seg = Request::segment(2);
        $menu = DB::table('profile_menu')->select('*')->first();
        $themeData = DB::table('customers')->select('themeprofile','panel_status','animation')->where('mobile', $seg)->first();
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Design System CSS -->
    <link rel="stylesheet" href="{{ asset('redesign/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('redesign/css/base.css') }}">

    <style>
        :root {
            --profile-primary: {{ $themeData && $themeData->themeprofile == 1 ? '#7c3aed' : '#7c3aed' }};
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background: var(--bg-secondary);
            min-height: 100vh;
        }

        /* Hero Section */
        .profile-hero {
            background: linear-gradient(135deg, var(--profile-primary) 0%, #a855f7 100%);
            padding: var(--space-3xl) var(--space-lg);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .profile-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 140%;
            height: 200%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin: 0 auto var(--space-lg);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: var(--text-3xl);
            font-weight: var(--font-bold);
            color: white;
            margin-bottom: var(--space-xs);
            position: relative;
            z-index: 1;
        }

        .profile-title {
            font-size: var(--text-lg);
            color: rgba(255,255,255,0.9);
            margin-bottom: var(--space-lg);
            position: relative;
            z-index: 1;
        }

        /* Social Links */
        .social-links {
            display: flex;
            justify-content: center;
            gap: var(--space-sm);
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }

        .social-link {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all var(--transition-fast);
            backdrop-filter: blur(10px);
        }

        .social-link:hover {
            background: white;
            color: var(--profile-primary);
            transform: translateY(-3px);
        }

        /* Main Content */
        .profile-container {
            max-width: 900px;
            margin: 0 auto;
            padding: var(--space-xl) var(--space-lg);
        }

        /* Profile Card */
        .profile-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-xl);
            margin-bottom: var(--space-lg);
            overflow: hidden;
        }

        .profile-card-header {
            padding: var(--space-lg);
            border-bottom: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            gap: var(--space-sm);
        }

        .profile-card-header i {
            color: var(--profile-primary);
            font-size: var(--text-lg);
        }

        .profile-card-title {
            font-size: var(--text-lg);
            font-weight: var(--font-semibold);
            color: var(--text-primary);
        }

        .profile-card-body {
            padding: var(--space-lg);
        }

        /* About Section */
        .about-text {
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: var(--space-lg);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-md);
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
        }

        .info-item i {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(124, 58, 237, 0.1);
            color: var(--profile-primary);
            border-radius: var(--radius-md);
            font-size: var(--text-sm);
        }

        .info-label {
            font-size: var(--text-xs);
            color: var(--text-muted);
        }

        .info-value {
            font-size: var(--text-sm);
            font-weight: var(--font-medium);
            color: var(--text-primary);
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--space-lg);
        }

        .service-card {
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
            padding: var(--space-lg);
            transition: all var(--transition-base);
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .service-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: var(--space-md);
        }

        .service-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .service-name {
            font-size: var(--text-lg);
            font-weight: var(--font-semibold);
            color: var(--text-primary);
            margin-bottom: var(--space-sm);
        }

        .service-detail {
            display: flex;
            align-items: center;
            gap: var(--space-xs);
            font-size: var(--text-sm);
            color: var(--text-secondary);
            margin-bottom: var(--space-xs);
        }

        .service-detail i {
            width: 16px;
            color: var(--profile-primary);
        }

        .service-detail a {
            color: var(--profile-primary);
            text-decoration: none;
        }

        .service-description {
            font-size: var(--text-sm);
            color: var(--text-muted);
            margin-top: var(--space-sm);
            padding-top: var(--space-sm);
            border-top: 1px solid var(--border-light);
        }

        /* Portfolio Tabs */
        .portfolio-tabs {
            display: flex;
            gap: var(--space-xs);
            flex-wrap: wrap;
            margin-bottom: var(--space-lg);
        }

        .portfolio-tab {
            padding: var(--space-sm) var(--space-lg);
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-full);
            font-size: var(--text-sm);
            font-weight: var(--font-medium);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .portfolio-tab:hover,
        .portfolio-tab.active {
            background: var(--profile-primary);
            color: white;
            border-color: var(--profile-primary);
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: var(--space-md);
        }

        .gallery-item {
            aspect-ratio: 1;
            border-radius: var(--radius-lg);
            overflow: hidden;
            cursor: pointer;
            transition: all var(--transition-base);
        }

        .gallery-item:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Qualifications */
        .qualification-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--space-md);
        }

        .qualification-card {
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
            padding: var(--space-lg);
            text-align: center;
        }

        .qualification-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto var(--space-md);
            background: rgba(124, 58, 237, 0.1);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--profile-primary);
            font-size: var(--text-xl);
        }

        .qualification-title {
            font-weight: var(--font-semibold);
            color: var(--text-primary);
            margin-bottom: var(--space-xs);
        }

        .qualification-desc {
            font-size: var(--text-sm);
            color: var(--text-muted);
        }

        /* Thoughts/Testimonials */
        .thought-card {
            background: linear-gradient(135deg, var(--profile-primary) 0%, #a855f7 100%);
            border-radius: var(--radius-xl);
            padding: var(--space-xl);
            color: white;
            text-align: center;
            margin-bottom: var(--space-md);
        }

        .thought-quote {
            font-size: var(--text-2xl);
            margin-bottom: var(--space-xs);
        }

        .thought-text {
            font-size: var(--text-lg);
            font-style: italic;
            opacity: 0.9;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: var(--space-lg);
        }

        .product-card {
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all var(--transition-base);
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .product-image {
            aspect-ratio: 1;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: var(--space-md);
            text-align: center;
        }

        .product-title {
            font-weight: var(--font-semibold);
            color: var(--text-primary);
            margin-bottom: var(--space-xs);
        }

        .product-price {
            font-size: var(--text-lg);
            font-weight: var(--font-bold);
            color: var(--profile-primary);
            margin-bottom: var(--space-sm);
        }

        /* Contact Actions */
        .contact-actions {
            display: flex;
            gap: var(--space-md);
            flex-wrap: wrap;
            justify-content: center;
            margin-top: var(--space-lg);
        }

        .contact-btn {
            display: inline-flex;
            align-items: center;
            gap: var(--space-sm);
            padding: var(--space-md) var(--space-xl);
            border-radius: var(--radius-lg);
            font-weight: var(--font-medium);
            text-decoration: none;
            transition: all var(--transition-fast);
        }

        .contact-btn-primary {
            background: var(--profile-primary);
            color: white;
        }

        .contact-btn-primary:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }

        .contact-btn-secondary {
            background: var(--bg-secondary);
            color: var(--text-primary);
            border: 1px solid var(--border-light);
        }

        .contact-btn-secondary:hover {
            border-color: var(--profile-primary);
            color: var(--profile-primary);
        }

        .contact-btn-whatsapp {
            background: #25D366;
            color: white;
        }

        .contact-btn-whatsapp:hover {
            background: #128C7E;
        }

        /* Footer */
        .profile-footer {
            text-align: center;
            padding: var(--space-xl) var(--space-lg);
            color: var(--text-muted);
            font-size: var(--text-sm);
        }

        .profile-footer a {
            color: var(--profile-primary);
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-hero {
                padding: var(--space-2xl) var(--space-md);
            }

            .profile-avatar {
                width: 120px;
                height: 120px;
            }

            .profile-name {
                font-size: var(--text-2xl);
            }

            .services-grid,
            .qualification-grid,
            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-base);
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90vh;
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .modal-content img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
        }

        .modal-close {
            position: absolute;
            top: var(--space-lg);
            right: var(--space-lg);
            width: 44px;
            height: 44px;
            background: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--text-xl);
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="profile-hero"
        @if($userdata->banner)
            style="background-image: linear-gradient(135deg, var(--profile-primary) 0%, #a855f7 100%), url('{{ url('public/frontend/user_images', $userdata->banner) }}'); background-size: cover; background-position: center;"
        @endif>
        <div class="profile-avatar">
            @if($userdata->profile)
                <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
            @else
                <img src="{{ asset('assets/images/avatars/default.png') }}" alt="{{ $userdata->name }}">
            @endif
        </div>
        <h1 class="profile-name">{{ $userdata->name }}</h1>
        <p class="profile-title">{{ $userdata->desig ?? '' }}</p>

        <!-- Social Links -->
        <div class="social-links">
            @if(isset($social['facebook']) && $social['facebook'])
                <a href="{{ $social['facebook'] }}" target="_blank" class="social-link"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if(isset($social['instagram']) && $social['instagram'])
                <a href="{{ $social['instagram'] }}" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
            @endif
            @if(isset($social['twitter']) && $social['twitter'])
                <a href="{{ $social['twitter'] }}" target="_blank" class="social-link"><i class="fab fa-twitter"></i></a>
            @endif
            @if(isset($social['youtube']) && $social['youtube'])
                <a href="{{ $social['youtube'] }}" target="_blank" class="social-link"><i class="fab fa-youtube"></i></a>
            @endif
            @if(isset($social['linkdin']) && $social['linkdin'])
                <a href="{{ $social['linkdin'] }}" target="_blank" class="social-link"><i class="fab fa-linkedin-in"></i></a>
            @endif
        </div>
    </section>

    <div class="profile-container">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="profile-card" style="background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3);">
                <div class="profile-card-body" style="color: var(--green-500);">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- About Section -->
        <div class="profile-card">
            <div class="profile-card-header">
                <i class="fas fa-user"></i>
                <h2 class="profile-card-title">About Me</h2>
            </div>
            <div class="profile-card-body">
                @if($userdata->title2)
                    <p class="about-text">{{ $userdata->title2 }}</p>
                @endif
                @if($userdata->title1)
                    <p class="about-text">{{ $userdata->title1 }}</p>
                @endif

                <div class="info-grid">
                    <div class="info-item">
                        <i class="fas fa-user"></i>
                        <div>
                            <div class="info-label">Name</div>
                            <div class="info-value">{{ $userdata->name }}</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $userdata->email }}</div>
                        </div>
                    </div>
                    @if($userdata->dob)
                    <div class="info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <div>
                            <div class="info-label">Date of Birth</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($userdata->dob)->format('d M Y') }}</div>
                        </div>
                    </div>
                    @endif
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <div class="info-label">Phone</div>
                            <div class="info-value">{{ ($userdata->country_code ?? '') . ' ' . ($userdata->phone ?? $userdata->mobile) }}</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <div class="info-label">Location</div>
                            <div class="info-value">
                                {{ $userdata->city ?? '' }}{{ $userdata->state ? ', ' . $userdata->state : '' }}{{ $userdata->country ? ', ' . $userdata->country : '' }}
                            </div>
                        </div>
                    </div>
                    @if($userdata->address)
                    <div class="info-item">
                        <i class="fas fa-location-arrow"></i>
                        <div>
                            <div class="info-label">Address</div>
                            <div class="info-value">{{ $userdata->address }}</div>
                        </div>
                    </div>
                    @endif
                    @if($userdata->company)
                    <div class="info-item">
                        <i class="fas fa-building"></i>
                        <div>
                            <div class="info-label">Company</div>
                            <div class="info-value">{{ $userdata->company }}</div>
                        </div>
                    </div>
                    @endif
                    @if($userdata->website)
                    <div class="info-item">
                        <i class="fas fa-globe"></i>
                        <div>
                            <div class="info-label">Website</div>
                            <div class="info-value"><a href="{{ $userdata->website }}" target="_blank" rel="noopener">{{ $userdata->website }}</a></div>
                        </div>
                    </div>
                    @endif
                    @if($userdata->company)
                    <div class="info-item">
                        <i class="fas fa-building"></i>
                        <div>
                            <div class="info-label">Company</div>
                            <div class="info-value">{{ $userdata->company }}</div>
                        </div>
                    </div>
                    @endif
                    @if($userdata->website)
                    <div class="info-item">
                        <i class="fas fa-globe"></i>
                        <div>
                            <div class="info-label">Website</div>
                            <div class="info-value"><a href="{{ $userdata->website }}" target="_blank" rel="noopener">{{ $userdata->website }}</a></div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Contact Actions -->
                <div class="contact-actions">
                    <a href="tel:{{ $userdata->phone ?? $userdata->mobile }}" class="contact-btn contact-btn-primary">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                    <a href="mailto:{{ $userdata->email }}" class="contact-btn contact-btn-secondary">
                        <i class="fas fa-envelope"></i> Send Email
                    </a>
                    @if($userdata->whatsapp ?? $userdata->mobile)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->whatsapp ?? $userdata->mobile) }}" class="contact-btn contact-btn-whatsapp" target="_blank">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Services Section -->
        @if(isset($menu->service) && $menu->service == '0' && count($professions) > 0)
        <div class="profile-card">
            <div class="profile-card-header">
                <i class="fas fa-briefcase"></i>
                <h2 class="profile-card-title">Services</h2>
            </div>
            <div class="profile-card-body">
                <div class="services-grid">
                    @foreach($professions as $profession)
                        <div class="service-card">
                            @if($profession->icon)
                                <div class="service-icon">
                                    <img src="{{ asset('public/frontend/profession_logo/'.$profession->icon) }}" alt="{{ $profession->profession }}">
                                </div>
                            @endif
                            <h3 class="service-name">{{ $profession->profession }}</h3>
                            @if($profession->designation)
                                <div class="service-detail">
                                    <i class="fas fa-id-badge"></i>
                                    <span>{{ $profession->designation }}</span>
                                </div>
                            @endif
                            @if($profession->phone)
                                <div class="service-detail">
                                    <i class="fas fa-phone"></i>
                                    <a href="tel:{{ $profession->phone }}">{{ $profession->phone }}</a>
                                </div>
                            @endif
                            @if($profession->email)
                                <div class="service-detail">
                                    <i class="fas fa-envelope"></i>
                                    <span>{{ $profession->email }}</span>
                                </div>
                            @endif
                            @if($profession->location)
                                <div class="service-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $profession->location }}</span>
                                </div>
                            @endif
                            @if($profession->website)
                                <div class="service-detail">
                                    <i class="fas fa-globe"></i>
                                    <a href="{{ $profession->website }}" target="_blank">Visit Website</a>
                                </div>
                            @endif
                            @if($profession->description)
                                <p class="service-description">{{ $profession->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Thoughts Section -->
        @if(count($thoughts) > 0)
        <div class="profile-card">
            <div class="profile-card-header">
                <i class="fas fa-lightbulb"></i>
                <h2 class="profile-card-title">Thoughts</h2>
            </div>
            <div class="profile-card-body">
                @foreach($thoughts as $thought)
                    <div class="thought-card">
                        <div class="thought-quote">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <h3 style="font-size: var(--text-xl); margin-bottom: var(--space-sm);">{{ $thought->thought }}</h3>
                        <p class="thought-text">{{ $thought->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Portfolio Section -->
        @if(($menu->personal ?? 1) == 0 || ($menu->profess ?? 1) == 0 || ($menu->videos ?? 1) == 0)
        <div class="profile-card">
            <div class="profile-card-header">
                <i class="fas fa-images"></i>
                <h2 class="profile-card-title">Portfolio</h2>
            </div>
            <div class="profile-card-body">
                <div class="portfolio-tabs">
                    @if(($menu->personal ?? 1) == 0)
                        <button class="portfolio-tab active" data-target="personal">Personal Photos</button>
                    @endif
                    @if(($menu->profess ?? 1) == 0)
                        <button class="portfolio-tab" data-target="professional">Professional Photos</button>
                    @endif
                    @if(($menu->videos ?? 1) == 0)
                        <button class="portfolio-tab" data-target="videos">Videos</button>
                    @endif
                </div>

                <!-- Personal Photos -->
                <div class="portfolio-content" id="personal">
                    <div class="gallery-grid">
                        @foreach($portfolios as $portfolio)
                            @foreach(json_decode($portfolio->image) as $image)
                                <div class="gallery-item" onclick="openModal('{{ url('public/frontend/portfolio', $image) }}')">
                                    <img src="{{ url('public/frontend/portfolio', $image) }}" alt="{{ $portfolio->title }}">
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                <!-- Professional Photos -->
                <div class="portfolio-content" id="professional" style="display: none;">
                    <div class="gallery-grid">
                        @foreach($professional_photos as $photo)
                            @foreach(json_decode($photo->image) as $image)
                                <div class="gallery-item" onclick="openModal('{{ url('public/frontend/professional_photos', $image) }}')">
                                    <img src="{{ url('public/frontend/professional_photos', $image) }}" alt="{{ $photo->title }}">
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                <!-- Videos -->
                <div class="portfolio-content" id="videos" style="display: none;">
                    <div class="gallery-grid">
                        @foreach($videos as $video)
                            <a href="{{ $video->video_link }}" target="_blank" class="gallery-item" style="display: flex; align-items: center; justify-content: center; background: var(--bg-secondary);">
                                <i class="fab fa-youtube" style="font-size: 48px; color: #ff0000;"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Products Section -->
        @if(isset($menu->product) && $menu->product == 0 && count($myproducts) > 0)
        <div class="profile-card">
            <div class="profile-card-header">
                <i class="fas fa-box"></i>
                <h2 class="profile-card-title">Products</h2>
            </div>
            <div class="profile-card-body">
                <div class="products-grid">
                    @foreach($myproducts as $product)
                        @php
                            $images = json_decode($product->images);
                        @endphp
                        <div class="product-card">
                            <div class="product-image">
                                @if($images && count($images) > 0)
                                    <img src="{{ asset('public/frontend/myproducts/'.$images[0]) }}" alt="{{ $product->title }}">
                                @endif
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">{{ $product->title }}</h3>
                                <div class="product-price">?{{ number_format($product->price) }}</div>
                                <button class="contact-btn contact-btn-primary" style="width: 100%; justify-content: center;" onclick="enquireProduct({{ $product->id }})">
                                    Enquire Now
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Qualifications Section -->
        @if(($menu->quali ?? 1) == 0 && count($qualifications) > 0)
        <div class="profile-card">
            <div class="profile-card-header">
                <i class="fas fa-graduation-cap"></i>
                <h2 class="profile-card-title">Qualifications</h2>
            </div>
            <div class="profile-card-body">
                <div class="qualification-grid">
                    @foreach($qualifications as $qual)
                        <div class="qualification-card">
                            <div class="qualification-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <h3 class="qualification-title">{{ $qual->qualifiaction }}</h3>
                            @if($qual->description)
                                <p class="qualification-desc">{{ $qual->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="profile-footer">
        <p>Powered by <a href="{{ url('/') }}" target="_blank">Fastap</a> - Digital Business Card</p>
    </footer>

    <!-- Image Modal -->
    <div class="modal-overlay" id="imageModal">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        <div class="modal-content">
            <img src="" alt="Preview" id="modalImage">
        </div>
    </div>

    @if($userdata->whatsapp ?? $userdata->mobile)
    <div class="profile-whatsapp-float">
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->whatsapp ?? $userdata->mobile) }}"
           class="profile-whatsapp-button"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    @endif

    <style>
    .profile-whatsapp-float {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 1200;
    }
    .profile-whatsapp-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: #ffffff;
        font-size: 26px;
        box-shadow: 0 10px 22px rgba(18, 140, 126, 0.35);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .profile-whatsapp-button:hover {
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 14px 26px rgba(18, 140, 126, 0.45);
    }
    @media (max-width: 640px) {
        .profile-whatsapp-float {
            bottom: 18px;
            right: 18px;
        }
        .profile-whatsapp-button {
            width: 52px;
            height: 52px;
            font-size: 24px;
        }
    }
    </style>

    <script>
        // Portfolio Tabs
        document.querySelectorAll('.portfolio-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.portfolio-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                document.querySelectorAll('.portfolio-content').forEach(content => {
                    content.style.display = 'none';
                });

                document.getElementById(this.dataset.target).style.display = 'block';
            });
        });

        // Image Modal
        function openModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.remove('active');
        }

        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Product Enquiry
        function enquireProduct(id) {
            alert('Product enquiry for ID: ' + id);
            // You can implement a modal form here
        }
    </script>
</body>
</html>

