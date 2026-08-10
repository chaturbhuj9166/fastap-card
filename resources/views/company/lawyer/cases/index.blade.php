@extends('layouts.redesign.company')

@section('page-title', 'Legal Cases')
@section('breadcrumb', 'Legal Cases')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Legal Cases</h2>
            <p>Register and track case status</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Case</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/lawyer/cases') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Case Number</label>
                    <input type="text" name="case_number" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Case Type</label>
                    <input type="text" name="case_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Court Name</label>
                    <input type="text" name="court_name" class="form-input">
                </div>
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
                    <label class="form-label">Case Status</label>
                    <select name="case_status" class="form-input">
                        <option value="inquiry">Inquiry</option>
                        <option value="filed">Filed</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="hearing">Hearing</option>
                        <option value="judgement">Judgement</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Filing Date</label>
                    <input type="date" name="filing_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Next Hearing Date</label>
                    <input type="date" name="next_hearing_date" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Case Details (one per line)</label>
                    <textarea name="case_details" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Documents (one per line)</label>
                    <textarea name="documents" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Case</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Cases</h3>
        </div>
        <div class="card-body">
            @if($cases->count() === 0)
                <p class="empty-state">No cases added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Case</th>
                                <th>Status</th>
                                <th>Next Hearing</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cases as $case)
                            <tr>
                                <td>{{ $case->client_name }}</td>
                                <td>{{ $case->case_number ?? $case->case_type ?? '-' }}</td>
                                <td>{{ ucfirst($case->case_status) }}</td>
                                <td>{{ $case->next_hearing_date ? $case->next_hearing_date->format('d M Y') : '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/lawyer/cases/' . $case->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="case_status" class="form-input form-input-sm">
                                            <option value="inquiry" {{ $case->case_status === 'inquiry' ? 'selected' : '' }}>Inquiry</option>
                                            <option value="filed" {{ $case->case_status === 'filed' ? 'selected' : '' }}>Filed</option>
                                            <option value="ongoing" {{ $case->case_status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                            <option value="hearing" {{ $case->case_status === 'hearing' ? 'selected' : '' }}>Hearing</option>
                                            <option value="judgement" {{ $case->case_status === 'judgement' ? 'selected' : '' }}>Judgement</option>
                                            <option value="closed" {{ $case->case_status === 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Update</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/lawyer/cases/' . $case->id) }}" class="inline-form" onsubmit="return confirm('Delete this case?');">
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
    .form-input-sm { max-width: 160px; }
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
