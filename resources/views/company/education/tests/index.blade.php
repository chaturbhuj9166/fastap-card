@extends('layouts.redesign.company')

@section('page-title', 'Student Tests')
@section('breadcrumb', 'Student Tests')

@section('company-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Tests</h1>
            <p class="content-subtitle">Record student tests</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Test</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/education/tests') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Batch</label>
                    <select name="batch_id" class="form-input">
                        <option value="">Select batch</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Test Name</label>
                    <input type="text" name="test_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Test Date</label>
                    <input type="date" name="test_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Total Marks</label>
                    <input type="number" name="total_marks" class="form-input" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Results (one per line)</label>
                    <textarea name="results" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Test</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tests</h3>
        </div>
        <div class="card-body">
            @if($tests->count() === 0)
                <p class="empty-state">No tests added yet.</p>
            @else
                @foreach($tests as $test)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $test->test_name }}</strong>
                            <span>{{ $test->test_date?->format('Y-m-d') ?? 'n/a' }}</span>
                        </div>
                        <p class="item-desc">Total Marks: {{ $test->total_marks ?? 'n/a' }}</p>

                        <form method="POST" action="{{ url('/company/education/tests/' . $test->id) }}" class="inline-form" onsubmit="return confirm('Delete this test?');">
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
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-top: 0.5rem; }
    .empty-state { color: var(--text-secondary); }
    .item-card { border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .item-header { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.5rem; }
    .item-desc { color: var(--text-secondary); }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection

