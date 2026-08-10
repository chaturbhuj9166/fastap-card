{{-- ========================================
     FASTAP - Modern Footer Component
     Clean footer with links and social icons
     ======================================== --}}

<footer class="modern-footer">
    <div class="footer-gradient-line"></div>

    <div class="container">
        <div class="footer-content">
            {{-- Brand Column --}}
            <div class="footer-column footer-brand">
                <img src="{{url('frontend/assets/img/logo/fastap.png')}}" alt="Fastap Logo" class="footer-logo">
                <p class="footer-tagline">
                    Artificial Intelligence (AI) and Machine Learning (ML) are closely related technologies that enable computers to learn from data and make predictions
                </p>
                <div class="footer-social">
                    <a href="https://www.facebook.com/profile.php?id=61551549521517&mibextid=LQQJ4d" class="social-icon" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/fastap_?igsh=MTR0bTIycmRjd2w2Zw==" class="social-icon" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://twitter.com/" target="_blank" class="social-icon" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/" target="_blank" class="social-icon" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="footer-column">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{url('/About-Us')}}">About us</a></li>
                    <li><a href="{{url('/Corporate')}}">Corporate</a></li>
                    <li><a href="{{url('/Product')}}">Products</a></li>
                    <li><a href="{{url('/faq')}}">Faq</a></li>
                    <li><a href="{{url('/Contact-Us')}}">Contact Us</a></li>
                </ul>
            </div>

            {{-- Products --}}
            <div class="footer-column">
                <h3 class="footer-title">Products</h3>
                <ul class="footer-links">
                    <li><a href="{{url('digital-business-card-in-jaipur')}}/business-card">BUSINESS CARD</a></li>
                    <li><a href="{{url('digital-business-card-in-jaipur')}}/business-professional-card">PROFESSIONAL CARD</a></li>
                    <li><a href="{{url('digital-business-card-in-jaipur')}}/premium-card">PREMIUM CARD</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            @php
                $data = App\Models\websetting::first();
            @endphp
            <div class="footer-column">
                <h3 class="footer-title">Contact</h3>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>{{$data->mobile ?? '+91 99999 99999'}}</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>{{$data->email ?? 'info@fastap.com'}}</span>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{$data->address ?? 'Jaipur, Rajasthan, India'}}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copyright">
                Copyright &copy;
                <script>document.write(new Date().getFullYear());</script>
                Fastap All right reserved.
            </p>
            <div class="footer-legal">
                <a href="{{url('/privacy_policy')}}">Privacy policy</a>
                <span class="separator">•</span>
                <a href="{{url('/privacy_policy')}}">Terms of condition</a>
            </div>
        </div>
    </div>
</footer>

<style>
/* ============= MODERN FOOTER ============= */
.modern-footer {
    background: var(--bg-secondary);
    padding-top: var(--space-3xl);
    padding-bottom: var(--space-xl);
    position: relative;
}

.footer-gradient-line {
    height: 3px;
    background: var(--gradient-multi);
    width: 100%;
}

/* Footer Content Grid */
.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.5fr;
    gap: var(--space-2xl);
    margin-bottom: var(--space-2xl);
    padding-top: var(--space-2xl);
}

/* Brand Column */
.footer-brand {
    max-width: 350px;
}

.footer-logo {
    max-width: 150px;
    height: auto;
    margin-bottom: var(--space-md);
}

.footer-tagline {
    font-size: var(--text-sm);
    color: var(--text-secondary);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-lg);
}

/* Social Icons */
.footer-social {
    display: flex;
    gap: var(--space-sm);
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: var(--bg-tertiary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    color: var(--text-secondary);
    font-size: var(--text-base);
    transition: all var(--transition-base);
}

.social-icon:hover {
    background: var(--gradient-purple);
    color: white;
    border-color: transparent;
    transform: translateY(-4px);
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.3);
}

/* Footer Columns */
.footer-column {
    display: flex;
    flex-direction: column;
}

.footer-title {
    font-size: var(--text-lg);
    font-weight: var(--font-semibold);
    color: var(--text-primary);
    margin-bottom: var(--space-md);
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: var(--space-sm);
}

.footer-links a {
    color: var(--text-secondary);
    font-size: var(--text-base);
    text-decoration: none;
    transition: color var(--transition-fast);
    position: relative;
}

.footer-links a::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 0;
    height: 2px;
    background: var(--purple-500);
    transition: width var(--transition-base);
}

.footer-links a:hover {
    color: var(--purple-500);
}

.footer-links a:hover::before {
    width: 100%;
}

/* Contact Info */
.footer-contact {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-contact li {
    display: flex;
    align-items: flex-start;
    gap: var(--space-sm);
    margin-bottom: var(--space-md);
    color: var(--text-secondary);
    font-size: var(--text-base);
}

.footer-contact i {
    color: var(--purple-500);
    font-size: var(--text-lg);
    margin-top: 2px;
}

.footer-contact a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.footer-contact a:hover {
    color: var(--purple-500);
}

/* Footer Bottom */
.footer-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: var(--space-xl);
    border-top: 1px solid var(--border-light);
}

.footer-copyright {
    font-size: var(--text-sm);
    color: var(--text-muted);
    margin: 0;
}

.footer-legal {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
}

.footer-legal a {
    font-size: var(--text-sm);
    color: var(--text-muted);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.footer-legal a:hover {
    color: var(--purple-500);
}

.footer-legal .separator {
    color: var(--text-muted);
}

/* Responsive */
@media (max-width: 992px) {
    .footer-content {
        grid-template-columns: 1fr 1fr;
    }

    .footer-brand {
        grid-column: 1 / -1;
        max-width: 100%;
    }
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: var(--space-xl);
    }

    .footer-bottom {
        flex-direction: column;
        gap: var(--space-md);
        text-align: center;
    }

    .footer-legal {
        flex-wrap: wrap;
        justify-content: center;
    }
}
</style>
