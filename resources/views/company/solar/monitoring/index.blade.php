@extends('layouts.redesign.company')

@section('page-title', 'Solar Monitoring')
@section('breadcrumb', 'Solar Monitoring')

@section('company-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Monitoring</h1>
            <p class="content-subtitle">Track live system performance</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Monitoring Entry</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/solar/monitoring') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Project</label>
                    <select name="project_id" class="form-input">
                        <option value="">Select project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->client_name ?? 'Project' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Monitoring URL</label>
                    <input type="text" name="monitoring_platform" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Daily Generation (kWh)</label>
                    <input type="number" name="daily_generation_kwh" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Monthly Generation (kWh)</label>
                    <input type="number" name="monthly_generation_kwh" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Performance Ratio</label>
                    <input type="number" name="performance_ratio" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Uptime (%)</label>
                    <input type="number" name="system_uptime_percentage" class="form-input" step="0.01" min="0" max="100">
                </div>
                <div class="form-group">
                    <label class="form-label">Last Updated</label>
                    <input type="date" name="last_updated" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Alerts (one per line)</label>
                    <textarea name="alerts" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Monitoring</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Monitoring Records</h3>
        </div>
        <div class="card-body">
            @if($monitoring->count() === 0)
                <p class="empty-state">No monitoring records yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Daily</th>
                                <th>Monthly</th>
                                <th>PR</th>
                                <th>Uptime</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($monitoring as $entry)
                            <tr>
                                <td>{{ optional($projects->firstWhere('id', $entry->project_id))->client_name ?? 'Project' }}</td>
                                <td>{{ $entry->daily_generation_kwh }}</td>
                                <td>{{ $entry->monthly_generation_kwh }}</td>
                                <td>{{ $entry->performance_ratio }}</td>
                                <td>{{ $entry->system_uptime_percentage }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/solar/monitoring/' . $entry->id) }}" class="inline-form" onsubmit="return confirm('Delete this record?');">
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
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection

