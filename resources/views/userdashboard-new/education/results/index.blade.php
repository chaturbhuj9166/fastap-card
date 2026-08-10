@extends('layouts.redesign.dashboard')

@section('title', 'Education Results')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Results</h1>
            <p class="content-subtitle">Showcase exam outcomes</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Result</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/education/results') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Exam Year</label>
                    <input type="text" name="exam_year" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Exam Type</label>
                    <input type="text" name="exam_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Total Students</label>
                    <input type="number" name="total_students" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Pass Percentage</label>
                    <input type="number" name="pass_percentage" class="form-input" min="0" max="100" step="0.01">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Toppers (one per line)</label>
                    <textarea name="toppers" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Achievements (one per line)</label>
                    <textarea name="achievements" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Result</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Result Highlights</h3>
        </div>
        <div class="card-body">
            @if($results->count() === 0)
                <p class="empty-state">No results added yet.</p>
            @else
                @foreach($results as $result)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $result->exam_type ?? 'Exam' }} ({{ $result->exam_year ?? 'n/a' }})</strong>
                            <span>{{ $result->pass_percentage ?? 'n/a' }}%</span>
                        </div>
                        <p class="item-desc">Total Students: {{ $result->total_students ?? 'n/a' }}</p>
                        <form method="POST" action="{{ url('/user/education/results/' . $result->id) }}" class="inline-form" onsubmit="return confirm('Delete this result?');">
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
