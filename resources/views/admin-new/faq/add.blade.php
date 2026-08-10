@extends('layouts.redesign.admin')

@section('page-title', 'Add FAQ')
@section('breadcrumb')
    <a href="{{ url('/admin/view-faq') }}">FAQs</a>
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
        max-width: 800px;
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

    .form-control::placeholder {
        color: var(--text-muted);
    }

    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    .form-error {
        font-size: var(--text-sm);
        color: var(--red-500);
        margin-top: var(--space-xs);
    }

    .form-actions {
        display: flex;
        gap: var(--space-md);
        padding-top: var(--space-lg);
        border-top: 1px solid var(--card-border);
        margin-top: var(--space-xl);
    }

    .faq-preview {
        background: var(--bg-secondary);
        border-radius: var(--radius-lg);
        margin-bottom: var(--space-xl);
        overflow: hidden;
    }

    .faq-preview-header {
        background: linear-gradient(135deg, var(--purple-500), var(--purple-600));
        padding: var(--space-md) var(--space-lg);
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
    }

    .faq-preview-question {
        color: white;
        font-weight: var(--font-medium);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .faq-preview-question i {
        opacity: 0.8;
    }

    .faq-preview-icon {
        color: white;
    }

    .faq-preview-body {
        padding: var(--space-lg);
        color: var(--text-secondary);
        font-size: var(--text-sm);
        line-height: 1.6;
    }

    .form-hint {
        font-size: var(--text-xs);
        color: var(--text-muted);
        margin-top: var(--space-xs);
    }
</style>
@endpush

@section('admin-content')

<div class="form-card">
    <div class="form-header">
        <h2><i class="fas fa-question-circle" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Add New FAQ</h2>
        <p>Create a frequently asked question for your website</p>
    </div>

    <div class="faq-preview">
        <div class="faq-preview-header">
            <div class="faq-preview-question">
                <i class="fas fa-question"></i>
                <span id="previewQuestion">Your question will appear here</span>
            </div>
            <span class="faq-preview-icon"><i class="fas fa-chevron-down"></i></span>
        </div>
        <div class="faq-preview-body" id="previewAnswer">
            Your answer will appear here...
        </div>
    </div>

    <form method="POST" action="{{ url('admin/faq-data') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Question <span class="required">*</span></label>
            <input type="text" name="name" id="faqQuestion" class="form-control" value="{{ old('name') }}" placeholder="Enter the frequently asked question">
            <p class="form-hint">Write a clear, concise question that customers might ask</p>
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Answer <span class="required">*</span></label>
            <textarea name="description" id="faqAnswer" class="form-control" placeholder="Enter the answer to this question">{{ old('description') }}</textarea>
            <p class="form-hint">Provide a helpful and complete answer</p>
            @error('description')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ url('/admin/view-faq') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save FAQ
            </button>
        </div>
    </form>
</div>

@endsection

@push('page-scripts')
<script>
    // Live preview for question
    document.getElementById('faqQuestion').addEventListener('input', function() {
        document.getElementById('previewQuestion').textContent = this.value || 'Your question will appear here';
    });

    // Live preview for answer
    document.getElementById('faqAnswer').addEventListener('input', function() {
        document.getElementById('previewAnswer').textContent = this.value || 'Your answer will appear here...';
    });
</script>
@endpush
