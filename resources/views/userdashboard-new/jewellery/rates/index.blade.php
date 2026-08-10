@extends('layouts.redesign.dashboard')

@section('title', 'Metal Rates')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Metal Rates</h1>
            <p class="content-subtitle">Update daily gold and silver prices</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Rate</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/jewellery/rates') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Metal Type</label>
                    <input type="text" name="metal_type" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Purity</label>
                    <input type="text" name="purity" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Rate per Gram</label>
                    <input type="number" name="rate_per_gram" class="form-input" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Rate Date</label>
                    <input type="date" name="rate_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-input">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Rate</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rate History</h3>
        </div>
        <div class="card-body">
            @if($rates->count() === 0)
                <p class="empty-state">No rates added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Metal</th>
                                <th>Purity</th>
                                <th>Rate</th>
                                <th>Date</th>
                                <th>City</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rates as $rate)
                            <tr>
                                <td>{{ $rate->metal_type }}</td>
                                <td>{{ $rate->purity ?? '-' }}</td>
                                <td>{{ number_format($rate->rate_per_gram, 2) }}</td>
                                <td>{{ $rate->rate_date ? $rate->rate_date->format('d M Y') : '-' }}</td>
                                <td>{{ $rate->city ?? '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/jewellery/rates/' . $rate->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="metal_type" class="form-input form-input-sm" value="{{ $rate->metal_type }}" required>
                                        <input type="text" name="purity" class="form-input form-input-sm" value="{{ $rate->purity }}">
                                        <input type="number" name="rate_per_gram" class="form-input form-input-sm" value="{{ $rate->rate_per_gram }}" step="0.01" min="0" required>
                                        <input type="date" name="rate_date" class="form-input form-input-sm" value="{{ $rate->rate_date ? $rate->rate_date->format('Y-m-d') : '' }}">
                                        <input type="text" name="city" class="form-input form-input-sm" value="{{ $rate->city }}">
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/jewellery/rates/' . $rate->id) }}" class="inline-form" onsubmit="return confirm('Delete this rate?');">
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
