@extends('layouts.redesign.agent')

@section('page-title', 'Add New User')
@section('breadcrumb')
    <a href="{{ url('/agent/allusers') }}">Users</a>
    <span class="breadcrumb-separator">/</span>
    <span>Add</span>
@endsection

@push('page-styles')
<style>
    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
    }

    .form-header {
        margin-bottom: var(--space-xl);
        padding-bottom: var(--space-lg);
        border-bottom: 1px solid var(--card-border);
    }

    .form-header h2 {
        font-size: var(--text-xl);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .form-header p {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .form-group {
        margin-bottom: var(--space-lg);
    }

    .form-label {
        display: block;
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .form-label .required {
        color: var(--red-500);
    }

    .form-control {
        width: 100%;
        padding: var(--space-sm) var(--space-md);
        font-size: var(--text-base);
        color: var(--text-primary);
        background: var(--bg-primary);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-md);
        transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--purple-500);
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-error {
        font-size: var(--text-sm);
        color: var(--red-500);
        margin-top: var(--space-xs);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-lg);
    }

    .bulk-upload-section {
        background: var(--bg-secondary);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        margin-bottom: var(--space-xl);
    }

    .bulk-upload-title {
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-md);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .bulk-upload-form {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        flex-wrap: wrap;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-actions {
        display: flex;
        gap: var(--space-md);
        padding-top: var(--space-lg);
        border-top: 1px solid var(--card-border);
        margin-top: var(--space-xl);
    }

    .recent-users-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('agent-content')

<!-- Bulk Upload Section -->
<div class="form-card">
    <div class="bulk-upload-section">
        <div class="bulk-upload-title">
            <i class="fas fa-upload" style="color: var(--purple-500);"></i>
            <span>Bulk Upload Users</span>
        </div>
        <form action="{{ route('users.bulk-upload') }}" method="POST" enctype="multipart/form-data" class="bulk-upload-form">
            @csrf
            <div style="flex: 1; min-width: 200px;">
                <input type="file" name="csv_file" accept=".csv, .txt" class="form-control" required>
                @error('csv_file')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-cloud-upload-alt"></i> Upload CSV
            </button>
        </form>
    </div>

    <div class="form-header">
        <h2><i class="fas fa-user-plus" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Add New User</h2>
        <p>Add a new user to the system</p>
    </div>

    <form method="POST" action="{{ url('/agent/addnewuser/store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Name <span class="required">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter full name">
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email address">
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Phone <span class="required">*</span></label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="+91">
                @error('phone')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Upload Documents</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" placeholder="Add notes about the user...">{{ old('description') }}</textarea>
            @error('description')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ url('/agent/allusers') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Add User
            </button>
        </div>
    </form>
</div>

<!-- Recent Users Table -->
@if(isset($last_interaction) && count($last_interaction) > 0)
<div class="recent-users-card">
    <h3 style="font-size: var(--text-lg); font-weight: var(--font-semibold); margin-bottom: var(--space-lg);">
        <i class="fas fa-history" style="color: var(--purple-500); margin-right: var(--space-sm);"></i>
        Recent Interactions
    </h3>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($last_interaction as $item)
                <tr>
                    <td>{{ $item->services_expiry_date }}</td>
                    <td>{{ Str::limit($item->description, 40) }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ url('/agent/edituser/' . $item->id . '/edit') }}" class="btn btn-icon btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ url('/agent/viewuser/' . $item->id . '/view') }}" class="btn btn-icon btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection

@push('page-scripts')
<script>
    // Auto-add +91 prefix
    document.getElementById('phone').addEventListener('keyup', function() {
        const prefix = '+91';
        if (this.value.indexOf(prefix) !== 0) {
            this.value = prefix + this.value.replace(prefix, '');
        }
    });
</script>
@endpush
