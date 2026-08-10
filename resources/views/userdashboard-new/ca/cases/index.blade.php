@extends('layouts.redesign.dashboard')

@section('title', 'CA Client Cases')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Client Cases</h1>
            <p class="content-subtitle">Track filings and client status</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Case</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/ca/cases') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Client Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">PAN Number</label>
                    <input type="text" name="pan_number" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">GSTIN</label>
                    <input type="text" name="gstin" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Service</label>
                    <select name="service_id" class="form-input">
                        <option value="">Select service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Financial Year</label>
                    <input type="text" name="financial_year" class="form-input" placeholder="2025-26">
                </div>
                <div class="form-group">
                    <label class="form-label">Case Status</label>
                    <input type="text" name="case_status" class="form-input" placeholder="inquiry/in_progress/filed">
                </div>
                <div class="form-group">
                    <label class="form-label">Due Date</label>
                    <input type="date" name="due_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Filing Date</label>
                    <input type="date" name="filing_date" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Documents Upload</label>
                    <input type="file" name="documents_uploaded[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Filed Returns Upload</label>
                    <input type="file" name="filed_returns[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Case Notes</label>
                    <textarea name="case_notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Case</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cases</h3>
        </div>
        <div class="card-body">
            @if($cases->count() === 0)
                <p class="empty-state">No cases added yet.</p>
            @else
                @foreach($cases as $case)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $case->client_name ?? 'Client' }}</strong>
                            <span>{{ $case->case_status ?? 'inquiry' }}</span>
                        </div>
                        <p class="item-desc">
                            {{ $case->financial_year ?? 'FY N/A' }}
                            @if($case->service)
                                • {{ $case->service->service_name }}
                            @endif
                        </p>

                        <form method="POST" action="{{ url('/user/ca/cases/' . $case->id . '/status') }}" class="form-grid">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Case Status</label>
                                <input type="text" name="case_status" class="form-input" value="{{ $case->case_status }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Due Date</label>
                                <input type="date" name="due_date" class="form-input" value="{{ $case->due_date ? $case->due_date->format('Y-m-d') : '' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Filing Date</label>
                                <input type="date" name="filing_date" class="form-input" value="{{ $case->filing_date ? $case->filing_date->format('Y-m-d') : '' }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Notes</label>
                                <textarea name="case_notes" class="form-input" rows="2">{{ $case->case_notes }}</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Update</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/ca/cases/' . $case->id) }}" class="inline-form" onsubmit="return confirm('Delete this case?');">
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
