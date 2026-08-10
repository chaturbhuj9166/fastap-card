<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ffffff">
    <title>About Us - Fastap | NFC Digital Business Cards</title>
    <meta name="description" content="Learn about Fastap - India's leading provider of NFC digital business cards. Discover our mission to revolutionize professional networking.">

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

    /* About Section */
    .about-intro {
        padding: var(--space-3xl) 0;
    }

    .about-intro-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-3xl);
        align-items: center;
    }

    .about-image {
        position: relative;
    }

    .about-image img {
        width: 100%;
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-2xl);
    }

    .about-image-badge {
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

    .about-image-badge .number {
        font-size: var(--text-3xl);
        font-weight: var(--font-extrabold);
        display: block;
    }

    .about-image-badge .label {
        font-size: var(--text-sm);
        opacity: 0.9;
    }

    .about-text h2 {
        font-size: var(--text-3xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-lg);
        line-height: 1.3;
    }

    .about-text p {
        color: var(--text-secondary);
        margin-bottom: var(--space-md);
        line-height: 1.8;
    }

    .about-features-list {
        margin-top: var(--space-xl);
    }

    .about-feature-item {
        display: flex;
        align-items: flex-start;
        gap: var(--space-md);
        margin-bottom: var(--space-md);
    }

    .about-feature-item i {
        color: var(--green-500);
        font-size: var(--text-xl);
        margin-top: 2px;
    }

    .about-feature-item span {
        color: var(--text-primary);
        font-weight: var(--font-medium);
    }

    /* Mission Vision Section */
    .mission-vision {
        background: var(--bg-secondary);
        padding: var(--space-3xl) 0;
    }

    .mv-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-2xl);
    }

    .mv-card {
        background: var(--bg-primary);
        border-radius: var(--radius-2xl);
        padding: var(--space-2xl);
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .mv-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }

    .mv-card.mission::before {
        background: var(--gradient-purple);
    }

    .mv-card.vision::before {
        background: var(--gradient-blue);
    }

    .mv-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-2xl);
        margin-bottom: var(--space-lg);
    }

    .mv-card.mission .mv-icon {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
        color: var(--purple-500);
    }

    .mv-card.vision .mv-icon {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%);
        color: var(--blue-500);
    }

    .mv-card h3 {
        font-size: var(--text-xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-md);
    }

    .mv-card p {
        color: var(--text-secondary);
        line-height: 1.7;
    }

    /* Stats Section */
    .about-stats {
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
        background: var(--bg-secondary);
        border-radius: var(--radius-xl);
        transition: all var(--transition-base);
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

    /* Values Section */
    .our-values {
        background: var(--bg-secondary);
        padding: var(--space-3xl) 0;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-xl);
        margin-top: var(--space-2xl);
    }

    .value-card {
        background: var(--bg-primary);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        text-align: center;
        transition: all var(--transition-base);
        border: 1px solid var(--border-light);
    }

    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--purple-300);
    }

    .value-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto var(--space-lg);
        border-radius: var(--radius-xl);
        background: var(--gradient-purple);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-2xl);
        color: white;
    }

    .value-card h4 {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-sm);
    }

    .value-card p {
        color: var(--text-secondary);
        font-size: var(--text-sm);
        line-height: 1.6;
    }

    /* CTA Section */
    .about-cta {
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
    @media (max-width: 992px) {
        .about-intro-grid {
            grid-template-columns: 1fr;
            gap: var(--space-2xl);
        }

        .about-image {
            order: -1;
        }

        .mv-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .values-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }

        .cta-buttons {
            flex-direction: column;
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
                <h1>About <span class="text-gradient-purple">Fastap</span></h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="current">About Us</span>
                </nav>
            </div>
        </div>
    </section>

    {{-- About Intro --}}
    <section class="about-intro">
        <div class="container">
            <div class="about-intro-grid">
                <div class="about-image fade-in">
                    <img src="{{url('frontend/assets/img/about/about2.png')}}" alt="About Fastap">
                    <div class="about-image-badge">
                        <span class="number">5+</span>
                        <span class="label">Years Experience</span>
                    </div>
                </div>
                <div class="about-text fade-up">
                    <h2>Revolutionizing Professional Networking with NFC Technology</h2>
                    <p>
                        Fastap is India's leading provider of NFC-enabled digital business cards. We believe that
                        first impressions matter, and your business card should reflect the innovative professional you are.
                    </p>
                    <p>
                        Our smart cards combine cutting-edge NFC technology with elegant design, allowing you to share
                        your complete professional profile with just a tap. No apps required, no contact details lost.
                    </p>
                    <div class="about-features-list">
                        <div class="about-feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Instant contact sharing with a single tap</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Eco-friendly - reduce paper waste</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Real-time profile updates</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Analytics dashboard included</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Mission & Vision --}}
    <section class="mission-vision">
        <div class="container">
            <div class="section-header text-center fade-up">
                <h2 class="section-title">Our Mission & Vision</h2>
                <p class="section-subtitle">Driving innovation in professional networking</p>
            </div>
            <div class="mv-grid stagger-animation">
                <div class="mv-card mission fade-up">
                    <div class="mv-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>
                        To empower professionals and businesses with innovative digital solutions that simplify
                        networking, enhance brand presence, and create lasting impressions. We are committed to
                        delivering premium quality NFC cards that combine technology with elegance.
                    </p>
                </div>
                <div class="mv-card vision fade-up">
                    <div class="mv-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p>
                        To become the global leader in digital business card solutions, making traditional paper
                        cards obsolete. We envision a future where every professional carries a smart card that
                        represents their digital identity instantly and sustainably.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="about-stats">
        <div class="container">
            <div class="stats-grid stagger-animation">
                <div class="stat-item fade-up">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number" data-target="2700">0</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                <div class="stat-item fade-up">
                    <div class="stat-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="stat-number" data-target="3600">0</div>
                    <div class="stat-label">Cards Delivered</div>
                </div>
                <div class="stat-item fade-up">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-number" data-target="150">0</div>
                    <div class="stat-label">Corporate Clients</div>
                </div>
                <div class="stat-item fade-up">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number" data-target="25">0</div>
                    <div class="stat-label">Awards Won</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Values --}}
    <section class="our-values">
        <div class="container">
            <div class="section-header text-center fade-up">
                <h2 class="section-title">Our Core Values</h2>
                <p class="section-subtitle">The principles that guide everything we do</p>
            </div>
            <div class="values-grid stagger-animation">
                <div class="value-card fade-up">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4>Innovation</h4>
                    <p>We constantly push boundaries to bring you the latest in NFC technology and digital solutions.</p>
                </div>
                <div class="value-card fade-up">
                    <div class="value-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4>Quality</h4>
                    <p>Premium materials, elegant designs, and flawless functionality in every card we create.</p>
                </div>
                <div class="value-card fade-up">
                    <div class="value-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h4>Sustainability</h4>
                    <p>Committed to reducing paper waste and promoting eco-friendly networking solutions.</p>
                </div>
                <div class="value-card fade-up">
                    <div class="value-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4>Trust</h4>
                    <p>Building lasting relationships with customers through transparency and reliability.</p>
                </div>
                <div class="value-card fade-up">
                    <div class="value-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>Support</h4>
                    <p>Dedicated customer service to help you make the most of your digital business card.</p>
                </div>
                <div class="value-card fade-up">
                    <div class="value-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h4>Growth</h4>
                    <p>Helping professionals and businesses grow their network and opportunities.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="about-cta">
        <div class="container">
            <div class="cta-box fade-up">
                <h2>Ready to Go Digital?</h2>
                <p>Join thousands of professionals who have upgraded to smart NFC business cards. Make your networking effortless and memorable.</p>
                <div class="cta-buttons">
                    <a href="{{ url('/Product') }}" class="btn-white">
                        <i class="fas fa-shopping-bag"></i> Shop Now
                    </a>
                    <a href="{{ url('/Contact-Us') }}" class="btn-outline-white">
                        <i class="fas fa-envelope"></i> Contact Us
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
</body>
</html>
