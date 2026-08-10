<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ffffff">
    <title>Corporate Solutions - Fastap | NFC Digital Business Cards for Enterprise</title>
    <meta name="description" content="Fastap corporate solutions - bulk NFC business cards for enterprises. Empower your team with smart digital business cards.">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Material Symbols --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    {{-- New Design System CSS --}}
    <link rel="stylesheet" href="{{url('redesign/css/variables.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/base.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/components.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/theme-toggle.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/animations.css')}}">

    {{-- Theme Toggle Script --}}
    <script src="{{url('redesign/js/theme-toggle.js')}}"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    /* Page Hero */
    .page-hero {
        background: var(--bg-secondary);
        padding: var(--space-3xl) 0;
        position: relative;
        overflow: hidden;
    }

    .page-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: var(--gradient-purple);
        opacity: 0.1;
        border-radius: 50%;
        filter: blur(100px);
    }

    .page-hero-content {
        position: relative;
        z-index: 1;
    }

    .page-hero h1 {
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        font-weight: var(--font-extrabold);
        margin-bottom: var(--space-md);
    }

    .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        color: var(--text-secondary);
    }

    .breadcrumb-nav a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: color var(--transition-fast);
    }

    .breadcrumb-nav a:hover {
        color: var(--purple-500);
    }

    .breadcrumb-nav .current {
        color: var(--purple-500);
        font-weight: var(--font-medium);
    }

    /* Corporate Intro Section */
    .corporate-intro {
        padding: var(--space-3xl) 0;
    }

    .corporate-intro-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-3xl);
        align-items: center;
    }

    .corporate-text h2 {
        font-size: var(--text-3xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-lg);
        line-height: 1.3;
    }

    .corporate-text p {
        color: var(--text-secondary);
        margin-bottom: var(--space-md);
        line-height: 1.8;
    }

    .corporate-benefits {
        margin-top: var(--space-xl);
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-md);
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        padding: var(--space-md);
        background: var(--bg-secondary);
        border-radius: var(--radius-lg);
        transition: all var(--transition-base);
    }

    .benefit-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .benefit-item i {
        color: var(--purple-500);
        font-size: var(--text-xl);
    }

    .benefit-item span {
        font-weight: var(--font-medium);
        color: var(--text-primary);
    }

    .corporate-image {
        position: relative;
    }

    .corporate-image img {
        width: 100%;
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-2xl);
    }

    .corporate-image-badge {
        position: absolute;
        bottom: -20px;
        right: -20px;
        background: var(--gradient-purple);
        color: white;
        padding: var(--space-lg) var(--space-xl);
        border-radius: var(--radius-xl);
        text-align: center;
        box-shadow: var(--shadow-lg);
    }

    .corporate-image-badge .number {
        font-size: var(--text-3xl);
        font-weight: var(--font-extrabold);
        display: block;
    }

    .corporate-image-badge .label {
        font-size: var(--text-sm);
        opacity: 0.9;
    }

    /* Partners Section */
    .partners-section {
        background: var(--bg-secondary);
        padding: var(--space-3xl) 0;
    }

    .partners-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: var(--space-xl);
        margin-top: var(--space-2xl);
    }

    .partner-item {
        background: var(--bg-primary);
        border-radius: var(--radius-xl);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100px;
        transition: all var(--transition-base);
        border: 1px solid var(--border-light);
    }

    .partner-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--purple-300);
    }

    .partner-item img {
        max-width: 100%;
        max-height: 60px;
        object-fit: contain;
        filter: grayscale(100%);
        opacity: 0.7;
        transition: all var(--transition-base);
    }

    .partner-item:hover img {
        filter: grayscale(0);
        opacity: 1;
    }

    /* Corporate Form Section */
    .corporate-form-section {
        padding: var(--space-3xl) 0;
    }

    .corporate-form-wrapper {
        max-width: 900px;
        margin: 0 auto;
    }

    .corporate-form {
        background: var(--bg-primary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-2xl);
        padding: var(--space-2xl);
        box-shadow: var(--shadow-lg);
    }

    .form-header {
        text-align: center;
        margin-bottom: var(--space-2xl);
    }

    .form-header h3 {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-sm);
    }

    .form-header p {
        color: var(--text-secondary);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-lg);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: var(--space-xs);
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-weight: var(--font-medium);
        color: var(--text-primary);
        font-size: var(--text-sm);
    }

    .form-group input,
    .form-group select {
        padding: var(--space-md);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-size: var(--text-base);
        transition: all var(--transition-fast);
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--purple-500);
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
    }

    .form-group input::placeholder {
        color: var(--text-muted);
    }

    .color-preference {
        margin-top: var(--space-lg);
        padding-top: var(--space-lg);
        border-top: 1px solid var(--border-light);
    }

    .color-preference h4 {
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-md);
    }

    .color-options {
        display: flex;
        flex-wrap: wrap;
        gap: var(--space-sm);
    }

    .color-option {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-sm) var(--space-md);
        background: var(--bg-secondary);
        border: 2px solid var(--border-light);
        border-radius: var(--radius-full);
        cursor: pointer;
        transition: all var(--transition-fast);
    }

    .color-option:hover {
        border-color: var(--purple-300);
    }

    .color-option input {
        display: none;
    }

    .color-option input:checked + .color-label {
        font-weight: var(--font-semibold);
    }

    .color-option:has(input:checked) {
        border-color: var(--purple-500);
        background: rgba(139, 92, 246, 0.1);
    }

    .color-swatch {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 1px solid rgba(0,0,0,0.1);
    }

    .color-swatch.red { background: #ef4444; }
    .color-swatch.green { background: #22c55e; }
    .color-swatch.purple { background: #a855f7; }
    .color-swatch.golden { background: linear-gradient(135deg, #fbbf24, #d97706); }
    .color-swatch.black { background: #1f2937; }
    .color-swatch.assorted { background: linear-gradient(135deg, #ef4444, #fbbf24, #22c55e, #3b82f6, #a855f7); }

    .form-note {
        margin-top: var(--space-lg);
        padding: var(--space-md);
        background: rgba(245, 158, 11, 0.1);
        border-radius: var(--radius-lg);
        color: var(--text-secondary);
        font-size: var(--text-sm);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .form-note i {
        color: var(--amber-500);
    }

    .form-note a {
        color: var(--purple-500);
        font-weight: var(--font-medium);
    }

    .form-submit {
        margin-top: var(--space-xl);
        text-align: center;
    }

    .btn-submit {
        background: var(--gradient-purple);
        color: white;
        padding: var(--space-md) var(--space-3xl);
        border: none;
        border-radius: var(--radius-full);
        font-weight: var(--font-semibold);
        font-size: var(--text-base);
        cursor: pointer;
        transition: all var(--transition-fast);
        display: inline-flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
    }

    /* Stats Section */
    .corporate-stats {
        background: var(--bg-secondary);
        padding: var(--space-3xl) 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--space-xl);
    }

    .stat-item {
        text-align: center;
        padding: var(--space-xl);
        background: var(--bg-primary);
        border-radius: var(--radius-xl);
        transition: all var(--transition-base);
        border: 1px solid var(--border-light);
    }

    .stat-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto var(--space-md);
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .stat-item:nth-child(1) .stat-icon {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
        color: var(--purple-500);
    }

    .stat-item:nth-child(2) .stat-icon {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%);
        color: var(--blue-500);
    }

    .stat-item:nth-child(3) .stat-icon {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(52, 211, 153, 0.15) 100%);
        color: var(--green-500);
    }

    .stat-item:nth-child(4) .stat-icon {
        background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(251, 146, 60, 0.15) 100%);
        color: var(--orange-500);
    }

    .stat-number {
        font-size: var(--text-3xl);
        font-weight: var(--font-extrabold);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: var(--text-sm);
    }

    /* CTA Section */
    .corporate-cta {
        padding: var(--space-3xl) 0;
    }

    .cta-box {
        background: var(--gradient-purple);
        border-radius: var(--radius-2xl);
        padding: var(--space-3xl);
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .cta-box::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .cta-box h2 {
        font-size: var(--text-3xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-md);
        position: relative;
        z-index: 1;
    }

    .cta-box p {
        opacity: 0.9;
        margin-bottom: var(--space-xl);
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        z-index: 1;
    }

    .cta-buttons {
        display: flex;
        gap: var(--space-md);
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    .cta-buttons .btn-white {
        background: white;
        color: var(--purple-600);
        padding: var(--space-md) var(--space-xl);
        border-radius: var(--radius-full);
        font-weight: var(--font-semibold);
        text-decoration: none;
        transition: all var(--transition-fast);
    }

    .cta-buttons .btn-white:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .cta-buttons .btn-outline-white {
        background: transparent;
        color: white;
        border: 2px solid white;
        padding: var(--space-md) var(--space-xl);
        border-radius: var(--radius-full);
        font-weight: var(--font-semibold);
        text-decoration: none;
        transition: all var(--transition-fast);
    }

    .cta-buttons .btn-outline-white:hover {
        background: white;
        color: var(--purple-600);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .partners-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 992px) {
        .corporate-intro-grid {
            grid-template-columns: 1fr;
            gap: var(--space-2xl);
        }

        .corporate-image {
            order: -1;
        }

        .partners-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .corporate-benefits {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .partners-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .cta-buttons {
            flex-direction: column;
        }

        .color-options {
            justify-content: center;
        }
    }
    </style>
</head>
<body>
    {{-- Header --}}
    @include('frontend.header-new')

    {{-- Page Hero --}}
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content fade-up">
                <h1><span class="text-gradient-purple">Corporate</span> Solutions</h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="current">Corporate</span>
                </nav>
            </div>
        </div>
    </section>

    {{-- Corporate Intro --}}
    <section class="corporate-intro">
        <div class="container">
            <div class="corporate-intro-grid">
                <div class="corporate-text fade-up">
                    <h2>Enterprise NFC Solutions for Modern Businesses</h2>
                    <p>
                        Transform your organization's networking capabilities with Fastap's corporate solutions.
                        Our bulk NFC business cards empower teams to make lasting impressions while maintaining
                        brand consistency across your entire organization.
                    </p>
                    <p>
                        Whether you're a startup or a Fortune 500 company, we provide tailored solutions
                        that scale with your business needs. Get custom branding, centralized management,
                        and dedicated support for your team.
                    </p>
                    <div class="corporate-benefits">
                        <div class="benefit-item">
                            <i class="fas fa-tags"></i>
                            <span>Bulk Pricing</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-palette"></i>
                            <span>Custom Branding</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-users-cog"></i>
                            <span>Team Management</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-headset"></i>
                            <span>Priority Support</span>
                        </div>
                    </div>
                </div>
                <div class="corporate-image fade-in">
                    <img src="{{url('frontend/assets/img/about/about2.png')}}" alt="Corporate Solutions">
                    <div class="corporate-image-badge">
                        <span class="number">150+</span>
                        <span class="label">Corporate Clients</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Partners Section --}}
    @php
        $brand_logo = App\Models\brand_logo::all();
    @endphp

    @if($brand_logo->count() > 0)
    <section class="partners-section">
        <div class="container">
            <div class="section-header text-center fade-up">
                <h2 class="section-title">Our Branding Partners</h2>
                <p class="section-subtitle">Trusted by leading companies across industries</p>
            </div>
            <div class="partners-grid stagger-animation">
                @foreach($brand_logo as $item)
                <div class="partner-item fade-up">
                    <img src="{{ url('uploads/product_images/'.$item->logo)}}" alt="Brand Partner">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Corporate Stats --}}
    <section class="corporate-stats">
        <div class="container">
            <div class="stats-grid stagger-animation">
                <div class="stat-item fade-up">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-number">150+</div>
                    <div class="stat-label">Corporate Clients</div>
                </div>
                <div class="stat-item fade-up">
                    <div class="stat-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Cards Deployed</div>
                </div>
                <div class="stat-item fade-up">
                    <div class="stat-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="stat-number">25+</div>
                    <div class="stat-label">Cities Served</div>
                </div>
                <div class="stat-item fade-up">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number">4.9</div>
                    <div class="stat-label">Client Rating</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Corporate Form Section --}}
    <section class="corporate-form-section" id="inquiry-form">
        <div class="container">
            <div class="corporate-form-wrapper">
                <div class="corporate-form fade-up">
                    <div class="form-header">
                        <h3>Get a Corporate Quote</h3>
                        <p>Fill out the form below to get an estimate for bulk business card orders</p>
                    </div>

                    <form method="POST" action="{{ url('savecorporate') }}">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="fname">First Name *</label>
                                <input type="text" name="fname" id="fname" placeholder="Enter your first name" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name *</label>
                                <input type="text" name="lname" id="lname" placeholder="Enter your last name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" name="email" id="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="cname">Company Name *</label>
                                <input type="text" name="cname" id="cname" placeholder="Enter your company name" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City *</label>
                                <input type="text" name="city" id="city" placeholder="Enter your city" required>
                            </div>
                            <div class="form-group">
                                <label for="state">State *</label>
                                <input type="text" name="state" id="state" placeholder="Enter your state" required>
                            </div>
                            <div class="form-group">
                                <label for="country">Country *</label>
                                <input type="text" name="country" id="country" placeholder="Enter your country" required>
                            </div>
                            <div class="form-group">
                                <label for="company_size">Company Size (Min. 5) *</label>
                                <input type="number" name="company_size" id="company_size" placeholder="Number of cards needed" min="5" required>
                            </div>
                        </div>

                        <div class="color-preference">
                            <h4>Card Color Preference</h4>
                            <div class="color-options">
                                <label class="color-option">
                                    <input type="radio" name="color" value="red">
                                    <span class="color-swatch red"></span>
                                    <span class="color-label">Red</span>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="color" value="green">
                                    <span class="color-swatch green"></span>
                                    <span class="color-label">Green</span>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="color" value="purple">
                                    <span class="color-swatch purple"></span>
                                    <span class="color-label">Purple</span>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="color" value="golden">
                                    <span class="color-swatch golden"></span>
                                    <span class="color-label">Golden</span>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="color" value="black">
                                    <span class="color-swatch black"></span>
                                    <span class="color-label">Black</span>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="color" value="assorted" checked>
                                    <span class="color-swatch assorted"></span>
                                    <span class="color-label">Assorted</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-note">
                            <i class="fas fa-info-circle"></i>
                            <span>For teams smaller than 5 members, we recommend our <a href="{{ url('/') }}">individual Fastap cards</a>.</span>
                        </div>

                        <div class="form-submit">
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane"></i>
                                Submit Inquiry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="corporate-cta">
        <div class="container">
            <div class="cta-box fade-up">
                <h2>Ready to Upgrade Your Team?</h2>
                <p>Join 150+ companies that trust Fastap for their digital business card needs. Contact us today for a personalized quote.</p>
                <div class="cta-buttons">
                    <a href="#inquiry-form" class="btn-white">
                        <i class="fas fa-file-alt"></i> Get Quote
                    </a>
                    <a href="{{ url('/Contact-Us') }}" class="btn-outline-white">
                        <i class="fas fa-phone"></i> Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('frontend.footer-new')

    {{-- WhatsApp Button --}}
    @include('frontend.whatsapp-new')

    {{-- Scripts --}}
    <script src="{{url('redesign/js/animations.js')}}"></script>

    {{-- Success Message --}}
    @if ($message = Session::get('message_corporate'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({
            icon: 'success',
            title: 'Thank you for your corporate inquiry! We will contact you soon.'
        });
    </script>
    @endif
</body>
</html>
