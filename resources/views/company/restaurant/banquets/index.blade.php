@extends('layouts.redesign.company')

@section('page-title', 'Banquet Halls')
@section('breadcrumb', 'Banquet Halls')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Banquet Halls</h2>
            <p>Manage halls and pricing</p>
        </div>
        <div class="page-header-right">
            <a href="{{ url('/company/restaurant/banquets/create') }}" class="btn btn-primary">Add Hall</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="settings-card">
        <div class="card-body">
            @if($banquets->count() === 0)
                <p class="empty-state">No banquet halls added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hall</th>
                                <th>Capacity</th>
                                <th>Type</th>
                                <th>Price/Plate</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banquets as $hall)
                            <tr>
                                <td>{{ $hall->hall_name }}</td>
                                <td>{{ $hall->capacity_min }} - {{ $hall->capacity_max }}</td>
                                <td>{{ $hall->hall_type ?? '-' }}</td>
                                <td>{{ $hall->price_per_plate ?? '-' }}</td>
                                <td>{{ $hall->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ url('/company/restaurant/banquets/' . $hall->id . '/edit') }}" class="btn btn-sm btn-outline">Edit</a>
                                    <form method="POST" action="{{ url('/company/restaurant/banquets/' . $hall->id) }}" class="inline-form" onsubmit="return confirm('Delete this hall?');">
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
                {{ $banquets->links() }}
            @endif
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .inline-form { display: inline-block; margin-left: 0.5rem; }
    .empty-state { color: var(--text-muted); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
    .alert-success { background: #d1fae5; color: #065f46; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .settings-card { margin-bottom: 1.5rem; }
    .card-body { padding: 1.5rem; }
</style>
@endpush
@endsection
