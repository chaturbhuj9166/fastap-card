@extends('layouts.redesign.dashboard')

@section('title', 'Salon Services')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Salon Services</h1>
            <p class="content-subtitle">Manage service categories and pricing</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Service</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/salon/services') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="service_category" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Service Name</label>
                    <input type="text" name="service_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Duration (Minutes)</label>
                    <input type="number" name="duration_minutes" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_available" value="1" checked>
                        <span>Available</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Service</button>
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
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Available</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->service_category }}</td>
                                <td>{{ $service->price ? number_format($service->price, 2) : '-' }}</td>
                                <td>{{ $service->is_available ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/salon/services/' . $service->id) }}" class="inline-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="service_category" class="form-input form-input-sm" value="{{ $service->service_category }}" required>
                                        <input type="text" name="service_name" class="form-input form-input-sm" value="{{ $service->service_name }}" required>
                                        <input type="number" name="price" class="form-input form-input-sm" value="{{ $service->price }}" step="0.01" min="0">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_available" value="1" {{ $service->is_available ? 'checked' : '' }}>
                                            <span>Available</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/salon/services/' . $service->id) }}" class="inline-form" onsubmit="return confirm('Delete this service?');">
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
