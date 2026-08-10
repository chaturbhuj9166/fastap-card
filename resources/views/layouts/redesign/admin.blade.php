@extends('layouts.redesign.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('redesign/css/dashboard.css') }}">
    @stack('page-styles')
@endpush

@section('content')
    <div class="dashboard-wrapper">
        <!-- Admin Sidebar -->
        @include('layouts.redesign.partials.sidebar-admin')

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
                            <a href="{{ url('/admin/index') }}">Admin</a>
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
                            <a href="{{ url('/admin/viewwebsetting') }}" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('/admin/logout') }}" class="dropdown-item">
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
                @yield('admin-content')
            </div>
        </div>
    </div>

    <!-- Modal Backdrop (for all modals) -->
    <div class="modal-backdrop"></div>
@endsection

@push('scripts')
    <script src="{{ asset('redesign/js/dashboard.js') }}"></script>
    @stack('page-scripts')
@endpush
