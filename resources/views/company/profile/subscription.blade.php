@extends('layouts.redesign.company')

@section('page-title', 'Subscription')
@section('breadcrumb', 'Subscription')

@section('company-content')
<div class="subscription-page">
    <!-- Current Plan Card -->
    <div class="current-plan-card">
        <div class="plan-badge">
            <i class="fas fa-crown"></i>
            <span>{{ ucfirst($company->subscription_type) }} Plan</span>
        </div>
        <div class="plan-details">
            <div class="plan-stat">
                <span class="stat-value">{{ $company->cards_used }}</span>
                <span class="stat-label">Cards Used</span>
            </div>
            <div class="plan-stat">
                <span class="stat-value">{{ $company->card_limit }}</span>
                <span class="stat-label">Card Limit</span>
            </div>
            <div class="plan-stat">
                <span class="stat-value">{{ $company->remaining_cards }}</span>
                <span class="stat-label">Remaining</span>
            </div>
        </div>
        @if($company->subscription_expires)
            <p class="plan-expiry">
                <i class="fas fa-calendar-alt"></i>
                Expires: {{ \Carbon\Carbon::parse($company->subscription_expires)->format('M d, Y') }}
            </p>
        @endif
    </div>

    <!-- Plans Grid -->
    <h2 class="section-title"><i class="fas fa-th-large"></i> Available Plans</h2>
    <div class="plans-grid">
        @foreach($plans as $key => $plan)
        <div class="plan-card {{ $company->subscription_type == $key ? 'active' : '' }}">
            @if($company->subscription_type == $key)
                <div class="current-badge">Current Plan</div>
            @endif
            <div class="plan-header">
                <h3>{{ $plan['name'] }}</h3>
                <div class="plan-price">
                    @if(is_numeric($plan['price']))
                        <span class="currency">₹</span>
                        <span class="amount">{{ number_format($plan['price']) }}</span>
                        <span class="period">/year</span>
                    @else
                        <span class="amount">{{ $plan['price'] }}</span>
                    @endif
                </div>
                <p class="plan-cards">{{ is_numeric($plan['cards']) ? $plan['cards'] . ' Staff Cards' : $plan['cards'] . ' Cards' }}</p>
            </div>
            <div class="plan-features">
                <ul>
                    @foreach($plan['features'] as $feature)
                        <li><i class="fas fa-check"></i> {{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="plan-action">
                @if($company->subscription_type == $key)
                    <button class="btn btn-outline" disabled>Current Plan</button>
                @elseif($key == 'enterprise')
                    <a href="mailto:support@fastap.in?subject=Enterprise Plan Inquiry" class="btn btn-primary">Contact Sales</a>
                @else
                    <button class="btn btn-primary" onclick="alert('Please contact support to upgrade your plan.')">
                        {{ $company->subscription_type == 'free' ? 'Upgrade' : 'Switch Plan' }}
                    </button>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
        <h3><i class="fas fa-question-circle"></i> Frequently Asked Questions</h3>
        <div class="faq-list">
            <div class="faq-item">
                <h4>How do I upgrade my plan?</h4>
                <p>Contact our support team and they will assist you with the upgrade process and payment options.</p>
            </div>
            <div class="faq-item">
                <h4>Can I downgrade my plan?</h4>
                <p>Yes, you can downgrade at the end of your billing cycle. Note that you may lose access to some features.</p>
            </div>
            <div class="faq-item">
                <h4>What happens when I reach my card limit?</h4>
                <p>You won't be able to create new staff cards until you upgrade or deactivate existing cards.</p>
            </div>
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .subscription-page { max-width: 1200px; }

    .current-plan-card {
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        border-radius: 1rem;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
    }
    .plan-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.2);
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    .plan-details {
        display: flex;
        gap: 3rem;
        margin-bottom: 1rem;
    }
    .plan-stat {
        display: flex;
        flex-direction: column;
    }
    .plan-stat .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }
    .plan-stat .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    .plan-expiry {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        opacity: 0.9;
        margin-top: 1rem;
    }

    .section-title {
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .plans-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .plan-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        position: relative;
        border: 2px solid transparent;
        transition: all 0.3s;
    }
    .plan-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }
    .plan-card.active {
        border-color: #0891b2;
    }
    .current-badge {
        position: absolute;
        top: -10px;
        right: 20px;
        background: #0891b2;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .plan-header {
        text-align: center;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 1rem;
    }
    .plan-header h3 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .plan-price {
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: 0.25rem;
        margin-bottom: 0.5rem;
    }
    .plan-price .currency {
        font-size: 1.25rem;
        color: var(--text-muted);
    }
    .plan-price .amount {
        font-size: 2.5rem;
        font-weight: 700;
        color: #0891b2;
    }
    .plan-price .period {
        font-size: 0.9rem;
        color: var(--text-muted);
    }
    .plan-cards {
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    .plan-features ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .plan-features li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0;
        font-size: 0.9rem;
    }
    .plan-features li i {
        color: #22c55e;
    }
    .plan-action {
        margin-top: 1.5rem;
    }
    .plan-action .btn {
        width: 100%;
    }

    .faq-section {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
    }
    .faq-section h3 {
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .faq-item {
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: 0.5rem;
    }
    .faq-item h4 {
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }
    .faq-item p {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin: 0;
    }

    @media (max-width: 768px) {
        .plan-details {
            flex-wrap: wrap;
            gap: 1.5rem;
        }
    }
</style>
@endpush
@endsection
