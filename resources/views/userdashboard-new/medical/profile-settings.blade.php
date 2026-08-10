@extends('layouts.redesign.dashboard')

@section('page-title', 'Medical Profile Settings')
@section('breadcrumb', 'Medical Profiles')

@section('dashboard-content')
<div class="form-page medical-profile-settings">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Medical Profiles</h1>
            <p>Manage doctor, hospital, and day care profiles for your medical card</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="form-card fade-up">
        <div class="form-card-header">
            <h3><i class="fas fa-user-md"></i> Active Profiles</h3>
        </div>
        <div class="form-card-body">
            @if($profiles->count())
                <div class="items-grid">
                    @foreach($profiles as $profile)
                        <div class="item-card">
                            <div class="item-card-body">
                                <div class="item-card-icon" style="font-size: 22px;">
                                    {!! $profile->getProfileTypeIcon() !!}
                                </div>
                                <div class="item-title">{{ $profile->getProfileTypeLabel() }}</div>
                                <div class="item-description">
                                    @if($profile->is_default)
                                        <span class="status-badge success">Default</span>
                                    @endif
                                    @if(!$profile->is_active)
                                        <span class="status-badge secondary">Inactive</span>
                                    @endif
                                </div>
                            </div>
                            <div class="item-card-actions">
                                <form action="{{ route('user.medical.profile.delete', $profile->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3>No profiles yet</h3>
                    <p>Create your first medical profile to start showing specialized details.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="form-card fade-up">
        <div class="form-card-header">
            <h3><i class="fas fa-edit"></i> Add/Edit Medical Profile</h3>
        </div>
        <div class="form-card-body">
            <form action="{{ route('user.medical.profile.save') }}" method="POST" enctype="multipart/form-data" id="medicalProfileForm">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>Profile Type *</label>
                        <select name="profile_type" class="form-control" id="profileTypeSelect" required>
                            <option value="doctor">Doctor</option>
                            <option value="hospital">Hospital</option>
                            <option value="daycare">Day Care / Home Health</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-row">
                            <label class="form-control" style="display:flex; align-items:center; gap:8px;">
                                <input type="checkbox" name="is_active" value="1" checked>
                                Active
                            </label>
                            <label class="form-control" style="display:flex; align-items:center; gap:8px;">
                                <input type="checkbox" name="is_default" value="1">
                                Set as Default
                            </label>
                        </div>
                    </div>
                </div>

                <div class="profile-section" data-profile="doctor">
                    <h4>Doctor Profile Fields</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Specialization</label>
                            <input type="text" name="specialization" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Degree</label>
                            <input type="text" name="degree" class="form-control" placeholder="e.g., MBBS, MD">
                        </div>
                        <div class="form-group">
                            <label>Experience (Years)</label>
                            <input type="number" name="experience_years" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Patients Treated</label>
                            <input type="number" name="patients_treated" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Registration Number</label>
                            <input type="text" name="registration_number" class="form-control">
                        </div>
                    </div>

                    <h4>Consultation Fees</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>In-person Consultation (?)</label>
                            <input type="number" name="consultation_fee_inperson" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Video Consultation (?)</label>
                            <input type="number" name="consultation_fee_video" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>OPD Timings</label>
                        <textarea name="opd_timings" class="form-control" rows="2" placeholder="Comma-separated, e.g., Mon-Fri 9am-1pm, Mon-Fri 5pm-8pm"></textarea>
                        <span class="form-hint">Use commas to separate timing blocks.</span>
                    </div>

                    <div class="form-group">
                        <label>Clinic Address</label>
                        <textarea name="clinic_address" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Clinic Facilities</label>
                        <textarea name="clinic_facilities" class="form-control" rows="2" placeholder="Comma-separated, e.g., Waiting area, Parking, Pharmacy"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Gallery Images</label>
                        <input type="file" name="gallery_images[]" class="form-control" multiple accept="image/*">
                        <span class="form-hint">Upload clinic/facility photos</span>
                    </div>
                </div>

                <div class="profile-section" data-profile="hospital" style="display:none;">
                    <h4>Hospital Profile Fields</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Hospital Name</label>
                            <input type="text" name="hospital_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Bed Capacity</label>
                            <input type="number" name="bed_capacity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact</label>
                            <input type="text" name="emergency_contact" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Departments</label>
                        <textarea name="departments" class="form-control" rows="2" placeholder="Comma-separated, e.g., Cardiology, Pediatrics, Radiology"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Facilities</label>
                        <textarea name="facilities" class="form-control" rows="2" placeholder="Comma-separated, e.g., ICU, Lab, Operation Theatre"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Insurance Accepted</label>
                        <textarea name="insurance_accepted" class="form-control" rows="2" placeholder="Comma-separated, e.g., ABC Health, XYZ Care"></textarea>
                    </div>

                    <div class="form-row">
                        <label class="form-control" style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="ambulance_service" value="1">
                            Ambulance Service Available
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Hospital Address</label>
                        <textarea name="clinic_address" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Hospital Facilities</label>
                        <textarea name="clinic_facilities" class="form-control" rows="2" placeholder="Comma-separated, e.g., Canteen, Pharmacy, Parking"></textarea>
                    </div>
                </div>

                <div class="profile-section" data-profile="daycare" style="display:none;">
                    <h4>Day Care / Home Health Fields</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Emergency Contact</label>
                            <input type="text" name="emergency_contact" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Service Areas</label>
                            <textarea name="service_areas" class="form-control" rows="2" placeholder="Comma-separated, e.g., Downtown, North Zone"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Home Services</label>
                        <textarea name="home_services" class="form-control" rows="2" placeholder="Comma-separated, e.g., Nursing, Physiotherapy, Diagnostics"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Service Packages</label>
                        <textarea name="service_packages" class="form-control" rows="2" placeholder="Comma-separated, e.g., 4-hour care, 24-hour care"></textarea>
                    </div>

                    <div class="form-row">
                        <label class="form-control" style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="equipment_rental" value="1">
                            Equipment Rental Available
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Service Address</label>
                        <textarea name="clinic_address" class="form-control" rows="2"></textarea>
                    </div>
                </div>

                <div class="form-card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('profileTypeSelect');
    const sections = document.querySelectorAll('.profile-section');

    function updateSections() {
        const value = select.value;
        sections.forEach(section => {
            section.style.display = section.dataset.profile === value ? 'block' : 'none';
        });
    }

    select.addEventListener('change', updateSections);
    updateSections();
});
</script>

@include('userdashboard-new.partials.content-page-styles')
@include('userdashboard-new.partials.form-page-styles')
@include('userdashboard-new.partials.table-page-styles')
@endsection

