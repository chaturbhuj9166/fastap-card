@extends('layouts.redesign.admin')

@section('page-title', 'Analytics Dashboard')
@section('breadcrumb', 'Analytics')

@push('page-styles')
<style>
    .analytics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-xl);
    }

    .analytics-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-lg);
    }

    .analytics-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: var(--space-md);
    }

    .analytics-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .analytics-trend {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
        font-size: var(--text-sm);
        padding: var(--space-xs) var(--space-sm);
        border-radius: var(--radius-md);
    }

    .analytics-trend.up {
        background: rgba(16, 185, 129, 0.1);
        color: var(--green-500);
    }

    .analytics-trend.down {
        background: rgba(239, 68, 68, 0.1);
        color: var(--red-500);
    }

    .analytics-value {
        font-size: var(--text-3xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .analytics-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .analytics-sublabel {
        font-size: var(--text-xs);
        color: var(--text-muted);
        margin-top: var(--space-xs);
    }

    .chart-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: var(--space-lg);
        margin-bottom: var(--space-xl);
    }

    .chart-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-lg);
    }

    .chart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: var(--space-lg);
    }

    .chart-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
    }

    .chart-container {
        height: 300px;
        position: relative;
    }

    .distribution-list {
        display: flex;
        flex-direction: column;
        gap: var(--space-sm);
    }

    .distribution-item {
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .distribution-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .distribution-info {
        flex: 1;
    }

    .distribution-name {
        font-size: var(--text-sm);
        color: var(--text-secondary);
    }

    .distribution-bar-container {
        height: 6px;
        background: var(--bg-tertiary);
        border-radius: 3px;
        margin-top: var(--space-xs);
        overflow: hidden;
    }

    .distribution-bar {
        height: 100%;
        border-radius: 3px;
    }

    .distribution-value {
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        color: var(--text-primary);
        white-space: nowrap;
    }

    .recent-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-lg);
    }

    .recent-list {
        display: flex;
        flex-direction: column;
    }

    .recent-item {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        padding: var(--space-md) 0;
        border-bottom: 1px solid var(--border-light);
    }

    .recent-item:last-child {
        border-bottom: none;
    }

    .recent-avatar {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        background: var(--bg-tertiary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        flex-shrink: 0;
    }

    .recent-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: var(--radius-md);
    }

    .recent-info {
        flex: 1;
        min-width: 0;
    }

    .recent-name {
        font-weight: var(--font-medium);
        color: var(--text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .recent-meta {
        font-size: var(--text-xs);
        color: var(--text-muted);
    }

    .recent-date {
        font-size: var(--text-xs);
        color: var(--text-muted);
        white-space: nowrap;
    }

    .usage-meter {
        margin-top: var(--space-lg);
    }

    .usage-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: var(--space-sm);
    }

    .usage-bar-container {
        height: 12px;
        background: var(--bg-tertiary);
        border-radius: 6px;
        overflow: hidden;
    }

    .usage-bar {
        height: 100%;
        border-radius: 6px;
        transition: width 0.3s ease;
    }

    .tier-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--space-md);
        margin-top: var(--space-lg);
    }

    .tier-card {
        text-align: center;
        padding: var(--space-md);
        background: var(--bg-secondary);
        border-radius: var(--radius-lg);
    }

    .tier-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-xs);
    }

    .tier-name {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    @media (max-width: 1400px) {
        .analytics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 1200px) {
        .chart-section {
            grid-template-columns: 1fr;
        }
        .recent-section {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .analytics-grid {
            grid-template-columns: 1fr;
        }
        .tier-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush

@section('admin-content')
<!-- Main Stats -->
<div class="analytics-grid">
    <!-- Companies -->
    <div class="analytics-card">
        <div class="analytics-card-header">
            <div class="analytics-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
                <i class="fas fa-building"></i>
            </div>
            @if($newCompaniesThisMonth > 0)
            <span class="analytics-trend up">
                <i class="fas fa-arrow-up"></i> +{{ $newCompaniesThisMonth }}
            </span>
            @endif
        </div>
        <div class="analytics-value">{{ number_format($totalCompanies) }}</div>
        <div class="analytics-label">Total Companies</div>
        <div class="analytics-sublabel">{{ $activeCompanies }} active</div>
    </div>

    <!-- Staff Cards -->
    <div class="analytics-card">
        <div class="analytics-card-header">
            <div class="analytics-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--blue-500);">
                <i class="fas fa-id-card"></i>
            </div>
            @if($newCardsThisMonth > 0)
            <span class="analytics-trend up">
                <i class="fas fa-arrow-up"></i> +{{ $newCardsThisMonth }}
            </span>
            @endif
        </div>
        <div class="analytics-value">{{ number_format($totalStaffCards) }}</div>
        <div class="analytics-label">Staff Cards</div>
        <div class="analytics-sublabel">{{ $activeStaffCards }} enabled</div>
    </div>

    <!-- Individual Users -->
    <div class="analytics-card">
        <div class="analytics-card-header">
            <div class="analytics-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
                <i class="fas fa-users"></i>
            </div>
            @if($newUsersThisMonth > 0)
            <span class="analytics-trend up">
                <i class="fas fa-arrow-up"></i> +{{ $newUsersThisMonth }}
            </span>
            @endif
        </div>
        <div class="analytics-value">{{ number_format($totalUsers) }}</div>
        <div class="analytics-label">Individual Users</div>
        <div class="analytics-sublabel">{{ $activeUsers }} active</div>
    </div>

    <!-- Card Usage -->
    <div class="analytics-card">
        <div class="analytics-card-header">
            <div class="analytics-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--yellow-600);">
                <i class="fas fa-chart-pie"></i>
            </div>
            @if($companiesNearLimit > 0)
            <span class="analytics-trend down">
                <i class="fas fa-exclamation-triangle"></i> {{ $companiesNearLimit }} near limit
            </span>
            @endif
        </div>
        <div class="analytics-value">{{ $cardUsagePercent }}%</div>
        <div class="analytics-label">Card Usage</div>
        <div class="analytics-sublabel">{{ number_format($totalCardsUsed) }} / {{ number_format($totalCardsLimit) }} cards</div>
    </div>
</div>

<!-- Charts Section -->
<div class="chart-section">
    <!-- Monthly Trend -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Registration Trends (6 Months)</h3>
        </div>
        <div class="chart-container">
            <canvas id="trendsChart"></canvas>
        </div>
    </div>

    <!-- Subscription Distribution -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Subscription Tiers</h3>
        </div>
        <div class="tier-grid">
            <div class="tier-card">
                <div class="tier-value" style="color: var(--text-muted);">{{ $subscriptionTiers['free'] ?? 0 }}</div>
                <div class="tier-name">Free</div>
            </div>
            <div class="tier-card">
                <div class="tier-value" style="color: var(--blue-500);">{{ $subscriptionTiers['basic'] ?? 0 }}</div>
                <div class="tier-name">Basic</div>
            </div>
            <div class="tier-card">
                <div class="tier-value" style="color: var(--purple-500);">{{ $subscriptionTiers['premium'] ?? 0 }}</div>
                <div class="tier-name">Premium</div>
            </div>
            <div class="tier-card">
                <div class="tier-value" style="color: var(--yellow-600);">{{ $subscriptionTiers['enterprise'] ?? 0 }}</div>
                <div class="tier-name">Enterprise</div>
            </div>
        </div>

        <div class="usage-meter">
            <div class="usage-header">
                <span class="analytics-label">Overall Card Capacity</span>
                <span class="analytics-label">{{ $cardUsagePercent }}%</span>
            </div>
            <div class="usage-bar-container">
                <div class="usage-bar" style="width: {{ min($cardUsagePercent, 100) }}%; background: {{ $cardUsagePercent > 90 ? 'var(--red-500)' : ($cardUsagePercent > 70 ? 'var(--yellow-500)' : 'var(--green-500)') }};"></div>
            </div>
        </div>
    </div>
</div>

<!-- Profession Distribution & Recent Activity -->
<div class="chart-section">
    <!-- Profession Distribution -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Companies by Profession Type</h3>
        </div>
        @php
            $colors = [
                1 => '#7C3AED', 2 => '#EF4444', 3 => '#3B82F6', 4 => '#10B981',
                5 => '#06B6D4', 6 => '#EC4899', 7 => '#F59E0B', 8 => '#8B5CF6',
                9 => '#14B8A6', 10 => '#F97316', 11 => '#6366F1', 12 => '#84CC16', 13 => '#6B7280'
            ];
            $maxCount = max($professionDistribution ?: [1]);
        @endphp
        <div class="distribution-list">
            @foreach($professionDistribution as $type => $count)
            <div class="distribution-item">
                <div class="distribution-color" style="background: {{ $colors[$type] ?? '#6B7280' }};"></div>
                <div class="distribution-info">
                    <div class="distribution-name">{{ $professionTypes[$type] ?? 'Unknown' }}</div>
                    <div class="distribution-bar-container">
                        <div class="distribution-bar" style="width: {{ ($count / $maxCount) * 100 }}%; background: {{ $colors[$type] ?? '#6B7280' }};"></div>
                    </div>
                </div>
                <div class="distribution-value">{{ $count }}</div>
            </div>
            @endforeach
            @if(empty($professionDistribution))
            <div style="text-align: center; padding: var(--space-xl); color: var(--text-muted);">
                <i class="fas fa-chart-bar" style="font-size: var(--text-2xl); margin-bottom: var(--space-md);"></i>
                <p>No profession data available yet</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Recent Activity Summary -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">This Month Summary</h3>
        </div>
        <div style="display: flex; flex-direction: column; gap: var(--space-lg);">
            <div style="display: flex; align-items: center; gap: var(--space-md); padding: var(--space-md); background: rgba(124, 58, 237, 0.1); border-radius: var(--radius-lg);">
                <div class="analytics-icon" style="background: var(--purple-500); color: white;">
                    <i class="fas fa-building"></i>
                </div>
                <div>
                    <div style="font-size: var(--text-2xl); font-weight: var(--font-bold); color: var(--text-primary);">+{{ $newCompaniesThisMonth }}</div>
                    <div style="font-size: var(--text-sm); color: var(--text-muted);">New Companies</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: var(--space-md); padding: var(--space-md); background: rgba(59, 130, 246, 0.1); border-radius: var(--radius-lg);">
                <div class="analytics-icon" style="background: var(--blue-500); color: white;">
                    <i class="fas fa-id-card"></i>
                </div>
                <div>
                    <div style="font-size: var(--text-2xl); font-weight: var(--font-bold); color: var(--text-primary);">+{{ $newCardsThisMonth }}</div>
                    <div style="font-size: var(--text-sm); color: var(--text-muted);">Staff Cards Created</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: var(--space-md); padding: var(--space-md); background: rgba(16, 185, 129, 0.1); border-radius: var(--radius-lg);">
                <div class="analytics-icon" style="background: var(--green-500); color: white;">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div>
                    <div style="font-size: var(--text-2xl); font-weight: var(--font-bold); color: var(--text-primary);">+{{ $newUsersThisMonth }}</div>
                    <div style="font-size: var(--text-sm); color: var(--text-muted);">Individual Registrations</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Section -->
<div class="recent-section">
    <!-- Recent Companies -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Recent Companies</h3>
            <a href="{{ url('/admin/companies') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="recent-list">
            @forelse($recentCompanies as $company)
            <div class="recent-item">
                <div class="recent-avatar">
                    @if($company->logo)
                    <img src="{{ url('uploads/company/' . $company->logo) }}" alt="{{ $company->name }}">
                    @else
                    {{ strtoupper(substr($company->name, 0, 2)) }}
                    @endif
                </div>
                <div class="recent-info">
                    <div class="recent-name">{{ $company->name }}</div>
                    <div class="recent-meta">{{ $company->email }} &bull; {{ $company->cards_used }}/{{ $company->card_limit }} cards</div>
                </div>
                <div class="recent-date">{{ $company->created_at->diffForHumans() }}</div>
            </div>
            @empty
            <div style="text-align: center; padding: var(--space-xl); color: var(--text-muted);">
                <p>No companies yet</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Staff Cards -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Recent Staff Cards</h3>
        </div>
        <div class="recent-list">
            @forelse($recentStaff as $staff)
            <div class="recent-item">
                <div class="recent-avatar">
                    @if($staff->profile_image)
                    <img src="{{ url('uploads/staff/' . $staff->profile_image) }}" alt="{{ $staff->name }}">
                    @else
                    {{ strtoupper(substr($staff->name, 0, 2)) }}
                    @endif
                </div>
                <div class="recent-info">
                    <div class="recent-name">{{ $staff->name }}</div>
                    <div class="recent-meta">{{ $staff->company->name ?? 'N/A' }} &bull; {{ $staff->designation ?? 'Staff' }}</div>
                </div>
                <div class="recent-date">{{ $staff->created_at->diffForHumans() }}</div>
            </div>
            @empty
            <div style="text-align: center; padding: var(--space-xl); color: var(--text-muted);">
                <p>No staff cards yet</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Trends Chart
    const ctx = document.getElementById('trendsChart').getContext('2d');
    const monthlyData = @json($monthlyData);

    const labels = Object.keys(monthlyData);
    const companiesData = labels.map(key => monthlyData[key].companies);
    const staffData = labels.map(key => monthlyData[key].staff);
    const usersData = labels.map(key => monthlyData[key].users);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Companies',
                    data: companiesData,
                    borderColor: '#7C3AED',
                    backgroundColor: 'rgba(124, 58, 237, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Staff Cards',
                    data: staffData,
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Users',
                    data: usersData,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>
@endpush
