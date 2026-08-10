<!-- Header -->
<header class="main-header" id="mainHeader">
    <div class="container">
        <nav class="header-nav">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="header-logo">
                <span class="logo-text">FASTAP</span>
            </a>

            <!-- Desktop Navigation -->
            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/Product') }}" class="{{ request()->is('Product*') ? 'active' : '' }}">Products</a></li>
                <li><a href="{{ url('/About-Us') }}" class="{{ request()->is('About-Us') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ url('/Contact-Us') }}" class="{{ request()->is('Contact-Us') ? 'active' : '' }}">Contact</a></li>
                <li><a href="{{ url('/faq') }}" class="{{ request()->is('faq') ? 'active' : '' }}">FAQ</a></li>
            </ul>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- Theme Toggle -->
                <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
                    <span class="theme-icon theme-icon-sun"><i class="fas fa-sun"></i></span>
                    <span class="theme-icon theme-icon-moon"><i class="fas fa-moon"></i></span>
                    <span class="theme-toggle-slider"></span>
                </button>

                <!-- Cart -->
                <a href="{{ url('/cart') }}" class="header-cart">
                    <i class="fas fa-shopping-cart"></i>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="cart-badge">{{ count(session('cart')) }}</span>
                    @endif
                </a>

                <!-- Auth Buttons -->
                @if(session('FRONT_USER_LOGIN'))
                    <a href="{{ url('/userdashboard') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user"></i>
                        Dashboard
                    </a>
                @else
                    <a href="{{ url('/Login') }}" class="btn btn-outline btn-sm">Login</a>
                    <a href="{{ url('/registration') }}" class="btn btn-primary btn-sm">Get Started</a>
                @endif

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
    </div>
</header>

<style>
.main-header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: var(--header-bg);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--header-border);
    z-index: var(--z-fixed);
    transition: all var(--transition-base);
}

.main-header.scrolled {
    box-shadow: var(--header-shadow);
}

.header-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 80px;
}

.header-logo {
    text-decoration: none;
}

.logo-text {
    font-size: var(--text-2xl);
    font-weight: var(--font-extrabold);
    background: var(--gradient-purple);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: var(--space-lg);
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-menu a {
    color: var(--text-secondary);
    font-weight: var(--font-medium);
    text-decoration: none;
    padding: var(--space-xs) 0;
    position: relative;
    transition: color var(--transition-fast);
}

.nav-menu a:hover,
.nav-menu a.active {
    color: var(--purple-500);
}

.nav-menu a.active::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--gradient-purple);
    border-radius: var(--radius-full);
}

.header-actions {
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.header-cart {
    position: relative;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.header-cart:hover {
    color: var(--purple-500);
}

.cart-badge {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--gradient-pink);
    color: white;
    font-size: 10px;
    font-weight: var(--font-bold);
    border-radius: var(--radius-full);
}

.mobile-menu-btn {
    display: none;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    width: 32px;
    height: 32px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
}

.mobile-menu-btn span {
    width: 24px;
    height: 2px;
    background: var(--text-primary);
    border-radius: var(--radius-full);
    transition: all var(--transition-fast);
}

.mobile-menu-btn.active span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}

.mobile-menu-btn.active span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-btn.active span:nth-child(3) {
    transform: rotate(-45deg) translate(5px, -5px);
}

@media (max-width: 992px) {
    .nav-menu {
        position: fixed;
        top: 80px;
        left: 0;
        right: 0;
        bottom: 0;
        flex-direction: column;
        justify-content: flex-start;
        padding: var(--space-xl);
        background: var(--bg-primary);
        border-top: 1px solid var(--border-light);
        transform: translateX(-100%);
        transition: transform var(--transition-base);
    }

    .nav-menu.active {
        transform: translateX(0);
    }

    .nav-menu a {
        font-size: var(--text-lg);
        padding: var(--space-md) 0;
    }

    .mobile-menu-btn {
        display: flex;
    }

    .header-actions .btn {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('mainHeader');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const navMenu = document.getElementById('navMenu');

    // Scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    if (mobileMenuBtn && navMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenuBtn.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    }
});
</script>
