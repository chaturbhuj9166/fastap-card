@extends('layouts.redesign.company')

@section('page-title', 'Restaurant Settings')
@section('breadcrumb', 'Restaurant Settings')

@section('company-content')
<div class="restaurant-page">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h2>Restaurant Settings</h2>
            <p>Configure your restaurant information and services</p>
        </div>
        <div class="page-header-right">
            <a href="{{ url('/company/menu') }}" class="btn btn-primary">
                <i class="fas fa-utensils"></i> Manage Menu
            </a>
        </div>
    </div>

    <div class="settings-grid">
        <!-- Basic Info -->
        <div class="settings-card">
            <div class="card-header">
                <h3><i class="fas fa-info-circle"></i> Basic Information</h3>
            </div>
            <form action="{{ route('company.restaurant.basic') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Cuisine Type</label>
                        <input type="text" name="cuisine_type" class="form-input" placeholder="e.g., North Indian, Chinese, Multi-cuisine" value="{{ old('cuisine_type', $restaurantInfo->cuisine_type) }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Seating Capacity</label>
                            <input type="number" name="seating_capacity" class="form-input" min="0" placeholder="e.g., 50" value="{{ old('seating_capacity', $restaurantInfo->seating_capacity) }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Average Cost (?)</label>
                            <input type="number" name="average_cost" class="form-input" min="0" placeholder="for two people" value="{{ old('average_cost', $restaurantInfo->average_cost) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Dress Code</label>
                        <input type="text" name="dress_code" class="form-input" placeholder="e.g., Smart Casual" value="{{ old('dress_code', $restaurantInfo->dress_code) }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Special Features</label>
                        <textarea name="special_features" class="form-input" rows="3" placeholder="e.g., Live music, Rooftop dining, Private dining room">{{ old('special_features', $restaurantInfo->special_features) }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>

        <!-- Operating Hours -->
        <div class="settings-card">
            <div class="card-header">
                <h3><i class="fas fa-clock"></i> Operating Hours</h3>
            </div>
            <form action="{{ route('company.restaurant.hours') }}" method="POST">
                @csrf
                <div class="card-body">
                    @php
                        $days = ['monday' => 'Monday', 'tuesday' => 'Tuesday', 'wednesday' => 'Wednesday', 'thursday' => 'Thursday', 'friday' => 'Friday', 'saturday' => 'Saturday', 'sunday' => 'Sunday'];
                        $hours = $restaurantInfo->operating_hours ?? [];
                    @endphp

                    @foreach($days as $key => $day)
                    <div class="hours-row">
                        <div class="day-toggle">
                            <label class="switch-label">
                                <input type="checkbox" name="operating_hours[{{ $key }}][is_open]" value="1" {{ ($hours[$key]['is_open'] ?? true) ? 'checked' : '' }}>
                                <span class="switch-slider"></span>
                            </label>
                            <span class="day-name">{{ $day }}</span>
                        </div>
                        <div class="time-inputs">
                            <input type="time" name="operating_hours[{{ $key }}][open]" class="form-input time-input" value="{{ $hours[$key]['open'] ?? '09:00' }}">
                            <span class="time-separator">to</span>
                            <input type="time" name="operating_hours[{{ $key }}][close]" class="form-input time-input" value="{{ $hours[$key]['close'] ?? '22:00' }}">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Hours
                    </button>
                </div>
            </form>
        </div>

        <!-- Services -->
        <div class="settings-card">
            <div class="card-header">
                <h3><i class="fas fa-concierge-bell"></i> Service Options</h3>
            </div>
            <form action="{{ route('company.restaurant.services') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="services-grid">
                        <label class="service-toggle">
                            <input type="checkbox" name="dine_in_available" value="1" {{ $restaurantInfo->dine_in_available ? 'checked' : '' }}>
                            <div class="service-card">
                                <i class="fas fa-chair"></i>
                                <span>Dine-In</span>
                            </div>
                        </label>
                        <label class="service-toggle">
                            <input type="checkbox" name="takeaway_available" value="1" {{ $restaurantInfo->takeaway_available ? 'checked' : '' }}>
                            <div class="service-card">
                                <i class="fas fa-shopping-bag"></i>
                                <span>Takeaway</span>
                            </div>
                        </label>
                        <label class="service-toggle">
                            <input type="checkbox" name="delivery_available" value="1" {{ $restaurantInfo->delivery_available ? 'checked' : '' }}>
                            <div class="service-card">
                                <i class="fas fa-motorcycle"></i>
                                <span>Delivery</span>
                            </div>
                        </label>
                        <label class="service-toggle">
                            <input type="checkbox" name="reservation_available" value="1" {{ $restaurantInfo->reservation_available ? 'checked' : '' }}>
                            <div class="service-card">
                                <i class="fas fa-calendar-check"></i>
                                <span>Reservations</span>
                            </div>
                        </label>
                    </div>

                    <h4 class="section-subtitle">Delivery Settings</h4>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Delivery Radius (km)</label>
                            <input type="text" name="delivery_radius" class="form-input" placeholder="e.g., 5" value="{{ old('delivery_radius', $restaurantInfo->delivery_radius) }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Minimum Order (?)</label>
                            <input type="number" name="minimum_order" class="form-input" min="0" placeholder="e.g., 200" value="{{ old('minimum_order', $restaurantInfo->minimum_order) }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Delivery Fee (?)</label>
                            <input type="number" name="delivery_fee" class="form-input" min="0" placeholder="e.g., 30" value="{{ old('delivery_fee', $restaurantInfo->delivery_fee) }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Delivery Time</label>
                            <input type="text" name="delivery_time" class="form-input" placeholder="e.g., 30-45 mins" value="{{ old('delivery_time', $restaurantInfo->delivery_time) }}">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Services
                    </button>
                </div>
            </form>
        </div>

        <!-- Payment Methods -->
        <div class="settings-card">
            <div class="card-header">
                <h3><i class="fas fa-credit-card"></i> Payment Methods</h3>
            </div>
            <form action="{{ route('company.restaurant.payments') }}" method="POST">
                @csrf
                <div class="card-body">
                    @php
                        $paymentMethods = $restaurantInfo->payment_methods_array ?? [];
                    @endphp
                    <div class="payment-grid">
                        <label class="payment-toggle">
                            <input type="checkbox" name="payment_cash" value="1" {{ in_array('cash', $paymentMethods) ? 'checked' : '' }}>
                            <div class="payment-card">
                                <i class="fas fa-money-bill-wave"></i>
                                <span>Cash</span>
                            </div>
                        </label>
                        <label class="payment-toggle">
                            <input type="checkbox" name="payment_card" value="1" {{ in_array('card', $paymentMethods) ? 'checked' : '' }}>
                            <div class="payment-card">
                                <i class="fas fa-credit-card"></i>
                                <span>Card</span>
                            </div>
                        </label>
                        <label class="payment-toggle">
                            <input type="checkbox" name="payment_upi" value="1" {{ in_array('upi', $paymentMethods) ? 'checked' : '' }}>
                            <div class="payment-card">
                                <i class="fas fa-mobile-alt"></i>
                                <span>UPI</span>
                            </div>
                        </label>
                        <label class="payment-toggle">
                            <input type="checkbox" name="payment_wallet" value="1" {{ in_array('wallet', $paymentMethods) ? 'checked' : '' }}>
                            <div class="payment-card">
                                <i class="fas fa-wallet"></i>
                                <span>Wallet</span>
                            </div>
                        </label>
                        <label class="payment-toggle">
                            <input type="checkbox" name="payment_netbanking" value="1" {{ in_array('netbanking', $paymentMethods) ? 'checked' : '' }}>
                            <div class="payment-card">
                                <i class="fas fa-university"></i>
                                <span>Net Banking</span>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Payment Methods
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .page-header h2 { font-size: 1.5rem; margin-bottom: 0.25rem; }
    .page-header p { color: var(--text-muted); font-size: 0.9rem; }
    .settings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 1.5rem;
    }
    @media (max-width: 480px) { .settings-grid { grid-template-columns: 1fr; } }
    .settings-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: var(--shadow-sm);
    }
    .card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    .card-header h3 {
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }
    .card-body { padding: 1.5rem; }
    .card-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
    }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-input, .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 1rem;
        background: var(--bg-primary);
        color: var(--text-primary);
    }
    .form-input:focus, .form-select:focus { outline: none; border-color: #0891b2; }
    .section-subtitle {
        font-size: 0.95rem;
        font-weight: 600;
        margin: 1.5rem 0 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }
    /* Hours */
    .hours-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }
    .hours-row:last-child { border-bottom: none; }
    .day-toggle {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 130px;
    }
    .day-name { font-weight: 500; }
    .time-inputs {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex: 1;
    }
    .time-input { width: auto; flex: 1; }
    .time-separator { color: var(--text-muted); }
    /* Switch */
    .switch-label {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px;
    }
    .switch-label input { opacity: 0; width: 0; height: 0; }
    .switch-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        border-radius: 22px;
        transition: 0.3s;
    }
    .switch-slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        border-radius: 50%;
        transition: 0.3s;
    }
    .switch-label input:checked + .switch-slider { background-color: #0891b2; }
    .switch-label input:checked + .switch-slider:before { transform: translateX(18px); }
    /* Services & Payment */
    .services-grid, .payment-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    .service-toggle input, .payment-toggle input { display: none; }
    .service-card, .payment-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.75rem;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }
    .service-card i, .payment-card i { font-size: 1.5rem; color: var(--text-muted); }
    .service-card span, .payment-card span { font-size: 0.85rem; font-weight: 500; }
    .service-toggle input:checked + .service-card,
    .payment-toggle input:checked + .payment-card {
        border-color: #0891b2;
        background: rgba(8, 145, 178, 0.05);
    }
    .service-toggle input:checked + .service-card i,
    .payment-toggle input:checked + .payment-card i { color: #0891b2; }
</style>
@endpush
@endsection

