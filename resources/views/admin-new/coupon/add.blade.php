@extends('layouts.redesign.admin')

@section('page-title', 'Add Coupon')
@section('breadcrumb')
    <a href="{{ url('/admin/view_coupon') }}">Coupons</a>
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
        max-width: 700px;
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-lg);
    }

    .input-with-suffix {
        position: relative;
    }

    .input-with-suffix .suffix {
        position: absolute;
        right: var(--space-md);
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-weight: var(--font-medium);
    }

    .input-with-suffix input {
        padding-right: 45px;
    }

    .coupon-preview {
        background: linear-gradient(135deg, var(--purple-500), var(--purple-600));
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        text-align: center;
        margin-bottom: var(--space-xl);
    }

    .coupon-preview .coupon-code {
        font-size: var(--text-xl);
        font-weight: var(--font-bold);
        color: white;
        letter-spacing: 2px;
        margin-bottom: var(--space-xs);
    }

    .coupon-preview .coupon-discount {
        font-size: var(--text-sm);
        color: rgba(255, 255, 255, 0.8);
    }

    .form-hint {
        font-size: var(--text-xs);
        color: var(--text-muted);
        margin-top: var(--space-xs);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')

<div class="form-card">
    <div class="form-header">
        <h2><i class="fas fa-ticket-alt" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Add New Coupon</h2>
        <p>Create a discount coupon code for customers</p>
    </div>

    <div class="coupon-preview">
        <div class="coupon-code" id="couponPreview">COUPON</div>
        <div class="coupon-discount" id="discountPreview">0% OFF</div>
    </div>

    <form method="POST" action="{{ url('/admin/add_coupon') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Coupon Code <span class="required">*</span></label>
                <input type="text" name="name" id="couponName" class="form-control" value="{{ old('name') }}" placeholder="e.g., SAVE20" style="text-transform: uppercase;">
                <p class="form-hint">Use uppercase letters and numbers only</p>
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Discount Percentage <span class="required">*</span></label>
                <div class="input-with-suffix">
                    <input type="number" name="discount" id="discountValue" class="form-control" value="{{ old('discount') }}" placeholder="e.g., 20" min="1" max="100">
                    <span class="suffix">%</span>
                </div>
                <p class="form-hint">Enter a value between 1 and 100</p>
                @error('discount')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ url('/admin/view_coupon') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Coupon
            </button>
        </div>
    </form>
</div>

@endsection

@push('page-scripts')
<script>
    // Live preview
    const couponInput = document.getElementById('couponName');
    const discountInput = document.getElementById('discountValue');
    const couponPreview = document.getElementById('couponPreview');
    const discountPreview = document.getElementById('discountPreview');

    couponInput.addEventListener('input', function() {
        couponPreview.textContent = this.value.toUpperCase() || 'COUPON';
    });

    discountInput.addEventListener('input', function() {
        discountPreview.textContent = (this.value || '0') + '% OFF';
    });
</script>
@endpush
