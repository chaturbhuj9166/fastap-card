@extends('layouts.redesign.company')

@section('page-title', 'Public Services')
@section('breadcrumb', 'Public Services')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Public Services</h2>
            <p>Manage citizen services and assistance</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Service</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/political/services') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Service Name</label>
                    <input type="text" name="service_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="service_category" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-input" min="0" value="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Eligibility</label>
                    <textarea name="eligibility" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Required Documents (one per line)</label>
                    <textarea name="required_documents" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Contact Details</label>
                    <textarea name="contact_details" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Service</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Services</h3>
        </div>
        <div class="card-body">
            @if($services->count() === 0)
                <p class="empty-state">No services added yet.</p>
            @else
                @foreach($services as $service)
                    <div class="item-card">
                        <form method="POST" action="{{ url('/company/political/services/' . $service->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Service Name</label>
                                <input type="text" name="service_name" class="form-input" value="{{ $service->service_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <input type="text" name="service_category" class="form-input" value="{{ $service->service_category }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Display Order</label>
                                <input type="number" name="display_order" class="form-input" min="0" value="{{ $service->display_order }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="2">{{ $service->description }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Eligibility</label>
                                <textarea name="eligibility" class="form-input" rows="2">{{ $service->eligibility }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Required Documents (one per line)</label>
                                <textarea name="required_documents" class="form-input" rows="3">{{ $service->required_documents ? implode("\n", $service->required_documents) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Contact Details</label>
                                <textarea name="contact_details" class="form-input" rows="2">{{ $service->contact_details }}</textarea>
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
                        <form method="POST" action="{{ url('/company/political/services/' . $service->id) }}" class="inline-form" onsubmit="return confirm('Delete this service?');">
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
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
