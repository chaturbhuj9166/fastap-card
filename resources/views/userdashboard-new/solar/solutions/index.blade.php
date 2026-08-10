@extends('layouts.redesign.dashboard')

@section('title', 'Solar Solutions')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Solar Solutions</h1>
            <p class="content-subtitle">Manage solar system offerings</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Solution</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/solar/solutions') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Solution Name</label>
                    <input type="text" name="solution_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Solution Type</label>
                    <input type="text" name="solution_type" class="form-input" placeholder="residential/commercial">
                </div>
                <div class="form-group">
                    <label class="form-label">Capacity (kW)</label>
                    <input type="number" name="system_capacity_kw" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Price per kW</label>
                    <input type="number" name="price_per_kw" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Total Price</label>
                    <input type="number" name="total_price" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Warranty (years)</label>
                    <input type="number" name="warranty_years" class="form-input" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Components (one per line)</label>
                    <textarea name="components" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Features (one per line)</label>
                    <textarea name="features" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Solution</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Solutions</h3>
        </div>
        <div class="card-body">
            @if($solutions->count() === 0)
                <p class="empty-state">No solutions added yet.</p>
            @else
                @foreach($solutions as $solution)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $solution->solution_name }}</strong>
                            <span>{{ $solution->solution_type ?? 'General' }}</span>
                        </div>
                        <p class="item-desc">{{ $solution->description ?? 'No description.' }}</p>

                        <form method="POST" action="{{ url('/user/solar/solutions/' . $solution->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Solution Name</label>
                                <input type="text" name="solution_name" class="form-input" value="{{ $solution->solution_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Solution Type</label>
                                <input type="text" name="solution_type" class="form-input" value="{{ $solution->solution_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Capacity (kW)</label>
                                <input type="number" name="system_capacity_kw" class="form-input" value="{{ $solution->system_capacity_kw }}" step="0.01" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Price per kW</label>
                                <input type="number" name="price_per_kw" class="form-input" value="{{ $solution->price_per_kw }}" step="0.01" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Total Price</label>
                                <input type="number" name="total_price" class="form-input" value="{{ $solution->total_price }}" step="0.01" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Warranty (years)</label>
                                <input type="number" name="warranty_years" class="form-input" value="{{ $solution->warranty_years }}" min="0">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Components</label>
                                <textarea name="components" class="form-input" rows="2">{{ is_array($solution->components) ? implode("\n", $solution->components) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Features</label>
                                <textarea name="features" class="form-input" rows="2">{{ is_array($solution->features) ? implode("\n", $solution->features) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="2">{{ $solution->description }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" value="1" {{ $solution->is_active ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/solar/solutions/' . $solution->id) }}" class="inline-form" onsubmit="return confirm('Delete this solution?');">
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
