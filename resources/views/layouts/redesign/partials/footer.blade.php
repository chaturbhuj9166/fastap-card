<!-- Footer -->
<footer class="main-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="{{ url('/') }}" class="footer-logo">
                    <span class="text-gradient-purple">FASTAP</span>
                </a>
                <p class="footer-tagline">Transform your networking with smart NFC digital business cards.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/About-Us') }}">About Us</a></li>
                    <li><a href="{{ url('/Product') }}">Products</a></li>
                    <li><a href="{{ url('/Contact-Us') }}">Contact</a></li>
                    <li><a href="{{ url('/faq') }}">FAQ</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="footer-links">
                <h4>Our Products</h4>
                <ul>
                    <li><a href="#">Smart Business Cards</a></li>
                    <li><a href="#">Professional Cards</a></li>
                    <li><a href="#">Metal Cards</a></li>
                    <li><a href="#">Custom Cards</a></li>
                    <li><a href="#">Corporate Solutions</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-contact">
                <h4>Contact Us</h4>
                <ul>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@fastap.in">info@fastap.in</a>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <a href="tel:+919876543210">+91 98765 43210</a>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jaipur, Rajasthan, India</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Fastap. All rights reserved.</p>
            <div class="footer-legal">
                <a href="{{ url('/privacy_policy') }}">Privacy Policy</a>
                <a href="{{ url('/term_condition') }}">Terms & Conditions</a>
                <a href="{{ url('/return_&_refund_policy') }}">Refund Policy</a>
            </div>
        </div>
    </div>
</footer>

<style>
.main-footer {
    background: var(--bg-secondary);
    border-top: 1px solid var(--border-light);
    padding: var(--space-3xl) 0 var(--space-lg);
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
    gap: var(--space-2xl);
    margin-bottom: var(--space-2xl);
}

.footer-logo {
    font-size: var(--text-2xl);
    font-weight: var(--font-extrabold);
    text-decoration: none;
    display: inline-block;
    margin-bottom: var(--space-md);
}

.footer-tagline {
    color: var(--text-secondary);
    margin-bottom: var(--space-lg);
    max-width: 280px;
}

.footer-social {
    display: flex;
    gap: var(--space-sm);
}

.footer-social a {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-tertiary);
    border-radius: var(--radius-full);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.footer-social a:hover {
    background: var(--gradient-purple);
    color: white;
    transform: translateY(-2px);
}

.footer-links h4,
.footer-contact h4 {
    font-size: var(--text-lg);
    font-weight: var(--font-semibold);
    color: var(--text-primary);
    margin-bottom: var(--space-lg);
}

.footer-links ul,
.footer-contact ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li,
.footer-contact li {
    margin-bottom: var(--space-sm);
}

.footer-links a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.footer-links a:hover {
    color: var(--purple-500);
}

.footer-contact li {
    display: flex;
    align-items: flex-start;
    gap: var(--space-sm);
    color: var(--text-secondary);
}

.footer-contact i {
    color: var(--purple-500);
    margin-top: 4px;
}

.footer-contact a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.footer-contact a:hover {
    color: var(--purple-500);
}

.footer-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: var(--space-lg);
    border-top: 1px solid var(--border-light);
}

.footer-bottom p {
    color: var(--text-muted);
    margin: 0;
}

.footer-legal {
    display: flex;
    gap: var(--space-lg);
}

.footer-legal a {
    color: var(--text-muted);
    text-decoration: none;
    font-size: var(--text-sm);
    transition: color var(--transition-fast);
}

.footer-legal a:hover {
    color: var(--purple-500);
}

@media (max-width: 992px) {
    .footer-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .footer-tagline {
        max-width: 100%;
    }

    .footer-social {
        justify-content: center;
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
