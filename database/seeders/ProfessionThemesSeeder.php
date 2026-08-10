<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            [
                'id' => 1,
                'name' => 'Medical Professional',
                'slug' => 'medical',
                'description' => 'Perfect for doctors, clinics, healthcare providers, and medical professionals',
                'icon' => 'fa-stethoscope',
                'color' => '#10b981',
                'view_template' => 'medical',
                'required_fields' => json_encode([
                    'specialization',
                    'qualifications',
                    'clinic_name',
                    'clinic_address',
                    'consultation_fee',
                    'experience_years',
                    'registration_number'
                ]),
                'optional_fields' => json_encode([
                    'consultation_timings',
                    'appointment_link',
                    'emergency_contact',
                    'insurance_accepted',
                    'languages_spoken',
                    'hospital_affiliations'
                ]),
                'sample_image' => 'themes/medical-sample.jpg',
                'status' => 1,
                'sort_order' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Creative Showcase',
                'slug' => 'creative',
                'description' => 'Ideal for photographers, videographers, artists, and creative professionals',
                'icon' => 'fa-camera',
                'color' => '#ec4899',
                'view_template' => 'creative',
                'required_fields' => json_encode([
                    'photography_type',
                    'portfolio_images',
                    'experience_years'
                ]),
                'optional_fields' => json_encode([
                    'equipment_list',
                    'pricing_packages',
                    'booking_link',
                    'awards',
                    'client_list',
                    'behind_the_scenes'
                ]),
                'sample_image' => 'themes/creative-sample.jpg',
                'status' => 1,
                'sort_order' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Service Provider',
                'slug' => 'service',
                'description' => 'For plumbers, electricians, home services, and maintenance professionals',
                'icon' => 'fa-wrench',
                'color' => '#f59e0b',
                'view_template' => 'service',
                'required_fields' => json_encode([
                    'services',
                    'service_areas',
                    'availability'
                ]),
                'optional_fields' => json_encode([
                    'pricing',
                    'certifications',
                    'team_size',
                    'emergency_service',
                    'guarantee_policy'
                ]),
                'sample_image' => 'themes/service-sample.jpg',
                'status' => 1,
                'sort_order' => 3,
            ],
            [
                'id' => 4,
                'name' => 'Manufacturing Company',
                'slug' => 'manufacturing',
                'description' => 'Designed for factories, industrial businesses, and manufacturing units',
                'icon' => 'fa-industry',
                'color' => '#64748b',
                'view_template' => 'manufacturing',
                'required_fields' => json_encode([
                    'products',
                    'certifications',
                    'production_capacity'
                ]),
                'optional_fields' => json_encode([
                    'factory_images',
                    'machinery_list',
                    'export_countries',
                    'quality_standards',
                    'raw_materials',
                    'minimum_order'
                ]),
                'sample_image' => 'themes/manufacturing-sample.jpg',
                'status' => 1,
                'sort_order' => 4,
            ],
            [
                'id' => 5,
                'name' => 'Product Retailer',
                'slug' => 'retail',
                'description' => 'Perfect for shops, retail stores, and product sellers',
                'icon' => 'fa-store',
                'color' => '#3b82f6',
                'view_template' => 'retail',
                'required_fields' => json_encode([
                    'product_categories',
                    'store_location',
                    'store_timings'
                ]),
                'optional_fields' => json_encode([
                    'featured_products',
                    'offers_discounts',
                    'delivery_options',
                    'payment_methods',
                    'loyalty_program'
                ]),
                'sample_image' => 'themes/retail-sample.jpg',
                'status' => 1,
                'sort_order' => 5,
            ],
            [
                'id' => 6,
                'name' => 'Real Estate Pro',
                'slug' => 'realestate',
                'description' => 'For real estate agents, brokers, and property dealers',
                'icon' => 'fa-home',
                'color' => '#059669',
                'view_template' => 'realestate',
                'required_fields' => json_encode([
                    'rera_number',
                    'specialization',
                    'areas_covered'
                ]),
                'optional_fields' => json_encode([
                    'property_listings',
                    'virtual_tour_links',
                    'sold_properties',
                    'awards',
                    'team_members'
                ]),
                'sample_image' => 'themes/realestate-sample.jpg',
                'status' => 1,
                'sort_order' => 6,
            ],
            [
                'id' => 7,
                'name' => 'Actors & Models',
                'slug' => 'entertainment',
                'description' => 'Tailored for actors, models, performers, and entertainment industry professionals',
                'icon' => 'fa-star',
                'color' => '#8b5cf6',
                'view_template' => 'entertainment',
                'required_fields' => json_encode([
                    'headshots',
                    'physical_stats',
                    'skills'
                ]),
                'optional_fields' => json_encode([
                    'showreel_link',
                    'filmography',
                    'awards',
                    'agency_info',
                    'availability_calendar',
                    'social_following'
                ]),
                'sample_image' => 'themes/entertainment-sample.jpg',
                'status' => 1,
                'sort_order' => 7,
            ],
            [
                'id' => 8,
                'name' => 'Production House',
                'slug' => 'production',
                'description' => 'For film production, video production, and media companies',
                'icon' => 'fa-film',
                'color' => '#ef4444',
                'view_template' => 'production',
                'required_fields' => json_encode([
                    'services',
                    'showreel',
                    'team'
                ]),
                'optional_fields' => json_encode([
                    'projects',
                    'equipment_list',
                    'clients',
                    'awards',
                    'studio_info'
                ]),
                'sample_image' => 'themes/production-sample.jpg',
                'status' => 1,
                'sort_order' => 8,
            ],
            [
                'id' => 9,
                'name' => 'Multi-Service Provider',
                'slug' => 'multiservice',
                'description' => 'For businesses offering multiple services across different categories',
                'icon' => 'fa-th-large',
                'color' => '#06b6d4',
                'view_template' => 'multiservice',
                'required_fields' => json_encode([
                    'service_categories',
                    'locations'
                ]),
                'optional_fields' => json_encode([
                    'team_size',
                    'years_in_business',
                    'certifications',
                    'key_clients',
                    'packages'
                ]),
                'sample_image' => 'themes/multiservice-sample.jpg',
                'status' => 1,
                'sort_order' => 9,
            ],
            [
                'id' => 10,
                'name' => 'Jewellery & Luxury',
                'slug' => 'luxury',
                'description' => 'Elegant theme for jewellery stores, luxury brands, and premium retailers',
                'icon' => 'fa-gem',
                'color' => '#d4a574',
                'view_template' => 'luxury',
                'required_fields' => json_encode([
                    'collections',
                    'store_location',
                    'price_range'
                ]),
                'optional_fields' => json_encode([
                    'certifications',
                    'custom_design_service',
                    'appointment_booking',
                    'financing_options',
                    'virtual_try_on'
                ]),
                'sample_image' => 'themes/luxury-sample.jpg',
                'status' => 1,
                'sort_order' => 10,
            ],
            [
                'id' => 11,
                'name' => 'IT & Technology',
                'slug' => 'technology',
                'description' => 'Modern theme for IT companies, startups, and tech professionals',
                'icon' => 'fa-laptop-code',
                'color' => '#7c3aed',
                'view_template' => 'technology',
                'required_fields' => json_encode([
                    'services',
                    'tech_stack',
                    'team'
                ]),
                'optional_fields' => json_encode([
                    'case_studies',
                    'github_link',
                    'open_source_projects',
                    'blog_link',
                    'client_logos'
                ]),
                'sample_image' => 'themes/technology-sample.jpg',
                'status' => 1,
                'sort_order' => 11,
            ],
            [
                'id' => 12,
                'name' => 'Product Company',
                'slug' => 'product',
                'description' => 'For product-based businesses and companies with product lines',
                'icon' => 'fa-box',
                'color' => '#2563eb',
                'view_template' => 'product',
                'required_fields' => json_encode([
                    'products',
                    'categories'
                ]),
                'optional_fields' => json_encode([
                    'featured_product',
                    'pricing_tiers',
                    'documentation_link',
                    'demo_link',
                    'customer_logos'
                ]),
                'sample_image' => 'themes/product-sample.jpg',
                'status' => 1,
                'sort_order' => 12,
            ],
            [
                'id' => 13,
                'name' => 'Restaurant/Hotel',
                'slug' => 'restaurant',
                'description' => 'Full-featured theme for restaurants, hotels, cafes, and food businesses with menu management',
                'icon' => 'fa-utensils',
                'color' => '#dc2626',
                'view_template' => 'restaurant',
                'required_fields' => json_encode([
                    'restaurant_name',
                    'cuisine_type',
                    'menu_categories',
                    'menu_items',
                    'operating_hours',
                    'location'
                ]),
                'optional_fields' => json_encode([
                    'ambiance_photos',
                    'chef_info',
                    'reservation_link',
                    'delivery_partners',
                    'special_offers',
                    'events_catering',
                    'private_dining',
                    'seating_capacity',
                    'payment_methods'
                ]),
                'sample_image' => 'themes/restaurant-sample.jpg',
                'status' => 1,
                'sort_order' => 13,
            ],
            [
                'id' => 14,
                'name' => 'Travel Agent',
                'slug' => 'travel',
                'description' => 'Perfect for travel agencies, tour operators, and trip planners',
                'icon' => 'fa-plane-departure',
                'color' => '#0891b2',
                'view_template' => 'travel',
                'required_fields' => json_encode([
                    'agency_name',
                    'tour_packages',
                    'destinations'
                ]),
                'optional_fields' => json_encode([
                    'visa_assistance',
                    'travel_tips',
                    'customer_reviews',
                    'customized_itinerary',
                    'flight_booking',
                    'hotel_booking'
                ]),
                'sample_image' => 'themes/travel-sample.jpg',
                'status' => 1,
                'sort_order' => 14,
            ],
            [
                'id' => 15,
                'name' => 'Gym & Fitness',
                'slug' => 'fitness',
                'description' => 'Ideal for gyms, personal trainers, yoga instructors, and fitness centers',
                'icon' => 'fa-dumbbell',
                'color' => '#ef4444',
                'view_template' => 'fitness',
                'required_fields' => json_encode([
                    'training_programs',
                    'membership_plans',
                    'certifications'
                ]),
                'optional_fields' => json_encode([
                    'transformation_gallery',
                    'nutrition_guidance',
                    'class_schedule',
                    'online_training',
                    'body_metrics_calculator'
                ]),
                'sample_image' => 'themes/fitness-sample.jpg',
                'status' => 1,
                'sort_order' => 15,
            ],
            [
                'id' => 16,
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'For coaching centers, schools, private tutors, and educational institutions',
                'icon' => 'fa-graduation-cap',
                'color' => '#6366f1',
                'view_template' => 'education',
                'required_fields' => json_encode([
                    'courses_offered',
                    'faculty_details',
                    'results_achievements'
                ]),
                'optional_fields' => json_encode([
                    'class_timings',
                    'fee_structure',
                    'online_classes',
                    'study_material',
                    'demo_class_booking',
                    'admission_process'
                ]),
                'sample_image' => 'themes/education-sample.jpg',
                'status' => 1,
                'sort_order' => 16,
            ],
            [
                'id' => 17,
                'name' => 'Lawyer',
                'slug' => 'lawyer',
                'description' => 'Professional theme for lawyers, advocates, and law firms',
                'icon' => 'fa-scale-balanced',
                'color' => '#1e40af',
                'view_template' => 'lawyer',
                'required_fields' => json_encode([
                    'practice_areas',
                    'bar_council_number',
                    'court_experience'
                ]),
                'optional_fields' => json_encode([
                    'case_success_rate',
                    'consultation_fee',
                    'legal_articles',
                    'document_checklist',
                    'client_confidentiality'
                ]),
                'sample_image' => 'themes/lawyer-sample.jpg',
                'status' => 1,
                'sort_order' => 17,
            ],
            [
                'id' => 18,
                'name' => 'CA & Accountant',
                'slug' => 'accountant',
                'description' => 'For chartered accountants, tax consultants, and accounting firms',
                'icon' => 'fa-calculator',
                'color' => '#10b981',
                'view_template' => 'accountant',
                'required_fields' => json_encode([
                    'services',
                    'qualifications',
                    'registration_numbers'
                ]),
                'optional_fields' => json_encode([
                    'specialization_areas',
                    'consultation_fee',
                    'document_requirements',
                    'tax_calendar',
                    'client_industries'
                ]),
                'sample_image' => 'themes/accountant-sample.jpg',
                'status' => 1,
                'sort_order' => 18,
            ],
            [
                'id' => 19,
                'name' => 'Salon & Beauty',
                'slug' => 'salon',
                'description' => 'Elegant theme for salons, beauty parlors, makeup artists, and hair stylists',
                'icon' => 'fa-scissors',
                'color' => '#ec4899',
                'view_template' => 'salon',
                'required_fields' => json_encode([
                    'services_menu',
                    'price_list',
                    'appointment_booking'
                ]),
                'optional_fields' => json_encode([
                    'before_after_gallery',
                    'bridal_packages',
                    'party_packages',
                    'stylist_profiles',
                    'product_recommendations',
                    'offers_discounts'
                ]),
                'sample_image' => 'themes/salon-sample.jpg',
                'status' => 1,
                'sort_order' => 19,
            ],
            [
                'id' => 20,
                'name' => 'Interior Designer',
                'slug' => 'interior',
                'description' => 'Sophisticated theme for interior designers and modular kitchen manufacturers',
                'icon' => 'fa-couch',
                'color' => '#78350f',
                'view_template' => 'interior',
                'required_fields' => json_encode([
                    'portfolio_gallery',
                    'design_styles',
                    'services'
                ]),
                'optional_fields' => json_encode([
                    '3d_design_preview',
                    'material_options',
                    'project_timeline',
                    'cost_estimation',
                    'manufacturer_partnerships'
                ]),
                'sample_image' => 'themes/interior-sample.jpg',
                'status' => 1,
                'sort_order' => 20,
            ],
            [
                'id' => 21,
                'name' => 'Solar Energy',
                'slug' => 'solar',
                'description' => 'Modern theme for solar panel dealers and power solution companies',
                'icon' => 'fa-solar-panel',
                'color' => '#eab308',
                'view_template' => 'solar',
                'required_fields' => json_encode([
                    'products',
                    'installation_process',
                    'certifications'
                ]),
                'optional_fields' => json_encode([
                    'savings_calculator',
                    'subsidy_information',
                    'amc_packages',
                    'project_gallery',
                    'roi_information'
                ]),
                'sample_image' => 'themes/solar-sample.jpg',
                'status' => 1,
                'sort_order' => 21,
            ],
            [
                'id' => 22,
                'name' => 'CCTV & Security',
                'slug' => 'security',
                'description' => 'Professional theme for CCTV dealers and security system providers',
                'icon' => 'fa-shield-halved',
                'color' => '#1f2937',
                'view_template' => 'security',
                'required_fields' => json_encode([
                    'products',
                    'security_packages',
                    'installation_service'
                ]),
                'optional_fields' => json_encode([
                    'live_demo',
                    'amc_plans',
                    'brand_partnerships',
                    'project_gallery',
                    'emergency_support'
                ]),
                'sample_image' => 'themes/security-sample.jpg',
                'status' => 1,
                'sort_order' => 22,
            ],
            [
                'id' => 23,
                'name' => 'Astrologer',
                'slug' => 'astrologer',
                'description' => 'Mystical theme for astrologers, vastu consultants, and numerologists',
                'icon' => 'fa-moon',
                'color' => '#f97316',
                'view_template' => 'astrologer',
                'required_fields' => json_encode([
                    'services',
                    'consultation_modes',
                    'expertise_areas'
                ]),
                'optional_fields' => json_encode([
                    'consultation_fees',
                    'language_options',
                    'report_delivery',
                    'online_payment',
                    'testimonials'
                ]),
                'sample_image' => 'themes/astrologer-sample.jpg',
                'status' => 1,
                'sort_order' => 23,
            ],
            [
                'id' => 24,
                'name' => 'Political Worker',
                'slug' => 'political',
                'description' => 'Professional theme for political workers, social workers, and local leaders',
                'icon' => 'fa-flag',
                'color' => '#3b82f6',
                'view_template' => 'political',
                'required_fields' => json_encode([
                    'profile_biography',
                    'party_affiliation',
                    'constituency_area'
                ]),
                'optional_fields' => json_encode([
                    'achievements_initiatives',
                    'public_works',
                    'news_updates',
                    'event_gallery',
                    'complaint_form',
                    'social_media'
                ]),
                'sample_image' => 'themes/political-sample.jpg',
                'status' => 1,
                'sort_order' => 24,
            ],
            [
                'id' => 25,
                'name' => 'Influencer',
                'slug' => 'influencer',
                'description' => 'Vibrant theme for social media influencers, YouTubers, and content creators',
                'icon' => 'fa-fire',
                'color' => '#ec4899',
                'view_template' => 'influencer',
                'required_fields' => json_encode([
                    'social_media_stats',
                    'content_categories',
                    'collaboration_packages'
                ]),
                'optional_fields' => json_encode([
                    'brand_collaborations',
                    'media_kit_download',
                    'audience_demographics',
                    'content_showcase',
                    'rate_card'
                ]),
                'sample_image' => 'themes/influencer-sample.jpg',
                'status' => 1,
                'sort_order' => 25,
            ],
        ];

        foreach ($themes as $theme) {
            DB::table('profession_themes')->updateOrInsert(
                ['id' => $theme['id']],
                array_merge($theme, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('25 profession themes seeded successfully!');
    }
}
