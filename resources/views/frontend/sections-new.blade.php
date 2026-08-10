{{-- ========================================
     FASTAP - Main Sections
     All content sections for landing page
     ======================================== --}}

{{-- ABOUT / FEATURES SECTION --}}
<section id="about" class="about-section bg-secondary">
    {{-- Decorative Elements --}}
    <img src="{{url('frontend/assets/img/redesign/elements/nfc-waves.svg')}}" alt="NFC Waves" class="section-decoration about-decoration-nfcwaves">
    <img src="{{url('frontend/assets/img/redesign/elements/wireless-nodes.svg')}}" alt="Wireless Nodes" class="section-decoration about-decoration-nodes">
    <img src="{{url('frontend/assets/img/redesign/elements/digital-pulse.svg')}}" alt="Digital Pulse" class="section-decoration about-decoration-pulse">

    <div class="container">
        <div class="about-content-wrapper">
            <div class="about-text-content">
                <div class="section-header fade-up">
                    <h2 class="section-title">Why Choose Fastap?</h2>
                    <p class="section-subtitle">
                        Transform your professional networking with our cutting-edge NFC technology.
                        Make every connection count.
                    </p>
                </div>

                <div class="features-grid stagger-animation">
            <div class="card hover-lift fade-up">
                <div class="card-icon card-icon-purple">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="card-title">Instant Sharing</h3>
                <p class="card-text">
                    Share your contact details, social media, and portfolio with just a tap. No apps required.
                </p>
            </div>

            <div class="card hover-lift fade-up">
                <div class="card-icon card-icon-blue">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="card-title">Secure & Private</h3>
                <p class="card-text">
                    Your data is encrypted and secure. You control what information you share.
                </p>
            </div>

            <div class="card hover-lift fade-up">
                <div class="card-icon card-icon-pink">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="card-title">Eco-Friendly</h3>
                <p class="card-text">
                    Reduce paper waste. One digital card replaces thousands of traditional business cards.
                </p>
            </div>

            <div class="card hover-lift fade-up">
                <div class="card-icon card-icon-orange">
                    <i class="fas fa-sync"></i>
                </div>
                <h3 class="card-title">Always Updated</h3>
                <p class="card-text">
                    Update your information anytime. Your contacts always have your latest details.
                </p>
            </div>

            <div class="card hover-lift fade-up">
                <div class="card-icon card-icon-purple">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="card-title">Analytics Dashboard</h3>
                <p class="card-text">
                    Track who viewed your profile and how they engaged with your content.
                </p>
            </div>

            <div class="card hover-lift fade-up">
                <div class="card-icon card-icon-blue">
                    <i class="fas fa-palette"></i>
                </div>
                <h3 class="card-title">Fully Customizable</h3>
                <p class="card-text">
                    Design your digital profile to match your personal brand and style.
                </p>
            </div>
        </div>
            </div>

            <div class="about-features-images fade-in">
                <div class="stacked-features-container">
                    <img src="{{url('frontend/assets/img/redesign/features/feature-instant-connect.svg')}}" alt="Instant Connect" class="feature-stack-img feature-img-1">
                    <img src="{{url('frontend/assets/img/redesign/features/feature-analytics.svg')}}" alt="Analytics Dashboard" class="feature-stack-img feature-img-2">
                    <img src="{{url('frontend/assets/img/redesign/features/feature-customize.svg')}}" alt="Customizable Profiles" class="feature-stack-img feature-img-3">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATS/COUNTER SECTION --}}
<section id="stats" class="stats-section">
    <div class="container">
        <div class="stats-grid stagger-animation">
            <div class="stat-card fade-up">
                <div class="stat-icon">
                    <i class="material-symbols-outlined">manage_accounts</i>
                </div>
                <div class="stat-number" data-target="3600">0</div>
                <div class="stat-label">Completed Projects</div>
            </div>

            <div class="stat-card fade-up">
                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%); color: var(--blue-500);">
                    <i class="material-symbols-outlined">thumb_up</i>
                </div>
                <div class="stat-number" data-target="2700">0</div>
                <div class="stat-label">Happy Customers</div>
            </div>

            <div class="stat-card fade-up">
                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(236, 72, 153, 0.15) 0%, rgba(244, 114, 182, 0.15) 100%); color: var(--pink-500);">
                    <i class="material-symbols-outlined">group</i>
                </div>
                <div class="stat-number" data-target="457">0</div>
                <div class="stat-label">Expert Team Members</div>
            </div>

            <div class="stat-card fade-up">
                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(251, 146, 60, 0.15) 100%); color: var(--orange-500);">
                    <i class="material-symbols-outlined">military_tech</i>
                </div>
                <div class="stat-number" data-target="25">0</div>
                <div class="stat-label">Awards & Recognition</div>
    {{-- Decorative Elements --}}
    <img src="{{url('frontend/assets/img/redesign/elements/card-float-1.svg')}}" alt="Floating Card" class="section-decoration how-decoration-card1">
    <img src="{{url('frontend/assets/img/redesign/elements/nfc-waves.svg')}}" alt="NFC Waves" class="section-decoration how-decoration-waves">
    <img src="{{url('frontend/assets/img/redesign/elements/digital-pulse.svg')}}" alt="Digital Pulse" class="section-decoration how-decoration-pulse">
            </div>
        </div>
    </div>
</section>

{{-- HOW IT WORKS SECTION --}}
<section id="how-it-works" class="how-it-works-section">
    <div class="container">
        <div class="section-header fade-up">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">
                Get started with your NFC digital card in 4 simple steps
            </p>
        </div>

        <div class="how-it-works-wrapper">
            <div class="steps-container">
            <div class="step fade-up">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Choose Your Card</h3>
                    <p>Browse our collection and select the perfect NFC card design that matches your style and profession.</p>
                </div>
            </div>

            <div class="step fade-up">
                <div class="step-number" style="background: var(--gradient-blue);">2</div>
                <div class="step-content">
                    <h3>Customize Your Profile</h3>
                    <p>Add your contact information, social media links, portfolio, and any other details you want to share.</p>
                </div>
            </div>

            <div class="step fade-up">
                <div class="step-number" style="background: var(--gradient-pink);">3</div>
                <div class="step-content">
                    <h3>Receive & Activate</h3>
                    <p>Get your physical card delivered to your door and activate it through our simple online process.</p>
                </div>
            </div>

            <div class="step fade-up">
                <div class="step-number" style="background: var(--gradient-orange);">4</div>
                <div class="step-content">
                    <h3>Start Sharing</h3>
                    <p>Tap your card on any smartphone to instantly share your professional information. It's that easy!</p>
                </div>
            </div>
        </div>

            <div class="how-it-works-phone fade-in">
                <img src="{{url('frontend/assets/img/redesign/elements/phone-nfc-animation.svg')}}" alt="NFC Tap Animation">
            </div>
        </div>
    </div>
</section>

{{-- DETAILED PRICING PLANS SECTION --}}
<section id="pricing-plans" class="pricing-plans-section bg-secondary">
    <div class="container">
        <div class="section-header fade-up">
            <h2 class="section-title">Choose Your Perfect Card</h2>
            <p class="section-subtitle">
                Select the plan that best fits your professional needs. All cards include lifetime support and 1-year warranty.
            </p>
        </div>

        <div class="pricing-plans-container">
            {{-- Google Business Review Card --}}
            <div class="pricing-plan-row fade-up">
                <div class="pricing-plan-image">
                    <img src="{{url('uploads/Pricing_Plans/business.jpeg')}}" alt="Google Business Review Card">
                    <span class="pricing-badge badge-green">Best Value</span>
                </div>
                <div class="pricing-plan-content">
                    <h3 class="pricing-plan-title">Google Business Review Card</h3>
                    <div class="pricing-plan-price">
                        <span class="price-current">₹499</span>
                        <span class="price-original">₹3,000</span>
                        <span class="price-save">Save 83%</span>
                    </div>
                    <p class="pricing-plan-description">
                        Perfect for businesses looking to boost their online presence with instant Google reviews.
                    </p>
                    <ul class="pricing-plan-features">
                        <li><i class="fas fa-check-circle"></i> One Tap Google Review Collection</li>
                        <li><i class="fas fa-check-circle"></i> Direct Review QR Code</li>
                        <li><i class="fas fa-check-circle"></i> Boost Your Google Rating</li>
                        <li><i class="fas fa-check-circle"></i> Easy Setup & Activation</li>
                        <li><i class="fas fa-check-circle"></i> 24/7 Customer Support</li>
                        <li><i class="fas fa-check-circle"></i> Premium Card Quality</li>
                        <li><i class="fas fa-check-circle"></i> 1 Year Warranty</li>
                    </ul>
                    <a href="{{url('/products')}}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart"></i>
                        Buy Now
                    </a>
                </div>
            </div>

            {{-- Business Card --}}
            <div class="pricing-plan-row pricing-plan-reverse fade-up">
                <div class="pricing-plan-image">
                    <img src="{{url('uploads/Pricing_Plans/business-card.png')}}" alt="Business Card">
                    <span class="pricing-badge badge-purple">Most Popular</span>
                </div>
                <div class="pricing-plan-content">
                    <h3 class="pricing-plan-title">Business Card</h3>
                    <div class="pricing-plan-price">
                        <span class="price-current">₹999</span>
                        <span class="price-original">₹3,500</span>
                        <span class="price-save">Save 71%</span>
                    </div>
                    <p class="pricing-plan-description">
                        Complete professional solution with AI-powered smart profile and integrated CRM system.
                    </p>
                    <ul class="pricing-plan-features">
                        <li><i class="fas fa-check-circle"></i> Smart Profile with AI Integration</li>
                        <li><i class="fas fa-check-circle"></i> Showcase Products & Services</li>
                        <li><i class="fas fa-check-circle"></i> Upload PDF Documents</li>
                        <li><i class="fas fa-check-circle"></i> Customer Inquiry System</li>
                        <li><i class="fas fa-check-circle"></i> Built-in CRM Dashboard</li>
                        <li><i class="fas fa-check-circle"></i> Dynamic QR Code Generator</li>
                        <li><i class="fas fa-check-circle"></i> Social Media Integration</li>
                        <li><i class="fas fa-check-circle"></i> Analytics & Insights</li>
                        <li><i class="fas fa-check-circle"></i> Unlimited Profile Updates</li>
                        <li><i class="fas fa-check-circle"></i> Priority Support</li>
                        <li><i class="fas fa-check-circle"></i> Premium Materials</li>
                        <li><i class="fas fa-check-circle"></i> 1 Year Warranty</li>
                        <li><i class="fas fa-check-circle"></i> Free Shipping</li>
                    </ul>
                    <a href="{{url('/products')}}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart"></i>
                        Buy Now
                    </a>
                </div>
            </div>

            {{-- Gold Card --}}
            <div class="pricing-plan-row fade-up">
                <div class="pricing-plan-image">
                    <img src="{{url('uploads/Pricing_Plans/gold-card.png')}}" alt="Gold Card">
                    <span class="pricing-badge badge-orange">Premium</span>
                </div>
                <div class="pricing-plan-content">
                    <h3 class="pricing-plan-title">Gold Card</h3>
                    <div class="pricing-plan-price">
                        <span class="price-current">₹1,999</span>
                        <span class="price-label">Premium Edition</span>
                    </div>
                    <p class="pricing-plan-description">
                        Luxury metal finish card with exclusive features for executives and professionals who demand the best.
                    </p>
                    <ul class="pricing-plan-features">
                        <li><i class="fas fa-check-circle"></i> Premium Metal Construction</li>
                        <li><i class="fas fa-check-circle"></i> Gold Plated Finish</li>
                        <li><i class="fas fa-check-circle"></i> All Business Card Features</li>
                        <li><i class="fas fa-check-circle"></i> Enhanced AI Capabilities</li>
                        <li><i class="fas fa-check-circle"></i> Advanced CRM Integration</li>
                        <li><i class="fas fa-check-circle"></i> Custom Branding Options</li>
                        <li><i class="fas fa-check-circle"></i> Exclusive Design Template</li>
                        <li><i class="fas fa-check-circle"></i> VIP Customer Support</li>
                        <li><i class="fas fa-check-circle"></i> Lifetime Updates</li>
                        <li><i class="fas fa-check-circle"></i> Express Delivery</li>
                    </ul>
                    <a href="{{url('/contact')}}" class="btn btn-primary btn-lg">
                        <i class="fas fa-envelope"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PRODUCTS SECTION --}}
<section id="products" class="products-section bg-secondary">
    <div class="container">
        <div class="section-header fade-up">
            <h2 class="section-title">Our Products</h2>
            <p class="section-subtitle">
                Choose from our premium collection of NFC business cards
            </p>
        </div>

        <div class="products-grid stagger-animation">
            <div class="product-card fade-up">
                <div class="product-card-image">
                    <img src="{{url('uploads/Pricing_Plans/business.jpeg')}}" alt="Google Review Card">
                    <span class="badge badge-green" style="position: absolute; top: 1rem; right: 1rem;">Best Value</span>
                </div>
                <div class="product-card-content">
                    <h3 class="product-card-title">Google Review Card</h3>
                    <p class="card-text">Boost your online presence with instant reviews</p>
                    <div class="product-card-price">₹499</div>
                    <a href="{{url('/Product')}}" class="btn btn-primary w-full">
                        <i class="fas fa-shopping-cart"></i>
                        Buy Now
                    </a>
                </div>
            </div>

            <div class="product-card fade-up">
                <div class="product-card-image">
                    <img src="{{url('uploads/Pricing_Plans/business-card.png')}}" alt="Business Card">
                    <span class="badge badge-purple" style="position: absolute; top: 1rem; right: 1rem;">Most Popular</span>
                </div>
                <div class="product-card-content">
                    <h3 class="product-card-title">Business Card</h3>
                    <p class="card-text">Complete professional solution with AI</p>
                    <div class="product-card-price">₹999</div>
                    <a href="{{url('/Product')}}" class="btn btn-primary w-full">
                        <i class="fas fa-shopping-cart"></i>
                        Buy Now
                    </a>
                </div>
            </div>

            <div class="product-card fade-up">
                <div class="product-card-image">
                    <img src="{{url('uploads/Pricing_Plans/gold-card.png')}}" alt="Gold Card">
                    <span class="badge badge-orange" style="position: absolute; top: 1rem; right: 1rem;">Premium</span>
                </div>
                <div class="product-card-content">
                    <h3 class="product-card-title">Gold Card</h3>
                    <p class="card-text">Luxury metal finish with exclusive features</p>
                    <div class="product-card-price">₹1,999</div>
                    <a href="{{url('/Contact-Us')}}" class="btn btn-outline w-full">
                        <i class="fas fa-envelope"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- INCLUDE AI FEATURES SECTION --}}
<section id="ai-features" class="ai-features-section">
    {{-- Decorative Elements --}}
    <img src="{{url('frontend/assets/img/redesign/elements/card-float-1.svg')}}" alt="Floating Card" class="section-decoration ai-decoration-card1">
    <img src="{{url('frontend/assets/img/elements/include-element.png')}}" alt="Include Element" class="section-decoration ai-decoration-include">
    <img src="{{url('frontend/assets/img/redesign/elements/card-float-2.svg')}}" alt="Floating Card 2" class="section-decoration ai-decoration-card2">

    <div class="container">
        <div class="section-header fade-up">
            <h2 class="section-title">Powered by Artificial Intelligence</h2>
            <p class="section-subtitle">
                Experience next-generation networking with our AI-enhanced features designed to maximize your professional impact.
            </p>
        </div>

        <div class="ai-features-grid stagger-animation">
            <div class="ai-feature-card fade-up">
                <div class="ai-feature-icon">
                    <img src="{{url('frontend/assets/img/feature/robotic.svg')}}" alt="AI Assistant">
                </div>
                <h3 class="ai-feature-title">Smart AI Assistant</h3>
                <p class="ai-feature-text">
                    Our intelligent AI assistant helps optimize your profile, suggests improvements, and provides personalized recommendations to enhance your professional presence.
                </p>
            </div>

            <div class="ai-feature-card fade-up">
                <div class="ai-feature-icon">
                    <img src="{{url('frontend/assets/img/feature/machine.svg')}}" alt="Machine Learning">
                </div>
                <h3 class="ai-feature-title">Machine Learning Analytics</h3>
                <p class="ai-feature-text">
                    Advanced machine learning algorithms analyze engagement patterns and provide actionable insights to help you make better networking decisions.
                </p>
            </div>

            <div class="ai-feature-card fade-up">
                <div class="ai-feature-icon">
                    <img src="{{url('frontend/assets/img/feature/virtual.svg')}}" alt="Virtual Intelligence">
                </div>
                <h3 class="ai-feature-title">Virtual Intelligence</h3>
                <p class="ai-feature-text">
                    Leverage cutting-edge virtual intelligence to automate follow-ups, personalize interactions, and build stronger professional relationships effortlessly.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONIALS SECTION --}}
    {{-- Decorative Elements --}}
    <img src="{{url('frontend/assets/img/redesign/elements/wireless-nodes.svg')}}" alt="Wireless Nodes" class="section-decoration testimonials-decoration-nodes">
    <img src="{{url('frontend/assets/img/redesign/elements/card-float-2.svg')}}" alt="Floating Card" class="section-decoration testimonials-decoration-card">
<section id="testimonials" class="testimonials-section">
    <div class="container">
        <div class="section-header fade-up">
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">
                Join thousands of satisfied professionals who trust Fastap
            </p>
        </div>

        <div class="testimonials-wrapper">
            <div class="testimonials-grid stagger-animation">
            @php
                $testimonials = App\Models\Testimonial::take(3)->get();
            @endphp

            @if($testimonials->count() > 0)
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-card fade-up">
                        <div class="testimonial-stars">
                            @for($i = 0; $i < 5; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <p class="testimonial-text">"{{ $testimonial->feedback }}"</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">
                                <i class="fas fa-user" style="font-size: 2rem; color: var(--purple-500);"></i>
                            </div>
                            <div>
                                <div class="testimonial-name">{{ $testimonial->name }}</div>
                                <div class="testimonial-role">{{ $testimonial->designation ?? 'Customer' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Fallback testimonials if database is empty --}}
                <div class="testimonial-card fade-up">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Fastap has transformed how I network. The NFC card is sleek, professional, and incredibly easy to use. Highly recommended!"</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user" style="font-size: 2rem; color: var(--purple-500);"></i>
                        </div>
                        <div>
                            <div class="testimonial-name">Rajesh Kumar</div>
                            <div class="testimonial-role">Business Owner</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card fade-up">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"As a freelancer, I love how easy it is to share my portfolio. The analytics feature helps me track my networking success."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user" style="font-size: 2rem; color: var(--purple-500);"></i>
                        </div>
                        <div>
                            <div class="testimonial-name">Priya Sharma</div>
                            <div class="testimonial-role">Graphic Designer</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card fade-up">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"The premium metal card is stunning! It makes a great first impression and the technology works flawlessly every time."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user" style="font-size: 2rem; color: var(--purple-500);"></i>
                        </div>
                        <div>
                            <div class="testimonial-name">Amit Patel</div>
                            <div class="testimonial-role">Sales Executive</div>
                        </div>
                    </div>
                </div>
            @endif
            </div>

            <div class="testimonials-illustrations-stack fade-in">
                <img src="{{url('frontend/assets/img/redesign/elements/testimonial-avatar-group.svg')}}" alt="Happy Customers" class="testimonial-stack-img testimonial-img-1">
                <img src="{{url('frontend/assets/img/redesign/elements/testimonial-speech-bubbles.svg')}}" alt="Customer Feedback" class="testimonial-stack-img testimonial-img-2">
                <img src="{{url('frontend/assets/img/redesign/elements/testimonial-stats-badge.svg')}}" alt="Customer Stats" class="testimonial-stack-img testimonial-img-3">
            </div>
        </div>
    </div>
</section>

{{-- REAL-WORLD USE CASES / BLOG SECTION --}}
<section id="use-cases" class="use-cases-section bg-secondary">
    <div class="container">
        <div class="section-header fade-up">
            <h2 class="section-title">Real-World Success Stories</h2>
            <p class="section-subtitle">
                Discover how professionals across industries are leveraging Fastap to transform their networking game.
            </p>
        </div>

        <div class="use-cases-grid stagger-animation">
            <div class="use-case-card fade-up">
                <div class="use-case-image">
                    <img src="{{url('frontend/assets/img/bog-capabilities/re1.jpg')}}" alt="Real Estate Success">
                    <div class="use-case-category">
                        <span class="badge badge-purple">Technology</span>
                    </div>
                    <div class="use-case-overlay">
                        <i class="fas fa-play-circle"></i>
                    </div>
                </div>
                <div class="use-case-content">
                    <h3 class="use-case-title">Real Estate Agent Closes 40% More Deals</h3>
                    <p class="use-case-excerpt">
                        Discover how Sarah transformed her real estate business using Fastap's instant sharing technology, closing more deals and building lasting client relationships.
                    </p>
                    <a href="#" class="use-case-link">
                        Read More
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="use-case-card fade-up">
                <div class="use-case-image">
                    <img src="{{url('frontend/assets/img/bog-capabilities/re2.jpg')}}" alt="Freelancer Growth">
                    <div class="use-case-category">
                        <span class="badge badge-blue">Technology</span>
                    </div>
                    <div class="use-case-overlay">
                        <i class="fas fa-play-circle"></i>
                    </div>
                </div>
                <div class="use-case-content">
                    <h3 class="use-case-title">Freelancer Grows Client Base by 200%</h3>
                    <p class="use-case-excerpt">
                        Learn how James leveraged AI-powered analytics and smart networking to triple his freelance client base in just 6 months.
                    </p>
                    <a href="#" class="use-case-link">
                        Read More
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="use-case-card fade-up">
                <div class="use-case-image">
                    <img src="{{url('frontend/assets/img/bog-capabilities/re3.jpg')}}" alt="Startup Success">
                    <div class="use-case-category">
                        <span class="badge badge-pink">Technology</span>
                    </div>
                    <div class="use-case-overlay">
                        <i class="fas fa-play-circle"></i>
                    </div>
                </div>
                <div class="use-case-content">
                    <h3 class="use-case-title">Startup Founder Secures Series A Funding</h3>
                    <p class="use-case-excerpt">
                        See how Michael used Fastap to make unforgettable impressions at pitch events, leading to successful Series A funding for his tech startup.
                    </p>
                    <a href="#" class="use-case-link">
                        Read More
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ SECTION --}}
<section id="faq" class="faq-section bg-secondary">
    <div class="container">
        <div class="section-header fade-up">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-subtitle">
                Everything you need to know about Fastap NFC cards
            </p>
        </div>

        <div class="faq-content-wrapper">
            <div class="faq-container fade-up">
            <div class="faq-item">
                <button class="faq-question">
                    <span>What is an NFC business card?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>An NFC business card is a smart card embedded with Near Field Communication (NFC) technology that allows you to share your contact information, social media profiles, and other details instantly by tapping it on any smartphone.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span>Do I need an app to use it?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>No app is required! NFC technology is built into most modern smartphones. Simply tap your card on any compatible device to share your information instantly.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span>Can I update my information after purchase?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes! You can update your contact details, links, and profile information anytime through your Fastap dashboard. All changes are reflected immediately.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span>How long does delivery take?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Standard delivery takes 5-7 business days within India. Express delivery options are also available for faster shipping.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span>Is my data secure?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Absolutely! Your data is encrypted and stored securely. You have full control over what information you share and can update or remove it at any time.</p>
                </div>
            </div>
            </div>

            <div class="faq-illustration fade-in">
                <img src="{{url('frontend/assets/img/redesign/elements/faq-illustration.svg')}}" alt="Frequently Asked Questions">
            </div>
        </div>
    </div>
</section>

{{-- NEWSLETTER / CTA SECTION --}}
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-content fade-up">
            <h2 class="newsletter-title">Stay Updated</h2>
            <p class="newsletter-text">
                Subscribe to our newsletter for exclusive offers, tips, and updates on the latest in NFC technology.
            </p>
            <form class="newsletter-form" action="javascript:void(0)">
                <div class="form-group" style="margin-bottom: 0;">
                    <input type="email" class="form-control" placeholder="Enter your email address" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-paper-plane"></i>
                    Subscribe
                </button>
            </form>
            <p class="newsletter-privacy">
                <i class="fas fa-lock"></i>
                We respect your privacy. Unsubscribe at any time.
            </p>
        </div>
    </div>
</section>

<style>
/* ============= SECTIONS STYLING ============= */

/* About/Features Section */
.about-section {
    background: var(--bg-secondary);
    position: relative;
    overflow: hidden;
}

.about-content-wrapper {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: var(--space-3xl);
    align-items: center;
}

.about-text-content {
    max-width: 100%;
}

/* Stacked Features Images Container */
.about-features-images {
    display: flex;
    align-items: center;
    justify-content: center;
}

.stacked-features-container {
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
    align-items: center;
    width: 100%;
    max-width: 450px;
}

.feature-stack-img {
    width: 100%;
    height: auto;
    border-radius: var(--radius-xl);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-img-1 {
    animation: float 6s ease-in-out infinite;
}

.feature-img-2 {
    animation: float 7s ease-in-out infinite 0.5s;
}

.feature-img-3 {
    animation: float 8s ease-in-out infinite 1s;
}

.feature-stack-img:hover {
    transform: scale(1.02) translateY(-5px);
    filter: drop-shadow(0 15px 40px rgba(124, 58, 237, 0.3));
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-lg);
}

@media (max-width: 992px) {
    .about-content-wrapper {
        grid-template-columns: 1fr;
    }

    .about-features-images {
        order: -1;
        margin-bottom: var(--space-xl);
    }

    .stacked-features-container {
        max-width: 100%;
    }

    .features-grid {
        grid-template-columns: 1fr;
    }
}

/* Stats Section */
.stats-section {
    background: var(--bg-primary);
    padding: var(--space-2xl) 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: var(--space-xl);
}

.stat-card {
    text-align: center;
    padding: var(--space-xl);
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-xl);
    transition: all var(--transition-base);
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
    border-color: var(--purple-400);
}

.stat-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto var(--space-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
    color: var(--purple-500);
    border-radius: var(--radius-xl);
    font-size: 2.5rem;
    transition: all var(--transition-base);
}

.stat-card:hover .stat-icon {
    transform: scale(1.1) rotate(5deg);
}

.stat-number {
    font-size: var(--text-5xl);
    font-weight: var(--font-extrabold);
    background: var(--gradient-purple);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: var(--space-sm);
    line-height: 1.2;
}

.stat-label {
    font-size: var(--text-lg);
    color: var(--text-secondary);
    font-weight: var(--font-medium);
}

@media (max-width: 968px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 568px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
}

/* How It Works Section */
.how-it-works-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-3xl);
    align-items: center;
}

.steps-container {
    display: flex;
    flex-direction: column;
    gap: var(--space-2xl);
}

/* How It Works Phone Animation */
.how-it-works-phone {
    display: flex;
    align-items: center;
    justify-content: center;
}

.how-it-works-phone img {
    width: 100%;
    max-width: 500px;
    height: auto;
    filter: drop-shadow(0 20px 40px rgba(124, 58, 237, 0.25));
}

@media (max-width: 992px) {
    .how-it-works-wrapper {
        grid-template-columns: 1fr;
    }

    .how-it-works-phone {
        order: -1;
        margin-bottom: var(--space-xl);
    }
}

/* Pricing Plans Section */
.pricing-plans-section {
    background: var(--bg-secondary);
}

.pricing-plans-container {
    max-width: 1100px;
    margin: 0 auto;
}

.pricing-plan-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-2xl);
    align-items: center;
    margin-bottom: var(--space-3xl);
    padding: var(--space-xl);
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-2xl);
    transition: all var(--transition-base);
}

.pricing-plan-row:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
    border-color: var(--purple-400);
}

.pricing-plan-reverse {
    grid-template-columns: 1fr 1fr;
}

.pricing-plan-reverse .pricing-plan-image {
    order: 2;
}

.pricing-plan-reverse .pricing-plan-content {
    order: 1;
}

.pricing-plan-image {
    position: relative;
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.pricing-plan-image img {
    width: 100%;
    height: auto;
    border-radius: var(--radius-xl);
    transition: transform var(--transition-slow);
}

.pricing-plan-row:hover .pricing-plan-image img {
    transform: scale(1.05);
}

.pricing-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: 0.5rem 1rem;
    font-size: var(--text-sm);
    font-weight: var(--font-semibold);
    border-radius: var(--radius-full);
    box-shadow: var(--shadow-md);
}

.pricing-plan-content {
    padding: var(--space-md);
}

.pricing-plan-title {
    font-size: var(--text-3xl);
    font-weight: var(--font-bold);
    color: var(--text-primary);
    margin-bottom: var(--space-md);
}

.pricing-plan-price {
    display: flex;
    align-items: baseline;
    gap: var(--space-sm);
    margin-bottom: var(--space-md);
    flex-wrap: wrap;
}

.price-current {
    font-size: var(--text-5xl);
    font-weight: var(--font-extrabold);
    background: var(--gradient-purple);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.price-original {
    font-size: var(--text-xl);
    color: var(--text-muted);
    text-decoration: line-through;
}

.price-save {
    background: var(--gradient-orange);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius-full);
    font-size: var(--text-sm);
    font-weight: var(--font-semibold);
}

.price-label {
    font-size: var(--text-lg);
    color: var(--text-secondary);
    font-weight: var(--font-medium);
}

.pricing-plan-description {
    font-size: var(--text-lg);
    color: var(--text-secondary);
    margin-bottom: var(--space-lg);
    line-height: var(--leading-relaxed);
}

.pricing-plan-features {
    list-style: none;
    padding: 0;
    margin: 0 0 var(--space-xl) 0;
}

.pricing-plan-features li {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    padding: 0.75rem 0;
    font-size: var(--text-base);
    color: var(--text-secondary);
    border-bottom: 1px solid var(--border-light);
}

.pricing-plan-features li:last-child {
    border-bottom: none;
}

.pricing-plan-features li i {
    color: var(--green-500);
    font-size: 1.125rem;
    flex-shrink: 0;
}

@media (max-width: 968px) {
    .pricing-plan-row,
    .pricing-plan-reverse {
        grid-template-columns: 1fr;
        gap: var(--space-lg);
    }

    .pricing-plan-reverse .pricing-plan-image {
        order: 1;
    }

    .pricing-plan-reverse .pricing-plan-content {
        order: 2;
    }
}

/* Products Section */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: var(--space-xl);
}

/* Card Gallery Section */

/* AI Features Section */
.ai-features-section {
    background: linear-gradient(135deg, #0f0f1e 0%, #1a1a2e 50%, #252538 100%);
    position: relative;
    overflow: hidden;
}

.ai-features-section .section-decoration {
    opacity: 0.3;
}

[data-theme="light"] .ai-features-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #dee2e6 100%);
}

.ai-features-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: radial-gradient(circle at 20% 50%, rgba(124, 58, 237, 0.1) 0%, transparent 50%),
                      radial-gradient(circle at 80% 80%, rgba(236, 72, 153, 0.1) 0%, transparent 50%);
    pointer-events: none;
}

.ai-features-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-2xl);
    position: relative;
    z-index: 1;
}

.ai-feature-card {
    background: var(--card-bg);
    border: 2px solid transparent;
    border-radius: var(--radius-2xl);
    padding: var(--space-2xl);
    text-align: center;
    transition: all var(--transition-slow);
    position: relative;
    overflow: hidden;
}

.ai-feature-card::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: var(--gradient-multi);
    border-radius: inherit;
    z-index: -1;
    opacity: 0;
    transition: opacity var(--transition-base);
}

.ai-feature-card:hover::before {
    opacity: 1;
}

.ai-feature-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(124, 58, 237, 0.3);
}

.ai-feature-icon {
    width: 70px;
    height: 120px;
    margin: 0 auto var(--space-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%);
    border-radius: var(--radius-2xl);
    transition: all var(--transition-base);
}

.ai-feature-card:hover .ai-feature-icon {
    transform: scale(1.1) rotate(5deg);
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.2) 0%, rgba(168, 85, 247, 0.2) 100%);
}

.ai-feature-icon img {
    width: 70px;
    height: 70px;
    object-fit: contain;
}

.ai-feature-title {
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    color: var(--text-primary);
    margin-bottom: var(--space-md);
}

.ai-feature-text {
    font-size: var(--text-base);
    color: var(--text-secondary);
    line-height: var(--leading-relaxed);
}

@media (max-width: 968px) {
    .ai-features-grid {
        grid-template-columns: 1fr;
    }
}


/* Use Cases Section */
.use-cases-section {
    background: var(--bg-secondary);
}

.use-cases-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-2xl);
}

.use-case-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    transition: all var(--transition-base);
}

.use-case-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
    border-color: var(--purple-400);
}

.use-case-image {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.use-case-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
}

.use-case-card:hover .use-case-image img {
    transform: scale(1.1);
}

.use-case-category {
    position: absolute;
    top: 1rem;
    left: 1rem;
    z-index: 2;
}

.use-case-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity var(--transition-base);
}

.use-case-card:hover .use-case-overlay {
    opacity: 1;
}

.use-case-overlay i {
    font-size: 4rem;
    color: white;
    transition: transform var(--transition-base);
}

.use-case-card:hover .use-case-overlay i {
    transform: scale(1.2);
}

.use-case-content {
    padding: var(--space-xl);
}

.use-case-title {
    font-size: var(--text-xl);
    font-weight: var(--font-bold);
    color: var(--text-primary);
    margin-bottom: var(--space-md);
    line-height: var(--leading-tight);
}

.use-case-excerpt {
    font-size: var(--text-base);
    color: var(--text-secondary);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-lg);
}

.use-case-link {
    display: inline-flex;
    align-items: center;
    gap: var(--space-xs);
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    color: var(--purple-500);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.use-case-link:hover {
    gap: var(--space-sm);
    color: var(--purple-600);
}

.use-case-link i {
    transition: transform var(--transition-fast);
}

.use-case-link:hover i {
    transform: translateX(4px);
}

@media (max-width: 968px) {
    .use-cases-grid {
        grid-template-columns: 1fr;
    }
}

/* Testimonials Section */
.testimonials-wrapper {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: var(--space-3xl);
    align-items: center;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--space-lg);
}

/* Testimonials Stacked Illustrations */
.testimonials-illustrations-stack {
    display: flex;
    flex-direction: column;
    gap: var(--space-sm);
    align-items: center;
    justify-content: center;
    width: 100%;
}

.testimonial-stack-img {
    width: 100%;
    max-width: 420px;
    height: auto;
    transition: transform 0.3s ease;
}

.testimonial-img-1 {
    animation: float 5s ease-in-out infinite;
}

.testimonial-img-2 {
    animation: float 6s ease-in-out infinite 0.5s;
}

.testimonial-img-3 {
    animation: float 7s ease-in-out infinite 1s;
}

.testimonial-stack-img:hover {
    transform: scale(1.02);
}

@media (max-width: 992px) {
    .testimonials-wrapper {
        grid-template-columns: 1fr;
    }

    .testimonials-illustrations-stack {
        order: -1;
        margin-bottom: var(--space-xl);
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }

    .testimonial-stack-img {
        max-width: 280px;
    }
}

/* FAQ Section */
.faq-content-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-3xl);
    align-items: center;
}

.faq-container {
    max-width: 100%;
}

/* FAQ Illustration */
.faq-illustration {
    display: flex;
    align-items: center;
    justify-content: center;
}

.faq-illustration img {
    width: 100%;
    max-width: 500px;
    height: auto;
    animation: float 12s ease-in-out infinite;
    filter: drop-shadow(0 15px 35px rgba(124, 58, 237, 0.2));
}

@media (max-width: 992px) {
    .faq-content-wrapper {
        grid-template-columns: 1fr;
    }

    .faq-illustration {
        order: -1;
        margin-bottom: var(--space-xl);
    }
}

.faq-item {
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-md);
    overflow: hidden;
    transition: all var(--transition-base);
}

.faq-item:hover {
    border-color: var(--purple-400);
}

.faq-question {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-lg);
    background: var(--card-bg);
    border: none;
    cursor: pointer;
    font-size: var(--text-lg);
    font-weight: var(--font-semibold);
    color: var(--text-primary);
    text-align: left;
    transition: all var(--transition-base);
}

.faq-question i {
    color: var(--purple-500);
    transition: transform var(--transition-base);
}

.faq-item.active .faq-question i {
    transform: rotate(45deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height var(--transition-base);
}

.faq-item.active .faq-answer {
    max-height: 500px;
}

.faq-answer p {
    padding: 0 var(--space-lg) var(--space-lg);
    color: var(--text-secondary);
    line-height: var(--leading-relaxed);
}

/* Newsletter Section */
.newsletter-section {
    background: var(--gradient-multi);
    color: white;
}

.newsletter-content {
    max-width: 700px;
    margin: 0 auto;
    text-align: center;
}

.newsletter-title {
    font-size: var(--text-4xl);
    color: white;
    margin-bottom: var(--space-md);
}

.newsletter-text {
    font-size: var(--text-lg);
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: var(--space-xl);
}

.newsletter-form {
    display: flex;
    justify-content: center;
    gap: var(--space-md);
    margin-bottom: var(--space-md);
    width: 100%;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.newsletter-form .form-control {
    flex: 1;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    backdrop-filter: blur(10px);
}

.newsletter-form .form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.newsletter-form .form-control:focus {
    background: rgba(255, 255, 255, 0.25);
    border-color: white;
    box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
}

.newsletter-form .btn {
    background: white;
    color: var(--purple-600);
}

.newsletter-form .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.newsletter-privacy {
    font-size: var(--text-sm);
    color: rgba(255, 255, 255, 0.8);
}

/* Decorative Elements */
.section-decoration {
    position: absolute;
    z-index: 0;
    opacity: 0.4;
    pointer-events: none;
}

/* About Section Decorations */
.about-decoration-nfcwaves {
    width: 70px;
    top: 10%;
    right: 10%;
    animation: float 10s ease-in-out infinite;
}

.about-decoration-nodes {
    width: 90px;
    bottom: 15%;
    left: 5%;
    animation: float 12s ease-in-out infinite 1s;
}

.about-decoration-pulse {
    width: 90px;
    top: 50%;
    right: 3%;
    animation: float 14s ease-in-out infinite 2s;
}

/* AI Features Section Decorations */
.ai-decoration-card1 {
    width: 60px;
    top: 15%;
    left: 8%;
    animation: float 11s ease-in-out infinite;
}

.ai-decoration-include {
    width: 100px;
    bottom: 10%;
    right: 10%;
    animation: float 13s ease-in-out infinite 1.5s;
}
n/* How It Works Section Decorations */
.how-decoration-card1 {
    width: 80px;
    top: 20%;
    left: 5%;
    animation: float 10s ease-in-out infinite;
}

.how-decoration-waves {
    width: 70px;
    bottom: 20%;
    right: 8%;
    animation: float 13s ease-in-out infinite 1s;
}

.how-decoration-pulse {
    width: 85px;
    top: 60%;
    right: 5%;
    animation: float 11s ease-in-out infinite 2s;
}

/* Testimonials Section Decorations */
.testimonials-decoration-nodes {
    width: 90px;
    top: 15%;
    left: 10%;
    animation: float 12s ease-in-out infinite;
}

.testimonials-decoration-card {
    width: 75px;
    bottom: 10%;
    right: 12%;
    animation: float 14s ease-in-out infinite 1.5s;
}

.ai-decoration-card2 {
    width: 80px;
    top: 60%;
    left: 5%;
    animation: float 9s ease-in-out infinite 2.5s;
}

/* Responsive */
@media (max-width: 768px) {
    .features-grid,
    .products-grid,
    .testimonials-grid {
        grid-template-columns: 1fr;
    }

    .newsletter-form {
        flex-direction: column;
    }

    .newsletter-form .btn {
        width: 100%;
    }

    /* Hide decorative elements on mobile for performance */
    .section-decoration {
        display: none;
    }
}
</style>

<script>
// FAQ Accordion
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all items
            faqItems.forEach(i => i.classList.remove('active'));

            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    // Counter Animation
    const animateCounter = (element) => {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60 FPS
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                element.textContent = Math.floor(current).toLocaleString();
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString();
            }
        };

        updateCounter();
    };

    // Intersection Observer for counters
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && entry.target.textContent === '0') {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-number').forEach(counter => {
        counterObserver.observe(counter);
    });
});
</script>
