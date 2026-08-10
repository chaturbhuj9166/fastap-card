@extends('layouts.redesign.company')

@section('page-title', 'Salon Packages')
@section('breadcrumb', 'Salon Packages')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Salon Packages</h2>
            <p>Create packages and offers</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Package</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/salon/packages') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Package Name</label>
                    <input type="text" name="package_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Package Type</label>
                    <input type="text" name="package_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Discount Price</label>
                    <input type="number" name="discount_price" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Validity (Days)</label>
                    <input type="number" name="validity_days" class="form-input" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Services Included (one per line)</label>
                    <textarea name="services_included" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Features (one per line)</label>
                    <textarea name="features" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Package</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Packages</h3>
        </div>
        <div class="card-body">
            @if($packages->count() === 0)
                <p class="empty-state">No packages added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->package_name }}</td>
                                <td>{{ $package->package_type ?? '-' }}</td>
                                <td>{{ $package->price ? number_format($package->price, 2) : '-' }}</td>
                                <td>{{ $package->is_active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/salon/packages/' . $package->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="package_name" class="form-input form-input-sm" value="{{ $package->package_name }}" required>
                                        <input type="text" name="package_type" class="form-input form-input-sm" value="{{ $package->package_type }}">
                                        <input type="number" name="price" class="form-input form-input-sm" value="{{ $package->price }}" step="0.01" min="0">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_active" value="1" {{ $package->is_active ? 'checked' : '' }}>
                                            <span>Active</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/salon/packages/' . $package->id) }}" class="inline-form" onsubmit="return confirm('Delete this package?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-right: 0.5rem; }
    .form-input-sm { max-width: 150px; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
