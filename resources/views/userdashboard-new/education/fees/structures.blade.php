@extends('layouts.redesign.dashboard')

@section('title', 'Fee Structures')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Fee Structures</h1>
            <p class="content-subtitle">Define fee structure by course</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Fee Structure</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/education/fee-structures') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Course</label>
                    <select name="course_id" class="form-input">
                        <option value="">Select course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Registration Fee</label>
                    <input type="number" name="registration_fee" class="form-input" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Tuition Fee</label>
                    <input type="number" name="tuition_fee" class="form-input" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Installments</label>
                    <input type="number" name="installment_count" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Late Fee Amount</label>
                    <input type="number" name="late_fee_amount" class="form-input" min="0" step="0.01">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Structure</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Structures</h3>
        </div>
        <div class="card-body">
            @if($structures->count() === 0)
                <p class="empty-state">No fee structures yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Registration</th>
                                <th>Tuition</th>
                                <th>Installments</th>
                                <th>Late Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($structures as $structure)
                            <tr>
                                <td>{{ optional($courses->firstWhere('id', $structure->course_id))->course_name ?? 'General' }}</td>
                                <td>{{ $structure->registration_fee }}</td>
                                <td>{{ $structure->tuition_fee }}</td>
                                <td>{{ $structure->installment_count }}</td>
                                <td>{{ $structure->late_fee_amount }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/education/fee-structures/' . $structure->id) }}" class="inline-form" onsubmit="return confirm('Delete this fee structure?');">
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
