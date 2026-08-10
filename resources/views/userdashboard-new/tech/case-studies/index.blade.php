@extends('layouts.redesign.dashboard')

@section('title', 'Case Studies')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Case Studies</h1>
            <p class="content-subtitle">Showcase results and project outcomes</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Case Study</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/tech/case-studies') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Industry</label>
                    <input type="text" name="industry" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Project URL</label>
                    <input type="url" name="project_url" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Summary</label>
                    <textarea name="summary" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Results</label>
                    <textarea name="results" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Technology Stack (one per line)</label>
                    <textarea name="technology_stack" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Metrics (one per line)</label>
                    <textarea name="metrics" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-input" multiple>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_featured" value="1">
                        <span>Featured</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Case Study</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Case Studies</h3>
        </div>
        <div class="card-body">
            @if($caseStudies->count() === 0)
                <p class="empty-state">No case studies added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Industry</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($caseStudies as $caseStudy)
                            <tr>
                                <td>{{ $caseStudy->title }}</td>
                                <td>{{ $caseStudy->industry ?? '-' }}</td>
                                <td>{{ $caseStudy->is_featured ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/tech/case-studies/' . $caseStudy->id) }}" class="inline-form" onsubmit="return confirm('Delete this case study?');">
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
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-right: 0.5rem; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
