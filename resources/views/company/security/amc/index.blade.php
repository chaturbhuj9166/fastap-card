@extends('layouts.redesign.company')

@section('title', 'Security AMC')

@section('content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">AMC Plans</h1>
            <p class="content-subtitle">Manage maintenance contracts</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add AMC Plan</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/security/amc') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Project</label>
                    <select name="project_id" class="form-input">
                        <option value="">Select project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->client_name ?? 'Project #' . $project->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">AMC Type</label>
                    <input type="text" name="amc_type" class="form-input" placeholder="basic/standard/premium">
                </div>
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="amc_start_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="date" name="amc_end_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Visit Frequency</label>
                    <input type="text" name="visit_frequency" class="form-input" placeholder="monthly/quarterly">
                </div>
                <div class="form-group">
                    <label class="form-label">AMC Amount</label>
                    <input type="number" name="amc_amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Next Visit Date</label>
                    <input type="date" name="next_visit_date" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Services Included (one per line)</label>
                    <textarea name="services_included" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Visit History (one per line)</label>
                    <textarea name="visit_history" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add AMC</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">AMC Plans</h3>
        </div>
        <div class="card-body">
            @if($amcPlans->count() === 0)
                <p class="empty-state">No AMC plans added yet.</p>
            @else
                @foreach($amcPlans as $plan)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $plan->amc_type ?? 'AMC' }}</strong>
                            <span>{{ $plan->visit_frequency ?? 'schedule' }}</span>
                        </div>
                        <p class="item-desc">Next visit: {{ $plan->next_visit_date ? $plan->next_visit_date->format('d M Y') : 'N/A' }}</p>

                        <form method="POST" action="{{ url('/company/security/amc/' . $plan->id) }}" class="inline-form" onsubmit="return confirm('Delete this AMC plan?');">
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
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection

