@extends('layouts.redesign.dashboard')

@section('page-title', 'Dashboard')

@section('dashboard-content')
<div class="dashboard-page">
    {{-- Welcome Section --}}
    <div class="welcome-banner fade-up">
        <div class="welcome-content">
            <h1>Welcome back, {{ session('FRONT_USER_NAME', 'User') }}!</h1>
            <p>Here's what's happening with your digital business card today.</p>
        </div>
        <div class="welcome-actions">
            <a href="{{ url('/myorder') }}" class="btn btn-white">
                <i class="fas fa-shopping-bag"></i> View Orders
            </a>
            <a href="{{ url('/qrcode') }}" class="btn btn-outline-white">
                <i class="fas fa-qrcode"></i> My QR Code
            </a>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="stats-grid stagger-animation">
        <div class="stat-card fade-up">
            <div class="stat-card-icon purple">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">{{ $profileViews ?? 0 }}</div>
                <div class="stat-card-label">Profile Views</div>
            </div>
            @php
                $profileTrend = $profileViewsTrend ?? 0;
                $profileTrendClass = $profileTrend < 0 ? 'down' : 'up';
                $profileTrendIcon = $profileTrend < 0 ? 'fa-arrow-down' : 'fa-arrow-up';
            @endphp
            <div class="stat-card-trend {{ $profileTrendClass }}">
                <i class="fas {{ $profileTrendIcon }}"></i> {{ abs($profileTrend) }}%
            </div>
        </div>

        <div class="stat-card fade-up">
            <div class="stat-card-icon blue">
                <i class="fas fa-share-alt"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">{{ $totalShares ?? 0 }}</div>
                <div class="stat-card-label">Profile Shares</div>
            </div>
            @php
                $sharesTrendValue = $sharesTrend ?? 0;
                $sharesTrendClass = $sharesTrendValue < 0 ? 'down' : 'up';
                $sharesTrendIcon = $sharesTrendValue < 0 ? 'fa-arrow-down' : 'fa-arrow-up';
            @endphp
            <div class="stat-card-trend {{ $sharesTrendClass }}">
                <i class="fas {{ $sharesTrendIcon }}"></i> {{ abs($sharesTrendValue) }}%
            </div>
        </div>

        <div class="stat-card fade-up">
            <div class="stat-card-icon green">
                <i class="fas fa-address-book"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">{{ $contactsSaved ?? 0 }}</div>
                <div class="stat-card-label">Contacts Saved</div>
            </div>
            @php
                $contactsTrendValue = $contactsTrend ?? 0;
                $contactsTrendClass = $contactsTrendValue < 0 ? 'down' : 'up';
                $contactsTrendIcon = $contactsTrendValue < 0 ? 'fa-arrow-down' : 'fa-arrow-up';
            @endphp
            <div class="stat-card-trend {{ $contactsTrendClass }}">
                <i class="fas {{ $contactsTrendIcon }}"></i> {{ abs($contactsTrendValue) }}%
            </div>
        </div>

        <div class="stat-card fade-up">
            <div class="stat-card-icon orange">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-card-content">
                @php
                    $orderCount = \App\Models\Order::where('user_id', session('FRONT_USER_ID'))->count();
                @endphp
                <div class="stat-card-value">{{ $orderCount }}</div>
                <div class="stat-card-label">Total Orders</div>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="dashboard-grid">
        {{-- Quick Actions --}}
        <div class="dashboard-card fade-up">
            <div class="dashboard-card-header">
                <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
            </div>
            <div class="dashboard-card-body">
                <div class="quick-actions-grid">
                    <a href="{{ url('/updateuserprofile') }}" class="quick-action-item">
                        <div class="quick-action-icon purple">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <span>Edit Profile</span>
                    </a>
                    <a href="{{ url('/mysocial') }}" class="quick-action-item">
                        <div class="quick-action-icon blue">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <span>Social Links</span>
                    </a>
                    <a href="{{ url('/myportfolio') }}" class="quick-action-item">
                        <div class="quick-action-icon pink">
                            <i class="fas fa-images"></i>
                        </div>
                        <span>Portfolio</span>
                    </a>
                    <a href="{{ url('/myvideos') }}" class="quick-action-item">
                        <div class="quick-action-icon orange">
                            <i class="fas fa-video"></i>
                        </div>
                        <span>Videos</span>
                    </a>
                    <a href="{{ url('/myprofessions') }}" class="quick-action-item">
                        <div class="quick-action-icon green">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <span>Professions</span>
                    </a>
                    <a href="{{ url('/myproducts') }}" class="quick-action-item">
                        <div class="quick-action-icon red">
                            <i class="fas fa-box"></i>
                        </div>
                        <span>Products</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Profile Preview --}}
        <div class="dashboard-card fade-up">
            <div class="dashboard-card-header">
                <h3><i class="fas fa-id-card"></i> Profile Preview</h3>
                <a href="{{ url('/updateuserprofile') }}" class="btn btn-sm btn-outline">Edit</a>
            </div>
            <div class="dashboard-card-body">
                <div class="profile-preview">
                    <div class="profile-preview-avatar">
                        @php
                            $customer = \App\Models\Customer::find(session('FRONT_USER_ID'));
                        @endphp
                        @if($customer && $customer->profile)
                            <img src="{{ asset('public/frontend/user_images/' . $customer->profile) }}" alt="Profile">
                        @else
                            <img src="{{ asset('assets/images/avatars/default.png') }}" alt="Profile">
                        @endif
                    </div>
                    <div class="profile-preview-info">
                        <h4>{{ session('FRONT_USER_NAME', 'User') }}</h4>
                        <p>{{ session('FRONT_USER_EMAIL', 'email@example.com') }}</p>
                        @if($customer && $customer->designation)
                            <span class="profile-preview-badge">{{ $customer->designation }}</span>
                        @endif
                    </div>
                    <div class="profile-preview-qr">
                        <a href="{{ url('/qrcode') }}" class="qr-link">
                            <i class="fas fa-qrcode"></i>
                            <span>View QR</span>
                        </a>
                    </div>
                </div>

                <div class="profile-completion">
                    <div class="profile-completion-header">
                        <span>Profile Completion</span>
                        <span class="completion-percent">75%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>
                    <p class="profile-completion-hint">Complete your profile to increase visibility</p>
                </div>
            </div>
        </div>

        {{-- Recent Orders --}}
        <div class="dashboard-card fade-up">
            <div class="dashboard-card-header">
                <h3><i class="fas fa-shopping-bag"></i> Recent Orders</h3>
                <a href="{{ url('/myorder') }}" class="btn btn-sm btn-outline">View All</a>
            </div>
            <div class="dashboard-card-body">
                @php
                    $recentOrders = \App\Models\Order::where('user_id', session('FRONT_USER_ID'))
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();
                @endphp

                @if($recentOrders->count() > 0)
                    <div class="orders-list">
                        @foreach($recentOrders as $order)
                            <div class="order-item">
                                <div class="order-item-info">
                                    <span class="order-id">#{{ $order->order_id ?? $order->id }}</span>
                                    <span class="order-date">{{ $order->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="order-item-status">
                                    @php
                                        $statusClass = match($order->status ?? 'pending') {
                                            'completed', 'delivered' => 'success',
                                            'processing', 'shipped' => 'warning',
                                            'cancelled' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">{{ ucfirst($order->status ?? 'Pending') }}</span>
                                </div>
                                <div class="order-item-amount">
                                    ₹{{ number_format($order->total ?? 0) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-shopping-bag"></i>
                        <p>No orders yet</p>
                        <a href="{{ url('/Product') }}" class="btn btn-sm btn-primary">Shop Now</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Content Overview --}}
        <div class="dashboard-card fade-up">
            <div class="dashboard-card-header">
                <h3><i class="fas fa-folder-open"></i> Your Content</h3>
            </div>
            <div class="dashboard-card-body">
                @php
                    $userId = session('FRONT_USER_ID');
                    $portfolioCount = \App\Models\Portfolio::where('user_id', $userId)->count();
                    $videoCount = \App\Models\Video::where('user_id', $userId)->count();
                    $productCount = \App\Models\Myproduct::where('user_id', $userId)->count();
                    $socialCount = \App\Models\Social::where('user_id', $userId)->count();
                @endphp

                <div class="content-stats">
                    <div class="content-stat-item">
                        <div class="content-stat-icon purple">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="content-stat-info">
                            <span class="content-stat-value">{{ $portfolioCount }}</span>
                            <span class="content-stat-label">Portfolio Items</span>
                        </div>
                    </div>

                    <div class="content-stat-item">
                        <div class="content-stat-icon blue">
                            <i class="fas fa-video"></i>
                        </div>
                        <div class="content-stat-info">
                            <span class="content-stat-value">{{ $videoCount }}</span>
                            <span class="content-stat-label">Videos</span>
                        </div>
                    </div>

                    <div class="content-stat-item">
                        <div class="content-stat-icon orange">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="content-stat-info">
                            <span class="content-stat-value">{{ $productCount }}</span>
                            <span class="content-stat-label">Products</span>
                        </div>
                    </div>

                    <div class="content-stat-item">
                        <div class="content-stat-icon pink">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <div class="content-stat-info">
                            <span class="content-stat-value">{{ $socialCount }}</span>
                            <span class="content-stat-label">Social Links</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Page Styles */
.dashboard-page {
    padding: var(--space-lg);
}

/* Welcome Banner */
.welcome-banner {
    background: var(--gradient-purple);
    border-radius: var(--radius-2xl);
    padding: var(--space-2xl);
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: var(--space-xl);
    color: white;
    position: relative;
    overflow: hidden;
}

.welcome-banner::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.welcome-content h1 {
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    margin-bottom: var(--space-xs);
}

.welcome-content p {
    opacity: 0.9;
}

.welcome-actions {
    display: flex;
    gap: var(--space-md);
    position: relative;
    z-index: 1;
}

.btn-white {
    background: white;
    color: var(--purple-600);
    padding: var(--space-sm) var(--space-lg);
    border-radius: var(--radius-full);
    font-weight: var(--font-medium);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: var(--space-sm);
    transition: all var(--transition-fast);
}

.btn-white:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}

.btn-outline-white {
    background: transparent;
    color: white;
    border: 2px solid white;
    padding: var(--space-sm) var(--space-lg);
    border-radius: var(--radius-full);
    font-weight: var(--font-medium);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: var(--space-sm);
    transition: all var(--transition-fast);
}

.btn-outline-white:hover {
    background: white;
    color: var(--purple-600);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: var(--space-lg);
    margin-bottom: var(--space-xl);
}

.stat-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    padding: var(--space-lg);
    display: flex;
    align-items: center;
    gap: var(--space-md);
    transition: all var(--transition-base);
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.stat-card-icon {
    width: 50px;
    height: 50px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-xl);
}

.stat-card-icon.purple {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
    color: var(--purple-500);
}

.stat-card-icon.blue {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%);
    color: var(--blue-500);
}

.stat-card-icon.green {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(52, 211, 153, 0.15) 100%);
    color: var(--green-500);
}

.stat-card-icon.orange {
    background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(251, 146, 60, 0.15) 100%);
    color: var(--orange-500);
}

.stat-card-content {
    flex: 1;
}

.stat-card-value {
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    color: var(--text-primary);
}

.stat-card-label {
    font-size: var(--text-sm);
    color: var(--text-secondary);
}

.stat-card-trend {
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
    display: flex;
    align-items: center;
    gap: 2px;
}

.stat-card-trend.up {
    color: var(--green-500);
}

.stat-card-trend.down {
    color: var(--red-500);
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-lg);
}

.dashboard-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.dashboard-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
}

.dashboard-card-header h3 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.dashboard-card-header h3 i {
    color: var(--purple-500);
}

.dashboard-card-body {
    padding: var(--space-lg);
}

/* Quick Actions Grid */
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-md);
}

.quick-action-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-sm);
    padding: var(--space-lg);
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
    text-decoration: none;
    color: var(--text-primary);
    transition: all var(--transition-fast);
}

.quick-action-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.quick-action-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-xl);
}

.quick-action-icon.purple { background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%); color: var(--purple-500); }
.quick-action-icon.blue { background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%); color: var(--blue-500); }
.quick-action-icon.pink { background: linear-gradient(135deg, rgba(236, 72, 153, 0.15) 0%, rgba(244, 114, 182, 0.15) 100%); color: var(--pink-500); }
.quick-action-icon.orange { background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(251, 146, 60, 0.15) 100%); color: var(--orange-500); }
.quick-action-icon.green { background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(52, 211, 153, 0.15) 100%); color: var(--green-500); }
.quick-action-icon.red { background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(248, 113, 113, 0.15) 100%); color: var(--red-500); }

.quick-action-item span {
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
}

/* Profile Preview */
.profile-preview {
    display: flex;
    align-items: center;
    gap: var(--space-lg);
    padding-bottom: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    margin-bottom: var(--space-lg);
}

.profile-preview-avatar {
    width: 70px;
    height: 70px;
    border-radius: var(--radius-full);
    overflow: hidden;
    border: 3px solid var(--purple-500);
}

.profile-preview-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-preview-info {
    flex: 1;
}

.profile-preview-info h4 {
    font-size: var(--text-lg);
    font-weight: var(--font-semibold);
    margin-bottom: var(--space-xs);
}

.profile-preview-info p {
    font-size: var(--text-sm);
    color: var(--text-secondary);
    margin-bottom: var(--space-xs);
}

.profile-preview-badge {
    display: inline-block;
    background: var(--purple-100);
    color: var(--purple-600);
    padding: 2px 10px;
    border-radius: var(--radius-full);
    font-size: var(--text-xs);
    font-weight: var(--font-medium);
}

.profile-preview-qr {
    text-align: center;
}

.qr-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-xs);
    padding: var(--space-md);
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
    text-decoration: none;
    color: var(--text-primary);
    transition: all var(--transition-fast);
}

.qr-link:hover {
    background: var(--purple-100);
    color: var(--purple-600);
}

.qr-link i {
    font-size: var(--text-2xl);
}

.qr-link span {
    font-size: var(--text-xs);
    font-weight: var(--font-medium);
}

/* Profile Completion */
.profile-completion-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: var(--space-sm);
    font-size: var(--text-sm);
}

.completion-percent {
    font-weight: var(--font-semibold);
    color: var(--purple-500);
}

.progress-bar {
    height: 8px;
    background: var(--bg-tertiary);
    border-radius: var(--radius-full);
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: var(--gradient-purple);
    border-radius: var(--radius-full);
    transition: width 0.5s ease;
}

.profile-completion-hint {
    font-size: var(--text-xs);
    color: var(--text-muted);
    margin-top: var(--space-sm);
}

/* Orders List */
.orders-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-sm);
}

.order-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-md);
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
}

.order-item-info {
    display: flex;
    flex-direction: column;
}

.order-id {
    font-weight: var(--font-semibold);
    font-size: var(--text-sm);
}

.order-date {
    font-size: var(--text-xs);
    color: var(--text-muted);
}

.status-badge {
    padding: 4px 10px;
    border-radius: var(--radius-full);
    font-size: var(--text-xs);
    font-weight: var(--font-medium);
}

.status-badge.success { background: rgba(16, 185, 129, 0.1); color: var(--green-600); }
.status-badge.warning { background: rgba(249, 115, 22, 0.1); color: var(--orange-600); }
.status-badge.danger { background: rgba(239, 68, 68, 0.1); color: var(--red-600); }
.status-badge.secondary { background: var(--bg-tertiary); color: var(--text-secondary); }

.order-item-amount {
    font-weight: var(--font-semibold);
    color: var(--purple-600);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--space-xl);
    color: var(--text-muted);
}

.empty-state i {
    font-size: var(--text-3xl);
    margin-bottom: var(--space-md);
    opacity: 0.5;
}

.empty-state p {
    margin-bottom: var(--space-md);
}

/* Content Stats */
.content-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-md);
}

.content-stat-item {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    padding: var(--space-md);
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
}

.content-stat-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
}

.content-stat-info {
    display: flex;
    flex-direction: column;
}

.content-stat-value {
    font-size: var(--text-lg);
    font-weight: var(--font-bold);
}

.content-stat-label {
    font-size: var(--text-xs);
    color: var(--text-muted);
}

/* Responsive */
@media (max-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 992px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }

    .welcome-banner {
        flex-direction: column;
        text-align: center;
        gap: var(--space-lg);
    }
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .quick-actions-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .welcome-actions {
        flex-direction: column;
        width: 100%;
    }

    .welcome-actions a {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
