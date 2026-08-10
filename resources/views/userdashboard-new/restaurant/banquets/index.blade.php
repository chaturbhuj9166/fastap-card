@extends('layouts.redesign.dashboard')

@section('title', 'Banquet Halls')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Banquet Halls</h1>
            <p class="content-subtitle">Manage halls and pricing</p>
        </div>
        <div class="content-header-right">
            <a href="{{ url('/user/restaurant/banquets/create') }}" class="btn btn-primary">Add Hall</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
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
                                    <a href="{{ url('/user/restaurant/banquets/' . $hall->id . '/edit') }}" class="btn btn-sm btn-outline">Edit</a>
                                    <form method="POST" action="{{ url('/user/restaurant/banquets/' . $hall->id) }}" class="inline-form" onsubmit="return confirm('Delete this hall?');">
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

<style>
    .inline-form { display: inline-block; margin-left: 0.5rem; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
    .alert { padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .alert-success { background: #d1fae5; color: #065f46; }
    .content-header-right { display: flex; align-items: center; }
    .btn-primary { background: #0891b2; color: #fff; border: none; }
    .inline-form button { margin-left: 0.5rem; }
</style>
@endsection
