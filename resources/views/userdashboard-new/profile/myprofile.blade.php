@extends('layouts.redesign.dashboard')

@section('page-title', 'My Profile')
@section('breadcrumb', 'My Profile')

@section('dashboard-content')
<div class="profile-page">
    <div class="profile-header fade-up">
        <div class="profile-header-bg"></div>
        <div class="profile-header-content">
            <div class="profile-avatar-wrapper">
                <div class="profile-avatar">
                    @if($user->profile ?? null)
                        <img src="{{ asset('public/frontend/user_images/' . $user->profile) }}" alt="Profile" id="profilePreview">
                    @else
                        <img src="{{ asset('assets/images/avatars/default.png') }}" alt="Profile" id="profilePreview">
                    @endif
                </div>
                <label for="profileImage" class="profile-avatar-edit">
                    <i class="fas fa-camera"></i>
                </label>
            </div>
            <div class="profile-header-info">
                <h1>{{ $user->name ?? session('FRONT_USER_NAME', 'User') }}</h1>
                <p>{{ $user->email ?? session('FRONT_USER_EMAIL', '') }}</p>
                @if($user->desig ?? null)
                    <span class="profile-badge">{{ $user->desig }}</span>
                @endif
            </div>
            <div class="profile-header-actions">
                <a href="{{ url('/qrcode') }}" class="btn btn-outline">
                    <i class="fas fa-qrcode"></i> View QR Code
                </a>
                <a href="{{ url('/'.$user->slug) }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-external-link-alt"></i> View Public Profile
                </a>
            </div>
        </div>
    </div>

    <form action="{{ url('/updateuserprofile_store') }}" method="POST" enctype="multipart/form-data" class="profile-form">
        @csrf
        <input type="file" name="profile" id="profileImage" hidden accept="image/*" onchange="previewImage(this)">
        <input type="file" name="banner" id="bannerImage" hidden accept="image/*" onchange="previewBanner(this)">

        <div class="form-grid">
            {{-- Cover Image --}}
            <div class="form-section fade-up">
                <div class="form-section-header">
                    <h3><i class="fas fa-image"></i> Cover Image</h3>
                </div>
                <div class="form-section-body">
                    <div class="banner-preview">
                        @if($user->banner ?? null)
                            <img src="{{ asset('public/frontend/user_images/' . $user->banner) }}" alt="Cover Image" id="bannerPreview">
                        @else
                            <img src="{{ asset('public/frontend/user_images/placeholder.png') }}" alt="Cover Image" id="bannerPreview">
                        @endif
                    </div>
                    <label for="bannerImage" class="btn btn-outline">
                        <i class="fas fa-upload"></i> Upload Cover Image
                    </label>
                    <span class="form-hint">Recommended size: 1200x400 (max 1 MB)</span>
                </div>
            </div>

            {{-- Personal Information --}}
            <div class="form-section fade-up">
                <div class="form-section-header">
                    <h3><i class="fas fa-user"></i> Personal Information</h3>
                </div>
                <div class="form-section-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required class="form-control">
                            @error('name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="form-control">
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="mobile">Mobile Number</label>
                            <input type="tel" id="mobile" name="mobile" value="{{ old('mobile', $user->mobile ?? '') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="{{ old('dob', $user->dob ?? '') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="designation">Designation / Title</label>
                            <input type="text" id="designation" name="designation" value="{{ old('designation', $user->desig ?? '') }}" class="form-control" placeholder="e.g., CEO, Designer, Developer">
                        </div>
                        <div class="form-group">
                            <label for="company">Company / Organization</label>
                            <input type="text" id="company" name="company" value="{{ old('company', $user->company ?? '') }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bio & About --}}
            <div class="form-section fade-up">
                <div class="form-section-header">
                    <h3><i class="fas fa-info-circle"></i> Bio & About</h3>
                </div>
                <div class="form-section-body">
                    <div class="form-group">
                        <label for="bio">Short Bio</label>
                        <textarea id="bio" name="bio" rows="3" class="form-control" placeholder="A brief description about yourself...">{{ old('bio', $user->bio ?? $user->title2 ?? '') }}</textarea>
                        <span class="form-hint">This will appear on your public profile (max 250 characters)</span>
                    </div>

                    <div class="form-group">
                        <label for="about">About Me</label>
                        <textarea id="about" name="about" rows="5" class="form-control" placeholder="Tell visitors more about yourself, your experience, and what you do...">{{ old('about', $user->about ?? $user->title1 ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Contact Information --}}
            <div class="form-section fade-up">
                <div class="form-section-header">
                    <h3><i class="fas fa-address-card"></i> Contact Information</h3>
                </div>
                <div class="form-section-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="whatsapp">WhatsApp Number</label>
                            <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp ?? '') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="2" class="form-control" placeholder="Your business or personal address">{{ old('address', $user->address ?? '') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $user->city ?? '') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" value="{{ old('state', $user->state ?? '') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" value="{{ old('country', $user->country ?? 'India') }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Website & Links --}}
            <div class="form-section fade-up">
                <div class="form-section-header">
                    <h3><i class="fas fa-globe"></i> Website & Links</h3>
                </div>
                <div class="form-section-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="website">Website URL</label>
                            <input type="url" id="website" name="website" value="{{ old('website', $user->website ?? '') }}" class="form-control" placeholder="https://yourwebsite.com">
                        </div>
                        <div class="form-group">
                            <label for="customer_url">Profile URL Slug</label>
                            <div class="input-group">
                                <span class="input-prefix">{{ url('/') }}/</span>
                                <input type="text" id="customer_url" name="customer_url" value="{{ old('customer_url', $user->slug ?? '') }}" class="form-control">
                            </div>
                            <span class="form-hint">This will be your public profile link</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profession-Specific Fields --}}
            @php
                $professionType = $user->profession_type ?? null;
                $professionData = $user->profession_data ?? [];
                if (is_string($professionData)) {
                    $professionData = json_decode($professionData, true) ?? [];
                }
            @endphp

            @if($professionType)
            <div class="form-section fade-up profession-fields-section" id="professionFieldsSection">
                <div class="form-section-header">
                    <h3><i class="fas fa-user-tie"></i> Professional Details</h3>
                    <span class="theme-badge">
                        @switch($professionType)
                            @case(1) Medical Professional @break
                            @case(2) Creative Showcase @break
                            @case(3) Service Provider @break
                            @case(4) Manufacturing @break
                            @case(5) Product Retailer @break
                            @case(6) Real Estate @break
                            @case(7) Actors & Models @break
                            @case(8) Production House @break
                            @case(9) Multi-Service @break
                            @case(10) Jewellery & Luxury @break
                            @case(11) IT & Technology @break
                            @case(12) Product Company @break
                            @case(13) Restaurant/Hotel @break
                            @default Other
                        @endswitch
                    </span>
                </div>
                <div class="form-section-body">
                    @switch($professionType)
                        {{-- Medical Professional (ID 1) --}}
                        @case(1)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="specialization">Specialization <span class="required">*</span></label>
                                    <input type="text" id="specialization" name="profession_data[specialization]" value="{{ $professionData['specialization'] ?? '' }}" class="form-control" placeholder="e.g., Cardiology, Pediatrics">
                                </div>
                                <div class="form-group">
                                    <label for="registration_number">Registration Number <span class="required">*</span></label>
                                    <input type="text" id="registration_number" name="profession_data[registration_number]" value="{{ $professionData['registration_number'] ?? '' }}" class="form-control" placeholder="Medical license number">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="clinic_name">Clinic / Hospital Name</label>
                                    <input type="text" id="clinic_name" name="profession_data[clinic_name]" value="{{ $professionData['clinic_name'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="experience_years">Experience (Years)</label>
                                    <input type="number" id="experience_years" name="profession_data[experience_years]" value="{{ $professionData['experience_years'] ?? '' }}" class="form-control" min="0">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="consultation_fee">Consultation Fee</label>
                                    <input type="text" id="consultation_fee" name="profession_data[consultation_fee]" value="{{ $professionData['consultation_fee'] ?? '' }}" class="form-control" placeholder="e.g., ₹500">
                                </div>
                                <div class="form-group">
                                    <label for="consultation_timings">Consultation Timings</label>
                                    <input type="text" id="consultation_timings" name="profession_data[consultation_timings]" value="{{ $professionData['consultation_timings'] ?? '' }}" class="form-control" placeholder="e.g., Mon-Fri 9AM-5PM">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="qualifications">Qualifications</label>
                                <textarea id="qualifications" name="profession_data[qualifications]" rows="2" class="form-control" placeholder="MBBS, MD, etc.">{{ $professionData['qualifications'] ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="hospital_affiliations">Hospital Affiliations</label>
                                <input type="text" id="hospital_affiliations" name="profession_data[hospital_affiliations]" value="{{ $professionData['hospital_affiliations'] ?? '' }}" class="form-control" placeholder="Comma separated list">
                            </div>
                            @break

                        {{-- Creative Showcase (ID 2) --}}
                        @case(2)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="photography_type">Photography/Creative Type <span class="required">*</span></label>
                                    <input type="text" id="photography_type" name="profession_data[photography_type]" value="{{ $professionData['photography_type'] ?? '' }}" class="form-control" placeholder="e.g., Wedding, Fashion, Landscape">
                                </div>
                                <div class="form-group">
                                    <label for="experience_years">Experience (Years)</label>
                                    <input type="number" id="experience_years" name="profession_data[experience_years]" value="{{ $professionData['experience_years'] ?? '' }}" class="form-control" min="0">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="equipment_list">Equipment Used</label>
                                    <input type="text" id="equipment_list" name="profession_data[equipment_list]" value="{{ $professionData['equipment_list'] ?? '' }}" class="form-control" placeholder="e.g., Canon EOS R5, DJI Mavic">
                                </div>
                                <div class="form-group">
                                    <label for="booking_link">Booking Link</label>
                                    <input type="url" id="booking_link" name="profession_data[booking_link]" value="{{ $professionData['booking_link'] ?? '' }}" class="form-control" placeholder="https://...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pricing_packages">Pricing Packages</label>
                                <textarea id="pricing_packages" name="profession_data[pricing_packages]" rows="2" class="form-control" placeholder="Describe your packages">{{ $professionData['pricing_packages'] ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="awards">Awards & Recognition</label>
                                <input type="text" id="awards" name="profession_data[awards]" value="{{ $professionData['awards'] ?? '' }}" class="form-control">
                            </div>
                            @break

                        {{-- Service Provider (ID 3) --}}
                        @case(3)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="services">Services Offered <span class="required">*</span></label>
                                    <input type="text" id="services" name="profession_data[services]" value="{{ $professionData['services'] ?? '' }}" class="form-control" placeholder="e.g., Plumbing, Electrical, AC Repair">
                                </div>
                                <div class="form-group">
                                    <label for="service_areas">Service Areas <span class="required">*</span></label>
                                    <input type="text" id="service_areas" name="profession_data[service_areas]" value="{{ $professionData['service_areas'] ?? '' }}" class="form-control" placeholder="Areas you serve">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="availability">Availability <span class="required">*</span></label>
                                    <input type="text" id="availability" name="profession_data[availability]" value="{{ $professionData['availability'] ?? '' }}" class="form-control" placeholder="e.g., 24/7, Mon-Sat 8AM-8PM">
                                </div>
                                <div class="form-group">
                                    <label for="team_size">Team Size</label>
                                    <input type="number" id="team_size" name="profession_data[team_size]" value="{{ $professionData['team_size'] ?? '' }}" class="form-control" min="1">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="pricing">Pricing Info</label>
                                    <input type="text" id="pricing" name="profession_data[pricing]" value="{{ $professionData['pricing'] ?? '' }}" class="form-control" placeholder="Starting rates">
                                </div>
                                <div class="form-group">
                                    <label for="emergency_service">Emergency Service</label>
                                    <select id="emergency_service" name="profession_data[emergency_service]" class="form-control">
                                        <option value="">Select</option>
                                        <option value="yes" {{ ($professionData['emergency_service'] ?? '') == 'yes' ? 'selected' : '' }}>Available</option>
                                        <option value="no" {{ ($professionData['emergency_service'] ?? '') == 'no' ? 'selected' : '' }}>Not Available</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="certifications">Certifications</label>
                                <input type="text" id="certifications" name="profession_data[certifications]" value="{{ $professionData['certifications'] ?? '' }}" class="form-control">
                            </div>
                            @break

                        {{-- Manufacturing Company (ID 4) --}}
                        @case(4)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="products">Products <span class="required">*</span></label>
                                    <input type="text" id="products" name="profession_data[products]" value="{{ $professionData['products'] ?? '' }}" class="form-control" placeholder="Products manufactured">
                                </div>
                                <div class="form-group">
                                    <label for="production_capacity">Production Capacity</label>
                                    <input type="text" id="production_capacity" name="profession_data[production_capacity]" value="{{ $professionData['production_capacity'] ?? '' }}" class="form-control" placeholder="e.g., 10,000 units/month">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="certifications">Certifications <span class="required">*</span></label>
                                    <input type="text" id="certifications" name="profession_data[certifications]" value="{{ $professionData['certifications'] ?? '' }}" class="form-control" placeholder="ISO, BIS, etc.">
                                </div>
                                <div class="form-group">
                                    <label for="minimum_order">Minimum Order Quantity</label>
                                    <input type="text" id="minimum_order" name="profession_data[minimum_order]" value="{{ $professionData['minimum_order'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="export_countries">Export Countries</label>
                                    <input type="text" id="export_countries" name="profession_data[export_countries]" value="{{ $professionData['export_countries'] ?? '' }}" class="form-control" placeholder="Countries you export to">
                                </div>
                                <div class="form-group">
                                    <label for="quality_standards">Quality Standards</label>
                                    <input type="text" id="quality_standards" name="profession_data[quality_standards]" value="{{ $professionData['quality_standards'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            @break

                        {{-- Product Retailer (ID 5) --}}
                        @case(5)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="product_categories">Product Categories <span class="required">*</span></label>
                                    <input type="text" id="product_categories" name="profession_data[product_categories]" value="{{ $professionData['product_categories'] ?? '' }}" class="form-control" placeholder="e.g., Electronics, Clothing">
                                </div>
                                <div class="form-group">
                                    <label for="store_location">Store Location <span class="required">*</span></label>
                                    <input type="text" id="store_location" name="profession_data[store_location]" value="{{ $professionData['store_location'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="store_timings">Store Timings <span class="required">*</span></label>
                                    <input type="text" id="store_timings" name="profession_data[store_timings]" value="{{ $professionData['store_timings'] ?? '' }}" class="form-control" placeholder="e.g., 10 AM - 9 PM">
                                </div>
                                <div class="form-group">
                                    <label for="delivery_options">Delivery Options</label>
                                    <input type="text" id="delivery_options" name="profession_data[delivery_options]" value="{{ $professionData['delivery_options'] ?? '' }}" class="form-control" placeholder="e.g., Home delivery, Pickup">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="offers_discounts">Current Offers</label>
                                <input type="text" id="offers_discounts" name="profession_data[offers_discounts]" value="{{ $professionData['offers_discounts'] ?? '' }}" class="form-control" placeholder="Any ongoing offers">
                            </div>
                            <div class="form-group">
                                <label for="payment_methods">Payment Methods</label>
                                <input type="text" id="payment_methods" name="profession_data[payment_methods]" value="{{ $professionData['payment_methods'] ?? '' }}" class="form-control" placeholder="Cash, Card, UPI, etc.">
                            </div>
                            @break

                        {{-- Real Estate Pro (ID 6) --}}
                        @case(6)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="rera_number">RERA Number <span class="required">*</span></label>
                                    <input type="text" id="rera_number" name="profession_data[rera_number]" value="{{ $professionData['rera_number'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="specialization">Specialization <span class="required">*</span></label>
                                    <input type="text" id="specialization" name="profession_data[specialization]" value="{{ $professionData['specialization'] ?? '' }}" class="form-control" placeholder="Residential, Commercial, etc.">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="areas_covered">Areas Covered <span class="required">*</span></label>
                                    <input type="text" id="areas_covered" name="profession_data[areas_covered]" value="{{ $professionData['areas_covered'] ?? '' }}" class="form-control" placeholder="Localities/cities you serve">
                                </div>
                                <div class="form-group">
                                    <label for="sold_properties">Properties Sold</label>
                                    <input type="number" id="sold_properties" name="profession_data[sold_properties]" value="{{ $professionData['sold_properties'] ?? '' }}" class="form-control" min="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="virtual_tour_links">Virtual Tour Links</label>
                                <input type="text" id="virtual_tour_links" name="profession_data[virtual_tour_links]" value="{{ $professionData['virtual_tour_links'] ?? '' }}" class="form-control" placeholder="Links to property tours">
                            </div>
                            @break

                        {{-- Actors & Models (ID 7) --}}
                        @case(7)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="skills">Skills <span class="required">*</span></label>
                                    <input type="text" id="skills" name="profession_data[skills]" value="{{ $professionData['skills'] ?? '' }}" class="form-control" placeholder="Acting, Dancing, Modeling, etc.">
                                </div>
                                <div class="form-group">
                                    <label for="showreel_link">Showreel/Portfolio Link</label>
                                    <input type="url" id="showreel_link" name="profession_data[showreel_link]" value="{{ $professionData['showreel_link'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="physical_stats">Physical Stats</label>
                                    <input type="text" id="physical_stats" name="profession_data[physical_stats]" value="{{ $professionData['physical_stats'] ?? '' }}" class="form-control" placeholder="Height, Weight, Eye color, etc.">
                                </div>
                                <div class="form-group">
                                    <label for="agency_info">Agency Information</label>
                                    <input type="text" id="agency_info" name="profession_data[agency_info]" value="{{ $professionData['agency_info'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="filmography">Filmography / Work History</label>
                                <textarea id="filmography" name="profession_data[filmography]" rows="2" class="form-control" placeholder="List your previous work">{{ $professionData['filmography'] ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="awards">Awards & Recognition</label>
                                <input type="text" id="awards" name="profession_data[awards]" value="{{ $professionData['awards'] ?? '' }}" class="form-control">
                            </div>
                            @break

                        {{-- Production House (ID 8) --}}
                        @case(8)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="services">Services <span class="required">*</span></label>
                                    <input type="text" id="services" name="profession_data[services]" value="{{ $professionData['services'] ?? '' }}" class="form-control" placeholder="Film production, Video, Ads, etc.">
                                </div>
                                <div class="form-group">
                                    <label for="showreel">Showreel Link <span class="required">*</span></label>
                                    <input type="url" id="showreel" name="profession_data[showreel]" value="{{ $professionData['showreel'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="team">Team Size</label>
                                    <input type="text" id="team" name="profession_data[team]" value="{{ $professionData['team'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="equipment_list">Equipment</label>
                                    <input type="text" id="equipment_list" name="profession_data[equipment_list]" value="{{ $professionData['equipment_list'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="projects">Notable Projects</label>
                                <textarea id="projects" name="profession_data[projects]" rows="2" class="form-control" placeholder="List your major projects">{{ $professionData['projects'] ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="clients">Clients</label>
                                <input type="text" id="clients" name="profession_data[clients]" value="{{ $professionData['clients'] ?? '' }}" class="form-control" placeholder="Notable clients">
                            </div>
                            @break

                        {{-- Multi-Service Provider (ID 9) --}}
                        @case(9)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="service_categories">Service Categories <span class="required">*</span></label>
                                    <input type="text" id="service_categories" name="profession_data[service_categories]" value="{{ $professionData['service_categories'] ?? '' }}" class="form-control" placeholder="List all service categories">
                                </div>
                                <div class="form-group">
                                    <label for="locations">Locations <span class="required">*</span></label>
                                    <input type="text" id="locations" name="profession_data[locations]" value="{{ $professionData['locations'] ?? '' }}" class="form-control" placeholder="Areas you operate in">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="team_size">Team Size</label>
                                    <input type="number" id="team_size" name="profession_data[team_size]" value="{{ $professionData['team_size'] ?? '' }}" class="form-control" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="years_in_business">Years in Business</label>
                                    <input type="number" id="years_in_business" name="profession_data[years_in_business]" value="{{ $professionData['years_in_business'] ?? '' }}" class="form-control" min="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="packages">Service Packages</label>
                                <textarea id="packages" name="profession_data[packages]" rows="2" class="form-control" placeholder="Describe your packages">{{ $professionData['packages'] ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="key_clients">Key Clients</label>
                                <input type="text" id="key_clients" name="profession_data[key_clients]" value="{{ $professionData['key_clients'] ?? '' }}" class="form-control">
                            </div>
                            @break

                        {{-- Jewellery & Luxury (ID 10) --}}
                        @case(10)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="collections">Collections <span class="required">*</span></label>
                                    <input type="text" id="collections" name="profession_data[collections]" value="{{ $professionData['collections'] ?? '' }}" class="form-control" placeholder="Gold, Diamond, Silver, etc.">
                                </div>
                                <div class="form-group">
                                    <label for="store_location">Store Location <span class="required">*</span></label>
                                    <input type="text" id="store_location" name="profession_data[store_location]" value="{{ $professionData['store_location'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="price_range">Price Range <span class="required">*</span></label>
                                    <input type="text" id="price_range" name="profession_data[price_range]" value="{{ $professionData['price_range'] ?? '' }}" class="form-control" placeholder="e.g., ₹5,000 - ₹50,00,000">
                                </div>
                                <div class="form-group">
                                    <label for="custom_design_service">Custom Design Service</label>
                                    <select id="custom_design_service" name="profession_data[custom_design_service]" class="form-control">
                                        <option value="">Select</option>
                                        <option value="yes" {{ ($professionData['custom_design_service'] ?? '') == 'yes' ? 'selected' : '' }}>Available</option>
                                        <option value="no" {{ ($professionData['custom_design_service'] ?? '') == 'no' ? 'selected' : '' }}>Not Available</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="certifications">Certifications (BIS, Hallmark)</label>
                                    <input type="text" id="certifications" name="profession_data[certifications]" value="{{ $professionData['certifications'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="appointment_booking">Appointment Booking Link</label>
                                    <input type="url" id="appointment_booking" name="profession_data[appointment_booking]" value="{{ $professionData['appointment_booking'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            @break

                        {{-- IT & Technology (ID 11) --}}
                        @case(11)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="services">Services <span class="required">*</span></label>
                                    <input type="text" id="services" name="profession_data[services]" value="{{ $professionData['services'] ?? '' }}" class="form-control" placeholder="Web Dev, Mobile Apps, Cloud, etc.">
                                </div>
                                <div class="form-group">
                                    <label for="tech_stack">Tech Stack <span class="required">*</span></label>
                                    <input type="text" id="tech_stack" name="profession_data[tech_stack]" value="{{ $professionData['tech_stack'] ?? '' }}" class="form-control" placeholder="React, Node.js, Python, etc.">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="team">Team Size</label>
                                    <input type="text" id="team" name="profession_data[team]" value="{{ $professionData['team'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="github_link">GitHub / Portfolio</label>
                                    <input type="url" id="github_link" name="profession_data[github_link]" value="{{ $professionData['github_link'] ?? '' }}" class="form-control" placeholder="https://github.com/...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="case_studies">Case Studies / Projects</label>
                                <textarea id="case_studies" name="profession_data[case_studies]" rows="2" class="form-control" placeholder="Notable projects">{{ $professionData['case_studies'] ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="client_logos">Key Clients</label>
                                <input type="text" id="client_logos" name="profession_data[client_logos]" value="{{ $professionData['client_logos'] ?? '' }}" class="form-control">
                            </div>
                            @break

                        {{-- Product Company (ID 12) --}}
                        @case(12)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="products">Products <span class="required">*</span></label>
                                    <input type="text" id="products" name="profession_data[products]" value="{{ $professionData['products'] ?? '' }}" class="form-control" placeholder="Your product offerings">
                                </div>
                                <div class="form-group">
                                    <label for="categories">Categories <span class="required">*</span></label>
                                    <input type="text" id="categories" name="profession_data[categories]" value="{{ $professionData['categories'] ?? '' }}" class="form-control" placeholder="Product categories">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="featured_product">Featured Product</label>
                                    <input type="text" id="featured_product" name="profession_data[featured_product]" value="{{ $professionData['featured_product'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="demo_link">Demo / Trial Link</label>
                                    <input type="url" id="demo_link" name="profession_data[demo_link]" value="{{ $professionData['demo_link'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pricing_tiers">Pricing Tiers</label>
                                <textarea id="pricing_tiers" name="profession_data[pricing_tiers]" rows="2" class="form-control" placeholder="Describe pricing options">{{ $professionData['pricing_tiers'] ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="documentation_link">Documentation Link</label>
                                <input type="url" id="documentation_link" name="profession_data[documentation_link]" value="{{ $professionData['documentation_link'] ?? '' }}" class="form-control">
                            </div>
                            @break

                        {{-- Restaurant/Hotel (ID 13) --}}
                        @case(13)
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="restaurant_name">Restaurant/Hotel Name <span class="required">*</span></label>
                                    <input type="text" id="restaurant_name" name="profession_data[restaurant_name]" value="{{ $professionData['restaurant_name'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="cuisine_type">Cuisine Type <span class="required">*</span></label>
                                    <input type="text" id="cuisine_type" name="profession_data[cuisine_type]" value="{{ $professionData['cuisine_type'] ?? '' }}" class="form-control" placeholder="Indian, Chinese, Continental, etc.">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="operating_hours">Operating Hours <span class="required">*</span></label>
                                    <input type="text" id="operating_hours" name="profession_data[operating_hours]" value="{{ $professionData['operating_hours'] ?? '' }}" class="form-control" placeholder="e.g., 11 AM - 11 PM">
                                </div>
                                <div class="form-group">
                                    <label for="seating_capacity">Seating Capacity</label>
                                    <input type="number" id="seating_capacity" name="profession_data[seating_capacity]" value="{{ $professionData['seating_capacity'] ?? '' }}" class="form-control" min="0">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="reservation_link">Reservation Link</label>
                                    <input type="url" id="reservation_link" name="profession_data[reservation_link]" value="{{ $professionData['reservation_link'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="delivery_partners">Delivery Partners</label>
                                    <input type="text" id="delivery_partners" name="profession_data[delivery_partners]" value="{{ $professionData['delivery_partners'] ?? '' }}" class="form-control" placeholder="Zomato, Swiggy, etc.">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="special_offers">Special Offers</label>
                                <input type="text" id="special_offers" name="profession_data[special_offers]" value="{{ $professionData['special_offers'] ?? '' }}" class="form-control" placeholder="Current promotions">
                            </div>
                            <div class="form-group">
                                <a href="{{ url('/menu-management') }}" class="btn btn-outline">
                                    <i class="fas fa-book-open"></i> Manage Menu
                                </a>
                            </div>
                            @break

                        {{-- Default / Unknown --}}
                        @default
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="business_type">Business Type</label>
                                    <input type="text" id="business_type" name="profession_data[business_type]" value="{{ $professionData['business_type'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="gst_number">GST Number</label>
                                    <input type="text" id="gst_number" name="profession_data[gst_number]" value="{{ $professionData['gst_number'] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="established_year">Established Year</label>
                                    <input type="number" id="established_year" name="profession_data[established_year]" value="{{ $professionData['established_year'] ?? '' }}" class="form-control" min="1900" max="{{ date('Y') }}">
                                </div>
                                <div class="form-group">
                                    <label for="business_hours">Business Hours</label>
                                    <input type="text" id="business_hours" name="profession_data[business_hours]" value="{{ $professionData['business_hours'] ?? '' }}" class="form-control" placeholder="e.g., Mon-Sat 9AM-6PM">
                                </div>
                            </div>
                    @endswitch
                </div>
            </div>
            @else
            <div class="form-section fade-up profession-notice">
                <div class="form-section-body" style="text-align: center; padding: var(--space-xl);">
                    <i class="fas fa-palette" style="font-size: 2rem; color: var(--purple-400); margin-bottom: var(--space-md);"></i>
                    <h4 style="margin-bottom: var(--space-sm);">Select a Profile Theme</h4>
                    <p style="color: var(--text-muted); margin-bottom: var(--space-lg);">Choose a profession theme to unlock additional professional fields for your profile.</p>
                            <div class="col-md-12 text-center mt-4">
                                {{-- <a href="{{ url('/profile-theme') }}" class="btn btn-primary">
                                    <i class="fas fa-palette"></i> Customize Profile Theme
                                </a> --}}
                            </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Form Actions --}}
        <div class="form-actions fade-up">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="{{ url('/userdashboard') }}" class="btn btn-outline btn-lg">
                Cancel
            </a>
        </div>
    </form>
</div>

<style>
.profile-page {
    padding: var(--space-lg);
}

/* Profile Header */
.profile-header {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    margin-bottom: var(--space-xl);
}

.profile-header-bg {
    height: 120px;
    background: var(--gradient-purple);
}

.profile-header-content {
    display: flex;
    align-items: flex-end;
    gap: var(--space-xl);
    padding: 0 var(--space-xl) var(--space-xl);
    margin-top: -50px;
    position: relative;
}

.profile-avatar-wrapper {
    position: relative;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: var(--radius-full);
    overflow: hidden;
    border: 4px solid var(--bg-primary);
    box-shadow: var(--shadow-lg);
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.banner-preview {
    width: 100%;
    height: 180px;
    border-radius: var(--radius-xl);
    overflow: hidden;
    border: 1px solid var(--border-light);
    background: var(--bg-secondary);
    margin-bottom: var(--space-md);
}

.banner-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-avatar-edit {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 36px;
    height: 36px;
    background: var(--gradient-purple);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.profile-avatar-edit:hover {
    transform: scale(1.1);
}

.profile-header-info {
    flex: 1;
    padding-bottom: var(--space-sm);
}

.profile-header-info h1 {
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    margin-bottom: var(--space-xs);
}

.profile-header-info p {
    color: var(--text-secondary);
    margin-bottom: var(--space-sm);
}

.profile-badge {
    display: inline-block;
    background: var(--purple-100);
    color: var(--purple-600);
    padding: 4px 12px;
    border-radius: var(--radius-full);
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
}

.profile-header-actions {
    display: flex;
    gap: var(--space-md);
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-lg);
}

/* Form Section */
.form-section {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.form-section-header {
    padding: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

.form-section-header h3 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.form-section-header h3 i {
    color: var(--purple-500);
}

.form-section-body {
    padding: var(--space-lg);
}

/* Form Elements */
.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--space-md);
    margin-bottom: var(--space-md);
}

.form-row:last-child {
    margin-bottom: 0;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: var(--space-xs);
    margin-bottom: var(--space-md);
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-group label {
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
    color: var(--text-primary);
}

.form-group label .required {
    color: var(--red-500);
}

.form-control {
    padding: var(--space-sm) var(--space-md);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: var(--text-base);
    transition: all var(--transition-fast);
}

.form-control:focus {
    outline: none;
    border-color: var(--purple-500);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
}

textarea.form-control {
    resize: vertical;
    min-height: 80px;
}

.form-hint {
    font-size: var(--text-xs);
    color: var(--text-muted);
}

.form-error {
    font-size: var(--text-xs);
    color: var(--red-500);
}

/* Input Group */
.input-group {
    display: flex;
    align-items: stretch;
}

.input-prefix {
    display: flex;
    align-items: center;
    padding: 0 var(--space-md);
    background: var(--bg-tertiary);
    border: 1px solid var(--border-light);
    border-right: none;
    border-radius: var(--radius-lg) 0 0 var(--radius-lg);
    font-size: var(--text-sm);
    color: var(--text-muted);
    white-space: nowrap;
}

.input-group .form-control {
    border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
}

/* Profession Fields Styles */
.profession-fields-section .form-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.theme-badge {
    display: inline-block;
    background: var(--purple-100);
    color: var(--purple-600);
    padding: 4px 12px;
    border-radius: var(--radius-full);
    font-size: var(--text-xs);
    font-weight: var(--font-medium);
}

.checkbox-group {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-md);
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: var(--space-xs);
    cursor: pointer;
    font-size: var(--text-sm);
}

.checkbox-label input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: var(--purple-500);
}

.profession-notice {
    grid-column: span 2;
}

.required {
    color: var(--red-500);
    margin-left: 2px;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: var(--space-md);
    justify-content: flex-start;
    margin-top: var(--space-xl);
    padding: var(--space-lg);
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
}

/* Responsive */
@media (max-width: 992px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .profile-header-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-header-actions {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .profile-header-actions {
        flex-direction: column;
        width: 100%;
    }

    .profile-header-actions .btn {
        width: 100%;
        justify-content: center;
    }

    .form-actions {
        flex-direction: column;
    }

    .form-actions .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewBanner(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('bannerPreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
