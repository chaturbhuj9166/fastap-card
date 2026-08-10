<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'profile_type',
        'is_active',
        'is_default',
        'display_order',
        'specialization',
        'degree',
        'experience_years',
        'patients_treated',
        'registration_number',
        'hospital_name',
        'bed_capacity',
        'departments',
        'facilities',
        'ambulance_service',
        'emergency_contact',
        'insurance_accepted',
        'home_services',
        'service_packages',
        'service_areas',
        'equipment_rental',
        'consultation_fee_inperson',
        'consultation_fee_video',
        'opd_timings',
        'clinic_address',
        'clinic_facilities',
        'gallery_images',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'ambulance_service' => 'boolean',
        'equipment_rental' => 'boolean',
        'departments' => 'array',
        'facilities' => 'array',
        'insurance_accepted' => 'array',
        'home_services' => 'array',
        'service_packages' => 'array',
        'service_areas' => 'array',
        'opd_timings' => 'array',
        'clinic_facilities' => 'array',
        'gallery_images' => 'array',
    ];

    /**
     * Relationship: Belongs to Customer
     */
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    /**
     * Relationship: Has many appointments
     */
    public function appointments()
    {
        return $this->hasMany(MedicalAppointment::class);
    }

    /**
     * Scope: Active profiles only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Filter by profile type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('profile_type', $type);
    }

    /**
     * Check if this is the default profile
     */
    public function isDefault()
    {
        return $this->is_default;
    }

    /**
     * Check if profile type is doctor
     */
    public function isDoctor()
    {
        return $this->profile_type === 'doctor';
    }

    /**
     * Check if profile type is hospital
     */
    public function isHospital()
    {
        return $this->profile_type === 'hospital';
    }

    /**
     * Check if profile type is daycare
     */
    public function isDaycare()
    {
        return $this->profile_type === 'daycare';
    }

    /**
     * Get formatted consultation fee
     */
    public function getFormattedInpersonFee()
    {
        return $this->consultation_fee_inperson ? '₹' . number_format($this->consultation_fee_inperson, 0) : 'N/A';
    }

    /**
     * Get formatted video consultation fee
     */
    public function getFormattedVideoFee()
    {
        return $this->consultation_fee_video ? '₹' . number_format($this->consultation_fee_video, 0) : 'N/A';
    }

    /**
     * Get profile type label
     */
    public function getProfileTypeLabel()
    {
        $labels = [
            'doctor' => 'Doctor Profile',
            'hospital' => 'Hospital Profile',
            'daycare' => 'Day Care / Home Health Profile',
        ];

        return $labels[$this->profile_type] ?? 'Unknown';
    }

    /**
     * Get profile type icon
     */
    public function getProfileTypeIcon()
    {
        $icons = [
            'doctor' => '👨‍⚕️',
            'hospital' => '🏥',
            'daycare' => '🏠',
        ];

        return $icons[$this->profile_type] ?? '💼';
    }
}
