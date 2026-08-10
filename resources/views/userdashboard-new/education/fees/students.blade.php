@extends('layouts.redesign.dashboard')

@section('title', 'Student Fees')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Student Fees</h1>
            <p class="content-subtitle">Track fee collections</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Student Fee</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/education/student-fees') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Student Name</label>
                    <input type="text" name="student_name" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Student Mobile</label>
                    <input type="text" name="student_mobile" class="form-input">
                </div>
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
                    <label class="form-label">Total Fee</label>
                    <input type="number" name="total_fee" class="form-input" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Discount</label>
                    <input type="number" name="discount_amount" class="form-input" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Amount Paid</label>
                    <input type="number" name="amount_paid" class="form-input" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Amount Due</label>
                    <input type="number" name="amount_due" class="form-input" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Next Due Date</label>
                    <input type="date" name="next_due_date" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Payment History (one per line)</label>
                    <textarea name="payment_history" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Fee</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Fees</h3>
        </div>
        <div class="card-body">
            @if($fees->count() === 0)
                <p class="empty-state">No student fees yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Batch</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Next Due</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fees as $fee)
                            <tr>
                                <td>{{ $fee->student_name }}</td>
                                <td>{{ optional($batches->firstWhere('id', $fee->batch_id))->batch_name ?? 'n/a' }}</td>
                                <td>{{ $fee->total_fee }}</td>
                                <td>{{ $fee->amount_paid }}</td>
                                <td>{{ $fee->amount_due }}</td>
                                <td>{{ $fee->next_due_date?->format('Y-m-d') }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/education/student-fees/' . $fee->id) }}" class="inline-form" onsubmit="return confirm('Delete this fee record?');">
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
