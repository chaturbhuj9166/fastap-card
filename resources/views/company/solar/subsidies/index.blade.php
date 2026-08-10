@extends('layouts.redesign.company')

@section('page-title', 'Subsidy Applications')
@section('breadcrumb', 'Subsidy Applications')

@section('company-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Subsidy Applications</h1>
            <p class="content-subtitle">Track subsidy and net metering support</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Application</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/solar/subsidies') }}" class="form-grid" enctype="multipart/form-data">
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
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Scheme Name</label>
                    <input type="text" name="scheme_name" class="form-input" placeholder="pm_surya_ghar">
                </div>
                <div class="form-group">
                    <label class="form-label">Capacity (kW)</label>
                    <input type="number" name="system_capacity_kw" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Subsidy Amount</label>
                    <input type="number" name="subsidy_amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Application Date</label>
                    <input type="date" name="application_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Application Number</label>
                    <input type="text" name="application_number" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-input" placeholder="applied/in_process">
                </div>
                <div class="form-group">
                    <label class="form-label">Documents</label>
                    <input type="file" name="documents[]" class="form-input" multiple>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Application</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Applications</h3>
        </div>
        <div class="card-body">
            @if($subsidies->count() === 0)
                <p class="empty-state">No applications yet.</p>
            @else
                @foreach($subsidies as $subsidy)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $subsidy->client_name ?? 'Application' }}</strong>
                            <span>{{ $subsidy->status }}</span>
                        </div>
                        <p class="item-desc">{{ $subsidy->scheme_name ?? 'Scheme' }}</p>

                        <form method="POST" action="{{ url('/company/solar/subsidies/' . $subsidy->id . '/status') }}" class="form-grid">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="status" class="form-input" value="{{ $subsidy->status }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Application Number</label>
                                <input type="text" name="application_number" class="form-input" value="{{ $subsidy->application_number }}">
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Update</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/company/solar/subsidies/' . $subsidy->id) }}" class="inline-form" onsubmit="return confirm('Delete this application?');">
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

