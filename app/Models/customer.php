<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class customer extends Authenticatable
{
    use HasFactory;
    protected $guarded=[];

    /**
     * Cast attributes to native types
     */
    protected $casts = [
        'visibility_settings' => 'array',
        'profession_data' => 'array',
        'dob' => 'date',
    ];

    public function getDesignationAttribute()
    {
        return $this->desig;
    }

    /**
     * Boot the model and attach event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug before creating customer
        static::creating(function ($customer) {
            if (empty($customer->slug)) {
                $customer->slug = static::generateUniqueSlug($customer->name);
            }
        });

        // Auto-update slug if name changes
        static::updating(function ($customer) {
            if (empty($customer->slug) || $customer->isDirty('name')) {
                $customer->slug = static::generateUniqueSlug($customer->name, $customer->id);
            }
        });
    }

    /**
     * Generate a unique slug from name
     */
    public static function generateUniqueSlug($name, $id = null)
    {
        // Create base slug from name
        $slug = Str::slug($name);

        // If slug is empty (non-latin characters), use 'user' prefix
        if (empty($slug)) {
            $slug = 'user';
        }

        // Check if slug exists
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $query = static::where('slug', $slug);

            // Exclude current record if updating
            if ($id) {
                $query->where('id', '!=', $id);
            }

            if (!$query->exists()) {
                break;
            }

            // Append counter to make it unique
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function messages(){
        return $this->hasMany(Message::class,'user_id','id');
    }

    /**
     * Get the company this customer belongs to (if staff)
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get the profession theme for this customer
     */
    public function professionTheme()
    {
        return $this->belongsTo(ProfessionTheme::class, 'profession_type', 'id');
    }

    /**
     * Get the company staff record for this customer
     */
    public function staffRecord()
    {
        return $this->hasOne(CompanyStaff::class, 'customer_id');
    }

    /**
     * Get menu categories for this customer (restaurant theme)
     */
    public function menuCategories()
    {
        return $this->hasMany(MenuCategory::class, 'customer_id');
    }

    /**
     * Get menu items for this customer (restaurant theme)
     */
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'customer_id');
    }

    /**
     * Get restaurant info for this customer
     */
    public function restaurantInfo()
    {
        return $this->hasOne(RestaurantInfo::class, 'customer_id');
    }

    public function restaurantProfiles()
    {
        return $this->hasMany(RestaurantProfile::class, 'customer_id');
    }

    public function restaurantTables()
    {
        return $this->hasMany(RestaurantTable::class, 'customer_id');
    }

    public function hotelRooms()
    {
        return $this->hasMany(HotelRoom::class, 'customer_id');
    }

    public function tableOrders()
    {
        return $this->hasMany(TableOrder::class, 'customer_id');
    }

    public function roomServiceOrders()
    {
        return $this->hasMany(RoomServiceOrder::class, 'customer_id');
    }

    public function restaurantPayments()
    {
        return $this->hasMany(RestaurantPayment::class, 'customer_id');
    }

    public function eventBookings()
    {
        return $this->hasMany(EventBooking::class, 'customer_id');
    }

    public function banquetHalls()
    {
        return $this->hasMany(BanquetHall::class, 'customer_id');
    }

    public function productionServices()
    {
        return $this->hasMany(ProductionService::class, 'customer_id');
    }

    public function productionProjects()
    {
        return $this->hasMany(ProductionProject::class, 'customer_id');
    }

    public function productionPortfolios()
    {
        return $this->hasMany(ProductionPortfolio::class, 'customer_id');
    }

    public function productionTeam()
    {
        return $this->hasMany(ProductionTeam::class, 'customer_id');
    }

    public function productionPayments()
    {
        return $this->hasMany(ProductionPayment::class, 'customer_id');
    }

    public function jewelleryProducts()
    {
        return $this->hasMany(JewelleryProduct::class, 'customer_id');
    }

    public function metalRates()
    {
        return $this->hasMany(MetalRate::class, 'customer_id');
    }

    public function jewelleryCustomOrders()
    {
        return $this->hasMany(JewelleryCustomOrder::class, 'customer_id');
    }

    public function techServices()
    {
        return $this->hasMany(TechService::class, 'customer_id');
    }

    public function techProjects()
    {
        return $this->hasMany(TechProject::class, 'customer_id');
    }

    public function techCaseStudies()
    {
        return $this->hasMany(TechCaseStudy::class, 'customer_id');
    }

    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class, 'customer_id');
    }

    public function tourBookings()
    {
        return $this->hasMany(TourBooking::class, 'customer_id');
    }

    public function fitnessTrainers()
    {
        return $this->hasMany(FitnessTrainer::class, 'customer_id');
    }

    public function fitnessPrograms()
    {
        return $this->hasMany(FitnessProgram::class, 'customer_id');
    }

    public function fitnessMemberships()
    {
        return $this->hasMany(FitnessMembership::class, 'customer_id');
    }

    public function memberSubscriptions()
    {
        return $this->hasMany(MemberSubscription::class, 'customer_id');
    }

    public function fitnessClasses()
    {
        return $this->hasMany(FitnessClass::class, 'customer_id');
    }

    public function classBookings()
    {
        return $this->hasMany(ClassBooking::class, 'customer_id');
    }

    public function memberProgressEntries()
    {
        return $this->hasMany(MemberProgress::class, 'customer_id');
    }

    public function transformationGallery()
    {
        return $this->hasMany(TransformationGallery::class, 'customer_id');
    }

    public function dietPlans()
    {
        return $this->hasMany(DietPlan::class, 'customer_id');
    }

    public function legalServices()
    {
        return $this->hasMany(LegalService::class, 'customer_id');
    }

    public function legalCases()
    {
        return $this->hasMany(LegalCase::class, 'customer_id');
    }

    public function legalConsultations()
    {
        return $this->hasMany(LegalConsultation::class, 'customer_id');
    }

    public function salonServices()
    {
        return $this->hasMany(SalonService::class, 'customer_id');
    }

    public function salonArtists()
    {
        return $this->hasMany(SalonArtist::class, 'customer_id');
    }

    public function salonAppointments()
    {
        return $this->hasMany(SalonAppointment::class, 'customer_id');
    }

    public function salonPackages()
    {
        return $this->hasMany(SalonPackage::class, 'customer_id');
    }

    public function salonPortfolio()
    {
        return $this->hasMany(SalonPortfolio::class, 'customer_id');
    }

    public function salonProducts()
    {
        return $this->hasMany(SalonProduct::class, 'customer_id');
    }

    /**
     * Check if customer is a company staff member
     */
    public function isStaff()
    {
        return $this->account_type === 'staff';
    }

    /**
     * Check if customer is a company admin
     */
    public function isCompanyAdmin()
    {
        return $this->is_company_admin == 1;
    }

    /**
     * Check if customer has restaurant theme
     */
    public function hasRestaurantTheme()
    {
        return $this->profession_type == 13;
    }

    /**
     * Get the profile view template based on profession type
     */
    public function getProfileTemplateAttribute()
    {
        if ($this->professionTheme) {
            return $this->professionTheme->view_path;
        }
        return 'frontend.profile-new.index';
    }

    /**
     * Check if a specific feature is visible on the profile
     *
     * @param string $feature The feature key to check
     * @return bool
     */
    public function isFeatureVisible($feature)
    {
        // Get visibility settings, default to empty array if null
        $settings = $this->visibility_settings ?? [];

        // If feature is not in settings, default to visible (true)
        // This ensures backward compatibility - existing profiles show all features
        return $settings[$feature] ?? true;
    }

    /**
     * Update visibility for a specific feature
     *
     * @param string $feature The feature key to update
     * @param bool $visible Whether the feature should be visible
     * @return void
     */
    public function setFeatureVisibility($feature, $visible)
    {
        $settings = $this->visibility_settings ?? [];
        $settings[$feature] = $visible;
        $this->visibility_settings = $settings;
        $this->save();
    }

    /**
     * Update multiple feature visibility settings at once
     *
     * @param array $features Array of feature => visibility pairs
     * @return void
     */
    public function updateVisibilitySettings($features)
    {
        $settings = $this->visibility_settings ?? [];
        foreach ($features as $feature => $visible) {
            $settings[$feature] = $visible;
        }
        $this->visibility_settings = $settings;
        $this->save();
    }

    /**
     * Get default visibility settings based on theme
     *
     * @return array
     */
    public function getDefaultVisibilitySettings()
    {
        // Base features available to all themes
        $defaults = [
            // Core Profile Features
            'profile_photo' => true,
            'cover_image' => true,
            'name' => true,
            'designation' => true,
            'bio' => true,
            'contact_number' => true,
            'email' => true,
            'address' => true,
            'save_contact_button' => true,
            'share_profile_button' => true,

            // Social & Media
            'social_media' => true,
            'facebook' => true,
            'instagram' => true,
            'linkedin' => true,
            'twitter' => true,
            'youtube' => true,
            'whatsapp_chat' => true,
            'photo_gallery' => true,
            'video_gallery' => true,

            // Professional Info
            'qualifications' => true,
            'services' => true,
            'work_experience' => true,
            'skills' => true,
            'achievements' => true,

            // Business Features
            'products' => true,
            'portfolio' => true,
            'testimonials' => true,
            'pricing' => true,
            'appointment_booking' => true,

            // Location & Timing
            'business_hours' => true,
            'location_map' => true,
            'service_areas' => true,

            // Additional Content
            'thoughts' => true,
            'blog_articles' => true,
            'faqs' => true,
            'downloads' => true,
        ];

        // Theme-specific features
        if ($this->hasRestaurantTheme()) {
            $defaults['menu'] = true;
            $defaults['menu_categories'] = true;
            $defaults['dietary_filters'] = true;
            $defaults['operating_hours'] = true;
            $defaults['dine_in'] = true;
            $defaults['takeaway'] = true;
            $defaults['delivery'] = true;
            $defaults['reservation'] = true;
        }

        // Medical theme (profession_type == 1)
        if ($this->profession_type == 1) {
            $defaults['opd_timings'] = true;
            $defaults['consultation_fees'] = true;
            $defaults['clinic_info'] = true;
            $defaults['medical_certifications'] = true;
        }

        return $defaults;
    }

    /**
     * Reset visibility settings to defaults
     *
     * @return void
     */
    public function resetVisibilityToDefaults()
    {
        $this->visibility_settings = $this->getDefaultVisibilitySettings();
        $this->save();
    }

    /**
     * Get medical profiles for this customer
     */
    public function medicalProfiles()
    {
        return $this->hasMany(MedicalProfile::class, 'customer_id');
    }

    /**
     * Get active medical profiles
     */
    public function activeMedicalProfiles()
    {
        return $this->hasMany(MedicalProfile::class, 'customer_id')->where('is_active', true);
    }

    /**
     * Get default medical profile
     */
    public function defaultMedicalProfile()
    {
        return $this->hasOne(MedicalProfile::class, 'customer_id')->where('is_default', true);
    }

    /**
     * Get medical appointments for this customer
     */
    public function medicalAppointments()
    {
        return $this->hasMany(MedicalAppointment::class, 'customer_id');
    }

    /**
     * Get medical payments for this customer
     */
    public function medicalPayments()
    {
        return $this->hasMany(MedicalPayment::class, 'customer_id');
    }

    /**
     * Get medical reviews for this customer
     */
    public function medicalReviews()
    {
        return $this->hasMany(MedicalReview::class, 'customer_id');
    }

    /**
     * Get approved medical reviews
     */
    public function approvedMedicalReviews()
    {
        return $this->hasMany(MedicalReview::class, 'customer_id')->where('status', 'approved');
    }

    /**
     * Check if customer has medical theme
     */
    public function hasMedicalTheme()
    {
        return $this->profession_type == 1;
    }

    /**
     * Get the user store settings for this customer
     */
    public function userStoreSetting()
    {
        return $this->hasOne(UserStoreSetting::class, 'user_id', 'id');
    }

    /**
     * Get location tracking records for this customer.
     */
    public function locationTracks()
    {
        return $this->hasMany(ProfileLocationTrack::class, 'customer_id');
    }
}
