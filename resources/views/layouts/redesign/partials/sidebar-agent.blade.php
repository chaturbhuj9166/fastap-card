<!-- Agent Sidebar -->
@php
    $websetting = App\Models\websetting::first();
@endphp

<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ url('/agent/dashboard') }}" class="sidebar-logo">
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
            <a href="{{ url('/agent/dashboard') }}" class="nav-item {{ request()->is('agent/dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span class="nav-item-text">Dashboard</span>
            </a>
        </div>

        <!-- User Management -->
        <div class="nav-section">
            <span class="nav-section-title">Users</span>
            <a href="{{ url('/agent/allusers') }}" class="nav-item {{ request()->is('agent/allusers*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span class="nav-item-text">All Users</span>
            </a>
            <a href="{{ url('/agent/addnewuser') }}" class="nav-item {{ request()->is('agent/addnewuser*') ? 'active' : '' }}">
                <i class="fas fa-user-plus"></i>
                <span class="nav-item-text">Add New User</span>
            </a>
        </div>

        <!-- Orders -->
        <div class="nav-section">
            <span class="nav-section-title">Orders</span>
            <a href="{{ url('/agent/allorders') }}" class="nav-item {{ request()->is('agent/allorders*') || request()->is('agent/vieworder*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="nav-item-text">All Orders</span>
            </a>
        </div>

        <!-- Content -->
        <div class="nav-section">
            <span class="nav-section-title">Content</span>
            <a href="{{ url('/agent/faq') }}" class="nav-item {{ request()->is('agent/faq*') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i>
                <span class="nav-item-text">FAQ</span>
            </a>
            <a href="{{ url('/agent/articles') }}" class="nav-item {{ request()->is('agent/articles*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span class="nav-item-text">Articles</span>
            </a>
        </div>

        <!-- Support -->
        <div class="nav-section">
            <span class="nav-section-title">Support</span>
            <a href="{{ url('/agent/contact') }}" class="nav-item {{ request()->is('agent/contact*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span class="nav-item-text">Contact Queries</span>
            </a>
            <a href="{{ url('/agent/support') }}" class="nav-item {{ request()->is('agent/support*') ? 'active' : '' }}">
                <i class="fas fa-headset"></i>
                <span class="nav-item-text">Support Tickets</span>
            </a>
        </div>

        <!-- Profile -->
        <div class="nav-section">
            <span class="nav-section-title">Account</span>
            <a href="{{ url('/agent/myprofile') }}" class="nav-item {{ request()->is('agent/myprofile*') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span class="nav-item-text">My Profile</span>
            </a>
            <a href="{{ url('/agent/logout') }}" class="nav-item">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item-text">Logout</span>
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                @if(session('agent_profile'))
                    <img src="{{ asset(session('agent_profile')) }}" alt="Agent">
                @else
                    <img src="{{ asset('assets/images/avatars/default.png') }}" alt="Agent">
                @endif
            </div>
            <div class="sidebar-user-info">
                <span class="sidebar-user-name">{{ session('agent_name', 'Agent') }}</span>
                <span class="sidebar-user-role">Franchise Partner</span>
            </div>
        </div>
    </div>
</aside>
