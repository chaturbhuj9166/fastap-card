{{-- ========================================
     FASTAP - Modern Header Component
     Clean navigation with theme toggle
     ======================================== --}}

<header class="modern-header">
    <div class="container">
        <div class="header-content">
            {{-- Logo --}}
            <div class="header-logo">
                <a href="{{url('/')}}" class="logo-link">
                    <img src="{{url('frontend/assets/img/logo/fastap.png')}}" alt="Fastap Logo" class="logo-image">
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <nav class="header-nav hide-mobile">
                <a href="{{url('/')}}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                <a href="{{url('/Product')}}" class="nav-link {{ Request::is('Product*') ? 'active' : '' }}">Product</a>
                <a href="{{url('/blog-list')}}" class="nav-link {{ Request::is('blog-list*') ? 'active' : '' }}">Blog</a>

                {{-- More Dropdown --}}
                <div class="nav-dropdown">
                    <a href="javascript:void(0)" class="nav-link">
                        More
                        <i class="fas fa-chevron-down" style="font-size: 0.75rem; margin-left: 0.25rem;"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{url('/About-Us')}}" class="dropdown-item">About Us</a>
                        <a href="{{url('/faq')}}" class="dropdown-item">FAQ Page</a>
                        <a href="{{url('/Contact-Us')}}" class="dropdown-item">Contact Us</a>
                        <a href="{{url('/Corporate')}}" class="dropdown-item">Corporate</a>
                    </div>
                </div>

                {{-- Login Dropdown --}}
                <div class="nav-dropdown">
                    <a href="javascript:void(0)" class="nav-link">
                        Login
                        <i class="fas fa-chevron-down" style="font-size: 0.75rem; margin-left: 0.25rem;"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{url('/userdashboard')}}" class="dropdown-item">User</a>
                    </div>
                </div>
            </nav>

            {{-- Header Actions --}}
            <div class="header-actions">
                {{-- Theme Toggle --}}
                <button class="theme-toggle" aria-label="Toggle dark mode">
                    <span class="theme-toggle-slider">
                        <i class="fas fa-sun"></i>
                    </span>
                    <i class="fas fa-sun theme-icon theme-icon-sun"></i>
                    <i class="fas fa-moon theme-icon theme-icon-moon"></i>
                </button>

                {{-- Shopping Cart --}}
                <a href="{{url('new-cart')}}" class="cart-icon-link">
                    <i class="fas fa-shopping-cart"></i>
                    @php
                        $user_id = request()->session()->get('FRONT_USER_ID');
                        $cart_count = App\Models\Cart::where('user_id', $user_id)->count();
                    @endphp
                    @if($cart_count > 0)
                        <span class="cart-badge">{{ $cart_count }}</span>
                    @endif
                </a>

                {{-- User Account --}}
                @if(session()->has('FRONT_USER_ID'))
                    <a href="{{url('/userdashboard')}}" class="btn btn-sm btn-primary hide-mobile">
                        <i class="fas fa-user"></i>
                        Dashboard
                    </a>
                @else
                    <a href="{{url('/Login')}}" class="btn btn-sm btn-outline hide-mobile">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </a>
                @endif

                {{-- Mobile Menu Toggle --}}
                <button class="mobile-menu-toggle" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="mobile-menu">
        <nav class="mobile-nav">
            <a href="{{url('/')}}" class="mobile-nav-link {{ Request::is('/') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                Home
            </a>
            <a href="{{url('/Product')}}" class="mobile-nav-link {{ Request::is('Product*') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                Product
            </a>
            <a href="{{url('/blog-list')}}" class="mobile-nav-link {{ Request::is('blog-list*') ? 'active' : '' }}">
                <i class="fas fa-blog"></i>
                Blog
            </a>
            <a href="{{url('/About-Us')}}" class="mobile-nav-link {{ Request::is('About-Us*') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i>
                About Us
            </a>
            <a href="{{url('/faq')}}" class="mobile-nav-link {{ Request::is('faq*') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i>
                FAQ
            </a>
            <a href="{{url('/Contact-Us')}}" class="mobile-nav-link {{ Request::is('Contact-Us*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                Contact Us
            </a>
            <a href="{{url('/Corporate')}}" class="mobile-nav-link {{ Request::is('Corporate*') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                Corporate
            </a>
            <div class="mobile-nav-divider"></div>
            @if(session()->has('FRONT_USER_ID'))
                <a href="{{url('/userdashboard')}}" class="mobile-nav-link">
                    <i class="fas fa-user"></i>
                    Dashboard
                </a>
            @else
                <a href="{{url('/userdashboard')}}" class="mobile-nav-link">
                    <i class="fas fa-sign-in-alt"></i>
                    User Login
                </a>
            @endif
        </nav>
    </div>
</header>

<style>
/* ============= MODERN HEADER STYLES ============= */
.modern-header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: var(--header-bg);
    border-bottom: 1px solid var(--header-border);
    z-index: var(--z-fixed);
    transition: all var(--transition-base);
    backdrop-filter: blur(10px);
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 0;
}

/* Logo */
.header-logo .logo-link {
    display: flex;
    align-items: center;
}

.logo-image {
    height: 40px;
    width: auto;
    transition: transform var(--transition-base);
}

.header-logo .logo-link:hover .logo-image {
    transform: scale(1.05);
}

/* Navigation */
.header-nav {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-link {
    position: relative;
    font-size: var(--text-base);
    font-weight: var(--font-medium);
    color: var(--text-secondary);
    text-decoration: none;
    transition: color var(--transition-fast);
    padding: 0.5rem 0;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--gradient-purple);
    transition: width var(--transition-base);
}

.nav-link:hover,
.nav-link.active {
    color: var(--purple-500);
}

.nav-link:hover::after,
.nav-link.active::after {
    width: 100%;
}

/* Navigation Dropdown */
.nav-dropdown {
    position: relative;
}

.nav-dropdown .nav-link {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 180px;
    background: var(--card-bg);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all var(--transition-base);
    z-index: var(--z-dropdown);
}

.nav-dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    display: block;
    padding: 0.75rem 1.25rem;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: var(--text-base);
    font-weight: var(--font-medium);
    transition: all var(--transition-fast);
}

.dropdown-item:hover {
    background: var(--bg-secondary);
    color: var(--purple-500);
    padding-left: 1.5rem;
}

/* Header Actions */
.header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

/* Cart Icon */
.cart-icon-link {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    color: var(--text-secondary);
    font-size: 1.25rem;
    border-radius: var(--radius-lg);
    transition: all var(--transition-fast);
}

.cart-icon-link:hover {
    color: var(--purple-500);
    background: var(--bg-secondary);
}

.cart-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 20px;
    height: 20px;
    padding: 0 6px;
    background: var(--gradient-purple);
    color: white;
    font-size: 0.75rem;
    font-weight: var(--font-semibold);
    border-radius: var(--radius-full);
    box-shadow: 0 2px 8px rgba(124, 58, 237, 0.4);
}

/* Mobile Menu Toggle */
.mobile-menu-toggle {
    display: none; /* Hidden on desktop */
    flex-direction: column;
    justify-content: space-around;
    width: 28px;
    height: 24px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
    z-index: 10;
}

.mobile-menu-toggle span {
    width: 28px;
    height: 3px;
    background: var(--text-primary);
    border-radius: 2px;
    transition: all var(--transition-base);
    transform-origin: center;
}

.mobile-menu-toggle.active span:nth-child(1) {
    transform: rotate(45deg) translateY(10px);
}

.mobile-menu-toggle.active span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active span:nth-child(3) {
    transform: rotate(-45deg) translateY(-10px);
}

/* Mobile Menu */
.mobile-menu {
    position: fixed;
    top: 73px;
    left: 0;
    right: 0;
    background: var(--bg-primary);
    border-bottom: 1px solid var(--border-light);
    max-height: 0;
    overflow: hidden;
    transition: max-height var(--transition-base);
    box-shadow: var(--shadow-lg);
    display: none; /* Hidden on desktop */
}

.mobile-menu.active {
    max-height: calc(100vh - 73px);
    overflow-y: auto;
}

.mobile-nav {
    padding: 1rem 0;
}

.mobile-nav-link {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem var(--space-md);
    color: var(--text-secondary);
    font-weight: var(--font-medium);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.mobile-nav-link i {
    width: 20px;
    font-size: 1.125rem;
    color: var(--purple-500);
}

.mobile-nav-link:hover,
.mobile-nav-link.active {
    background: var(--bg-secondary);
    color: var(--purple-500);
}

.mobile-nav-divider {
    height: 1px;
    background: var(--border-light);
    margin: 0.5rem var(--space-md);
}

/* Scrolled State */
.modern-header.scrolled {
    box-shadow: var(--shadow-md);
}

/* Body Padding for Fixed Header */
body {
    padding-top: 73px;
}

/* Responsive */
@media (max-width: 768px) {
    .header-content {
        padding: 0.875rem 0;
    }

    .logo-image {
        height: 32px;
    }

    body {
        padding-top: 65px;
    }

    /* Hide desktop navigation on mobile */
    .hide-mobile {
        display: none !important;
    }

    /* Show mobile menu toggle on mobile */
    .mobile-menu-toggle {
        display: flex;
    }

    /* Show mobile menu on mobile */
    .mobile-menu {
        display: block;
        top: 65px;
    }
}
</style>

<script>
// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                menuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Close menu on link click
        mobileMenu.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', function() {
                menuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }
});
</script>
