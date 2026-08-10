@extends('layouts.redesign.dashboard')

@section('page-title', 'Create Property')
@section('breadcrumb', 'Create Property')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Add New Property</h1>
            <p>Create a new real estate listing</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('real-estate.properties.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ route('real-estate.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Information -->
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-info-circle"></i> Basic Information</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="profile_type">Profile Type <span class="required">*</span></label>
                        <select id="profile_type" name="profile_type" class="form-control @error('profile_type') is-invalid @enderror" required>
                            <option value="">Select Profile Type</option>
                            @foreach($activeProfiles ?? [] as $profile)
                                <option value="{{ $profile }}" {{ old('profile_type') == $profile ? 'selected' : '' }}>
                                    {{ ucfirst($profile) }}
                                </option>
                            @endforeach
                        </select>
                        @error('profile_type')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="property_type">Property Type <span class="required">*</span></label>
                        <select id="property_type" name="property_type" class="form-control @error('property_type') is-invalid @enderror" required>
                            <option value="">Select Property Type</option>
                            <option value="house" {{ old('property_type') == 'house' ? 'selected' : '' }}>House</option>
                            <option value="apartment" {{ old('property_type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="villa" {{ old('property_type') == 'villa' ? 'selected' : '' }}>Villa</option>
                            <option value="land" {{ old('property_type') == 'land' ? 'selected' : '' }}>Land</option>
                            <option value="office" {{ old('property_type') == 'office' ? 'selected' : '' }}>Office</option>
                            <option value="shop" {{ old('property_type') == 'shop' ? 'selected' : '' }}>Shop</option>
                            <option value="warehouse" {{ old('property_type') == 'warehouse' ? 'selected' : '' }}>Warehouse</option>
                        </select>
                        @error('property_type')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Property Title <span class="required">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="e.g., 3 BHK Apartment in Prime Location" required>
                    @error('title')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description <span class="required">*</span></label>
                    <textarea id="description" name="description" rows="5"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Describe the property, its features, and benefits..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Pricing & Details -->
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-rupee-sign"></i> Pricing & Details</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price (₹) <span class="required">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}"
                               class="form-control @error('price') is-invalid @enderror"
                               placeholder="0" min="0" step="1" required>
                        @error('price')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" id="rental_price_group" style="display: none;">
                        <label for="rental_price">Rental Price (₹/month)</label>
                        <input type="number" id="rental_price" name="rental_price" value="{{ old('rental_price') }}"
                               class="form-control @error('rental_price') is-invalid @enderror"
                               placeholder="0" min="0" step="1">
                        @error('rental_price')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="area">Area (sq ft) <span class="required">*</span></label>
                        <input type="number" id="area" name="area" value="{{ old('area') }}"
                               class="form-control @error('area') is-invalid @enderror"
                               placeholder="0" min="0" step="1" required>
                        @error('area')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" id="bedrooms_group">
                        <label for="bedrooms">Bedrooms</label>
                        <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms') }}"
                               class="form-control @error('bedrooms') is-invalid @enderror"
                               placeholder="0" min="0">
                        @error('bedrooms')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" id="bathrooms_group">
                        <label for="bathrooms">Bathrooms</label>
                        <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}"
                               class="form-control @error('bathrooms') is-invalid @enderror"
                               placeholder="0" min="0">
                        @error('bathrooms')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" id="parking_group">
                        <label for="parking">Parking Spaces</label>
                        <input type="number" id="parking" name="parking" value="{{ old('parking') }}"
                               class="form-control @error('parking') is-invalid @enderror"
                               placeholder="0" min="0">
                        @error('parking')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="status">Status <span class="required">*</span></label>
                        <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="ready" {{ old('status') == 'ready' ? 'selected' : '' }}>Ready to Move</option>
                            <option value="under_construction" {{ old('status') == 'under_construction' ? 'selected' : '' }}>Under Construction</option>
                            <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        </select>
                        @error('status')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="rera_number">RERA Number</label>
                        <input type="text" id="rera_number" name="rera_number" value="{{ old('rera_number') }}"
                               class="form-control @error('rera_number') is-invalid @enderror"
                               placeholder="Enter RERA registration number">
                        @error('rera_number')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-map-marker-alt"></i> Location</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="location">City/Area <span class="required">*</span></label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}"
                               class="form-control @error('location') is-invalid @enderror"
                               placeholder="e.g., Bangalore, Koramangala" required>
                        @error('location')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Property Contact Number</label>
                        <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number') }}"
                               class="form-control @error('contact_number') is-invalid @enderror"
                               placeholder="e.g., +91 98765 43210">
                        @error('contact_number')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Full Address <span class="required">*</span></label>
                    <textarea id="address" name="address" rows="3"
                              class="form-control @error('address') is-invalid @enderror"
                              placeholder="Enter complete address with landmarks" required>{{ old('address') }}</textarea>
                    @error('address')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-images"></i> Property Images</h3>
            </div>
            <div class="form-card-body">
                <div class="form-group">
                    <label for="images">Upload Images (Max 10) <span class="required">*</span></label>
                    <input type="file" id="images" name="images[]" multiple accept="image/*"
                           class="form-control @error('images') is-invalid @enderror" required>
                    @error('images')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    @error('images.*')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Upload up to 10 high-quality images of the property</small>
                </div>
                <div id="imagePreviewContainer" class="image-preview-grid"></div>
            </div>
        </div>

        <!-- Features -->
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-th-list"></i> Amenities & Features</h3>
            </div>
            <div class="form-card-body">
                <div class="features-grid">
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_pool" name="features[]" value="Swimming Pool" {{ in_array('Swimming Pool', old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_pool">
                            <i class="fas fa-swimming-pool"></i> Swimming Pool
                        </label>
                    </div>
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_gym" name="features[]" value="Gym" {{ in_array('Gym', old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_gym">
                            <i class="fas fa-dumbbell"></i> Gym
                        </label>
                    </div>
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_garden" name="features[]" value="Garden" {{ in_array('Garden', old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_garden">
                            <i class="fas fa-tree"></i> Garden
                        </label>
                    </div>
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_security" name="features[]" value="24x7 Security" {{ in_array('24x7 Security', old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_security">
                            <i class="fas fa-shield-alt"></i> 24x7 Security
                        </label>
                    </div>
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_parking" name="features[]" value="Covered Parking" {{ in_array('Covered Parking', old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_parking">
                            <i class="fas fa-parking"></i> Covered Parking
                        </label>
                    </div>
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_elevator" name="features[]" value="Elevator" {{ in_array('Elevator', old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_elevator">
                            <i class="fas fa-building"></i> Elevator
                        </label>
                    </div>
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_power" name="features[]" value="Power Backup" {{ in_array('Power Backup', old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_power">
                            <i class="fas fa-bolt"></i> Power Backup
                        </label>
                    </div>
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_clubhouse" name="features[]" value="Clubhouse" {{ in_array('Clubhouse', old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_clubhouse">
                            <i class="fas fa-home"></i> Clubhouse
                        </label>
                    </div>
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_playground" name="features[]" value="Children's Play Area" {{ in_array("Children's Play Area", old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_playground">
                            <i class="fas fa-child"></i> Children's Play Area
                        </label>
                    </div>
                    <div class="feature-checkbox-item">
                        <input type="checkbox" id="feature_water" name="features[]" value="Water Supply" {{ in_array('Water Supply', old('features', [])) ? 'checked' : '' }}>
                        <label for="feature_water">
                            <i class="fas fa-tint"></i> Water Supply
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rental Specific (if applicable) -->
        <div class="form-card fade-up" id="rental_specific_section" style="display: none;">
            <div class="form-card-header">
                <h3><i class="fas fa-home"></i> Rental Information</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="furnishing">Furnishing Status</label>
                        <select id="furnishing" name="furnishing" class="form-control @error('furnishing') is-invalid @enderror">
                            <option value="">Select Furnishing</option>
                            <option value="unfurnished" {{ old('furnishing') == 'unfurnished' ? 'selected' : '' }}>Unfurnished</option>
                            <option value="semi_furnished" {{ old('furnishing') == 'semi_furnished' ? 'selected' : '' }}>Semi-Furnished</option>
                            <option value="fully_furnished" {{ old('furnishing') == 'fully_furnished' ? 'selected' : '' }}>Fully Furnished</option>
                        </select>
                        @error('furnishing')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="available_from">Available From</label>
                        <input type="date" id="available_from" name="available_from" value="{{ old('available_from') }}"
                               class="form-control @error('available_from') is-invalid @enderror">
                        @error('available_from')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Options -->
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-cog"></i> Listing Options</h3>
            </div>
            <div class="form-card-body">
                <div class="form-checkboxes-row">
                    <div class="form-checkbox">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured">Mark as Featured</label>
                    </div>
                    <div class="form-checkbox">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active">Active (visible to clients)</label>
                    </div>
                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Create Property
                </button>
                <a href="{{ route('real-estate.properties.index') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>

<style>
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
}

.feature-checkbox-item {
    display: flex;
    align-items: center;
}

.feature-checkbox-item input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--purple-500);
    margin-right: 0.75rem;
}

.feature-checkbox-item label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    user-select: none;
    margin: 0;
    font-size: 0.9rem;
}

.feature-checkbox-item label i {
    color: var(--purple-500);
}

.form-checkboxes-row {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.form-checkbox {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.form-checkbox input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: var(--purple-500);
}

.form-checkbox label {
    margin: 0;
    cursor: pointer;
    user-select: none;
}

#imagePreviewContainer {
    display: none;
}

#imagePreviewContainer.has-images {
    display: grid;
}

@media (max-width: 768px) {
    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Handle profile type change to show/hide rental fields
document.addEventListener('DOMContentLoaded', function() {
    const profileTypeSelect = document.getElementById('profile_type');
    const rentalPriceGroup = document.getElementById('rental_price_group');
    const rentalSpecificSection = document.getElementById('rental_specific_section');
    const propertyTypeSelect = document.getElementById('property_type');
    const bedroomsGroup = document.getElementById('bedrooms_group');
    const bathroomsGroup = document.getElementById('bathrooms_group');
    const parkingGroup = document.getElementById('parking_group');

    const propertyTypeMap = {
        residential: [
            { value: 'house', label: 'House' },
            { value: 'apartment', label: 'Apartment' },
            { value: 'villa', label: 'Villa' },
        ],
        commercial: [
            { value: 'office', label: 'Office' },
            { value: 'shop', label: 'Shop' },
            { value: 'warehouse', label: 'Warehouse' },
        ],
        plot: [
            { value: 'land', label: 'Land' },
        ],
        rental: [
            { value: 'house', label: 'House' },
            { value: 'apartment', label: 'Apartment' },
            { value: 'villa', label: 'Villa' },
        ],
        builder: [
            { value: 'house', label: 'House' },
            { value: 'apartment', label: 'Apartment' },
            { value: 'villa', label: 'Villa' },
            { value: 'land', label: 'Land' },
        ],
    };

    function setPropertyTypeOptions(profileType) {
        const currentValue = propertyTypeSelect.value;
        const allowed = propertyTypeMap[profileType] || [];
        propertyTypeSelect.innerHTML = '<option value=\"\">Select Property Type</option>';
        allowed.forEach((option) => {
            const optionEl = document.createElement('option');
            optionEl.value = option.value;
            optionEl.textContent = option.label;
            if (option.value === currentValue) {
                optionEl.selected = true;
            }
            propertyTypeSelect.appendChild(optionEl);
        });
        if (!allowed.find((option) => option.value === currentValue)) {
            propertyTypeSelect.value = '';
        }
    }

    function togglePropertyFields() {
        const propertyType = propertyTypeSelect.value;
        const showRooms = ['house', 'apartment', 'villa'].includes(propertyType);
        const showParking = propertyType && propertyType !== 'land';
        bedroomsGroup.style.display = showRooms ? 'block' : 'none';
        bathroomsGroup.style.display = showRooms ? 'block' : 'none';
        parkingGroup.style.display = showParking ? 'block' : 'none';
    }

    function toggleRentalFields() {
        const isRental = profileTypeSelect.value === 'rental';
        rentalPriceGroup.style.display = isRental ? 'block' : 'none';
        rentalSpecificSection.style.display = isRental ? 'block' : 'none';
    }

    profileTypeSelect.addEventListener('change', () => {
        toggleRentalFields();
        setPropertyTypeOptions(profileTypeSelect.value);
        togglePropertyFields();
    });
    propertyTypeSelect.addEventListener('change', togglePropertyFields);
    toggleRentalFields();
    setPropertyTypeOptions(profileTypeSelect.value);
    togglePropertyFields();

    // Image preview
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('imagePreviewContainer');

    imageInput.addEventListener('change', function(e) {
        previewContainer.innerHTML = '';
        const files = Array.from(e.target.files).slice(0, 10); // Max 10 images

        if (files.length > 0) {
            previewContainer.classList.add('has-images');
            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('div');
                    preview.className = 'preview-item';
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}">
                    `;
                    previewContainer.appendChild(preview);
                }
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.classList.remove('has-images');
        }
    });
});
</script>
@include('userdashboard-new.partials.form-page-styles')
@endsection
