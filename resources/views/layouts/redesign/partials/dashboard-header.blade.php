<!-- Dashboard Header -->
<header class="dashboard-header">
    <div class="dashboard-header-left">
        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Page Title & Breadcrumb -->
        <div>
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            @hasSection('breadcrumb')
                <nav class="breadcrumb">
                    <a href="{{ url('/userdashboard') }}">Home</a>
                    <span class="breadcrumb-separator">/</span>
                    @yield('breadcrumb')
                </nav>
            @endif
        </div>
    </div>

    <div class="dashboard-header-right">
        <!-- Search -->
        <div class="header-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search...">
        </div>

        <!-- Theme Toggle -->
        <button class="theme-toggle" id="dashboardThemeToggle" aria-label="Toggle theme">
            <span class="theme-icon theme-icon-sun"><i class="fas fa-sun"></i></span>
            <span class="theme-icon theme-icon-moon"><i class="fas fa-moon"></i></span>
            <span class="theme-toggle-slider"></span>
        </button>

        <!-- Notifications -->
        <div class="dropdown">
            <button class="header-icon-btn dropdown-trigger">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </button>
            <div class="dropdown-menu">
                <div class="dropdown-item">
                    <i class="fas fa-info-circle text-blue"></i>
                    <span>New order received</span>
                </div>
                <div class="dropdown-item">
                    <i class="fas fa-check-circle text-green"></i>
                    <span>Profile updated</span>
                </div>
                <div class="dropdown-item">
                    <i class="fas fa-star text-orange"></i>
                    <span>New feature available</span>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-eye"></i>
                    <span>View all notifications</span>
                </a>
            </div>
        </div>

        <!-- Profile Dropdown -->
        @php
            $customer = \App\Models\Customer::find(session('FRONT_USER_ID'));
            $profileImage = $customer?->profile;
        @endphp
        <div class="dropdown">
            <button class="sidebar-user dropdown-trigger">
                <div class="sidebar-user-avatar">
                    @if($profileImage)
                        <img src="{{ asset('public/frontend/user_images/' . $profileImage) }}" alt="Profile">
                    @else
                        <img src="{{ asset('assets/images/avatars/default.png') }}" alt="Profile">
                    @endif
                </div>
            </button>
            <div class="dropdown-menu">
                <a href="{{ url('/updateuserprofile') }}" class="dropdown-item">
                    <i class="fas fa-user"></i>
                    <span>My Profile</span>
                </a>
                <a href="{{ url('/changepassword') }}" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ url('/logout') }}" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
</header>
