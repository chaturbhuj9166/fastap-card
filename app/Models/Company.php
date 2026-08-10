<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'phone',
        'logo',
        'banner',
        'description',
        'profession_type',
        'industry',
        'website',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'gst_number',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube',
        'card_limit',
        'cards_used',
        'status',
        'subscription_type',
        'subscription_expires',
        'branding_settings',
        'created_by',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'branding_settings' => 'array',
        'subscription_expires' => 'date',
    ];

    /**
     * Get the staff members for this company
     */
    public function staff()
    {
        return $this->hasMany(CompanyStaff::class, 'company_id');
    }

    /**
     * Get the customers linked to this company
     */
    public function customers()
    {
        return $this->hasMany(customer::class, 'company_id');
    }

    /**
     * Get the profession theme for this company
     */
    public function professionTheme()
    {
        return $this->belongsTo(ProfessionTheme::class, 'profession_type', 'id');
    }

    /**
     * Get menu categories for this company
     */
    public function menuCategories()
    {
        return $this->hasMany(MenuCategory::class, 'company_id');
    }

    /**
     * Get menu items for this company
     */
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'company_id');
    }

    /**
     * Get restaurant info for this company
     */
    public function restaurantInfo()
    {
        return $this->hasOne(RestaurantInfo::class, 'company_id');
    }

    public function restaurantProfiles()
    {
        return $this->hasMany(RestaurantProfile::class, 'company_id');
    }

    public function restaurantTables()
    {
        return $this->hasMany(RestaurantTable::class, 'company_id');
    }

    public function hotelRooms()
    {
        return $this->hasMany(HotelRoom::class, 'company_id');
    }

    public function tableOrders()
    {
        return $this->hasMany(TableOrder::class, 'company_id');
    }

    public function roomServiceOrders()
    {
        return $this->hasMany(RoomServiceOrder::class, 'company_id');
    }

    public function restaurantPayments()
    {
        return $this->hasMany(RestaurantPayment::class, 'company_id');
    }

    public function eventBookings()
    {
        return $this->hasMany(EventBooking::class, 'company_id');
    }

    public function banquetHalls()
    {
        return $this->hasMany(BanquetHall::class, 'company_id');
    }

    public function productionServices()
    {
        return $this->hasMany(ProductionService::class, 'company_id');
    }

    public function productionProjects()
    {
        return $this->hasMany(ProductionProject::class, 'company_id');
    }

    public function productionPortfolios()
    {
        return $this->hasMany(ProductionPortfolio::class, 'company_id');
    }

    public function productionTeam()
    {
        return $this->hasMany(ProductionTeam::class, 'company_id');
    }

    public function productionPayments()
    {
        return $this->hasMany(ProductionPayment::class, 'company_id');
    }

    public function jewelleryProducts()
    {
        return $this->hasMany(JewelleryProduct::class, 'company_id');
    }

    public function metalRates()
    {
        return $this->hasMany(MetalRate::class, 'company_id');
    }

    public function jewelleryCustomOrders()
    {
        return $this->hasMany(JewelleryCustomOrder::class, 'company_id');
    }

    public function techServices()
    {
        return $this->hasMany(TechService::class, 'company_id');
    }

    public function techProjects()
    {
        return $this->hasMany(TechProject::class, 'company_id');
    }

    public function techCaseStudies()
    {
        return $this->hasMany(TechCaseStudy::class, 'company_id');
    }

    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class, 'company_id');
    }

    public function tourBookings()
    {
        return $this->hasMany(TourBooking::class, 'company_id');
    }

    public function fitnessTrainers()
    {
        return $this->hasMany(FitnessTrainer::class, 'company_id');
    }

    public function fitnessPrograms()
    {
        return $this->hasMany(FitnessProgram::class, 'company_id');
    }

    public function fitnessMemberships()
    {
        return $this->hasMany(FitnessMembership::class, 'company_id');
    }

    public function memberSubscriptions()
    {
        return $this->hasMany(MemberSubscription::class, 'company_id');
    }

    public function fitnessClasses()
    {
        return $this->hasMany(FitnessClass::class, 'company_id');
    }

    public function classBookings()
    {
        return $this->hasMany(ClassBooking::class, 'company_id');
    }

    public function memberProgressEntries()
    {
        return $this->hasMany(MemberProgress::class, 'company_id');
    }

    public function transformationGallery()
    {
        return $this->hasMany(TransformationGallery::class, 'company_id');
    }

    public function dietPlans()
    {
        return $this->hasMany(DietPlan::class, 'company_id');
    }

    public function legalServices()
    {
        return $this->hasMany(LegalService::class, 'company_id');
    }

    public function legalCases()
    {
        return $this->hasMany(LegalCase::class, 'company_id');
    }

    public function legalConsultations()
    {
        return $this->hasMany(LegalConsultation::class, 'company_id');
    }

    public function salonServices()
    {
        return $this->hasMany(SalonService::class, 'company_id');
    }

    public function salonArtists()
    {
        return $this->hasMany(SalonArtist::class, 'company_id');
    }

    public function salonAppointments()
    {
        return $this->hasMany(SalonAppointment::class, 'company_id');
    }

    public function salonPackages()
    {
        return $this->hasMany(SalonPackage::class, 'company_id');
    }

    public function salonPortfolio()
    {
        return $this->hasMany(SalonPortfolio::class, 'company_id');
    }

    public function salonProducts()
    {
        return $this->hasMany(SalonProduct::class, 'company_id');
    }

    /**
     * Check if company can create more cards
     */
    public function canCreateCard()
    {
        return $this->cards_used < $this->card_limit;
    }

    /**
     * Get remaining card slots
     */
    public function getRemainingCardsAttribute()
    {
        return max(0, $this->card_limit - $this->cards_used);
    }

    /**
     * Increment cards used count
     */
    public function incrementCardsUsed()
    {
        $this->increment('cards_used');
    }

    /**
     * Decrement cards used count
     */
    public function decrementCardsUsed()
    {
        if ($this->cards_used > 0) {
            $this->decrement('cards_used');
        }
    }

    /**
     * Check if subscription is active
     */
    public function isSubscriptionActive()
    {
        if ($this->subscription_type === 'free') {
            return true;
        }
        return $this->subscription_expires && $this->subscription_expires->isFuture();
    }

    /**
     * Scope to get only active companies
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Get the logo URL
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('uploads/companies/' . $this->logo) : asset('images/default-company.png');
    }

    /**
     * Get the banner URL
     */
    public function getBannerUrlAttribute()
    {
        return $this->banner ? asset('uploads/companies/' . $this->banner) : null;
    }
}
