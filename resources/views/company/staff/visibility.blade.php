@extends('layouts.redesign.company')

@section('page-title', 'Visibility Settings')
@section('breadcrumb')
<a href="{{ url('/company/staff') }}">Staff</a>
<span class="breadcrumb-separator">/</span>
<a href="{{ url('/company/staff/' . $staff->id) }}">{{ $staff->name }}</a>
<span class="breadcrumb-separator">/</span>
Visibility
@endsection

@section('company-content')
<div class="visibility-page">
    <div class="page-header">
        <div class="staff-info">
            <div class="staff-avatar">
                @if($staff->profile_image)
                    <img src="{{ asset('uploads/staff/' . $staff->profile_image) }}" alt="{{ $staff->name }}">
                @else
                    <span>{{ substr($staff->name, 0, 1) }}</span>
                @endif
            </div>
            <div>
                <h1>{{ $staff->name }}</h1>
                <p>{{ $staff->designation ?? 'Staff Member' }}</p>
            </div>
        </div>
        <a href="{{ url('/company/staff/' . $staff->id) }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Profile
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('company.staff.visibility.update', $staff->id) }}" method="POST">
        @csrf

        <div class="visibility-grid">
            <!-- Personal Information -->
            <div class="visibility-card">
                <div class="card-header">
                    <h3><i class="fas fa-user"></i> Personal Information</h3>
                    <p>Control which personal details appear on the card</p>
                </div>
                <div class="card-body">
                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Full Name</span>
                            <span class="item-value">{{ $staff->name }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[name]" value="1"
                                   {{ ($visibility['name'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Profile Photo</span>
                            <span class="item-value">{{ $staff->profile_image ? 'Uploaded' : 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[photo]" value="1"
                                   {{ ($visibility['photo'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Employee ID</span>
                            <span class="item-value">{{ $staff->employee_id ?? 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[employee_id]" value="1"
                                   {{ ($visibility['employee_id'] ?? false) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="visibility-card">
                <div class="card-header">
                    <h3><i class="fas fa-address-book"></i> Contact Information</h3>
                    <p>Control which contact details are visible</p>
                </div>
                <div class="card-body">
                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Email Address</span>
                            <span class="item-value">{{ $staff->email ?? 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[email]" value="1"
                                   {{ ($visibility['email'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Phone Number</span>
                            <span class="item-value">{{ $staff->phone ?? 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[phone]" value="1"
                                   {{ ($visibility['phone'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Work Information -->
            <div class="visibility-card">
                <div class="card-header">
                    <h3><i class="fas fa-briefcase"></i> Work Information</h3>
                    <p>Control which work details are displayed</p>
                </div>
                <div class="card-body">
                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Designation/Title</span>
                            <span class="item-value">{{ $staff->designation ?? 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[designation]" value="1"
                                   {{ ($visibility['designation'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Department</span>
                            <span class="item-value">{{ $staff->department ?? 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[department]" value="1"
                                   {{ ($visibility['department'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Role Level</span>
                            <span class="item-value">{{ ucfirst($staff->role) }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[role]" value="1"
                                   {{ ($visibility['role'] ?? false) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Company Information -->
            <div class="visibility-card">
                <div class="card-header">
                    <h3><i class="fas fa-building"></i> Company Information</h3>
                    <p>Control company details on staff card</p>
                </div>
                <div class="card-body">
                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Company Logo</span>
                            <span class="item-value">{{ $company->logo ? 'Set' : 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[company_logo]" value="1"
                                   {{ ($visibility['company_logo'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Company Name</span>
                            <span class="item-value">{{ $company->name }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[company_name]" value="1"
                                   {{ ($visibility['company_name'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Company Website</span>
                            <span class="item-value">{{ $company->website ?? 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[company_website]" value="1"
                                   {{ ($visibility['company_website'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Company Address</span>
                            <span class="item-value">{{ $company->address ? 'Set' : 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[company_address]" value="1"
                                   {{ ($visibility['company_address'] ?? false) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="visibility-card">
                <div class="card-header">
                    <h3><i class="fas fa-share-alt"></i> Social Media</h3>
                    <p>Control which social links are visible</p>
                </div>
                <div class="card-body">
                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label"><i class="fab fa-linkedin" style="color: #0a66c2;"></i> LinkedIn</span>
                            <span class="item-value">{{ $company->linkedin ? 'Set' : 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[linkedin]" value="1"
                                   {{ ($visibility['linkedin'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label"><i class="fab fa-twitter" style="color: #1da1f2;"></i> Twitter</span>
                            <span class="item-value">{{ $company->twitter ? 'Set' : 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[twitter]" value="1"
                                   {{ ($visibility['twitter'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label"><i class="fab fa-facebook" style="color: #1877f2;"></i> Facebook</span>
                            <span class="item-value">{{ $company->facebook ? 'Set' : 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[facebook]" value="1"
                                   {{ ($visibility['facebook'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label"><i class="fab fa-instagram" style="color: #e4405f;"></i> Instagram</span>
                            <span class="item-value">{{ $company->instagram ? 'Set' : 'Not set' }}</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[instagram]" value="1"
                                   {{ ($visibility['instagram'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Card Sections -->
            <div class="visibility-card">
                <div class="card-header">
                    <h3><i class="fas fa-th-large"></i> Card Sections</h3>
                    <p>Control which sections appear on card</p>
                </div>
                <div class="card-body">
                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Contact Button</span>
                            <span class="item-desc">Quick contact action buttons</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[contact_buttons]" value="1"
                                   {{ ($visibility['contact_buttons'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Share Button</span>
                            <span class="item-desc">Allow sharing the card</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[share_button]" value="1"
                                   {{ ($visibility['share_button'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">Save Contact</span>
                            <span class="item-desc">Download vCard option</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[save_contact]" value="1"
                                   {{ ($visibility['save_contact'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="visibility-item">
                        <div class="item-info">
                            <span class="item-label">QR Code</span>
                            <span class="item-desc">Display QR code on card</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" name="visibility[qr_code]" value="1"
                                   {{ ($visibility['qr_code'] ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" class="btn btn-outline" onclick="resetToDefaults()">
                <i class="fas fa-undo"></i> Reset to Defaults
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Visibility Settings
            </button>
        </div>
    </form>
</div>

@push('page-styles')
<style>
    .visibility-page { max-width: 1000px; }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .staff-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .staff-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        overflow: hidden;
    }
    .staff-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .staff-info h1 { font-size: 1.25rem; margin-bottom: 0.25rem; }
    .staff-info p { color: var(--text-muted); }

    .alert {
        padding: 1rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .alert-success { background: #d1fae5; color: #065f46; }

    .visibility-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    @media (max-width: 768px) { .visibility-grid { grid-template-columns: 1fr; } }

    .visibility-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: var(--shadow-sm);
    }
    .card-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border-color);
    }
    .card-header h3 {
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.25rem;
    }
    .card-header p { color: var(--text-muted); font-size: 0.8rem; }
    .card-body { padding: 0.5rem 1.25rem; }

    .visibility-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.875rem 0;
        border-bottom: 1px solid var(--border-color);
    }
    .visibility-item:last-child { border-bottom: none; }
    .item-info { flex: 1; }
    .item-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
        margin-bottom: 0.125rem;
    }
    .item-value, .item-desc {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .toggle {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }
    .toggle input { display: none; }
    .toggle-slider {
        display: block;
        width: 44px;
        height: 24px;
        background: var(--border-color);
        border-radius: 12px;
        transition: background 0.2s;
    }
    .toggle-slider::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        transition: transform 0.2s;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }
    .toggle input:checked + .toggle-slider {
        background: #0891b2;
    }
    .toggle input:checked + .toggle-slider::after {
        transform: translateX(20px);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }
</style>
@endpush

@push('page-scripts')
<script>
    function resetToDefaults() {
        if (confirm('Reset all visibility settings to defaults?')) {
            document.querySelectorAll('.toggle input').forEach(input => {
                // Default: most things visible except employee_id, role, company_address
                const field = input.name.match(/\[(\w+)\]/)[1];
                const defaults = {
                    name: true, photo: true, employee_id: false,
                    email: true, phone: true,
                    designation: true, department: true, role: false,
                    company_logo: true, company_name: true, company_website: true, company_address: false,
                    linkedin: true, twitter: true, facebook: true, instagram: true,
                    contact_buttons: true, share_button: true, save_contact: true, qr_code: true
                };
                input.checked = defaults[field] ?? true;
            });
        }
    }
</script>
@endpush
@endsection
