<!-- Keep all content before line 219 as is -->
<!-- Professions Showcase Section -->
<section class="professions-showcase-section" style="padding: 5rem 0; background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%); position: relative; overflow: hidden;">

    <!-- Decorative Background Elements -->
    <div class="profession-bg-element profession-bg-1" style="position: absolute; top: 10%; left: 5%; width: 80px; height: 80px; opacity: 0.4;">
        <img src="{{ asset('frontend/assets/img/redesign/elements/nfc-waves.svg') }}" alt="" style="width: 100%; height: 100%;">
    </div>
    <div class="profession-bg-element profession-bg-2" style="position: absolute; top: 20%; right: 8%; width: 120px; height: 80px; opacity: 0.3;">
        <img src="{{ asset('frontend/assets/img/redesign/elements/card-float-1.svg') }}" alt="" style="width: 100%; height: 100%;">
    </div>
    <div class="profession-bg-element profession-bg-3" style="position: absolute; bottom: 15%; left: 10%; width: 100px; height: 100px; opacity: 0.35;">
        <img src="{{ asset('frontend/assets/img/redesign/elements/wireless-nodes.svg') }}" alt="" style="width: 100%; height: 100%;">
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; position: relative; z-index: 2;">

        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 5rem;">
            <div style="display: inline-block; padding: 0.25rem 1rem; background: linear-gradient(135deg, #7c3aed, #ec4899); border-radius: 9999px; margin-bottom: 1rem;">
                <span style="color: #ffffff; font-size: 0.875rem; font-weight: 600; letter-spacing: 0.05em;">OUR SOLUTIONS</span>
            </div>

            <h2 class="professions-title" style="font-size: clamp(32px, 5vw, 48px); font-weight: 700; color: #1e293b; margin-bottom: 1rem; line-height: 1.2;">
                NFC Cards Tailored for
                <span style="background: linear-gradient(135deg, #7c3aed, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Your Profession</span>
            </h2>

            <p class="professions-subtitle" style="font-size: 1.125rem; color: #64748b; max-width: 700px; margin: 0 auto 1.5rem; line-height: 1.6;">
                Choose from our professionally designed NFC cards, each customized for your industry with theme-based layouts and features.
            </p>
        </div>

        <!-- Professions Grid -->
        <div class="professions-grid-new" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; margin-bottom: 3rem;">

            <!-- Doctor Card -->
            <div class="prof-card" data-profession="doctor">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/doctor-card.svg') }}" alt="Medical Professional">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Medical Professional</h3>
                    <p class="prof-card-desc">Perfect for doctors, clinics, and healthcare providers to share information.</p>
                    <div class="prof-card-tag">Medical</div>
                    <a href="{{ url('/theme-preview/medical') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Event & Photographer Card -->
            <div class="prof-card" data-profession="photographer">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/photographer-card.svg') }}" alt="Creative Showcase">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Creative Showcase</h3>
                    <p class="prof-card-desc">Ideal for photographers and creatives to display their work beautifully.</p>
                    <div class="prof-card-tag">Portfolio</div>
                    <a href="{{ url('/theme-preview/creative') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Service Provider Card -->
            <div class="prof-card" data-profession="service">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/service-provider-card.svg') }}" alt="Service Provider">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Service Provider</h3>
                    <p class="prof-card-desc">Built for maintenance and service companies to showcase their offerings.</p>
                    <div class="prof-card-tag">Service</div>
                    <a href="{{ url('/theme-preview/service') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Manufacturing Card -->
            <div class="prof-card" data-profession="manufacturing">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/manufacturing-card.svg') }}" alt="Manufacturing Company">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Manufacturing Company</h3>
                    <p class="prof-card-desc">Designed for industrial businesses to present capabilities and details.</p>
                    <div class="prof-card-tag">Industrial</div>
                    <a href="{{ url('/theme-preview/manufacturing') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Product Company Card -->
            <div class="prof-card" data-profession="product">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/product-company-card.svg') }}" alt="Product Retailer">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Product Retailer</h3>
                    <p class="prof-card-desc">Perfect for stores and retailers to showcase products with easy access.</p>
                    <div class="prof-card-tag">Retail</div>
                    <a href="{{ url('/theme-preview/retail') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Real Estate Card -->
            <div class="prof-card" data-profession="realestate">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/real-estate-card.svg') }}" alt="Real Estate">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Real Estate Pro</h3>
                    <p class="prof-card-desc">Essential for agents and brokers to share property listings instantly.</p>
                    <div class="prof-card-tag">Real Estate</div>
                    <a href="{{ url('/theme-preview/realestate') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Actor & Model Card -->
            <div class="prof-card" data-profession="actor">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/actor-model-card.svg') }}" alt="Actors & Models">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Actors & Models</h3>
                    <p class="prof-card-desc">Showcase portfolios, headshots, and reels for casting opportunities.</p>
                    <div class="prof-card-tag">Entertainment</div>
                    <a href="{{ url('/theme-preview/entertainment') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Production House Card -->
            <div class="prof-card" data-profession="production">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/production-house-card.svg') }}" alt="Production House">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Production House</h3>
                    <p class="prof-card-desc">Tailored for film, video, and media production company portfolios.</p>
                    <div class="prof-card-tag">Media</div>
                    <a href="{{ url('/theme-preview/production') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Multi Service Provider Card -->
            <div class="prof-card" data-profession="multiservice">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/multi-service-card.svg') }}" alt="Multi-Service Provider">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Multi-Service Provider</h3>
                    <p class="prof-card-desc">Versatile design for businesses offering multiple service categories.</p>
                    <div class="prof-card-tag">Multi-Service</div>
                    <a href="{{ url('/theme-preview/multiservice') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Jewellery Card -->
            <div class="prof-card" data-profession="jewellery">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/jewellery-card.svg') }}" alt="Jewellery & Luxury">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Jewellery & Luxury</h3>
                    <p class="prof-card-desc">Premium cards for luxury brands showcasing exquisite collections.</p>
                    <div class="prof-card-tag">Luxury</div>
                    <a href="{{ url('/theme-preview/luxury') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- IT Service Card -->
            <div class="prof-card" data-profession="it">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/it-service-card.svg') }}" alt="IT & Technology">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">IT & Technology</h3>
                    <p class="prof-card-desc">Modern design for IT companies, startups, and tech professionals.</p>
                    <div class="prof-card-tag">Technology</div>
                    <a href="{{ url('/theme-preview/technology') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Product Based Company Card -->
            <div class="prof-card" data-profession="productbased">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/product-based-company-card.svg') }}" alt="Product Based Company">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Product Company</h3>
                    <p class="prof-card-desc">Designed for companies developing and selling unique product lines.</p>
                    <div class="prof-card-tag">Products</div>
                    <a href="{{ url('/theme-preview/product') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Restaurant/Hotel Card -->
            <div class="prof-card" data-profession="restaurant">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/restaurant-card.svg') }}" alt="Restaurant & Hotel">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Restaurant & Hotel</h3>
                    <p class="prof-card-desc">Complete menu management and reservations for restaurants, hotels, and cafes.</p>
                    <div class="prof-card-tag">Hospitality</div>
                    <a href="{{ url('/theme-preview/restaurant') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Travel Agent Card -->
            <div class="prof-card" data-profession="travel">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/travel-agent-card.svg') }}" alt="Travel Agent">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Travel Agent</h3>
                    <p class="prof-card-desc">Perfect for travel agencies and tour operators to showcase destinations and packages.</p>
                    <div class="prof-card-tag">Travel</div>
                    <a href="{{ url('/theme-preview/travel') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Gym & Fitness Card -->
            <div class="prof-card" data-profession="fitness">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/fitness-card.svg') }}" alt="Gym & Fitness">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Gym & Fitness</h3>
                    <p class="prof-card-desc">Ideal for gyms, personal trainers, and yoga instructors to showcase programs.</p>
                    <div class="prof-card-tag">Fitness</div>
                    <a href="{{ url('/theme-preview/fitness') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Education Card -->
            <div class="prof-card" data-profession="education">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/education-card.svg') }}" alt="Education">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Education</h3>
                    <p class="prof-card-desc">Built for coaching centers, schools, and tutors to display courses and results.</p>
                    <div class="prof-card-tag">Education</div>
                    <a href="{{ url('/theme-preview/education') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Lawyer Card -->
            <div class="prof-card" data-profession="lawyer">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/lawyer-card.svg') }}" alt="Lawyer">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Lawyer</h3>
                    <p class="prof-card-desc">Professional design for lawyers and advocates to showcase practice areas and expertise.</p>
                    <div class="prof-card-tag">Legal</div>
                    <a href="{{ url('/theme-preview/lawyer') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- CA & Accountant Card -->
            <div class="prof-card" data-profession="accountant">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/accountant-card.svg') }}" alt="CA & Accountant">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">CA & Accountant</h3>
                    <p class="prof-card-desc">Designed for chartered accountants and tax consultants to display services.</p>
                    <div class="prof-card-tag">Finance</div>
                    <a href="{{ url('/theme-preview/accountant') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Salon & Beauty Card -->
            <div class="prof-card" data-profession="salon">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/salon-card.svg') }}" alt="Salon & Beauty">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Salon & Beauty</h3>
                    <p class="prof-card-desc">Perfect for salons, beauty parlors, and makeup artists to showcase services and packages.</p>
                    <div class="prof-card-tag">Beauty</div>
                    <a href="{{ url('/theme-preview/salon') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Interior Designer Card -->
            <div class="prof-card" data-profession="interior">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/interior-card.svg') }}" alt="Interior Designer">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Interior Designer</h3>
                    <p class="prof-card-desc">Elegant design for interior designers and modular kitchen manufacturers.</p>
                    <div class="prof-card-tag">Design</div>
                    <a href="{{ url('/theme-preview/interior') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Solar Energy Card -->
            <div class="prof-card" data-profession="solar">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/solar-card.svg') }}" alt="Solar Energy">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Solar Energy</h3>
                    <p class="prof-card-desc">Built for solar panel dealers and renewable energy solution providers.</p>
                    <div class="prof-card-tag">Energy</div>
                    <a href="{{ url('/theme-preview/solar') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- CCTV & Security Card -->
            <div class="prof-card" data-profession="security">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/security-card.svg') }}" alt="CCTV & Security">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">CCTV & Security</h3>
                    <p class="prof-card-desc">Industrial design for security camera dealers and surveillance system providers.</p>
                    <div class="prof-card-tag">Security</div>
                    <a href="{{ url('/theme-preview/security') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Astrologer Card -->
            <div class="prof-card" data-profession="astrologer">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/astrologer-card.svg') }}" alt="Astrologer">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Astrologer</h3>
                    <p class="prof-card-desc">Mystical design for astrologers, vastu consultants, and numerologists.</p>
                    <div class="prof-card-tag">Spiritual</div>
                    <a href="{{ url('/theme-preview/astrologer') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Political Worker Card -->
            <div class="prof-card" data-profession="political">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/political-card.svg') }}" alt="Political Worker">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Political Worker</h3>
                    <p class="prof-card-desc">Professional design for political workers and social leaders to showcase achievements.</p>
                    <div class="prof-card-tag">Political</div>
                    <a href="{{ url('/theme-preview/political') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

            <!-- Influencer Card -->
            <div class="prof-card" data-profession="influencer">
                <div class="prof-card-img">
                    <img src="{{ asset('frontend/assets/img/redesign/professions/influencer-card.svg') }}" alt="Influencer">
                </div>
                <div class="prof-card-body">
                    <h3 class="prof-card-title">Influencer</h3>
                    <p class="prof-card-desc">Vibrant design for social media influencers and content creators to showcase stats.</p>
                    <div class="prof-card-tag">Social Media</div>
                    <a href="{{ url('/theme-preview/influencer') }}" class="prof-card-link">View Theme</a>
                </div>
            </div>

        </div>

        <!-- CTA Button -->
        <div class="professions-cta" style="text-align: center;">
            <a href="{{ url('/Product') }}" class="shop-products-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 1rem 3rem; background: linear-gradient(135deg, #7c3aed, #ec4899); color: white; font-size: 1.125rem; font-weight: 600; border-radius: 9999px; text-decoration: none; box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3); transition: all all 0.3s ease;">
                <span>Shop Our Products</span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

    </div>
</section>

<style>
    /* New Profession Card Styles - Vertical Layout */
    .prof-card {
        background: var(--bg-primary, #ffffff);
        border-radius: 0.75rem;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: 1px solid var(--border-light, #e2e8f0);
    }

    .prof-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(124, 58, 237, 0.15);
        border-color: #7c3aed;
    }

    .prof-card-img {
        width: 100%;
        height: 180px;
        overflow: hidden;
        background: var(--bg-secondary, #f8f9fa);
    }

    .prof-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .prof-card:hover .prof-card-img img {
        transform: scale(1.05);
    }

    .prof-card-body {
        padding: 1.5rem;
    }

    .prof-card-title {
        color: var(--text-primary, #1a1a2e);
        font-size: 1.125rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .prof-card-desc {
        color: var(--text-secondary, #64748b);
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .prof-card-tag {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: var(--bg-tertiary, #f1f5f9);
        color: var(--text-secondary, #475569);
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 0.375rem;
        margin-bottom: 0.75rem;
    }

    .prof-card-link {
        display: block;
        width: 100%;
        text-align: center;
        padding: 0.625rem 1.5rem;
        background: linear-gradient(135deg, #7c3aed, #a855f7);
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(124, 58, 237, 0.2);
    }

    .prof-card-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        background: linear-gradient(135deg, #6d28d9, #9333ea);
        color: white;
    }

    /* Dark Theme Support for Cards */
    [data-theme="dark"] .prof-card {
        background: var(--bg-secondary, #1a1a2e);
        border-color: var(--border-medium, #2d3748);
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    [data-theme="dark"] .prof-card:hover {
        box-shadow: 0 12px 24px rgba(124, 58, 237, 0.3);
        border-color: #9333ea;
    }

    [data-theme="dark"] .prof-card-img {
        background: var(--bg-primary, #0f0f1e);
    }

    [data-theme="dark"] .prof-card-title {
        color: var(--text-primary, #f7fafc);
    }

    [data-theme="dark"] .prof-card-desc {
        color: var(--text-secondary, #cbd5e0);
    }

    [data-theme="dark"] .prof-card-tag {
        background: var(--bg-accent, #2d3748);
        color: var(--text-secondary, #cbd5e0);
    }

    [data-theme="dark"] .prof-card-link {
        background: linear-gradient(135deg, #9333ea, #c084fc);
        color: white;
    }

    [data-theme="dark"] .prof-card-link:hover {
        background: linear-gradient(135deg, #7c3aed, #a855f7);
        color: white;
    }

    /* Dark Theme Support */
    [data-theme="dark"] .professions-showcase-section {
        background: linear-gradient(180deg, #0f0f1e 0%, #1a1a2e 100%) !important;
    }

    [data-theme="dark"] .section-badge {
        background: linear-gradient(135deg, #9333ea, #ec4899) !important;
    }

    [data-theme="dark"] .professions-title {
        color: #f7fafc !important;
    }

    [data-theme="dark"] .professions-subtitle {
        color: #cbd5e0 !important;
    }

    [data-theme="dark"] .profession-card img {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
    }

    [data-theme="dark"] .profession-card:hover img {
        box-shadow: 0 25px 50px rgba(124, 58, 237, 0.4) !important;
    }

    [data-theme="dark"] .shop-products-btn {
        background: linear-gradient(135deg, #9333ea, #ec4899) !important;
    }

    [data-theme="dark"] .cta-subtext {
        color: #a0aec0 !important;
    }

    /* Profession Card Hover Effects */
    .profession-card:hover {
        transform: translateY(-8px);
    }

    .profession-card:hover .profession-overlay {
        opacity: 1;
    }

    .shop-products-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(124, 58, 237, 0.4);
    }

    /* Responsive Grid */
    @media (max-width: 1200px) {
        .professions-grid-new {
            grid-template-columns: repeat(3, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        .professions-grid, .professions-grid-new {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 1.5rem !important;
        }

        .professions-title {
            font-size: 32px !important;
        }

        .professions-subtitle {
            font-size: 1rem !important;
        }

        .prof-card-img {
            height: 150px;
        }

        .prof-card-body {
            padding: 1.25rem;
        }
    }

    @media (max-width: 480px) {
        .professions-grid, .professions-grid-new {
            grid-template-columns: 1fr !important;
            gap: 1rem !important;
        }
    }
</style>
