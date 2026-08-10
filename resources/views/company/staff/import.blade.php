@extends('layouts.redesign.company')

@section('page-title', 'Import Staff')
@section('breadcrumb', 'Import Staff')

@section('company-content')
<div class="import-page">
    <div class="import-card">
        <div class="card-header">
            <h3><i class="fas fa-file-import"></i> Bulk Import Staff</h3>
        </div>
        <div class="card-body">
            <div class="import-info">
                <div class="info-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="info-content">
                    <h4>Import Staff from CSV/Excel</h4>
                    <p>Upload a CSV or Excel file to add multiple staff members at once. Make sure your file follows the required format.</p>
                </div>
            </div>

            <div class="template-section">
                <h4><i class="fas fa-download"></i> Download Template</h4>
                <p>Download our template file and fill in your staff data in the correct format.</p>
                <a href="#" class="btn btn-outline" onclick="downloadTemplate()">
                    <i class="fas fa-file-excel"></i> Download CSV Template
                </a>
            </div>

            <form action="{{ route('company.staff.import') }}" method="POST" enctype="multipart/form-data" class="import-form">
                @csrf
                <div class="upload-area" id="uploadArea">
                    <input type="file" name="file" id="fileInput" accept=".csv,.xlsx,.xls" required>
                    <div class="upload-content">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h4>Drag & Drop your file here</h4>
                        <p>or click to browse</p>
                        <span class="file-types">Supported: CSV, XLSX, XLS</span>
                    </div>
                    <div class="file-selected" id="fileSelected" style="display: none;">
                        <i class="fas fa-file-alt"></i>
                        <span id="fileName"></span>
                        <button type="button" class="remove-file" onclick="removeFile()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                @error('file')
                    <div class="form-error">{{ $message }}</div>
                @enderror

                <div class="import-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="skip_duplicates" value="1" checked>
                        <span>Skip duplicate entries (based on email)</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="enable_cards" value="1" checked>
                        <span>Enable cards for imported staff</span>
                    </label>
                </div>

                <div class="form-actions">
                    <a href="{{ url('/company/staff') }}" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Import Staff
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="format-guide">
        <h3><i class="fas fa-book"></i> File Format Guide</h3>
        <p>Your CSV/Excel file should have the following columns:</p>
        <div class="table-responsive">
            <table class="format-table">
                <thead>
                    <tr>
                        <th>Column</th>
                        <th>Required</th>
                        <th>Description</th>
                        <th>Example</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>name</code></td>
                        <td><span class="badge badge-success">Yes</span></td>
                        <td>Full name of the staff member</td>
                        <td>John Doe</td>
                    </tr>
                    <tr>
                        <td><code>email</code></td>
                        <td><span class="badge badge-success">Yes</span></td>
                        <td>Email address (must be unique)</td>
                        <td>john@company.com</td>
                    </tr>
                    <tr>
                        <td><code>phone</code></td>
                        <td><span class="badge badge-secondary">No</span></td>
                        <td>Phone number</td>
                        <td>9876543210</td>
                    </tr>
                    <tr>
                        <td><code>designation</code></td>
                        <td><span class="badge badge-secondary">No</span></td>
                        <td>Job title/designation</td>
                        <td>Software Engineer</td>
                    </tr>
                    <tr>
                        <td><code>department</code></td>
                        <td><span class="badge badge-secondary">No</span></td>
                        <td>Department name</td>
                        <td>Technology</td>
                    </tr>
                    <tr>
                        <td><code>employee_id</code></td>
                        <td><span class="badge badge-secondary">No</span></td>
                        <td>Internal employee ID</td>
                        <td>EMP001</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .import-page {
        max-width: 800px;
    }
    .import-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
    }
    .card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    .card-header h3 {
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .card-body {
        padding: 1.5rem;
    }
    .import-info {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        background: rgba(8, 145, 178, 0.1);
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
    }
    .info-icon {
        font-size: 1.5rem;
        color: #0891b2;
    }
    .info-content h4 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }
    .info-content p {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin: 0;
    }
    .template-section {
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
    }
    .template-section h4 {
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }
    .template-section p {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }
    .upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        position: relative;
        transition: all 0.3s;
        margin-bottom: 1rem;
    }
    .upload-area:hover,
    .upload-area.dragover {
        border-color: #0891b2;
        background: rgba(8, 145, 178, 0.05);
    }
    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }
    .upload-icon {
        font-size: 3rem;
        color: #0891b2;
        margin-bottom: 1rem;
    }
    .upload-content h4 {
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
    }
    .upload-content p {
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }
    .file-types {
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    .file-selected {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1rem;
        background: rgba(34, 197, 94, 0.1);
        border-radius: 0.5rem;
    }
    .file-selected i {
        font-size: 1.5rem;
        color: #22c55e;
    }
    .remove-file {
        background: none;
        border: none;
        color: #ef4444;
        cursor: pointer;
        padding: 0.25rem;
    }
    .import-options {
        margin-bottom: 1.5rem;
    }
    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0;
        cursor: pointer;
    }
    .checkbox-label input {
        width: 18px;
        height: 18px;
        accent-color: #0891b2;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }
    .form-error {
        color: #ef4444;
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }
    .format-guide {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
    }
    .format-guide h3 {
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }
    .format-guide > p {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    .format-table {
        width: 100%;
        border-collapse: collapse;
    }
    .format-table th,
    .format-table td {
        padding: 0.75rem;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }
    .format-table th {
        font-weight: 600;
        background: var(--bg-secondary);
    }
    .format-table code {
        background: var(--bg-secondary);
        padding: 0.2rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.85rem;
    }
    .table-responsive {
        overflow-x: auto;
    }
</style>
@endpush

@push('page-scripts')
<script>
    const fileInput = document.getElementById('fileInput');
    const uploadArea = document.getElementById('uploadArea');
    const uploadContent = document.querySelector('.upload-content');
    const fileSelected = document.getElementById('fileSelected');
    const fileName = document.getElementById('fileName');

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            showFile(this.files[0]);
        }
    });

    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function() {
        this.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        if (e.dataTransfer.files.length > 0) {
            fileInput.files = e.dataTransfer.files;
            showFile(e.dataTransfer.files[0]);
        }
    });

    function showFile(file) {
        fileName.textContent = file.name;
        uploadContent.style.display = 'none';
        fileSelected.style.display = 'flex';
    }

    function removeFile() {
        fileInput.value = '';
        uploadContent.style.display = 'block';
        fileSelected.style.display = 'none';
    }

    function downloadTemplate() {
        const csvContent = "name,email,phone,designation,department,employee_id\nJohn Doe,john@company.com,9876543210,Software Engineer,Technology,EMP001\nJane Smith,jane@company.com,9876543211,Product Manager,Product,EMP002";
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'staff_import_template.csv';
        a.click();
        window.URL.revokeObjectURL(url);
    }
</script>
@endpush
@endsection
