@extends('layouts.redesign.dashboard')

@section('title', 'Case Hearings')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Case Hearings</h1>
            <p class="content-subtitle">Track hearing schedules and outcomes</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Hearing</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/lawyer/hearings') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Case</label>
                    <select name="case_id" class="form-input" required>
                        <option value="">Select</option>
                        @foreach($cases as $case)
                            <option value="{{ $case->id }}">{{ $case->case_number ?? $case->client_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Hearing Date</label>
                    <input type="date" name="hearing_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Hearing Time</label>
                    <input type="time" name="hearing_time" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Court Room</label>
                    <input type="text" name="court_room" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="hearing_status" class="form-input">
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="adjourned">Adjourned</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Next Hearing Date</label>
                    <input type="date" name="next_hearing_date" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Outcome Notes</label>
                    <textarea name="outcome_notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Hearing</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Hearings</h3>
        </div>
        <div class="card-body">
            @if($hearings->count() === 0)
                <p class="empty-state">No hearings scheduled yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Case</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Next Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hearings as $hearing)
                            <tr>
                                <td>{{ $hearing->legalCase?->case_number ?? $hearing->legalCase?->client_name ?? '-' }}</td>
                                <td>{{ $hearing->hearing_date ? $hearing->hearing_date->format('d M Y') : '-' }}</td>
                                <td>{{ ucfirst($hearing->hearing_status) }}</td>
                                <td>{{ $hearing->next_hearing_date ? $hearing->next_hearing_date->format('d M Y') : '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/lawyer/hearings/' . $hearing->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <select name="hearing_status" class="form-input form-input-sm">
                                            <option value="scheduled" {{ $hearing->hearing_status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                            <option value="completed" {{ $hearing->hearing_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="adjourned" {{ $hearing->hearing_status === 'adjourned' ? 'selected' : '' }}>Adjourned</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Update</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/lawyer/hearings/' . $hearing->id) }}" class="inline-form" onsubmit="return confirm('Delete this hearing?');">
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
