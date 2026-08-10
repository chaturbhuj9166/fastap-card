@extends('layouts.redesign.dashboard')

@section('title', 'CA Services')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">CA Services</h1>
            <p class="content-subtitle">Manage service catalog and pricing</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Service</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/ca/services') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Service Category</label>
                    <input type="text" name="service_category" class="form-input" placeholder="taxation/gst/audit">
                </div>
                <div class="form-group">
                    <label class="form-label">Service Name</label>
                    <input type="text" name="service_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Pricing Type</label>
                    <input type="text" name="pricing_type" class="form-input" placeholder="fixed/hourly">
                </div>
                <div class="form-group">
                    <label class="form-label">Base Price</label>
                    <input type="number" name="base_price" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Turnaround (days)</label>
                    <input type="number" name="turnaround_time_days" class="form-input" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Required Documents (one per line)</label>
                    <textarea name="required_documents" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Service</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Services</h3>
        </div>
        <div class="card-body">
            @if($services->count() === 0)
                <p class="empty-state">No services added yet.</p>
            @else
                @foreach($services as $service)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $service->service_name }}</strong>
                            <span>{{ $service->service_category ?? 'General' }}</span>
                        </div>
                        <p class="item-desc">{{ $service->description ?? 'No description.' }}</p>

                        <form method="POST" action="{{ url('/user/ca/services/' . $service->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Service Category</label>
                                <input type="text" name="service_category" class="form-input" value="{{ $service->service_category }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Service Name</label>
                                <input type="text" name="service_name" class="form-input" value="{{ $service->service_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pricing Type</label>
                                <input type="text" name="pricing_type" class="form-input" value="{{ $service->pricing_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Base Price</label>
                                <input type="number" name="base_price" class="form-input" value="{{ $service->base_price }}" step="0.01" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Turnaround (days)</label>
                                <input type="number" name="turnaround_time_days" class="form-input" value="{{ $service->turnaround_time_days }}" min="0">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Required Documents</label>
                                <textarea name="required_documents" class="form-input" rows="2">{{ is_array($service->required_documents) ? implode("\n", $service->required_documents) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="2">{{ $service->description }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/ca/services/' . $service->id) }}" class="inline-form" onsubmit="return confirm('Delete this service?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-top: 0.75rem; }
    .empty-state { color: var(--text-secondary); }
    .item-card { border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .item-header { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.5rem; }
    .item-desc { color: var(--text-secondary); margin-bottom: 1rem; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
