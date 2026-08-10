<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ffffff">
    <title>Contact Us - Fastap | NFC Digital Business Cards</title>
    <meta name="description" content="Get in touch with Fastap. We're here to help you with NFC digital business cards, corporate solutions, and support.">

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

    /* Contact Section */
    .contact-section {
        padding: var(--space-3xl) 0;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: var(--space-3xl);
    }

    /* Contact Info */
    .contact-info {
        background: var(--bg-secondary);
        border-radius: var(--radius-2xl);
        padding: var(--space-2xl);
    }

    .contact-info h2 {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-sm);
    }

    .contact-info > p {
        color: var(--text-secondary);
        margin-bottom: var(--space-xl);
    }

    .contact-methods {
        display: flex;
        flex-direction: column;
        gap: var(--space-lg);
    }

    .contact-method {
        display: flex;
        align-items: flex-start;
        gap: var(--space-md);
        padding: var(--space-lg);
        background: var(--bg-primary);
        border-radius: var(--radius-xl);
        transition: all var(--transition-base);
    }

    .contact-method:hover {
        transform: translateX(5px);
        box-shadow: var(--shadow-md);
    }

    .contact-method-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
        flex-shrink: 0;
    }

    .contact-method:nth-child(1) .contact-method-icon {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
        color: var(--purple-500);
    }

    .contact-method:nth-child(2) .contact-method-icon {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%);
        color: var(--blue-500);
    }

    .contact-method:nth-child(3) .contact-method-icon {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(52, 211, 153, 0.15) 100%);
        color: var(--green-500);
    }

    .contact-method-content h4 {
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-xs);
    }

    .contact-method-content a,
    .contact-method-content span {
        color: var(--text-secondary);
        text-decoration: none;
        font-size: var(--text-sm);
        transition: color var(--transition-fast);
    }

    .contact-method-content a:hover {
        color: var(--purple-500);
    }

    /* Social Links */
    .contact-social {
        margin-top: var(--space-xl);
        padding-top: var(--space-xl);
        border-top: 1px solid var(--border-light);
    }

    .contact-social h4 {
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-md);
    }

    .social-links {
        display: flex;
        gap: var(--space-sm);
    }

    .social-link {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-lg);
        background: var(--bg-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        text-decoration: none;
        transition: all var(--transition-fast);
    }

    .social-link:hover {
        background: var(--gradient-purple);
        color: white;
        transform: translateY(-3px);
    }

    /* Contact Form */
    .contact-form-wrapper {
        background: var(--bg-primary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-2xl);
        padding: var(--space-2xl);
    }

    .contact-form-wrapper h2 {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-sm);
    }

    .contact-form-wrapper > p {
        color: var(--text-secondary);
        margin-bottom: var(--space-xl);
    }

    .contact-form {
        display: flex;
        flex-direction: column;
        gap: var(--space-lg);
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-lg);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: var(--space-xs);
    }

    .form-group label {
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        color: var(--text-primary);
    }

    .form-group input,
    .form-group textarea {
        padding: var(--space-md);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-size: var(--text-base);
        transition: all var(--transition-fast);
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--purple-500);
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 150px;
    }

    .submit-btn {
        background: var(--gradient-purple);
        color: white;
        border: none;
        padding: var(--space-md) var(--space-xl);
        border-radius: var(--radius-full);
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        cursor: pointer;
        transition: all var(--transition-base);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-sm);
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
    }

    /* Map Section */
    .map-section {
        padding: var(--space-3xl) 0;
        background: var(--bg-secondary);
    }

    .map-container {
        border-radius: var(--radius-2xl);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .map-container iframe {
        width: 100%;
        height: 400px;
        border: none;
    }

    /* FAQ Preview */
    .faq-preview {
        padding: var(--space-3xl) 0;
    }

    .faq-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-lg);
        margin-top: var(--space-2xl);
    }

    .faq-item {
        background: var(--bg-secondary);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        transition: all var(--transition-base);
    }

    .faq-item:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .faq-item h4 {
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-sm);
        display: flex;
        align-items: flex-start;
        gap: var(--space-sm);
    }

    .faq-item h4 i {
        color: var(--purple-500);
        font-size: var(--text-lg);
    }

    .faq-item p {
        color: var(--text-secondary);
        font-size: var(--text-sm);
        line-height: 1.6;
        padding-left: calc(var(--text-lg) + var(--space-sm));
    }

    /* Responsive */
    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .faq-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    /* Alert Styles */
    .alert {
        padding: var(--space-md) var(--space-lg);
        border-radius: var(--radius-lg);
        margin-bottom: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: var(--green-600);
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #dc2626;
    }
    </style>
</head>
<body>
    @php
        $websetting = App\Models\websetting::first();
    @endphp

    {{-- Header --}}
    @include('frontend.header-new')

    {{-- Page Hero --}}
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content fade-up">
                <h1>Contact <span class="text-gradient-purple">Us</span></h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="current">Contact Us</span>
                </nav>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                {{-- Contact Info --}}
                <div class="contact-info fade-up">
                    <h2>Get in Touch</h2>
                    <p>We'd love to hear from you. Reach out to us through any of these channels.</p>

                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="contact-method-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-method-content">
                                <h4>Call Us</h4>
                                <a href="tel:{{ $websetting->mobile ?? '+919876543210' }}">
                                    {{ $websetting->mobile ?? '+91 98765 43210' }}
                                </a>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="contact-method-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-method-content">
                                <h4>Email Us</h4>
                                <a href="mailto:{{ $websetting->email ?? 'info@fastap.in' }}">
                                    {{ $websetting->email ?? 'info@fastap.in' }}
                                </a>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="contact-method-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-method-content">
                                <h4>Visit Us</h4>
                                <span>{{ $websetting->address ?? 'Jaipur, Rajasthan, India' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="contact-social">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="contact-form-wrapper fade-up">
                    <h2>Send us a Message</h2>
                    <p>Fill out the form below and we'll get back to you within 24 hours.</p>

                    @if (Session::get('message_contact'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            Thank you for your enquiry! We'll get back to you soon.
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            Please check the form and try again.
                        </div>
                    @endif

                    <form class="contact-form" method="POST" action="savecontact">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" id="name" name="name" placeholder="John Doe" required value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="john@example.com" required value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="sub" placeholder="+91 98765 43210" required value="{{ old('sub') }}">
                        </div>

                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="msg" placeholder="Tell us how we can help you..." required>{{ old('msg') }}</textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="map-section">
        <div class="container">
            <div class="section-header text-center fade-up">
                <h2 class="section-title">Find Us</h2>
                <p class="section-subtitle">Visit our office in Jaipur, Rajasthan</p>
            </div>
            <div class="map-container fade-up" style="margin-top: var(--space-2xl);">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227749.07905254!2d75.6505!3d26.9124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1234567890"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    {{-- FAQ Preview --}}
    <section class="faq-preview">
        <div class="container">
            <div class="section-header text-center fade-up">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Quick answers to common questions</p>
            </div>
            <div class="faq-grid stagger-animation">
                <div class="faq-item fade-up">
                    <h4><i class="fas fa-question-circle"></i> How does an NFC card work?</h4>
                    <p>Simply tap your NFC card on any smartphone, and your digital profile will instantly appear. No app download required.</p>
                </div>
                <div class="faq-item fade-up">
                    <h4><i class="fas fa-question-circle"></i> Can I update my information?</h4>
                    <p>Yes! You can update your profile information anytime through your dashboard. Changes reflect instantly.</p>
                </div>
                <div class="faq-item fade-up">
                    <h4><i class="fas fa-question-circle"></i> What's the delivery time?</h4>
                    <p>Standard delivery takes 5-7 business days. Express delivery is available for urgent orders.</p>
                </div>
                <div class="faq-item fade-up">
                    <h4><i class="fas fa-question-circle"></i> Do you offer corporate solutions?</h4>
                    <p>Yes, we offer bulk orders and customized branding solutions for businesses. Contact us for special pricing.</p>
                </div>
            </div>
            <div class="text-center" style="margin-top: var(--space-2xl);">
                <a href="{{ url('/faq') }}" class="btn btn-primary">
                    View All FAQs <i class="fas fa-arrow-right"></i>
                </a>
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
