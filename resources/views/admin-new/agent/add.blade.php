@extends('layouts.redesign.admin')

@section('page-title', 'Add Franchise')
@section('breadcrumb')
    <a href="{{ url('/admin/manageagent') }}">Franchises</a>
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
        max-width: 900px;
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

    .form-section {
        margin-bottom: var(--space-xl);
    }

    .form-section-title {
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-md);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .form-section-title i {
        color: var(--purple-500);
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

    .file-upload {
        border: 2px dashed var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        text-align: center;
        cursor: pointer;
        transition: border-color var(--transition-fast), background var(--transition-fast);
    }

    .file-upload:hover {
        border-color: var(--purple-500);
        background: rgba(124, 58, 237, 0.05);
    }

    .file-upload i {
        font-size: var(--text-2xl);
        color: var(--text-muted);
        margin-bottom: var(--space-sm);
    }

    .file-upload p {
        color: var(--text-muted);
        font-size: var(--text-sm);
        margin: 0;
    }

    .file-upload input {
        display: none;
    }

    .preview-image {
        max-width: 150px;
        max-height: 100px;
        border-radius: var(--radius-md);
        margin-top: var(--space-md);
        display: none;
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

    .password-toggle {
        position: relative;
    }

    .password-toggle .toggle-btn {
        position: absolute;
        right: var(--space-md);
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 0;
    }

    .password-toggle .toggle-btn:hover {
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    /* Hide number input spinners */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        appearance: textfield;
    }
</style>
@endpush

@section('admin-content')

<div class="form-card">
    <div class="form-header">
        <h2><i class="fas fa-user-tie" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Add New Franchise</h2>
        <p>Create a new franchise partner account</p>
    </div>

    <form method="POST" action="{{ url('/admin/addagent/addagentstore') }}" enctype="multipart/form-data">
        @csrf

        <!-- Personal Information -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-user"></i> Personal Information
            </h3>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Full Name <span class="required">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter full name">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email address">
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Mobile Number <span class="required">*</span></label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Enter mobile number">
                    @error('mobile')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Alternative Mobile</label>
                    <input type="text" name="alternative_mobile" class="form-control" value="{{ old('alternative_mobile') }}" placeholder="Enter alternative mobile (optional)">
                    @error('alternative_mobile')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Address <span class="required">*</span></label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Enter complete address">
                @error('address')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Documents -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-id-card"></i> Identity Documents
            </h3>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Aadhar Card (Front) <span class="required">*</span></label>
                    <div class="file-upload" onclick="document.getElementById('aadharFront').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload front side</p>
                        <input type="file" id="aadharFront" name="aadhar_front" accept="image/*">
                    </div>
                    <img id="aadharFrontPreview" class="preview-image" alt="Preview">
                    @error('aadhar_front')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Aadhar Card (Back) <span class="required">*</span></label>
                    <div class="file-upload" onclick="document.getElementById('aadharBack').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload back side</p>
                        <input type="file" id="aadharBack" name="aadhar_back" accept="image/*">
                    </div>
                    <img id="aadharBackPreview" class="preview-image" alt="Preview">
                    @error('aadhar_back')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Account Settings -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-cog"></i> Account Settings
            </h3>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Franchise Code <span class="required">*</span></label>
                    <input type="text" name="agent_code" class="form-control" value="{{ old('agent_code') }}" placeholder="Enter unique franchise code">
                    @error('agent_code')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password <span class="required">*</span></label>
                    <div class="password-toggle">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                        <button type="button" class="toggle-btn" onclick="togglePassword()">
                            <i class="fas fa-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group" style="max-width: 50%;">
                <label class="form-label">Status <span class="required">*</span></label>
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ url('/admin/manageagent') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Franchise
            </button>
        </div>
    </form>
</div>

@endsection

@push('page-scripts')
<script>
    // Password toggle
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }

    // Image preview for Aadhar Front
    document.getElementById('aadharFront').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('aadharFrontPreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Image preview for Aadhar Back
    document.getElementById('aadharBack').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('aadharBackPreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
