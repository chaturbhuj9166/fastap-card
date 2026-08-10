<!-- Admin Sidebar -->
@php
    $websetting = App\Models\websetting::first();
@endphp

<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ url('/admin/index') }}" class="sidebar-logo">
            @if($websetting && $websetting->logo)
                <img src="{{ url('uploads/system_setting/'.$websetting->logo) }}" alt="Fastap" style="height: 32px;">
            @endif
            <span class="sidebar-logo-text">FASTAP</span>
        </a>
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav">
        <!-- Main Menu -->
        <div class="nav-section">
            <span class="nav-section-title">Main</span>
            <a href="{{ url('/admin/index') }}" class="nav-item {{ request()->is('admin/index') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span class="nav-item-text">Dashboard</span>
            </a>
        </div>

        <!-- E-Commerce -->
        <div class="nav-section">
            <span class="nav-section-title">E-Commerce</span>
            <a href="{{ url('/admin/viewcategroy') }}" class="nav-item {{ request()->is('admin/viewcategroy*') || request()->is('admin/*category*') ? 'active' : '' }}">
                <i class="fas fa-list"></i>
                <span class="nav-item-text">Categories</span>
            </a>
            <a href="{{ url('/admin/view-product') }}" class="nav-item {{ request()->is('admin/view-product*') || request()->is('admin/*product*') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                <span class="nav-item-text">Products</span>
            </a>
            <a href="{{ url('/admin/orders') }}" class="nav-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="nav-item-text">Orders</span>
            </a>
            <a href="{{ url('/admin/preorder') }}" class="nav-item {{ request()->is('admin/preorder*') ? 'active' : '' }}">
                <i class="fas fa-clock"></i>
                <span class="nav-item-text">Pre-Orders</span>
            </a>
        </div>

        <!-- Users & Agents -->
        <div class="nav-section">
            <span class="nav-section-title">Users & Agents</span>
            <a href="{{ url('/admin/user-list') }}" class="nav-item {{ request()->is('admin/user-list*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span class="nav-item-text">Users</span>
            </a>
            <a href="{{ url('/admin/manageagent') }}" class="nav-item {{ request()->is('admin/manageagent*') || request()->is('admin/*agent*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i>
                <span class="nav-item-text">Franchise</span>
            </a>
        </div>

        <!-- Companies & Themes -->
        <div class="nav-section">
            <span class="nav-section-title">Companies & Themes</span>
            <a href="{{ url('/admin/companies') }}" class="nav-item {{ request()->is('admin/companies*') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                <span class="nav-item-text">Companies</span>
            </a>
            <a href="{{ url('/admin/profession-themes') }}" class="nav-item {{ request()->is('admin/profession-themes*') ? 'active' : '' }}">
                <i class="fas fa-palette"></i>
                <span class="nav-item-text">Profession Themes</span>
            </a>
        </div>

        <!-- Marketing -->
        <div class="nav-section">
            <span class="nav-section-title">Marketing</span>
            <a href="{{ url('/admin/view_offer') }}" class="nav-item {{ request()->is('admin/view_offer*') || request()->is('admin/*offer*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i>
                <span class="nav-item-text">Offers</span>
            </a>
            <a href="{{ url('/admin/view_coupon') }}" class="nav-item {{ request()->is('admin/view_coupon*') || request()->is('admin/*coupon*') ? 'active' : '' }}">
                <i class="fas fa-ticket-alt"></i>
                <span class="nav-item-text">Coupons</span>
            </a>
        </div>

        <!-- Content -->
        <div class="nav-section">
            <span class="nav-section-title">Content</span>
            <a href="{{ url('/admin/testimonial') }}" class="nav-item {{ request()->is('admin/testimonial*') ? 'active' : '' }}">
                <i class="fas fa-comment-dots"></i>
                <span class="nav-item-text">Testimonials</span>
            </a>
            <a href="{{ url('/admin/view-faq') }}" class="nav-item {{ request()->is('admin/view-faq*') || request()->is('admin/*faq*') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i>
                <span class="nav-item-text">FAQ</span>
            </a>
            <a href="{{ url('/admin/view-brand_logo') }}" class="nav-item {{ request()->is('admin/view-brand_logo*') ? 'active' : '' }}">
                <i class="fas fa-handshake"></i>
                <span class="nav-item-text">Partners</span>
            </a>
        </div>

        <!-- Communications -->
        <div class="nav-section">
            <span class="nav-section-title">Communications</span>
            <a href="{{ url('/admin/contactus') }}" class="nav-item {{ request()->is('admin/contactus*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span class="nav-item-text">Contact Us</span>
            </a>
            <a href="{{ url('/admin/corporate') }}" class="nav-item {{ request()->is('admin/corporate*') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                <span class="nav-item-text">Corporate Leads</span>
            </a>
        </div>

        <!-- Settings -->
        <div class="nav-section">
            <span class="nav-section-title">Settings</span>
            <a href="{{ url('/admin/viewwebsetting') }}" class="nav-item {{ request()->is('admin/viewwebsetting*') || request()->is('admin/*websetting*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span class="nav-item-text">Web Settings</span>
            </a>
            <a href="{{ url('/admin/logout') }}" class="nav-item">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item-text">Logout</span>
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                @if($websetting && $websetting->logo)
                    <img src="{{ url('uploads/system_setting/'.$websetting->logo) }}" alt="Admin">
                @else
                    <img src="{{ asset('assets/images/avatars/default.png') }}" alt="Admin">
                @endif
            </div>
            <div class="sidebar-user-info">
                <span class="sidebar-user-name">{{ session('admin', 'Admin') }}</span>
                <span class="sidebar-user-role">Administrator</span>
            </div>
        </div>
    </div>
</aside>
