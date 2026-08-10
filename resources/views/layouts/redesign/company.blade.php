@extends('layouts.redesign.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('redesign/css/dashboard.css') }}">
    <style>
        /* Company Theme - Blue/Teal Color Scheme */
        .dashboard-sidebar {
            --sidebar-accent: #0891b2;
        }
        .dashboard-sidebar .sidebar-logo {
            background: linear-gradient(135deg, #0891b2, #06b6d4);
        }
        .sidebar-nav-link.active,
        .sidebar-nav-link:hover {
            background: linear-gradient(135deg, rgba(8, 145, 178, 0.1), rgba(6, 182, 212, 0.1));
            color: #0891b2;
        }
        .sidebar-nav-link.active::before {
            background: #0891b2;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0891b2, #06b6d4);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0e7490, #0891b2);
        }
        .stat-card.primary {
            background: linear-gradient(135deg, #0891b2, #06b6d4);
        }
        .welcome-card {
            background: linear-gradient(135deg, #0891b2, #06b6d4);
        }
        .table-actions .btn-primary {
            background: #0891b2;
        }
        .badge-primary {
            background: rgba(8, 145, 178, 0.1);
            color: #0891b2;
        }
    </style>
    @stack('page-styles')
@endpush

@section('content')
    <div class="dashboard-wrapper">
        <!-- Company Sidebar -->
        @include('layouts.redesign.partials.sidebar-company')

        <!-- Main Content Area -->
        <div class="dashboard-main">
            <!-- Top Header -->
            <header class="dashboard-header">
                <div class="dashboard-header-left">
                    <button class="mobile-menu-toggle" id="mobileMenuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                        <nav class="breadcrumb">
                            <a href="{{ url('/company/dashboard') }}">Company</a>
                            <span class="breadcrumb-separator">/</span>
                            @yield('breadcrumb')
                        </nav>
                    </div>
                </div>
                <div class="dashboard-header-right">
                    <div class="header-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search...">
                    </div>
                    <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
                        <span class="theme-icon theme-icon-sun"><i class="fas fa-sun"></i></span>
                        <span class="theme-icon theme-icon-moon"><i class="fas fa-moon"></i></span>
                        <span class="theme-toggle-slider"></span>
                    </button>
                    <a href="{{ url('/') }}" class="header-icon-btn" title="View Site" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div class="dropdown">
                        <button class="header-icon-btn dropdown-trigger">
                            <i class="fas fa-user"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ url('/company/profile') }}" class="dropdown-item">
                                <i class="fas fa-building"></i>
                                <span>Company Profile</span>
                            </a>
                            <a href="{{ url('/company/change-password') }}" class="dropdown-item">
                                <i class="fas fa-key"></i>
                                <span>Change Password</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('/company/logout') }}" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Flash Messages -->
                @include('layouts.redesign.partials.flash-messages')

                <!-- Page Content -->
                @yield('company-content')
            </div>
        </div>
    </div>

    <!-- Modal Backdrop -->
    <div class="modal-backdrop"></div>
@endsection

@push('scripts')
    <script src="{{ asset('redesign/js/dashboard.js') }}"></script>
    @stack('page-scripts')
@endpush
