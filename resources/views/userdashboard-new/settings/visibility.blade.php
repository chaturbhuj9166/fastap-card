@extends('layouts.redesign.dashboard')

@section('page-title', 'Profile Visibility Settings')
@section('breadcrumb', 'Visibility Settings')

@section('dashboard-content')
<div class="form-page settings-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Profile Visibility Settings</h1>
            <p>Control which sections are visible on your public profile</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-container-wide">
        <form action="{{ route('profile.visibility.update') }}" method="POST" id="visibilityForm">
            @csrf

            <!-- Core Profile Features -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-user-circle"></i> Core Profile Features</h3>
                    <div class="header-actions">
                        <label class="toggle-all">
                            <input type="checkbox" class="section-toggle" data-section="core" checked>
                            <span>Toggle All</span>
                        </label>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="visibility-grid">
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-camera"></i>
                                <div>
                                    <strong>Profile Photo</strong>
                                    <small>Your profile picture</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[profile_photo]" class="core-feature"
                                       {{ ($visibility_settings['profile_photo'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-image"></i>
                                <div>
                                    <strong>Cover Image</strong>
                                    <small>Background header image</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[cover_image]" class="core-feature"
                                       {{ ($visibility_settings['cover_image'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-id-card"></i>
                                <div>
                                    <strong>Name</strong>
                                    <small>Your full name</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[name]" class="core-feature"
                                       {{ ($visibility_settings['name'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-briefcase"></i>
                                <div>
                                    <strong>Designation</strong>
                                    <small>Your job title or role</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[designation]" class="core-feature"
                                       {{ ($visibility_settings['designation'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-align-left"></i>
                                <div>
                                    <strong>Bio/About</strong>
                                    <small>Your description</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[bio]" class="core-feature"
                                       {{ ($visibility_settings['bio'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <strong>Contact Number</strong>
                                    <small>Your phone number</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[contact_number]" class="core-feature"
                                       {{ ($visibility_settings['contact_number'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <strong>Email Address</strong>
                                    <small>Your email contact</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[email]" class="core-feature"
                                       {{ ($visibility_settings['email'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <strong>Address</strong>
                                    <small>Your physical location</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[address]" class="core-feature"
                                       {{ ($visibility_settings['address'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-download"></i>
                                <div>
                                    <strong>Save Contact Button</strong>
                                    <small>Allow visitors to save contact</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[save_contact_button]" class="core-feature"
                                       {{ ($visibility_settings['save_contact_button'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-share-alt"></i>
                                <div>
                                    <strong>Share Profile Button</strong>
                                    <small>Allow profile sharing</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[share_profile_button]" class="core-feature"
                                       {{ ($visibility_settings['share_profile_button'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social & Media -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-hashtag"></i> Social & Media</h3>
                    <div class="header-actions">
                        <label class="toggle-all">
                            <input type="checkbox" class="section-toggle" data-section="social" checked>
                            <span>Toggle All</span>
                        </label>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="visibility-grid">
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fab fa-facebook"></i>
                                <div>
                                    <strong>Facebook</strong>
                                    <small>Facebook profile link</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[facebook]" class="social-feature"
                                       {{ ($visibility_settings['facebook'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fab fa-instagram"></i>
                                <div>
                                    <strong>Instagram</strong>
                                    <small>Instagram profile link</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[instagram]" class="social-feature"
                                       {{ ($visibility_settings['instagram'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fab fa-linkedin"></i>
                                <div>
                                    <strong>LinkedIn</strong>
                                    <small>LinkedIn profile link</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[linkedin]" class="social-feature"
                                       {{ ($visibility_settings['linkedin'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fab fa-twitter"></i>
                                <div>
                                    <strong>Twitter</strong>
                                    <small>Twitter profile link</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[twitter]" class="social-feature"
                                       {{ ($visibility_settings['twitter'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fab fa-youtube"></i>
                                <div>
                                    <strong>YouTube</strong>
                                    <small>YouTube channel link</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[youtube]" class="social-feature"
                                       {{ ($visibility_settings['youtube'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fab fa-whatsapp"></i>
                                <div>
                                    <strong>WhatsApp Chat</strong>
                                    <small>WhatsApp contact button</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[whatsapp_chat]" class="social-feature"
                                       {{ ($visibility_settings['whatsapp_chat'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-images"></i>
                                <div>
                                    <strong>Photo Gallery</strong>
                                    <small>Your image gallery</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[photo_gallery]" class="social-feature"
                                       {{ ($visibility_settings['photo_gallery'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-video"></i>
                                <div>
                                    <strong>Video Gallery</strong>
                                    <small>Your video content</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[video_gallery]" class="social-feature"
                                       {{ ($visibility_settings['video_gallery'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Info -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-graduation-cap"></i> Professional Information</h3>
                    <div class="header-actions">
                        <label class="toggle-all">
                            <input type="checkbox" class="section-toggle" data-section="professional" checked>
                            <span>Toggle All</span>
                        </label>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="visibility-grid">
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-certificate"></i>
                                <div>
                                    <strong>Qualifications</strong>
                                    <small>Education and degrees</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[qualifications]" class="professional-feature"
                                       {{ ($visibility_settings['qualifications'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-tools"></i>
                                <div>
                                    <strong>Services/Professions</strong>
                                    <small>What you offer</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[services]" class="professional-feature"
                                       {{ ($visibility_settings['services'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-history"></i>
                                <div>
                                    <strong>Work Experience</strong>
                                    <small>Career history</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[work_experience]" class="professional-feature"
                                       {{ ($visibility_settings['work_experience'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-award"></i>
                                <div>
                                    <strong>Skills/Certifications</strong>
                                    <small>Your expertise areas</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[skills]" class="professional-feature"
                                       {{ ($visibility_settings['skills'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-trophy"></i>
                                <div>
                                    <strong>Achievements</strong>
                                    <small>Awards and recognition</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[achievements]" class="professional-feature"
                                       {{ ($visibility_settings['achievements'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Features -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-store"></i> Business Features</h3>
                    <div class="header-actions">
                        <label class="toggle-all">
                            <input type="checkbox" class="section-toggle" data-section="business" checked>
                            <span>Toggle All</span>
                        </label>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="visibility-grid">
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-box"></i>
                                <div>
                                    <strong>Products</strong>
                                    <small>Product listings</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[products]" class="business-feature"
                                       {{ ($visibility_settings['products'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-folder-open"></i>
                                <div>
                                    <strong>Portfolio</strong>
                                    <small>Your work showcase</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[portfolio]" class="business-feature"
                                       {{ ($visibility_settings['portfolio'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-star"></i>
                                <div>
                                    <strong>Testimonials</strong>
                                    <small>Client reviews</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[testimonials]" class="business-feature"
                                       {{ ($visibility_settings['testimonials'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-rupee-sign"></i>
                                <div>
                                    <strong>Pricing</strong>
                                    <small>Service pricing info</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[pricing]" class="business-feature"
                                       {{ ($visibility_settings['pricing'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-calendar-check"></i>
                                <div>
                                    <strong>Appointment Booking</strong>
                                    <small>Schedule appointments</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[appointment_booking]" class="business-feature"
                                       {{ ($visibility_settings['appointment_booking'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location & Timing -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-map-marked-alt"></i> Location & Timing</h3>
                    <div class="header-actions">
                        <label class="toggle-all">
                            <input type="checkbox" class="section-toggle" data-section="location" checked>
                            <span>Toggle All</span>
                        </label>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="visibility-grid">
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <strong>Business Hours</strong>
                                    <small>Operating hours/timings</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[business_hours]" class="location-feature"
                                       {{ ($visibility_settings['business_hours'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-map"></i>
                                <div>
                                    <strong>Location Map</strong>
                                    <small>Google Maps integration</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[location_map]" class="location-feature"
                                       {{ ($visibility_settings['location_map'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-globe-asia"></i>
                                <div>
                                    <strong>Service Areas</strong>
                                    <small>Locations you serve</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[service_areas]" class="location-feature"
                                       {{ ($visibility_settings['service_areas'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Content -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-plus-circle"></i> Additional Content</h3>
                    <div class="header-actions">
                        <label class="toggle-all">
                            <input type="checkbox" class="section-toggle" data-section="additional" checked>
                            <span>Toggle All</span>
                        </label>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="visibility-grid">
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-quote-right"></i>
                                <div>
                                    <strong>Thoughts/Quotes</strong>
                                    <small>Your personal quotes</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[thoughts]" class="additional-feature"
                                       {{ ($visibility_settings['thoughts'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-blog"></i>
                                <div>
                                    <strong>Blog Articles</strong>
                                    <small>Your blog posts</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[blog_articles]" class="additional-feature"
                                       {{ ($visibility_settings['blog_articles'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-question-circle"></i>
                                <div>
                                    <strong>FAQs</strong>
                                    <small>Frequently asked questions</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[faqs]" class="additional-feature"
                                       {{ ($visibility_settings['faqs'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-file-download"></i>
                                <div>
                                    <strong>Downloads</strong>
                                    <small>Brochures/documents</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[downloads]" class="additional-feature"
                                       {{ ($visibility_settings['downloads'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            @if($user->hasRestaurantTheme())
            <!-- Restaurant Specific Features -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-utensils"></i> Restaurant Features</h3>
                    <div class="header-actions">
                        <label class="toggle-all">
                            <input type="checkbox" class="section-toggle" data-section="restaurant" checked>
                            <span>Toggle All</span>
                        </label>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="visibility-grid">
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-book-open"></i>
                                <div>
                                    <strong>Menu</strong>
                                    <small>Food menu items</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[menu]" class="restaurant-feature"
                                       {{ ($visibility_settings['menu'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-filter"></i>
                                <div>
                                    <strong>Dietary Filters</strong>
                                    <small>Veg/Non-veg filters</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[dietary_filters]" class="restaurant-feature"
                                       {{ ($visibility_settings['dietary_filters'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-door-open"></i>
                                <div>
                                    <strong>Dine In</strong>
                                    <small>Dine-in availability</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[dine_in]" class="restaurant-feature"
                                       {{ ($visibility_settings['dine_in'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-shopping-bag"></i>
                                <div>
                                    <strong>Takeaway</strong>
                                    <small>Takeaway service</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[takeaway]" class="restaurant-feature"
                                       {{ ($visibility_settings['takeaway'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-shipping-fast"></i>
                                <div>
                                    <strong>Delivery</strong>
                                    <small>Home delivery service</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[delivery]" class="restaurant-feature"
                                       {{ ($visibility_settings['delivery'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <strong>Reservation</strong>
                                    <small>Table reservation</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[reservation]" class="restaurant-feature"
                                       {{ ($visibility_settings['reservation'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($user->profession_type == 1)
            <!-- Medical Theme Specific Features -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-stethoscope"></i> Medical Features</h3>
                    <div class="header-actions">
                        <label class="toggle-all">
                            <input type="checkbox" class="section-toggle" data-section="medical" checked>
                            <span>Toggle All</span>
                        </label>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="visibility-grid">
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-user-md"></i>
                                <div>
                                    <strong>OPD Timings</strong>
                                    <small>Consultation hours</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[opd_timings]" class="medical-feature"
                                       {{ ($visibility_settings['opd_timings'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-rupee-sign"></i>
                                <div>
                                    <strong>Consultation Fees</strong>
                                    <small>Consultation charges</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[consultation_fees]" class="medical-feature"
                                       {{ ($visibility_settings['consultation_fees'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-clinic-medical"></i>
                                <div>
                                    <strong>Clinic Information</strong>
                                    <small>Clinic details</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[clinic_info]" class="medical-feature"
                                       {{ ($visibility_settings['clinic_info'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="visibility-item">
                            <div class="item-info">
                                <i class="fas fa-certificate"></i>
                                <div>
                                    <strong>Medical Certifications</strong>
                                    <small>Medical credentials</small>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="visibility[medical_certifications]" class="medical-feature"
                                       {{ ($visibility_settings['medical_certifications'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Form Actions -->
            <div class="form-card fade-up">
                <div class="form-card-footer action-footer">
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                        <button type="button" class="btn btn-outline btn-lg" onclick="window.location.reload()">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                    <form action="{{ route('profile.visibility.reset') }}" method="POST" class="reset-form"
                          onsubmit="return confirm('Are you sure you want to reset all settings to defaults?')">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-lg">
                            <i class="fas fa-undo"></i> Reset to Defaults
                        </button>
                    </form>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
.settings-container-wide {
    max-width: 900px;
}

.form-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.toggle-all {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
    cursor: pointer;
}

.toggle-all input[type="checkbox"] {
    cursor: pointer;
}

.visibility-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1rem;
}

.visibility-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: var(--card-background);
    border-radius: 8px;
    border: 1px solid var(--border-color);
    transition: all 0.2s;
}

.visibility-item:hover {
    border-color: var(--primary-color);
    box-shadow: 0 2px 8px rgba(var(--primary-rgb), 0.1);
}

.item-info {
    display: flex;
    gap: 0.75rem;
    align-items: flex-start;
    flex: 1;
}

.item-info i {
    font-size: 1.25rem;
    color: var(--primary-color);
    margin-top: 0.25rem;
}

.item-info strong {
    display: block;
    color: var(--text-color);
    margin-bottom: 0.125rem;
    font-size: 0.9375rem;
}

.item-info small {
    color: var(--text-muted);
    font-size: 0.8125rem;
}

/* Toggle Switch Styles */
.switch {
    position: relative;
    display: inline-block;
    width: 48px;
    height: 26px;
    flex-shrink: 0;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #2a2f3a;
    border: 1px solid #3a4050;
    transition: .3s;
    border-radius: 26px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: #f8fafc;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    transition: .3s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #22c55e;
    border-color: #22c55e;
}

input:checked + .slider:before {
    transform: translateX(22px);
}

.action-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.button-group {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.reset-form {
    margin: 0;
}

@media (max-width: 768px) {
    .visibility-grid {
        grid-template-columns: 1fr;
    }

    .action-footer {
        flex-direction: column;
        align-items: stretch;
    }

    .button-group {
        flex-direction: column;
    }

    .reset-form {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Section toggle all functionality
    document.querySelectorAll('.section-toggle').forEach(toggle => {
        const section = toggle.dataset.section;

        toggle.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll(`.${section}-feature`);
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        // Update toggle all state when individual items change
        const checkboxes = document.querySelectorAll(`.${section}-feature`);
        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const allChecked = Array.from(checkboxes).every(c => c.checked);
                const someChecked = Array.from(checkboxes).some(c => c.checked);
                toggle.checked = allChecked;
                toggle.indeterminate = someChecked && !allChecked;
            });
        });
    });

    // Save animation
    const form = document.getElementById('visibilityForm');
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        submitBtn.disabled = true;
    });
});
</script>
@include('userdashboard-new.partials.form-page-styles')
@endsection
