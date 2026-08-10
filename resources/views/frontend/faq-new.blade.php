<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ffffff">
    <title>FAQs - Fastap | NFC Digital Business Cards</title>
    <meta name="description" content="Find answers to frequently asked questions about Fastap NFC digital business cards, ordering, delivery, and support.">

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

    /* FAQ Section */
    .faq-section {
        padding: var(--space-3xl) 0;
    }

    .faq-layout {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: var(--space-3xl);
    }

    /* FAQ Sidebar */
    .faq-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .faq-info-card {
        background: var(--gradient-purple);
        border-radius: var(--radius-2xl);
        padding: var(--space-2xl);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .faq-info-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .faq-info-card h3 {
        font-size: var(--text-xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-md);
        position: relative;
        z-index: 1;
    }

    .faq-info-card p {
        opacity: 0.9;
        line-height: 1.7;
        margin-bottom: var(--space-lg);
        position: relative;
        z-index: 1;
    }

    .faq-contact-btn {
        display: inline-flex;
        align-items: center;
        gap: var(--space-sm);
        background: white;
        color: var(--purple-600);
        padding: var(--space-sm) var(--space-lg);
        border-radius: var(--radius-full);
        text-decoration: none;
        font-weight: var(--font-semibold);
        font-size: var(--text-sm);
        transition: all var(--transition-fast);
        position: relative;
        z-index: 1;
    }

    .faq-contact-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    /* Categories */
    .faq-categories {
        background: var(--bg-secondary);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-top: var(--space-lg);
    }

    .faq-categories h4 {
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-md);
    }

    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-list li {
        margin-bottom: var(--space-xs);
    }

    .category-list a {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        padding: var(--space-sm) var(--space-md);
        color: var(--text-secondary);
        text-decoration: none;
        border-radius: var(--radius-md);
        font-size: var(--text-sm);
        transition: all var(--transition-fast);
    }

    .category-list a:hover,
    .category-list a.active {
        background: var(--bg-primary);
        color: var(--purple-500);
    }

    .category-list a i {
        font-size: var(--text-base);
    }

    /* FAQ Main */
    .faq-main {
        min-width: 0;
    }

    .faq-search {
        background: var(--bg-secondary);
        border-radius: var(--radius-xl);
        padding: var(--space-lg);
        margin-bottom: var(--space-2xl);
    }

    .faq-search-box {
        display: flex;
        gap: var(--space-sm);
    }

    .faq-search-box input {
        flex: 1;
        padding: var(--space-md) var(--space-lg);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        background: var(--bg-primary);
        color: var(--text-primary);
        font-size: var(--text-base);
    }

    .faq-search-box input:focus {
        outline: none;
        border-color: var(--purple-500);
    }

    .faq-search-box button {
        padding: var(--space-md) var(--space-xl);
        background: var(--gradient-purple);
        border: none;
        border-radius: var(--radius-lg);
        color: white;
        cursor: pointer;
        font-weight: var(--font-semibold);
        transition: all var(--transition-fast);
    }

    .faq-search-box button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(139, 92, 246, 0.3);
    }

    /* Accordion */
    .faq-accordion {
        display: flex;
        flex-direction: column;
        gap: var(--space-md);
    }

    .faq-item {
        background: var(--bg-primary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: all var(--transition-base);
    }

    .faq-item:hover {
        border-color: var(--purple-300);
    }

    .faq-item.active {
        border-color: var(--purple-500);
        box-shadow: var(--shadow-md);
    }

    .faq-question {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: var(--space-lg) var(--space-xl);
        cursor: pointer;
        gap: var(--space-md);
    }

    .faq-question h3 {
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin: 0;
        flex: 1;
    }

    .faq-icon {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-full);
        background: var(--bg-secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all var(--transition-fast);
        flex-shrink: 0;
    }

    .faq-item.active .faq-icon {
        background: var(--gradient-purple);
        color: white;
    }

    .faq-icon i {
        font-size: var(--text-sm);
        transition: transform var(--transition-fast);
    }

    .faq-item.active .faq-icon i {
        transform: rotate(180deg);
    }

    .faq-answer {
        padding: 0 var(--space-xl) var(--space-lg);
        display: none;
    }

    .faq-item.active .faq-answer {
        display: block;
    }

    .faq-answer p {
        color: var(--text-secondary);
        line-height: 1.7;
        margin: 0;
    }

    /* Contact CTA */
    .faq-cta {
        margin-top: var(--space-3xl);
        background: var(--bg-secondary);
        border-radius: var(--radius-2xl);
        padding: var(--space-2xl);
        text-align: center;
    }

    .faq-cta h3 {
        font-size: var(--text-xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-sm);
    }

    .faq-cta p {
        color: var(--text-secondary);
        margin-bottom: var(--space-lg);
    }

    .faq-cta-buttons {
        display: flex;
        gap: var(--space-md);
        justify-content: center;
        flex-wrap: wrap;
    }

    .faq-cta-buttons a {
        display: inline-flex;
        align-items: center;
        gap: var(--space-sm);
        padding: var(--space-sm) var(--space-lg);
        border-radius: var(--radius-full);
        text-decoration: none;
        font-weight: var(--font-medium);
        transition: all var(--transition-fast);
    }

    .faq-cta-buttons .btn-primary {
        background: var(--gradient-purple);
        color: white;
    }

    .faq-cta-buttons .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(139, 92, 246, 0.3);
    }

    .faq-cta-buttons .btn-secondary {
        background: var(--bg-primary);
        color: var(--text-primary);
        border: 1px solid var(--border-light);
    }

    .faq-cta-buttons .btn-secondary:hover {
        border-color: var(--purple-500);
        color: var(--purple-500);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .faq-layout {
            grid-template-columns: 1fr;
        }

        .faq-sidebar {
            position: static;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--space-lg);
        }

        .faq-categories {
            margin-top: 0;
        }
    }

    @media (max-width: 768px) {
        .faq-sidebar {
            grid-template-columns: 1fr;
        }

        .faq-search-box {
            flex-direction: column;
        }

        .faq-question h3 {
            font-size: var(--text-sm);
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
                <h1>Frequently Asked <span class="text-gradient-purple">Questions</span></h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="current">FAQs</span>
                </nav>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="faq-section">
        <div class="container">
            <div class="faq-layout">
                {{-- Sidebar --}}
                <aside class="faq-sidebar fade-up">
                    <div class="faq-info-card">
                        <h3>Have Questions?</h3>
                        <p>Fastap is the leading Digital NFC Business Card Platform for Companies and individuals. We provide best-in-class services to help you manage your professional profile easily.</p>
                        <a href="{{ url('/Contact-Us') }}" class="faq-contact-btn">
                            <i class="fas fa-envelope"></i> Contact Us
                        </a>
                    </div>

                    <div class="faq-categories">
                        <h4>Categories</h4>
                        <ul class="category-list">
                            <li><a href="#" class="active"><i class="fas fa-list"></i> All Questions</a></li>
                            <li><a href="#"><i class="fas fa-credit-card"></i> NFC Cards</a></li>
                            <li><a href="#"><i class="fas fa-shopping-cart"></i> Orders & Delivery</a></li>
                            <li><a href="#"><i class="fas fa-cog"></i> Account & Profile</a></li>
                            <li><a href="#"><i class="fas fa-rupee-sign"></i> Pricing & Payment</a></li>
                            <li><a href="#"><i class="fas fa-headset"></i> Support</a></li>
                        </ul>
                    </div>
                </aside>

                {{-- FAQ Main --}}
                <div class="faq-main">
                    {{-- Search --}}
                    <div class="faq-search fade-up">
                        <form class="faq-search-box">
                            <input type="text" placeholder="Search for answers...">
                            <button type="submit"><i class="fas fa-search"></i> Search</button>
                        </form>
                    </div>

                    {{-- FAQ Accordion --}}
                    <div class="faq-accordion stagger-animation">
                        @if(isset($show_info) && count($show_info) > 0)
                            @foreach($show_info as $index => $faq)
                                <div class="faq-item fade-up {{ $index === 0 ? 'active' : '' }}">
                                    <div class="faq-question">
                                        <h3>{{ $faq->question }}</h3>
                                        <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="faq-answer">
                                        <p>{!! $faq->answer !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{-- Default FAQs if no data --}}
                            <div class="faq-item fade-up active">
                                <div class="faq-question">
                                    <h3>What is an NFC digital business card?</h3>
                                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>An NFC (Near Field Communication) digital business card is a smart card embedded with NFC technology. When tapped against a smartphone, it instantly shares your digital profile, contact information, social media links, and more - no app required.</p>
                                </div>
                            </div>

                            <div class="faq-item fade-up">
                                <div class="faq-question">
                                    <h3>How do I set up my Fastap card?</h3>
                                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>Setting up is easy! Once you receive your card, create an account on our website, customize your digital profile with your information, links, and content. Your card is pre-linked to your profile and ready to use.</p>
                                </div>
                            </div>

                            <div class="faq-item fade-up">
                                <div class="faq-question">
                                    <h3>Does the recipient need an app to receive my information?</h3>
                                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>No! That's the beauty of NFC technology. When someone taps your card on their smartphone, your profile opens directly in their web browser. No app download required - it works instantly on all modern smartphones.</p>
                                </div>
                            </div>

                            <div class="faq-item fade-up">
                                <div class="faq-question">
                                    <h3>Can I update my information after the card is made?</h3>
                                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>Absolutely! You can update your digital profile anytime through your dashboard. Change your bio, update contact details, add new social links, or modify your portfolio. Changes reflect instantly - your card never becomes outdated.</p>
                                </div>
                            </div>

                            <div class="faq-item fade-up">
                                <div class="faq-question">
                                    <h3>What is the delivery time?</h3>
                                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>Standard delivery takes 5-7 business days across India. We also offer express delivery options for urgent orders. You'll receive tracking information once your order ships.</p>
                                </div>
                            </div>

                            <div class="faq-item fade-up">
                                <div class="faq-question">
                                    <h3>Do you offer bulk orders for companies?</h3>
                                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>Yes! We offer special corporate solutions for businesses of all sizes. Bulk orders include custom branding options, centralized management dashboard, and special pricing. Contact us for a customized quote.</p>
                                </div>
                            </div>

                            <div class="faq-item fade-up">
                                <div class="faq-question">
                                    <h3>What types of cards do you offer?</h3>
                                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>We offer various card types including PVC cards, metal cards, wooden cards, and custom designs. Each type has different finishes and customization options to match your personal or brand style.</p>
                                </div>
                            </div>

                            <div class="faq-item fade-up">
                                <div class="faq-question">
                                    <h3>Is my data secure?</h3>
                                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>Yes, security is our priority. Your data is encrypted and stored securely. You have complete control over what information you share, and you can enable/disable your profile anytime. We never sell or share your personal information.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Contact CTA --}}
                    <div class="faq-cta fade-up">
                        <h3>Still have questions?</h3>
                        <p>Can't find what you're looking for? Our support team is here to help.</p>
                        <div class="faq-cta-buttons">
                            <a href="{{ url('/Contact-Us') }}" class="btn-primary">
                                <i class="fas fa-envelope"></i> Contact Support
                            </a>
                            <a href="https://wa.me/919876543210" class="btn-secondary" target="_blank">
                                <i class="fab fa-whatsapp"></i> WhatsApp Us
                            </a>
                        </div>
                    </div>
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

    <script>
    // FAQ Accordion
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');

            question.addEventListener('click', () => {
                // Close other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });

                // Toggle current item
                item.classList.toggle('active');
            });
        });
    });
    </script>
</body>
</html>
