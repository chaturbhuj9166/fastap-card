@extends('layouts.redesign.dashboard')

@section('page-title', 'My Properties')
@section('breadcrumb', 'Properties')

@section('dashboard-content')
<div class="properties-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Properties</h1>
            <p>Manage your real estate listings</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('real-estate.properties.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add New Property
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        @php
            $totalProperties = $properties ? (is_countable($properties) ? count($properties) : 0) : 0;
            $activeProperties = $properties ? $properties->where('is_active', true)->count() : 0;
            $featuredProperties = $properties ? $properties->where('is_featured', true)->count() : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon purple">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalProperties }}</span>
                <span class="stat-mini-label">Total Properties</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $activeProperties }}</span>
                <span class="stat-mini-label">Active Listings</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon orange">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $featuredProperties }}</span>
                <span class="stat-mini-label">Featured</span>
            </div>
        </div>
    </div>

    <!-- Profile-wise Analytics -->
    @if(isset($analytics) && !empty($analytics))
    <div class="analytics-section fade-up">
        <div class="section-header">
            <h2><i class="fas fa-chart-bar"></i> Analytics by Profile Type</h2>
            <p>Track performance across different property categories</p>
        </div>
        <div class="analytics-grid">
            @php
                $profileIcons = [
                    'residential' => ['icon' => 'fa-home', 'color' => '#0d9488', 'label' => 'Residential'],
                    'commercial' => ['icon' => 'fa-building', 'color' => '#3b82f6', 'label' => 'Commercial'],
                    'plot' => ['icon' => 'fa-map', 'color' => '#10b981', 'label' => 'Plot/Land'],
                    'rental' => ['icon' => 'fa-key', 'color' => '#f59e0b', 'label' => 'Rental'],
                    'builder' => ['icon' => 'fa-hard-hat', 'color' => '#8b5cf6', 'label' => 'Builder']
                ];
            @endphp
            @foreach($profileIcons as $type => $config)
                @if(in_array($type, $activeProfiles))
                <div class="analytics-card" style="border-left-color: {{ $config['color'] }}">
                    <div class="analytics-header">
                        <div class="analytics-icon" style="background: {{ $config['color'] }}">
                            <i class="fas {{ $config['icon'] }}"></i>
                        </div>
                        <h3>{{ $config['label'] }}</h3>
                    </div>
                    <div class="analytics-stats">
                        <div class="analytics-stat">
                            <span class="stat-value">{{ $analytics[$type]['total'] ?? 0 }}</span>
                            <span class="stat-label">Total</span>
                        </div>
                        <div class="analytics-stat">
                            <span class="stat-value">{{ $analytics[$type]['active'] ?? 0 }}</span>
                            <span class="stat-label">Active</span>
                        </div>
                        <div class="analytics-stat">
                            <span class="stat-value">{{ $analytics[$type]['featured'] ?? 0 }}</span>
                            <span class="stat-label">Featured</span>
                        </div>
                        <div class="analytics-stat">
                            <span class="stat-value">{{ $analytics[$type]['visits'] ?? 0 }}</span>
                            <span class="stat-label">Visits</span>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    @if($properties && count($properties) > 0)
        <div class="properties-table-container fade-up">
            <div class="table-responsive">
                <table class="properties-table">
                    <thead>
                        <tr>
                            <th>Property</th>
                            <th>Profile</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td>
                                    <div class="property-info">
                                        @php
                                            $images = is_string($property->images) ? json_decode($property->images, true) : $property->images;
                                            $firstImage = is_array($images) ? ($images[0] ?? null) : null;
                                        @endphp
                                        @if($firstImage)
                                            @php
                                                $imagePath = ltrim($firstImage, '/');
                                                $imageUrl = Str::startsWith($imagePath, 'public/') ? asset($imagePath) : asset('public/' . $imagePath);
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $property->title }}" class="property-thumb">
                                        @else
                                            <div class="property-thumb-placeholder">
                                                <i class="fas fa-building"></i>
                                            </div>
                                        @endif
                                        <div class="property-details">
                                            <h4>{{ $property->title }}</h4>
                                            <p>{{ Str::limit($property->address, 30) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="profile-badge {{ $property->profile_type }}">
                                        {{ ucfirst($property->profile_type) }}
                                    </span>
                                </td>
                                <td>{{ ucfirst($property->property_type) }}</td>
                                <td>
                                    @if($property->profile_type === 'rental')
                                        <strong class="price-text">₹{{ number_format($property->rental_price) }}/mo</strong>
                                    @else
                                        <strong class="price-text">₹{{ number_format($property->price) }}</strong>
                                    @endif
                                </td>
                                <td>{{ $property->location }}</td>
                                <td>
                                    <span class="status-badge {{ $property->status }}">
                                        @if($property->status === 'ready')
                                            <i class="fas fa-check-circle"></i> Ready
                                        @elseif($property->status === 'under_construction')
                                            <i class="fas fa-hammer"></i> Under Construction
                                        @else
                                            <i class="fas fa-clock"></i> Upcoming
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    @if($property->is_featured)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($property->is_active)
                                        <i class="fas fa-toggle-on text-success"></i>
                                    @else
                                        <i class="fas fa-toggle-off text-muted"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('real-estate.properties.edit', $property->id) }}" class="action-btn-small" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('real-estate.properties.toggle-status', $property->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="action-btn-small {{ $property->is_active ? 'warning' : 'success' }}" title="{{ $property->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-{{ $property->is_active ? 'eye-slash' : 'eye' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('real-estate.properties.destroy', $property->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this property?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn-small danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($properties, 'links'))
            <div class="pagination-wrapper fade-up">
                {{ $properties->links() }}
            </div>
        @endif
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-building"></i>
            </div>
            <h3>No Properties Yet</h3>
            <p>Add your first property to start showcasing your real estate listings.</p>
            <a href="{{ route('real-estate.properties.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add New Property
            </a>
        </div>
    @endif
</div>

<style>
/* Analytics Section */
.analytics-section {
    margin-bottom: 2rem;
}

.section-header {
    margin-bottom: 1.5rem;
}

.section-header h2 {
    font-size: 1.5rem;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.section-header p {
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.analytics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.25rem;
}

.analytics-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    border-left: 4px solid;
    transition: all 0.3s ease;
}

.analytics-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.analytics-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-color);
}

.analytics-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.analytics-header h3 {
    font-size: 1.1rem;
    color: var(--text-primary);
    font-weight: 600;
    margin: 0;
}

.analytics-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.analytics-stat {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0.75rem;
    background: var(--bg-secondary);
    border-radius: 12px;
}

.analytics-stat .stat-value {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--purple-500);
    margin-bottom: 0.25rem;
}

.analytics-stat .stat-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

@media (max-width: 768px) {
    .analytics-grid {
        grid-template-columns: 1fr;
    }
}

.properties-table-container {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.table-responsive {
    overflow-x: auto;
}

.properties-table {
    width: 100%;
    border-collapse: collapse;
}

.properties-table thead {
    background: var(--bg-secondary);
    border-bottom: 2px solid var(--border-color);
}

.properties-table th {
    padding: 1rem;
    text-align: left;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.properties-table tbody tr {
    border-bottom: 1px solid var(--border-color);
    transition: background 0.2s;
}

.properties-table tbody tr:hover {
    background: var(--bg-secondary);
}

.properties-table td {
    padding: 1rem;
    font-size: 0.9rem;
    color: var(--text-color);
}

.property-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.property-thumb {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
}

.property-thumb-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 1.5rem;
}

.property-details h4 {
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0 0 0.25rem;
    color: var(--text-primary);
}

.property-details p {
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin: 0;
}

.profile-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: capitalize;
}

.profile-badge.residential {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
}

.profile-badge.commercial {
    background: rgba(245, 87, 108, 0.1);
    color: #f5576c;
}

.profile-badge.plot {
    background: rgba(79, 172, 254, 0.1);
    color: #4facfe;
}

.profile-badge.rental {
    background: rgba(67, 233, 123, 0.1);
    color: #43e97b;
}

.profile-badge.builder {
    background: rgba(250, 112, 154, 0.1);
    color: #fa709a;
}

.price-text {
    color: var(--success-color);
    font-weight: 600;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.35rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.ready {
    background: rgba(39, 174, 96, 0.1);
    color: var(--success-color);
}

.status-badge.under_construction {
    background: rgba(241, 196, 15, 0.1);
    color: #f39c12;
}

.status-badge.upcoming {
    background: rgba(52, 152, 219, 0.1);
    color: #3498db;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.action-btn-small {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    color: var(--text-secondary);
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
}

.action-btn-small:hover {
    background: var(--purple-500);
    border-color: var(--purple-500);
    color: white;
    transform: translateY(-2px);
}

.action-btn-small.danger:hover {
    background: var(--danger-color);
    border-color: var(--danger-color);
}

.action-btn-small.warning:hover {
    background: #f39c12;
    border-color: #f39c12;
}

.action-btn-small.success:hover {
    background: var(--success-color);
    border-color: var(--success-color);
}

.text-warning {
    color: #f39c12;
}

.text-success {
    color: var(--success-color);
}

.text-muted {
    color: var(--text-muted);
}

.page-header-actions .btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.65rem 1.1rem;
    border-radius: 0.75rem;
    text-decoration: none;
    font-weight: 600;
    border: 1px solid transparent;
    box-shadow: 0 8px 16px rgba(5, 150, 105, 0.18);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.page-header-actions .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 12px 20px rgba(5, 150, 105, 0.22);
}

.btn-success {
    background: linear-gradient(135deg, var(--success-color), #27ae60);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #27ae60, var(--success-color));
}

.stat-mini-icon.purple {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
    color: var(--purple-500);
}

@media (max-width: 768px) {
    .properties-table {
        font-size: 0.85rem;
    }

    .properties-table th,
    .properties-table td {
        padding: 0.75rem 0.5rem;
    }

    .property-thumb,
    .property-thumb-placeholder {
        width: 50px;
        height: 50px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@endsection
