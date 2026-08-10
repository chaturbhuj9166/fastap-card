@extends('layouts.redesign.company')

@section('page-title', 'Edit Staff Member')
@section('breadcrumb')
<a href="{{ url('/company/staff') }}">Staff</a>
<span class="breadcrumb-separator">/</span>
Edit
@endsection

@section('company-content')
<div class="form-page">
    <div class="form-card">
        <div class="form-header">
            <h2><i class="fas fa-user-edit"></i> Edit Staff Member</h2>
            <p>Update {{ $staff->name }}'s information</p>
        </div>

        <form action="{{ route('company.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-section">
                <h3 class="section-title">Personal Information</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-input" value="{{ old('name', $staff->name) }}" required>
                        @error('name')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Employee ID</label>
                        <input type="text" name="employee_id" class="form-input" value="{{ old('employee_id', $staff->employee_id) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', $staff->email) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-input" value="{{ old('phone', $staff->phone) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Profile Photo</label>
                    <div class="file-upload-area" id="uploadArea">
                        <input type="file" name="profile_image" id="profileImage" accept="image/*" hidden>
                        <div class="upload-placeholder" id="uploadPlaceholder" style="{{ $staff->profile_image ? 'display:none' : '' }}">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click or drag to upload photo</p>
                            <span>Max 2MB, JPG/PNG</span>
                        </div>
                        <div class="upload-preview" id="uploadPreview" style="{{ $staff->profile_image ? '' : 'display:none' }}">
                            <img id="previewImage" src="{{ $staff->profile_image ? asset('uploads/staff/' . $staff->profile_image) : '' }}" alt="Preview">
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
                        <input type="text" name="designation" class="form-input" value="{{ old('designation', $staff->designation) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-input" value="{{ old('department', $staff->department) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Role *</label>
                    <select name="role" class="form-select" required>
                        <option value="staff" {{ old('role', $staff->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="manager" {{ old('role', $staff->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="admin" {{ old('role', $staff->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ url('/company/staff') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@push('page-styles')
<style>
    .form-page { max-width: 700px; }
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
    .form-header p { color: var(--text-muted); font-size: 0.9rem; }
    .form-section { margin-bottom: 1.5rem; }
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
    @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }
    .form-group { margin-bottom: 1rem; }
    .form-label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .form-input, .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 1rem;
        background: var(--bg-primary);
        color: var(--text-primary);
    }
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #0891b2;
    }
    .error-text { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; display: block; }
    .file-upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 0.75rem;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
    }
    .file-upload-area:hover { border-color: #0891b2; }
    .upload-placeholder i { font-size: 2.5rem; color: #0891b2; margin-bottom: 0.75rem; }
    .upload-placeholder p { font-weight: 500; margin-bottom: 0.25rem; }
    .upload-placeholder span { font-size: 0.85rem; color: var(--text-muted); }
    .upload-preview { position: relative; display: inline-block; }
    .upload-preview img { width: 120px; height: 120px; border-radius: 0.75rem; object-fit: cover; }
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
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
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
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                previewImage.src = ev.target.result;
                uploadPlaceholder.style.display = 'none';
                uploadPreview.style.display = 'block';
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
    function removeImage() {
        fileInput.value = '';
        previewImage.src = '';
        uploadPlaceholder.style.display = 'block';
        uploadPreview.style.display = 'none';
    }
</script>
@endpush
@endsection
