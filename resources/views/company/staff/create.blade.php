@extends('layouts.redesign.company')

@section('page-title', 'Add Staff Member')
@section('breadcrumb')
<a href="{{ url('/company/staff') }}">Staff</a>
<span class="breadcrumb-separator">/</span>
Add New
@endsection

@section('company-content')
<div class="form-page">
    <div class="form-card">
        <div class="form-header">
            <h2><i class="fas fa-user-plus"></i> Add Staff Member</h2>
            <p>Create a new digital business card for your staff</p>
        </div>

        <form action="{{ route('company.staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <h3 class="section-title">Personal Information</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-input" placeholder="Enter full name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Employee ID</label>
                        <input type="text" name="employee_id" class="form-input" placeholder="e.g., EMP001" value="{{ old('employee_id') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" placeholder="staff@example.com" value="{{ old('email') }}">
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-input" placeholder="Enter phone number" value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Profile Photo</label>
                    <div class="file-upload-area" id="uploadArea">
                        <input type="file" name="profile_image" id="profileImage" accept="image/*" hidden>
                        <div class="upload-placeholder" id="uploadPlaceholder">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click or drag to upload photo</p>
                            <span>Max 2MB, JPG/PNG</span>
                        </div>
                        <div class="upload-preview" id="uploadPreview" style="display: none;">
                            <img id="previewImage" src="" alt="Preview">
                            <button type="button" class="remove-image" onclick="removeImage()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">Work Information</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Designation</label>
                        <input type="text" name="designation" class="form-input" placeholder="e.g., Software Engineer" value="{{ old('designation') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-input" placeholder="e.g., Technology" value="{{ old('department') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Role *</label>
                    <select name="role" class="form-select" required>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ url('/company/staff') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Staff Member
                </button>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="info-card">
        <h4><i class="fas fa-info-circle"></i> Card Information</h4>
        <ul>
            <li><strong>Cards Used:</strong> {{ $company->cards_used }} / {{ $company->card_limit }}</li>
            <li><strong>Remaining:</strong> {{ $company->remaining_cards }} cards</li>
            <li><strong>Plan:</strong> {{ ucfirst($company->subscription_type) }}</li>
        </ul>
        @if($company->remaining_cards <= 2)
            <a href="{{ url('/company/subscription') }}" class="btn btn-warning btn-sm" style="margin-top: 1rem; width: 100%;">
                <i class="fas fa-crown"></i> Upgrade Plan
            </a>
        @endif
    </div>
</div>

@push('page-styles')
<style>
    .form-page {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 1.5rem;
        max-width: 1000px;
    }
    @media (max-width: 768px) {
        .form-page {
            grid-template-columns: 1fr;
        }
    }
    .form-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
    }
    .form-header {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }
    .form-header h2 {
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.25rem;
    }
    .form-header p {
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    .form-section {
        margin-bottom: 1.5rem;
    }
    .section-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #0891b2;
        display: inline-block;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    @media (max-width: 480px) {
        .form-row { grid-template-columns: 1fr; }
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
    }
    .form-input, .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 1rem;
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: all 0.2s;
    }
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #0891b2;
        box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
    }
    .error-text {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }
    .file-upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 0.75rem;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .file-upload-area:hover {
        border-color: #0891b2;
        background: rgba(8, 145, 178, 0.02);
    }
    .upload-placeholder i {
        font-size: 2.5rem;
        color: #0891b2;
        margin-bottom: 0.75rem;
    }
    .upload-placeholder p {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
    .upload-placeholder span {
        font-size: 0.85rem;
        color: var(--text-muted);
    }
    .upload-preview {
        position: relative;
        display: inline-block;
    }
    .upload-preview img {
        width: 120px;
        height: 120px;
        border-radius: 0.75rem;
        object-fit: cover;
    }
    .remove-image {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #ef4444;
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }
    .info-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: var(--shadow-sm);
        height: fit-content;
    }
    .info-card h4 {
        font-size: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-card ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .info-card li {
        padding: 0.5rem 0;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.9rem;
    }
    .info-card li:last-child {
        border-bottom: none;
    }
</style>
@endpush

@push('page-scripts')
<script>
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('profileImage');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const uploadPreview = document.getElementById('uploadPreview');
    const previewImage = document.getElementById('previewImage');

    uploadArea.addEventListener('click', () => fileInput.click());

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#0891b2';
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.borderColor = '';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '';
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    function handleFileSelect(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                uploadPlaceholder.style.display = 'none';
                uploadPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        fileInput.value = '';
        previewImage.src = '';
        uploadPlaceholder.style.display = 'block';
        uploadPreview.style.display = 'none';
    }
</script>
@endpush
@endsection
