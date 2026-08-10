{{-- ========================================
     FASTAP - Modern Hero Section
     Clean, professional hero with gradient
     ======================================== --}}

<section class="hero-section">
    <div class="hero-background">
        <div class="hero-gradient"></div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        {{-- Decorative Elements - Upgraded NFC Theme --}}
        <img src="{{url('frontend/assets/img/redesign/elements/nfc-waves.svg')}}" alt="NFC Waves" class="hero-decoration decoration-nfcwaves">
        <img src="{{url('frontend/assets/img/redesign/elements/card-float-1.svg')}}" alt="Floating Card" class="hero-decoration decoration-card1">
        <img src="{{url('frontend/assets/img/redesign/elements/card-float-2.svg')}}" alt="Floating Card 2" class="hero-decoration decoration-card2">
        <img src="{{url('frontend/assets/img/redesign/elements/wireless-nodes.svg')}}" alt="Wireless Nodes" class="hero-decoration decoration-nodes">
        <img src="{{url('frontend/assets/img/redesign/elements/digital-pulse.svg')}}" alt="Digital Pulse" class="hero-decoration decoration-pulse">
    </div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-text fade-up">
                <span class="hero-badge badge badge-purple">
                    <i class="fas fa-sparkles"></i>
                    NFC Technology
                </span>
                <h1 class="hero-title">
                    Redefine Your Networking with
                    <span class="text-gradient-purple">NFC Digital Cards</span>
                </h1>
                <p class="hero-description">
                    Instantly share your professional identity, portfolio, and contact details with a single tap. Modernize your connections and leave a lasting impression.
                </p>

                <div class="hero-cta">
                    <a href="{{url('/Product')}}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart"></i>
                        Shop Now
                    </a>
                    <a href="#how-it-works" class="btn btn-outline btn-lg">
                        <i class="fas fa-play-circle"></i>
                        Learn More
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number" data-count="10000">0</div>
                        <div class="stat-label">Happy Customers</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="50000">0</div>
                        <div class="stat-label">Cards Delivered</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="99">0</div>
                        <div class="stat-label">% Satisfaction</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual fade-in">
                <div class="hero-image-container">
                    <img src="{{url('frontend/assets/img/redesign/hero/hero-ai-tech.svg')}}" alt="Fastap AI Technology" class="hero-main-image">

                    {{-- Feature Pills --}}
                    <div class="feature-pill pill-1">
                        <i class="fas fa-wifi"></i>
                        <span>Instant Sharing</span>
                    </div>
                    <div class="feature-pill pill-2">
                        <i class="fas fa-shield-alt"></i>
                        <span>Secure & Safe</span>
                    </div>
                    <div class="feature-pill pill-3">
                        <i class="fas fa-leaf"></i>
                        <span>Eco-Friendly</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<style>
/* ============= HERO SECTION ============= */
.hero-section {
    position: relative;
    min-height: calc(100vh - 73px);
    display: flex;
    align-items: center;
    overflow: hidden;
    padding: var(--space-3xl) 0;
}

/* Background */
.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: -1;
}

.hero-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg,
        rgba(124, 58, 237, 0.05) 0%,
        rgba(236, 72, 153, 0.05) 50%,
        rgba(249, 115, 22, 0.05) 100%
    );
}

/* Animated Shapes */
.hero-shapes {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.shape {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    opacity: 0.3;
}

.shape-1 {
    width: 400px;
    height: 400px;
    background: var(--gradient-purple);
    top: -200px;
    right: -100px;
    animation: float 20s ease-in-out infinite;
}

.shape-2 {
    width: 300px;
    height: 300px;
    background: var(--gradient-pink);
    bottom: -150px;
    left: -100px;
    animation: float 15s ease-in-out infinite reverse;
}

.shape-3 {
    width: 200px;
    height: 200px;
    background: var(--gradient-blue);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: pulse 10s ease-in-out infinite;
}

/* Content Layout */
.hero-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-3xl);
    align-items: center;
}

/* Text Content */
.hero-text {
    max-width: 600px;
}

.hero-badge {
    margin-bottom: var(--space-md);
    display: inline-flex;
}

.hero-title {
    font-size: var(--text-6xl);
    line-height: 1.1;
    margin-bottom: var(--space-lg);
    font-weight: var(--font-extrabold);
}

.hero-description {
    font-size: var(--text-xl);
    color: var(--text-secondary);
    margin-bottom: var(--space-2xl);
    line-height: var(--leading-relaxed);
}

/* CTA Buttons */
.hero-cta {
    display: flex;
    gap: var(--space-md);
    margin-bottom: var(--space-2xl);
}

/* Stats */
.hero-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-lg);
    padding-top: var(--space-xl);
    border-top: 1px solid var(--border-light);
}

.stat-item {
    text-align: left;
}

.stat-item .stat-number {
    font-size: var(--text-3xl);
    font-weight: var(--font-extrabold);
    background: var(--gradient-purple);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: var(--space-xs);
    display: block;
}

.stat-item .stat-label {
    font-size: var(--text-sm);
    color: var(--text-muted);
    font-weight: var(--font-medium);
}

/* Visual Showcase */
.hero-visual {
    position: relative;
}

.hero-image-container {
    position: relative;
    width: 100%;
    min-height: 600px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.hero-main-image {
    width: 140%;
    max-width: none;
    height: auto;
    margin-right: -20%;
    margin-top: -5%;
    animation: float 6s ease-in-out infinite;
    filter: drop-shadow(0 10px 30px rgba(124, 58, 237, 0.3));
}

/* Feature Pills */
.feature-pill {
    position: absolute;
    display: flex;
    align-items: center;
    gap: var(--space-xs);
    padding: 0.75rem 1.25rem;
    background: var(--card-bg);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-full);
    box-shadow: var(--shadow-lg);
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
    color: var(--text-primary);
    white-space: nowrap;
}

.feature-pill i {
    color: var(--purple-500);
}

.pill-1 {
    top: 15%;
    right: 10%;
    animation: float 6s ease-in-out infinite;
}

.pill-2 {
    bottom: 25%;
    left: 5%;
    animation: float 7s ease-in-out infinite 1s;
}

.pill-3 {
    top: 60%;
    right: 5%;
    animation: float 8s ease-in-out infinite 2s;
}

/* Decorative Elements - Updated Positions */
.hero-decoration {
    position: absolute;
    z-index: 0;
    opacity: 0.5;
    pointer-events: none;
}

.decoration-nfcwaves {
    width: 200px;
    top: 10%;
    left: 5%;
    animation: float 10s ease-in-out infinite;
}

.decoration-card1 {
    width: 90px;
    top: 20%;
    right: 8%;
    animation: float 12s ease-in-out infinite 1s;
}

.decoration-card2 {
    width: 90px;
    bottom: 20%;
    left: 8%;
    animation: float 11s ease-in-out infinite 2s;
}

.decoration-nodes {
    width: 100px;
    top: 50%;
    right: 5%;
    animation: float 13s ease-in-out infinite 1.5s;
}

.decoration-pulse {
    width: 150px;
    bottom: 10%;
    right: 15%;
    animation: float 9s ease-in-out infinite 0.5s;
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: var(--space-2xl);
    left: 50%;
    transform: translateX(-50%);
    color: var(--text-muted);
    font-size: var(--text-2xl);
    animation: scroll-indicator 2s ease-in-out infinite;
}

/* Responsive */
@media (max-width: 992px) {
    .hero-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .hero-text {
        max-width: 100%;
    }

    .hero-title {
        font-size: var(--text-5xl);
    }

    .hero-cta {
        justify-content: center;
    }

    .hero-stats {
        justify-content: center;
    }

    .hero-visual {
        margin-top: var(--space-2xl);
    }

    .hero-image-container {
        justify-content: center;
    }

    .hero-main-image {
        width: 100%;
        max-width: 600px;
        margin-right: 0;
        margin-top: 0;
    }
}

@media (max-width: 768px) {
    .hero-section {
        min-height: auto;
        padding: var(--space-2xl) 0;
    }

    .hero-title {
        font-size: var(--text-4xl);
    }

    .hero-description {
        font-size: var(--text-lg);
    }

    .hero-cta {
        flex-direction: column;
        width: 100%;
    }

    .hero-cta .btn {
        width: 100%;
    }

    .hero-stats {
        grid-template-columns: 1fr;
        gap: var(--space-md);
    }

    .stat-item {
        text-align: center;
    }

    .hero-image-container {
        min-height: 400px;
    }

    .hero-main-image {
        width: 100%;
        max-width: 500px;
    }

    .feature-pill {
        font-size: var(--text-xs);
        padding: 0.5rem 1rem;
    }

    .scroll-indicator {
        display: none;
    }

    /* Hide some decorations on mobile */
    .decoration-nodes,
    .decoration-pulse {
        display: none;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: var(--text-3xl);
    }

    .hero-image-container {
        min-height: 300px;
    }

    .hero-main-image {
        width: 100%;
        max-width: 350px;
    }

    .decoration-card2 {
        display: none;
    }
}
</style>
