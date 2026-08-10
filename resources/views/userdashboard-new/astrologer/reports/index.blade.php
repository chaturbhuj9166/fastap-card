@extends('layouts.redesign.dashboard')

@section('title', 'Client Reports')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Client Reports</h1>
            <p class="content-subtitle">Store kundli and consultation reports</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Report</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/astrologer/reports') }}" class="form-grid" enctype="multipart/form-data">
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
                    <label class="form-label">Birth Date</label>
                    <input type="date" name="birth_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Birth Time</label>
                    <input type="text" name="birth_time" class="form-input" placeholder="10:45 PM">
                </div>
                <div class="form-group">
                    <label class="form-label">Birth Place</label>
                    <input type="text" name="birth_place" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Kundli Data (one per line)</label>
                    <textarea name="kundli_data" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Report Files</label>
                    <input type="file" name="reports[]" class="form-input" multiple>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Report</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Reports</h3>
        </div>
        <div class="card-body">
            @if($reports->count() === 0)
                <p class="empty-state">No reports added yet.</p>
            @else
                @foreach($reports as $report)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $report->client_name ?? 'Client' }}</strong>
                            <span>{{ $report->birth_date ? $report->birth_date->format('d M Y') : 'Birth date N/A' }}</span>
                        </div>
                        <p class="item-desc">
                            {{ $report->birth_place ?? 'Birth place N/A' }}
                        </p>

                        <form method="POST" action="{{ url('/user/astrologer/reports/' . $report->id) }}" class="inline-form" onsubmit="return confirm('Delete this report?');">
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
