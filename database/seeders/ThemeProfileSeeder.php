<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ThemeProfileSeeder extends Seeder
{
    private array $columnCache = [];
    private array $columnMetaCache = [];
    private int $mobileSeed = 9000000001;

    public function run(): void
    {
        $this->ensureFrontendUserImages();
        $this->ensureJewelleryImages();
        $this->ensureTechImages();
        $this->ensureMenuImages();
        $this->ensureTourImages();
        $this->ensureFitnessImages();
        $this->ensureSalonImages();
        $this->ensureInteriorImages();

        $themes = [
            'medical' => 'medical',
            'creative' => 'creative',
            'realestate' => 'realestate',
            'entertainment' => 'entertainment',
            'production' => 'production',
            'luxury' => 'luxury',
            'technology' => 'technology',
            'restaurant' => 'restaurant',
            'travel' => null,
            'fitness' => null,
            'education' => 'education',
            'lawyer' => null,
            'accountant' => 'accountant',
            'salon' => null,
            'interior' => 'interior',
            'solar' => 'solar',
            'security' => 'security',
            'astrologer' => 'astrologer',
            'political' => 'political',
            'influencer' => 'influencer',
        ];

        $themeRecords = DB::table('profession_themes')
            ->whereIn('slug', array_keys($themes))
            ->get()
            ->keyBy('slug');

        foreach ($themes as $slug => $configKey) {
            $theme = $themeRecords->get($slug);
            if (!$theme) {
                continue;
            }

            $sample = $configKey ? config("theme-samples.{$configKey}") : null;
            if (!$sample) {
                $sample = $this->fallbackSample($theme->name, $slug);
            }

            $userData = $this->buildCustomerData($theme->id, $slug, $sample['user'] ?? []);
            $customerId = $this->upsertCustomer($userData);

            $this->clearCommonData($customerId);
            $this->seedCommonSections($customerId, $sample, $userData);

            switch ($slug) {
                case 'medical':
                    $this->seedMedical($customerId);
                    break;
                case 'creative':
                    $this->seedCreative($customerId);
                    break;
                case 'realestate':
                    $this->seedRealEstate($customerId);
                    break;
                case 'entertainment':
                    $this->seedEntertainment($customerId);
                    break;
                case 'production':
                    $this->seedProduction($customerId);
                    break;
                case 'luxury':
                    $this->seedJewellery($customerId);
                    break;
                case 'technology':
                    $this->seedTechnology($customerId);
                    break;
                case 'restaurant':
                    $this->seedRestaurant($customerId, $sample);
                    break;
                case 'travel':
                    $this->seedTravel($customerId);
                    break;
                case 'fitness':
                    $this->seedFitness($customerId);
                    break;
                case 'education':
                    $this->seedEducation($customerId, $sample);
                    break;
                case 'lawyer':
                    $this->seedLawyer($customerId);
                    break;
                case 'accountant':
                    $this->seedAccountant($customerId, $sample);
                    break;
                case 'salon':
                    $this->seedSalon($customerId);
                    break;
                case 'interior':
                    $this->seedInterior($customerId, $sample);
                    break;
                case 'solar':
                    $this->seedSolar($customerId, $sample);
                    break;
                case 'security':
                    $this->seedSecurity($customerId, $sample);
                    break;
                case 'astrologer':
                    $this->seedAstrologer($customerId, $sample);
                    break;
                case 'political':
                    $this->seedPolitical($customerId, $sample);
                    break;
                case 'influencer':
                    $this->seedInfluencer($customerId, $sample);
                    break;
            }
        }
    }

    private function buildCustomerData(int $themeId, string $slug, array $user): array
    {
        $slugValue = Str::slug($slug . '-demo');
        $email = $user['email'] ?? ($slug . '@example.com');

        $mobile = $user['mobile'] ?? $this->nextMobile();
        $mobile = $this->sanitizePhone($mobile);

        $about = $user['about'] ?? ('Demo profile for ' . Str::title(str_replace('-', ' ', $slug)));
        $designation = $user['desig'] ?? Str::title(str_replace('-', ' ', $slug));

        return [
            'name' => $user['name'] ?? (Str::title(str_replace('-', ' ', $slug)) . ' Demo'),
            'email' => $email,
            'password' => Hash::make('password123'),
            'country_code' => '+91',
            'mobile' => $mobile,
            'whatsapp' => $mobile,
            'phone' => $mobile,
            'address' => $user['address'] ?? 'Demo Address',
            'city' => $user['city'] ?? 'Mumbai',
            'state' => $user['state'] ?? 'Maharashtra',
            'country' => $user['country'] ?? 'India',
            'zip' => $user['zip'] ?? '400001',
            'company' => $user['company'] ?? null,
            'status' => 1,
            'profession' => $designation,
            'profession_type' => $themeId,
            'profession_data' => null,
            'twitter' => $user['twitter'] ?? null,
            'facebook' => $user['facebook'] ?? null,
            'instagram' => $user['instagram'] ?? null,
            'linkdn' => $user['linkdn'] ?? null,
            'youtube' => $user['youtube'] ?? null,
            'pinterest' => $user['pinterest'] ?? null,
            'profile' => $user['profile'] ?? '1655631454.jpg',
            'banner' => $user['banner'] ?? '1656410629.jpg',
            'title1' => $about,
            'about' => $about,
            'bio' => $user['bio'] ?? ('Brief bio for ' . ($user['name'] ?? 'demo user')),
            'title2' => $user['title2'] ?? 'Vision & Values',
            'title3' => $user['title3'] ?? 'Highlights',
            'title4' => $user['title4'] ?? 'Contact',
            'desig' => $designation,
            'panel_status' => 1,
            'permission' => '1',
            'themeprofile' => 1,
            'animation' => 0,
            'slug' => $slugValue,
            'website' => $user['website'] ?? ('https://example.com/' . $slugValue),
            'account_type' => 'individual',
        ];
    }

    private function upsertCustomer(array $data): int
    {
        $existing = DB::table('customers')->where('email', $data['email'])->first();
        if ($existing) {
            DB::table('customers')->where('id', $existing->id)->update($data);
            return (int) $existing->id;
        }

        return (int) DB::table('customers')->insertGetId($data);
    }

    private function clearCommonData(int $customerId): void
    {
        $this->clearTable('socials', 'user_id', $customerId);
        $this->clearTable('qualifications', 'user_id', $customerId);
        $this->clearTable('professions', 'user_id', $customerId);
        $this->clearTable('thoughts', 'user_id', $customerId);
        $this->clearTable('portfolios', 'user_id', $customerId);
        $this->clearTable('videos', 'user_id', $customerId);
        $this->clearTable('professional_photos', 'user_id', $customerId);
        $this->clearTable('myproducts', 'user_id', $customerId);
    }

    private function seedCommonSections(int $customerId, array $sample, array $userData): void
    {
        $social = $sample['social'] ?? (object)[];
        $this->insertWithDefaults('socials', [
            'user_id' => $customerId,
            'youtube' => $social->youtube ?? null,
            'pinterest' => $social->pinterest ?? null,
            'snapchat' => $social->snapchat ?? null,
            'facebook' => $social->facebook ?? null,
            'instagram' => $social->instagram ?? null,
            'twitter' => $social->twitter ?? null,
            'whatsapp' => $social->whatsapp ?? $userData['mobile'],
            'skype' => $social->skype ?? null,
            'google_review' => $social->map ?? null,
            'linkdin' => $social->linkedin ?? ($social->linkdin ?? null),
            'status' => '1',
        ]);

        $qualifications = $sample['qualifications'] ?? [];
        if (empty($qualifications)) {
            $qualifications = [
                (object)['title' => 'Certification', 'desc' => 'Industry certified professional'],
                (object)['title' => 'Workshop', 'desc' => 'Advanced training program'],
            ];
        }
        foreach ($qualifications as $qualification) {
            $this->insertWithDefaults('qualifications', [
                'user_id' => $customerId,
                'qualifiaction' => $qualification->title ?? 'Qualification',
                'description' => $qualification->desc ?? '',
            ]);
        }

        $professions = $sample['professions'] ?? [];
        if (empty($professions)) {
            $professions = [
                (object)['title' => 'Primary Service', 'desc' => 'Core offering and expertise'],
                (object)['title' => 'Secondary Service', 'desc' => 'Supporting service and consulting'],
            ];
        }
        foreach ($professions as $profession) {
            $this->insertWithDefaults('professions', [
                'user_id' => $customerId,
                'profession' => $profession->title ?? 'Service',
                'designation' => $userData['desig'] ?? null,
                'phone' => $userData['mobile'] ?? null,
                'location' => $userData['address'] ?? null,
                'website' => $userData['website'] ?? null,
                'email' => $userData['email'] ?? null,
                'description' => $profession->desc ?? '',
                'icon' => $profession->icon ?? null,
            ]);
        }

        $thoughts = $sample['thoughts'] ?? [];
        if (empty($thoughts)) {
            $thoughts = [
                (object)['title' => 'Customer First', 'desc' => 'Delivering quality and trust in every engagement.'],
                (object)['title' => 'Innovation', 'desc' => 'Always improving with smarter solutions.'],
            ];
        }
        foreach ($thoughts as $thought) {
            $this->insertWithDefaults('thoughts', [
                'user_id' => $customerId,
                'thought' => $thought->title ?? 'Thought',
                'description' => $thought->desc ?? '',
            ]);
        }

        $portfolios = $sample['portfolios'] ?? [];
        if (empty($portfolios)) {
            $portfolios = [
                (object)['title' => 'Project Alpha', 'desc' => 'Showcase project with measurable results', 'image' => ['69638c8a2a11a_1768131722.jpg', '696a376febabe_1768568687.jpg']],
                (object)['title' => 'Project Beta', 'desc' => 'Case study with client success story', 'image' => ['696a4a0787bb7_1768573447.jpg', '696a4a1ba3473_1768573467.jpg']],
            ];
        }
        foreach ($portfolios as $portfolio) {
            $imageValue = $portfolio->image ?? null;
            if (is_array($imageValue)) {
                $imageValue = json_encode($imageValue);
            } elseif ($imageValue === null) {
                $imageValue = json_encode(['69638c8a2a11a_1768131722.jpg']);
            }
            $this->insertWithDefaults('portfolios', [
                'user_id' => $customerId,
                'title' => $portfolio->title ?? 'Portfolio Item',
                'description' => $portfolio->desc ?? '',
                'image' => $imageValue,
            ]);
        }

        $videos = $sample['videos'] ?? [];
        if (empty($videos)) {
            $videos = [
                (object)['url' => 'https://youtube.com/watch?v=dQw4w9WgXcQ'],
            ];
        }
        foreach ($videos as $video) {
            $this->insertWithDefaults('videos', [
                'user_id' => $customerId,
                'video_link' => $video->url ?? $video->video_link ?? '',
                'status' => '1',
            ]);
        }

        $photos = $sample['professional_photos'] ?? [];
        if (empty($photos)) {
            $photos = [
                (object)['title' => 'Profile Shot', 'desc' => 'Professional portrait', 'image' => 'frontend/user_images/1655631454.jpg'],
                (object)['title' => 'Clinic Interior', 'desc' => 'Reception and waiting area', 'image' => 'frontend/user_images/1656410629.jpg'],
                (object)['title' => 'Consultation Room', 'desc' => 'Well-equipped consultation space', 'image' => 'frontend/user_images/1657175064.png'],
            ];
        }
        foreach ($photos as $photo) {
            $this->insertWithDefaults('professional_photos', [
                'user_id' => $customerId,
                'title' => $photo->title ?? 'Photo',
                'description' => $photo->desc ?? '',
                'image' => $photo->image ?? 'frontend/user_images/1658213749.jpg',
            ]);
        }

        $products = $sample['myproducts'] ?? [];
        if (empty($products)) {
            $products = [
                (object)['title' => 'Starter Package', 'desc' => 'Entry level offering', 'price' => 999, 'image' => '6551c452e155e_1699857490.png'],
                (object)['title' => 'Premium Package', 'desc' => 'All inclusive service', 'price' => 4999, 'image' => '6551cc6522153_1699859557.png'],
            ];
        }
        foreach ($products as $product) {
            $imageValue = $product->image ?? '6551c452e155e_1699857490.png';
            if (is_array($imageValue)) {
                $imageValue = json_encode($imageValue);
            } else {
                $imageValue = json_encode([$imageValue]);
            }
            $this->insertWithDefaults('myproducts', [
                'user_id' => $customerId,
                'title' => $product->title ?? 'Product',
                'images' => $imageValue,
                'price' => $product->price ?? 999,
                'sd' => $product->desc ?? '',
            ]);
        }
    }
    private function seedMedical(int $customerId): void
    {
        if (!Schema::hasTable('medical_profiles')) {
            return;
        }

        $this->clearTable('medical_profiles', 'customer_id', $customerId);
        $this->clearTable('medical_appointments', 'customer_id', $customerId);
        $this->clearTable('medical_payments', 'customer_id', $customerId);
        $this->clearTable('medical_reviews', 'customer_id', $customerId);

        $doctorId = $this->insertWithDefaults('medical_profiles', [
            'customer_id' => $customerId,
            'profile_type' => 'doctor',
            'is_active' => 1,
            'is_default' => 1,
            'display_order' => 1,
            'specialization' => 'Cardiology',
            'degree' => 'MBBS, MD',
            'experience_years' => 12,
            'patients_treated' => 5800,
            'registration_number' => 'MED-2026-001',
            'consultation_fee_inperson' => '800',
            'consultation_fee_video' => '600',
            'clinic_address' => 'Main Road Clinic, Mumbai',
            'clinic_facilities' => json_encode(['ECG', 'Echo', 'Pharmacy', 'Digital X-Ray', 'Emergency Care']),
            'opd_timings' => json_encode(['mon' => '10:00-13:00', 'wed' => '16:00-19:00', 'fri' => '09:00-12:00']),
            'gallery_images' => json_encode([
                'frontend/user_images/1655631454.jpg',
                'frontend/user_images/1656410629.jpg',
                'frontend/user_images/1657175064.png',
                'frontend/user_images/1658213749.jpg',
            ]),
        ]);

        $hospitalId = $this->insertWithDefaults('medical_profiles', [
            'customer_id' => $customerId,
            'profile_type' => 'hospital',
            'is_active' => 1,
            'is_default' => 0,
            'display_order' => 2,
            'hospital_name' => 'City Care Hospital',
            'bed_capacity' => 120,
            'departments' => json_encode(['Cardiology', 'Orthopedics', 'Pediatrics', 'Neurology', 'Radiology']),
            'facilities' => json_encode(['ICU', 'Diagnostics', 'Pharmacy', '24/7 Emergency', 'Ambulance']),
            'ambulance_service' => 1,
            'emergency_contact' => '9876540000',
            'insurance_accepted' => json_encode(['MediAssist', 'Star Health', 'HDFC Ergo']),
        ]);

        $this->insertWithDefaults('medical_profiles', [
            'customer_id' => $customerId,
            'profile_type' => 'daycare',
            'is_active' => 1,
            'is_default' => 0,
            'display_order' => 3,
            'home_services' => json_encode(['Physiotherapy', 'Nursing', 'Lab tests', 'Post-op Care']),
            'service_packages' => json_encode([
                ['name' => 'Post Surgery Care', 'description' => '7 day nursing support', 'price' => 4500],
                ['name' => 'Elder Care', 'description' => 'Daily assistance', 'price' => 3000],
                ['name' => 'Home Diagnostics', 'description' => 'Home sample collection', 'price' => 1200],
            ]),
            'service_areas' => json_encode(['Andheri', 'Bandra', 'Powai', 'Juhu']),
            'equipment_rental' => 1,
        ]);

        if (Schema::hasTable('medical_appointments')) {
            $this->insertWithDefaults('medical_appointments', [
                'customer_id' => $customerId,
                'medical_profile_id' => $doctorId,
                'profile_type' => 'doctor',
                'patient_name' => 'Rohan Mehta',
                'patient_mobile' => '9876501111',
                'patient_email' => 'rohan@example.com',
                'patient_age' => 42,
                'patient_gender' => 'male',
                'service' => 'General Consultation',
                'appointment_date' => Carbon::now()->addDays(1)->toDateString(),
                'appointment_time' => '11:30:00',
                'symptoms' => 'Chest discomfort',
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'consultation_fee' => 800,
            ]);
        }

        if (Schema::hasTable('medical_payments')) {
            $this->insertWithDefaults('medical_payments', [
                'customer_id' => $customerId,
                'appointment_id' => null,
                'patient_name' => 'Rohan Mehta',
                'patient_mobile' => '9876501111',
                'patient_email' => 'rohan@example.com',
                'service_type' => 'Consultation',
                'amount' => 800,
                'discount' => 0,
                'final_amount' => 800,
                'payment_mode' => 'upi',
                'status' => 'completed',
                'paid_at' => Carbon::now()->toDateTimeString(),
                'receipt_number' => 'MED-REC-0001',
            ]);
        }

        if (Schema::hasTable('medical_reviews')) {
            $this->insertWithDefaults('medical_reviews', [
                'customer_id' => $customerId,
                'medical_profile_id' => $hospitalId,
                'profile_type' => 'hospital',
                'reviewer_name' => 'Neha Kapoor',
                'reviewer_email' => 'neha@example.com',
                'reviewer_mobile' => '9876502222',
                'rating' => 5,
                'review_text' => 'Excellent care and professional staff.',
                'visit_date' => Carbon::now()->subDays(10)->toDateString(),
                'status' => 'approved',
                'approved_at' => Carbon::now()->toDateTimeString(),
                'is_featured' => 1,
            ]);
        }
    }

    private function seedCreative(int $customerId): void
    {
        $this->clearTable('creative_packages', 'customer_id', $customerId);
        $this->clearTable('creative_bookings', 'customer_id', $customerId);
        $this->clearTable('creative_portfolio_categories', 'customer_id', $customerId);

        if (Schema::hasTable('creative_packages')) {
            $this->insertWithDefaults('creative_packages', [
                'customer_id' => $customerId,
                'package_name' => 'Wedding Essentials',
                'package_price' => 45000,
                'description' => 'Full day coverage with edited album.',
                'is_active' => 1,
            ]);
        }

        if (Schema::hasTable('creative_bookings')) {
            $this->insertWithDefaults('creative_bookings', [
                'customer_id' => $customerId,
                'client_name' => 'Anita Sharma',
                'client_mobile' => '9876510000',
                'event_type' => 'Wedding',
                'event_date' => Carbon::now()->addDays(20)->toDateString(),
                'status' => 'confirmed',
            ]);
        }

        if (Schema::hasTable('creative_portfolio_categories')) {
            $this->insertWithDefaults('creative_portfolio_categories', [
                'customer_id' => $customerId,
                'title' => 'Highlights',
                'description' => 'Best shots from recent events.',
                'is_active' => 1,
            ]);
        }
    }

    private function seedRealEstate(int $customerId): void
    {
        $this->clearTable('real_estate_profiles', 'customer_id', $customerId);
        $this->clearTable('real_estate_properties', 'customer_id', $customerId);
        $this->clearTable('real_estate_site_visits', 'customer_id', $customerId);

        if (Schema::hasTable('real_estate_profiles')) {
            $this->insertWithDefaults('real_estate_profiles', [
                'customer_id' => $customerId,
                'company_name' => 'Prime Realty',
                'company_address' => 'DLF Phase 2, Gurgaon',
                'rera_number' => 'RERA-HR-2026-001',
                'years_experience' => 10,
                'specializations' => json_encode(['Residential', 'Commercial']),
                'is_active' => 1,
            ]);
        }

        $propertyId = null;
        if (Schema::hasTable('real_estate_properties')) {
            $propertyId = $this->insertWithDefaults('real_estate_properties', [
                'customer_id' => $customerId,
                'title' => '3 BHK Luxury Apartment',
                'slug' => Str::slug('3 BHK Luxury Apartment') . '-' . $customerId,
                'profile_type' => 'residential',
                'property_type' => 'apartment',
                'status' => 'ready',
                'price' => 17500000,
                'location' => 'Gurgaon',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'area_sqft' => 2250,
                'images' => json_encode(['public/frontend/portfolio/69638c8a2a11a_1768131722.jpg']),
            ]);
        }

        if (Schema::hasTable('real_estate_site_visits')) {
            $this->insertWithDefaults('real_estate_site_visits', [
                'customer_id' => $customerId,
                'property_id' => $propertyId,
                'client_name' => 'Rahul Jain',
                'client_mobile' => '9876511111',
                'visit_date' => Carbon::now()->addDays(3)->toDateString(),
                'visit_time' => '10:00',
                'status' => 1,
            ]);
        }
    }

    private function seedEntertainment(int $customerId): void
    {
        $this->clearTable('talent_profiles', 'customer_id', $customerId);
        $this->clearTable('talent_portfolio', 'customer_id', $customerId);
        $this->clearTable('talent_bookings', 'customer_id', $customerId);
        $this->clearTable('talent_social_stats', 'customer_id', $customerId);

        if (Schema::hasTable('talent_profiles')) {
            $this->insertWithDefaults('talent_profiles', [
                'customer_id' => $customerId,
                'category' => 'actor',
                'bio' => 'Versatile performer with experience in commercials and web series.',
                'experience_years' => 6,
                'languages' => json_encode(['Hindi', 'English']),
                'is_active' => 1,
            ]);
        }

        if (Schema::hasTable('talent_portfolio')) {
            $this->insertWithDefaults('talent_portfolio', [
                'customer_id' => $customerId,
                'title' => 'Brand Campaign',
                'description' => 'Lead role in FMCG campaign.',
                'media_type' => 'image',
                'media_url' => 'portfolio/brand-campaign.jpg',
            ]);
        }

        if (Schema::hasTable('talent_bookings')) {
            $this->insertWithDefaults('talent_bookings', [
                'customer_id' => $customerId,
                'client_name' => 'Studio One',
                'project_type' => 'ad_shoot',
                'booking_date' => Carbon::now()->addDays(5)->toDateString(),
                'status' => 'confirmed',
            ]);
        }

        if (Schema::hasTable('talent_social_stats')) {
            $this->insertWithDefaults('talent_social_stats', [
                'customer_id' => $customerId,
                'platform' => 'instagram',
                'handle' => '@talentdemo',
                'followers_count' => 82000,
                'engagement_rate' => 6.8,
            ]);
        }
    }
    private function seedProduction(int $customerId): void
    {
        $this->clearTable('production_services', 'customer_id', $customerId);
        $this->clearTable('production_projects', 'customer_id', $customerId);
        $this->clearTable('production_portfolios', 'customer_id', $customerId);
        $this->clearTable('production_team', 'customer_id', $customerId);
        $this->clearTable('production_payments', 'customer_id', $customerId);

        if (Schema::hasTable('production_services')) {
            $this->insertWithDefaults('production_services', [
                'customer_id' => $customerId,
                'category' => 'Corporate',
                'service_name' => 'Corporate Film',
                'description' => 'End-to-end corporate film production.',
                'pricing_type' => 'project',
                'base_price' => 85000,
                'is_active' => 1,
            ]);
        }

        $projectId = null;
        if (Schema::hasTable('production_projects')) {
            $projectId = $this->insertWithDefaults('production_projects', [
                'customer_id' => $customerId,
                'client_name' => 'Apex Infotech',
                'client_mobile' => '9876512222',
                'service_category' => 'Corporate',
                'project_type' => 'Brand Film',
                'shoot_date' => Carbon::now()->addDays(7)->toDateString(),
                'location' => 'Hyderabad',
                'budget_range' => '80000-120000',
                'project_status' => 'inquiry',
            ]);
        }

        if (Schema::hasTable('production_portfolios')) {
            $this->insertWithDefaults('production_portfolios', [
                'customer_id' => $customerId,
                'category' => 'Corporate',
                'project_title' => 'Tech Launch Film',
                'client_name' => 'Apex Infotech',
                'project_type' => 'Corporate Film',
                'description' => 'Launch film with product shots and interviews.',
                'is_featured' => 1,
            ]);
        }

        if (Schema::hasTable('production_team')) {
            $this->insertWithDefaults('production_team', [
                'customer_id' => $customerId,
                'member_name' => 'Rakesh Kumar',
                'role' => 'Director',
                'bio' => '10+ years in commercial filmmaking.',
                'experience_years' => 10,
                'is_active' => 1,
            ]);
        }

        if (Schema::hasTable('production_payments')) {
            $this->insertWithDefaults('production_payments', [
                'customer_id' => $customerId,
                'project_id' => $projectId,
                'payment_stage' => 'advance',
                'amount' => 25000,
                'payment_mode' => 'bank_transfer',
                'payment_status' => 'paid',
                'paid_on' => Carbon::now()->toDateString(),
            ]);
        }
    }

    private function seedJewellery(int $customerId): void
    {
        $this->clearTable('jewellery_products', 'customer_id', $customerId);
        $this->clearTable('metal_rates', 'customer_id', $customerId);
        $this->clearTable('jewellery_custom_orders', 'customer_id', $customerId);

        if (Schema::hasTable('jewellery_products')) {
            $this->insertWithDefaults('jewellery_products', [
                'customer_id' => $customerId,
                'category' => 'Necklace',
                'product_name' => 'Diamond Necklace',
                'metal_type' => 'Gold',
                'weight_grams' => 28.5,
                'price' => 250000,
                'images' => json_encode(['luxury-01.jpg', 'luxury-02.jpg']),
                'is_available' => 1,
            ]);
        }

        if (Schema::hasTable('metal_rates')) {
            $this->insertWithDefaults('metal_rates', [
                'customer_id' => $customerId,
                'metal_type' => 'Gold',
                'rate_per_gram' => 6200,
                'effective_date' => Carbon::now()->toDateString(),
            ]);
        }

        if (Schema::hasTable('jewellery_custom_orders')) {
            $this->insertWithDefaults('jewellery_custom_orders', [
                'customer_id' => $customerId,
                'client_name' => 'Anjali Mehta',
                'client_mobile' => '9876513333',
                'product_type' => 'Ring',
                'metal_type' => 'Gold',
                'budget_range' => '40000-60000',
                'status' => 'inquiry',
            ]);
        }
    }

    private function seedTechnology(int $customerId): void
    {
        $this->clearTable('tech_services', 'customer_id', $customerId);
        $this->clearTable('tech_projects', 'customer_id', $customerId);
        $this->clearTable('tech_case_studies', 'customer_id', $customerId);

        if (Schema::hasTable('tech_services')) {
            $this->insertWithDefaults('tech_services', [
                'customer_id' => $customerId,
                'category' => 'Web Development',
                'service_name' => 'Custom Web App',
                'description' => 'Full-stack web application development.',
                'pricing_type' => 'project',
                'base_price' => 150000,
                'is_active' => 1,
            ]);
        }

        if (Schema::hasTable('tech_projects')) {
            $this->insertWithDefaults('tech_projects', [
                'customer_id' => $customerId,
                'client_name' => 'TechNova',
                'project_type' => 'SaaS Platform',
                'budget_range' => '200000-350000',
                'status' => 'in_progress',
            ]);
        }

        if (Schema::hasTable('tech_case_studies')) {
            $this->insertWithDefaults('tech_case_studies', [
                'customer_id' => $customerId,
                'title' => 'Retail Analytics Platform',
                'description' => 'Improved conversion by 18% with data-driven insights.',
                'industry' => 'Retail',
                'result_metrics' => json_encode(['18% conversion lift', '35% faster reports']),
                'images' => json_encode(['case-01.jpg']),
            ]);
        }
    }

    private function seedRestaurant(int $customerId, array $sample): void
    {
        $this->clearTable('restaurant_profiles', 'customer_id', $customerId);
        $this->clearTable('restaurant_tables', 'customer_id', $customerId);
        $this->clearTable('hotel_rooms', 'customer_id', $customerId);
        $this->clearTable('menu_categories', 'customer_id', $customerId);
        $this->clearTable('menu_items', 'customer_id', $customerId);
        $this->clearTable('restaurant_info', 'customer_id', $customerId);
        $this->clearTable('event_bookings', 'customer_id', $customerId);
        $this->clearTable('banquet_halls', 'customer_id', $customerId);

        if (Schema::hasTable('restaurant_profiles')) {
            $this->insertWithDefaults('restaurant_profiles', [
                'customer_id' => $customerId,
                'profile_type' => 'restaurant',
                'profile_name' => 'Spice Garden',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('restaurant_tables')) {
            $this->insertWithDefaults('restaurant_tables', [
                'customer_id' => $customerId,
                'table_number' => 'T-101',
                'table_type' => '4-seater',
                'seating_capacity' => 4,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('hotel_rooms')) {
            $this->insertWithDefaults('hotel_rooms', [
                'customer_id' => $customerId,
                'room_number' => 'R-201',
                'room_type' => 'Deluxe',
                'status' => 1,
            ]);
        }

        $menuCategories = $sample['menuCategories'] ?? [];
        if (Schema::hasTable('menu_categories')) {
            $categoryIndex = 0;
            foreach ($menuCategories as $category) {
                $categoryIndex++;
                $categoryImage = sprintf('menu-cat-%02d.png', $categoryIndex);
                $categoryId = $this->insertWithDefaults('menu_categories', [
                    'customer_id' => $customerId,
                    'name' => $category->name ?? 'Category',
                    'description' => $category->description ?? null,
                    'image' => $category->image ?? $categoryImage,
                    'status' => $category->is_active ?? 1,
                    'sort_order' => 0,
                ]);

                if (Schema::hasTable('menu_items') && !empty($category->items)) {
                    $itemIndex = 0;
                    foreach ($category->items as $item) {
                        $itemIndex++;
                        $itemImage = sprintf('menu-item-%02d.png', $itemIndex);
                        $this->insertWithDefaults('menu_items', [
                            'customer_id' => $customerId,
                            'category_id' => $categoryId,
                            'name' => $item->name ?? 'Menu Item',
                            'description' => $item->description ?? null,
                            'image' => $item->image ?? $itemImage,
                            'price' => $item->price ?? 199,
                            'dietary_type' => $item->dietary_type ?? 'veg',
                            'is_bestseller' => $item->is_bestseller ?? 0,
                            'is_available' => $item->is_available ?? 1,
                            'is_chefs_special' => 0,
                            'spice_level' => 0,
                            'status' => 1,
                        ]);
                    }
                }
            }
        }

        if (Schema::hasTable('restaurant_info')) {
            $info = $sample['restaurantInfo'] ?? (object)[];
            $this->insertWithDefaults('restaurant_info', [
                'customer_id' => $customerId,
                'opening_hours' => $info->opening_hours ?? '10:00 AM - 10:00 PM',
                'cuisine_type' => $info->cuisine_type ?? 'Indian, Continental',
                'seating_capacity' => $info->seating_capacity ?? 80,
                'average_cost' => $info->average_cost ?? 900,
                'delivery_available' => $info->delivery_available ?? 1,
                'reservation_available' => $info->reservation_available ?? 1,
            ]);
        }

        if (Schema::hasTable('event_bookings')) {
            $this->insertWithDefaults('event_bookings', [
                'customer_id' => $customerId,
                'client_name' => 'Raj Malhotra',
                'client_mobile' => '9876514444',
                'event_type' => 'Birthday',
                'event_date' => Carbon::now()->addDays(12)->toDateString(),
                'status' => 'pending',
            ]);
        }

        if (Schema::hasTable('banquet_halls')) {
            $this->insertWithDefaults('banquet_halls', [
                'customer_id' => $customerId,
                'hall_name' => 'Grand Hall',
                'capacity_min' => 50,
                'capacity_max' => 200,
                'status' => 1,
            ]);
        }
    }

    private function seedTravel(int $customerId): void
    {
        $this->clearTable('tour_packages', 'customer_id', $customerId);
        $this->clearTable('tour_bookings', 'customer_id', $customerId);

        if (Schema::hasTable('tour_packages')) {
            $this->insertWithDefaults('tour_packages', [
                'customer_id' => $customerId,
                'package_name' => 'Goa Beach Escape',
                'destination' => 'Goa',
                'package_type' => 'Beach',
                'duration_days' => 4,
                'price_per_person' => 22000,
                'best_time_to_visit' => 'Nov - Feb',
                'images' => json_encode(['tour-01.jpg']),
            ]);
        }

        if (Schema::hasTable('tour_bookings')) {
            $this->insertWithDefaults('tour_bookings', [
                'customer_id' => $customerId,
                'client_name' => 'Sonal Verma',
                'client_mobile' => '9876515555',
                'travel_date' => Carbon::now()->addDays(25)->toDateString(),
                'status' => 'confirmed',
            ]);
        }
    }

    private function seedFitness(int $customerId): void
    {
        $this->clearTable('fitness_trainers', 'customer_id', $customerId);
        $this->clearTable('fitness_programs', 'customer_id', $customerId);
        $this->clearTable('fitness_memberships', 'customer_id', $customerId);
        $this->clearTable('member_subscriptions', 'customer_id', $customerId);
        $this->clearTable('fitness_classes', 'customer_id', $customerId);
        $this->clearTable('class_bookings', 'customer_id', $customerId);
        $this->clearTable('member_progress', 'customer_id', $customerId);
        $this->clearTable('transformation_gallery', 'customer_id', $customerId);
        $this->clearTable('diet_plans', 'customer_id', $customerId);

        if (Schema::hasTable('fitness_trainers')) {
            $this->insertWithDefaults('fitness_trainers', [
                'customer_id' => $customerId,
                'trainer_name' => 'Neeraj Singh',
                'specialization' => json_encode(['Strength Training', 'Mobility']),
                'experience_years' => 8,
                'photo' => 'trainer-01.png',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('fitness_programs')) {
            $this->insertWithDefaults('fitness_programs', [
                'customer_id' => $customerId,
                'program_name' => 'Weight Loss Bootcamp',
                'duration_weeks' => 8,
                'price' => 6999,
                'description' => 'HIIT workouts with diet guidance.',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('fitness_memberships')) {
            $this->insertWithDefaults('fitness_memberships', [
                'customer_id' => $customerId,
                'membership_name' => 'Gold Membership',
                'duration_months' => 6,
                'price' => 12000,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('member_subscriptions')) {
            $this->insertWithDefaults('member_subscriptions', [
                'customer_id' => $customerId,
                'member_name' => 'Akshay Patel',
                'membership_type' => 'Gold Membership',
                'start_date' => Carbon::now()->subDays(10)->toDateString(),
                'end_date' => Carbon::now()->addMonths(6)->toDateString(),
                'status' => 'active',
            ]);
        }

        if (Schema::hasTable('fitness_classes')) {
            $this->insertWithDefaults('fitness_classes', [
                'customer_id' => $customerId,
                'class_name' => 'Morning Yoga',
                'schedule_days' => json_encode(['Mon', 'Wed', 'Fri']),
                'start_time' => '07:00',
                'end_time' => '08:00',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('class_bookings')) {
            $this->insertWithDefaults('class_bookings', [
                'customer_id' => $customerId,
                'class_name' => 'Morning Yoga',
                'client_name' => 'Megha Joshi',
                'booking_date' => Carbon::now()->addDays(2)->toDateString(),
                'status' => 'confirmed',
            ]);
        }

        if (Schema::hasTable('member_progress')) {
            $this->insertWithDefaults('member_progress', [
                'customer_id' => $customerId,
                'member_name' => 'Akshay Patel',
                'weight' => 78,
                'body_fat' => 22.5,
                'progress_date' => Carbon::now()->toDateString(),
            ]);
        }

        if (Schema::hasTable('transformation_gallery')) {
            $this->insertWithDefaults('transformation_gallery', [
                'customer_id' => $customerId,
                'member_name' => 'Megha Joshi',
                'before_photo' => 'transform-before-01.png',
                'after_photo' => 'transform-after-01.png',
                'duration_months' => 3,
                'program_type' => 'Weight Loss',
                'weight_lost_kg' => 8,
                'testimonial' => 'Lost 8kg in 10 weeks with guided workouts.',
                'is_featured' => 1,
            ]);
        }

        if (Schema::hasTable('diet_plans')) {
            $this->insertWithDefaults('diet_plans', [
                'customer_id' => $customerId,
                'plan_name' => 'Lean Diet Plan',
                'calories_per_day' => 1800,
                'duration_days' => 30,
                'description' => 'High protein, moderate carbs.',
                'status' => 1,
            ]);
        }
    }
    private function seedEducation(int $customerId, array $sample): void
    {
        $this->clearTable('education_courses', 'customer_id', $customerId);
        $this->clearTable('education_batches', 'customer_id', $customerId);
        $this->clearTable('education_faculty', 'customer_id', $customerId);
        $this->clearTable('admission_applications', 'customer_id', $customerId);
        $this->clearTable('class_attendance', 'customer_id', $customerId);
        $this->clearTable('student_tests', 'customer_id', $customerId);
        $this->clearTable('education_results', 'customer_id', $customerId);
        $this->clearTable('study_materials', 'customer_id', $customerId);
        $this->clearTable('fee_structures', 'customer_id', $customerId);
        $this->clearTable('student_fees', 'customer_id', $customerId);

        if (Schema::hasTable('education_courses')) {
            $this->insertWithDefaults('education_courses', [
                'customer_id' => $customerId,
                'course_name' => $sample['courseTitle'] ?? 'Full Stack Development',
                'duration_months' => 6,
                'fee' => 85000,
                'description' => $sample['courseDesc'] ?? 'Job-ready curriculum with live projects.',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('education_batches')) {
            $this->insertWithDefaults('education_batches', [
                'customer_id' => $customerId,
                'batch_name' => 'Weekday Morning',
                'start_date' => Carbon::now()->addDays(5)->toDateString(),
                'end_date' => Carbon::now()->addMonths(6)->toDateString(),
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('education_faculty')) {
            $this->insertWithDefaults('education_faculty', [
                'customer_id' => $customerId,
                'faculty_name' => 'Anita Rao',
                'designation' => 'Lead Instructor',
                'experience_years' => 9,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('admission_applications')) {
            $this->insertWithDefaults('admission_applications', [
                'customer_id' => $customerId,
                'student_name' => 'Sanjay Kulkarni',
                'student_mobile' => '9876516666',
                'course_name' => 'Full Stack Development',
                'status' => 'pending',
            ]);
        }

        if (Schema::hasTable('class_attendance')) {
            $this->insertWithDefaults('class_attendance', [
                'customer_id' => $customerId,
                'student_name' => 'Sanjay Kulkarni',
                'attendance_date' => Carbon::now()->toDateString(),
                'status' => 'present',
            ]);
        }

        if (Schema::hasTable('student_tests')) {
            $this->insertWithDefaults('student_tests', [
                'customer_id' => $customerId,
                'test_name' => 'Module 1 Assessment',
                'total_marks' => 100,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('education_results')) {
            $this->insertWithDefaults('education_results', [
                'customer_id' => $customerId,
                'student_name' => 'Sanjay Kulkarni',
                'test_name' => 'Module 1 Assessment',
                'marks_obtained' => 86,
                'result' => 'pass',
            ]);
        }

        if (Schema::hasTable('study_materials')) {
            $this->insertWithDefaults('study_materials', [
                'customer_id' => $customerId,
                'title' => 'Module 1 Slides',
                'description' => 'Intro to web development concepts.',
                'file_url' => 'study/module-1.pdf',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('fee_structures')) {
            $this->insertWithDefaults('fee_structures', [
                'customer_id' => $customerId,
                'fee_name' => 'Course Fee',
                'amount' => 85000,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('student_fees')) {
            $this->insertWithDefaults('student_fees', [
                'customer_id' => $customerId,
                'student_name' => 'Sanjay Kulkarni',
                'fee_type' => 'Course Fee',
                'amount_paid' => 25000,
                'payment_date' => Carbon::now()->subDays(2)->toDateString(),
                'status' => 'partial',
            ]);
        }
    }

    private function seedLawyer(int $customerId): void
    {
        $this->clearTable('legal_services', 'customer_id', $customerId);
        $this->clearTable('legal_cases', 'customer_id', $customerId);
        $this->clearTable('case_hearings', 'customer_id', $customerId);
        $this->clearTable('legal_consultations', 'customer_id', $customerId);

        if (Schema::hasTable('legal_services')) {
            $this->insertWithDefaults('legal_services', [
                'customer_id' => $customerId,
                'practice_area' => 'Corporate Compliance',
                'description' => 'Advisory on governance and compliance.',
                'status' => 1,
            ]);
        }

        $caseId = null;
        if (Schema::hasTable('legal_cases')) {
            $caseId = $this->insertWithDefaults('legal_cases', [
                'customer_id' => $customerId,
                'case_title' => 'IP Protection Case',
                'client_name' => 'Kavita Shah',
                'case_type' => 'Intellectual Property',
                'status' => 'open',
            ]);
        }

        if (Schema::hasTable('case_hearings')) {
            $this->insertWithDefaults('case_hearings', [
                'customer_id' => $customerId,
                'case_id' => $caseId,
                'hearing_date' => Carbon::now()->addDays(15)->toDateString(),
                'court_name' => 'Mumbai High Court',
                'status' => 'scheduled',
            ]);
        }

        if (Schema::hasTable('legal_consultations')) {
            $this->insertWithDefaults('legal_consultations', [
                'customer_id' => $customerId,
                'client_name' => 'Kavita Shah',
                'consultation_date' => Carbon::now()->addDays(3)->toDateString(),
                'consultation_mode' => 'online',
                'status' => 'booked',
            ]);
        }
    }

    private function seedAccountant(int $customerId, array $sample): void
    {
        $this->clearTable('ca_services', 'customer_id', $customerId);
        $this->clearTable('ca_client_cases', 'customer_id', $customerId);
        $this->clearTable('ca_consultations', 'customer_id', $customerId);
        $this->clearTable('compliance_deadlines', 'customer_id', $customerId);

        if (Schema::hasTable('ca_services')) {
            $serviceTitle = $sample['services'][0]->title ?? 'Tax Filing';
            $serviceDesc = $sample['services'][0]->desc ?? 'End-to-end filing for individuals and SMEs.';
            $this->insertWithDefaults('ca_services', [
                'customer_id' => $customerId,
                'service_name' => $serviceTitle,
                'description' => $serviceDesc,
                'fee_amount' => 3500,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('ca_client_cases')) {
            $this->insertWithDefaults('ca_client_cases', [
                'customer_id' => $customerId,
                'client_name' => 'Nova Enterprises',
                'case_type' => 'GST Compliance',
                'status' => 'in_progress',
            ]);
        }

        if (Schema::hasTable('ca_consultations')) {
            $this->insertWithDefaults('ca_consultations', [
                'customer_id' => $customerId,
                'client_name' => 'Nova Enterprises',
                'consultation_date' => Carbon::now()->addDays(4)->toDateString(),
                'status' => 'scheduled',
            ]);
        }

        if (Schema::hasTable('compliance_deadlines')) {
            $this->insertWithDefaults('compliance_deadlines', [
                'customer_id' => $customerId,
                'compliance_name' => 'GST Return',
                'due_date' => Carbon::now()->addDays(20)->toDateString(),
                'status' => 'upcoming',
            ]);
        }
    }

    private function seedSalon(int $customerId): void
    {
        $this->clearTable('salon_services', 'customer_id', $customerId);
        $this->clearTable('salon_artists', 'customer_id', $customerId);
        $this->clearTable('salon_appointments', 'customer_id', $customerId);
        $this->clearTable('salon_packages', 'customer_id', $customerId);
        $this->clearTable('salon_portfolio', 'customer_id', $customerId);
        $this->clearTable('salon_products', 'customer_id', $customerId);

        if (Schema::hasTable('salon_services')) {
            $this->insertWithDefaults('salon_services', [
                'customer_id' => $customerId,
                'service_name' => 'Bridal Makeup',
                'service_category' => 'Makeup',
                'price' => 12000,
                'duration_minutes' => 120,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('salon_artists')) {
            $this->insertWithDefaults('salon_artists', [
                'customer_id' => $customerId,
                'artist_name' => 'Ritu Sharma',
                'specialization' => json_encode(['Makeup', 'Hair']),
                'experience_years' => 7,
                'photo' => 'artist-01.png',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('salon_appointments')) {
            $this->insertWithDefaults('salon_appointments', [
                'customer_id' => $customerId,
                'client_name' => 'Pooja Malik',
                'appointment_date' => Carbon::now()->addDays(2)->toDateString(),
                'appointment_time' => '15:00',
                'status' => 'confirmed',
            ]);
        }

        if (Schema::hasTable('salon_packages')) {
            $this->insertWithDefaults('salon_packages', [
                'customer_id' => $customerId,
                'package_name' => 'Glow Package',
                'price' => 8999,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('salon_portfolio')) {
            $this->insertWithDefaults('salon_portfolio', [
                'customer_id' => $customerId,
                'title' => 'Bridal Look',
                'description' => 'Traditional bridal makeover.',
                'before_image' => 'before-01.png',
                'after_image' => 'after-01.png',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('salon_products')) {
            $this->insertWithDefaults('salon_products', [
                'customer_id' => $customerId,
                'product_name' => 'Argan Shampoo',
                'price' => 1200,
                'image' => 'product-01.png',
                'stock' => 25,
                'status' => 1,
            ]);
        }
    }

    private function seedInterior(int $customerId, array $sample): void
    {
        $this->clearTable('interior_services', 'customer_id', $customerId);
        $this->clearTable('interior_projects', 'customer_id', $customerId);
        $this->clearTable('interior_portfolio', 'customer_id', $customerId);
        $this->clearTable('design_consultations', 'customer_id', $customerId);

        if (Schema::hasTable('interior_services')) {
            $serviceTitle = $sample['services'][0]->title ?? 'Residential Design';
            $serviceDesc = $sample['services'][0]->desc ?? 'Full home interior planning and execution.';
            $this->insertWithDefaults('interior_services', [
                'customer_id' => $customerId,
                'service_name' => $serviceTitle,
                'description' => $serviceDesc,
                'base_price' => 350000,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('interior_projects')) {
            $this->insertWithDefaults('interior_projects', [
                'customer_id' => $customerId,
                'project_name' => 'Skyline Apartment',
                'client_name' => 'Arjun Nair',
                'project_value' => 1250000,
                'status' => 'in_progress',
            ]);
        }

        if (Schema::hasTable('interior_portfolio')) {
            $this->insertWithDefaults('interior_portfolio', [
                'customer_id' => $customerId,
                'project_title' => 'Modern Living Room',
                'project_category' => 'Residential',
                'room_type' => 'Living Room',
                'style' => 'Modern Luxury',
                'area_sqft' => 420,
                'before_images' => json_encode(['interior-before-01.jpg']),
                'after_images' => json_encode(['interior-after-01.jpg']),
                'design_render_images' => json_encode(['interior-render-01.jpg']),
                'video_url' => 'https://youtube.com/watch?v=dQw4w9WgXcQ',
                'project_description' => 'Neutral palette with warm lighting and custom millwork.',
                'is_featured' => 1,
            ]);
        }

        if (Schema::hasTable('design_consultations')) {
            $this->insertWithDefaults('design_consultations', [
                'customer_id' => $customerId,
                'client_name' => 'Arjun Nair',
                'consultation_date' => Carbon::now()->addDays(6)->toDateString(),
                'status' => 'scheduled',
            ]);
        }
    }

    private function seedSolar(int $customerId, array $sample): void
    {
        $this->clearTable('solar_solutions', 'customer_id', $customerId);
        $this->clearTable('solar_site_surveys', 'customer_id', $customerId);
        $this->clearTable('subsidy_applications', 'customer_id', $customerId);
        $this->clearTable('solar_projects', 'customer_id', $customerId);
        $this->clearTable('solar_monitoring', 'customer_id', $customerId);
        $this->clearTable('solar_amc', 'customer_id', $customerId);

        if (Schema::hasTable('solar_solutions')) {
            $solutionTitle = $sample['services'][0]->title ?? 'Residential Solar';
            $solutionDesc = $sample['services'][0]->desc ?? 'Rooftop solar for homes and villas.';
            $this->insertWithDefaults('solar_solutions', [
                'customer_id' => $customerId,
                'solution_name' => $solutionTitle,
                'description' => $solutionDesc,
                'capacity_kw' => 5,
                'price' => 240000,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('solar_site_surveys')) {
            $this->insertWithDefaults('solar_site_surveys', [
                'customer_id' => $customerId,
                'client_name' => 'Sunita Reddy',
                'survey_date' => Carbon::now()->addDays(7)->toDateString(),
                'site_address' => 'Banjara Hills, Hyderabad',
                'status' => 'scheduled',
            ]);
        }

        if (Schema::hasTable('subsidy_applications')) {
            $this->insertWithDefaults('subsidy_applications', [
                'customer_id' => $customerId,
                'application_number' => 'SUB-2026-001',
                'status' => 'submitted',
            ]);
        }

        if (Schema::hasTable('solar_projects')) {
            $this->insertWithDefaults('solar_projects', [
                'customer_id' => $customerId,
                'project_name' => 'Green Villa Install',
                'project_capacity_kw' => 5,
                'status' => 'in_progress',
            ]);
        }

        if (Schema::hasTable('solar_monitoring')) {
            $this->insertWithDefaults('solar_monitoring', [
                'customer_id' => $customerId,
                'system_id' => 'SYS-2026-001',
                'current_output_kw' => 3.8,
                'status' => 'active',
            ]);
        }

        if (Schema::hasTable('solar_amc')) {
            $this->insertWithDefaults('solar_amc', [
                'customer_id' => $customerId,
                'contract_name' => 'Annual Maintenance',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addYear()->toDateString(),
                'status' => 'active',
            ]);
        }
    }

    private function seedSecurity(int $customerId, array $sample): void
    {
        $this->clearTable('security_products', 'customer_id', $customerId);
        $this->clearTable('security_site_surveys', 'customer_id', $customerId);
        $this->clearTable('security_projects', 'customer_id', $customerId);
        $this->clearTable('security_amc', 'customer_id', $customerId);

        if (Schema::hasTable('security_products')) {
            $productTitle = $sample['services'][0]->title ?? 'CCTV Installation';
            $productDesc = $sample['services'][0]->desc ?? 'Smart surveillance with mobile monitoring.';
            $this->insertWithDefaults('security_products', [
                'customer_id' => $customerId,
                'product_name' => $productTitle,
                'description' => $productDesc,
                'price' => 28000,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('security_site_surveys')) {
            $this->insertWithDefaults('security_site_surveys', [
                'customer_id' => $customerId,
                'client_name' => 'Rajiv Menon',
                'survey_date' => Carbon::now()->addDays(5)->toDateString(),
                'status' => 'scheduled',
            ]);
        }

        if (Schema::hasTable('security_projects')) {
            $this->insertWithDefaults('security_projects', [
                'customer_id' => $customerId,
                'project_name' => 'Office Surveillance Upgrade',
                'status' => 'in_progress',
            ]);
        }

        if (Schema::hasTable('security_amc')) {
            $this->insertWithDefaults('security_amc', [
                'customer_id' => $customerId,
                'contract_name' => 'CCTV AMC',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addYear()->toDateString(),
                'status' => 'active',
            ]);
        }
    }

    private function seedAstrologer(int $customerId, array $sample): void
    {
        $this->clearTable('astro_services', 'customer_id', $customerId);
        $this->clearTable('astro_consultations', 'customer_id', $customerId);
        $this->clearTable('astro_client_data', 'customer_id', $customerId);

        if (Schema::hasTable('astro_services')) {
            $serviceTitle = $sample['services'][0]->title ?? 'Kundli Analysis';
            $serviceDesc = $sample['services'][0]->desc ?? 'Personalized horoscope and remedies.';
            $this->insertWithDefaults('astro_services', [
                'customer_id' => $customerId,
                'service_name' => $serviceTitle,
                'description' => $serviceDesc,
                'fee_amount' => 1500,
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('astro_consultations')) {
            $this->insertWithDefaults('astro_consultations', [
                'customer_id' => $customerId,
                'client_name' => 'Priya Iyer',
                'consultation_date' => Carbon::now()->addDays(1)->toDateString(),
                'status' => 'scheduled',
            ]);
        }

        if (Schema::hasTable('astro_client_data')) {
            $this->insertWithDefaults('astro_client_data', [
                'customer_id' => $customerId,
                'client_name' => 'Priya Iyer',
                'birth_date' => '1993-05-12',
                'birth_time' => '08:15',
                'birth_place' => 'Pune',
                'status' => 1,
            ]);
        }
    }

    private function seedPolitical(int $customerId, array $sample): void
    {
        $this->clearTable('political_profiles', 'customer_id', $customerId);
        $this->clearTable('public_grievances', 'customer_id', $customerId);
        $this->clearTable('public_services', 'customer_id', $customerId);
        $this->clearTable('development_projects', 'customer_id', $customerId);
        $this->clearTable('public_events', 'customer_id', $customerId);
        $this->clearTable('party_volunteers', 'customer_id', $customerId);

        if (Schema::hasTable('political_profiles')) {
            $profileTitle = $sample['services'][0]->title ?? 'Community Outreach';
            $profileDesc = $sample['services'][0]->desc ?? 'Serving the community through initiatives.';
            $this->insertWithDefaults('political_profiles', [
                'customer_id' => $customerId,
                'designation' => 'Councillor',
                'constituency' => 'Ward 12',
                'manifesto' => $profileDesc,
                'biography' => 'Dedicated to public service with over 10 years of experience in community development and policy making.',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('public_grievances')) {
            $this->insertWithDefaults('public_grievances', [
                'customer_id' => $customerId,
                'citizen_name' => 'Ramesh Naik',
                'issue_title' => 'Road repair',
                'status' => 'open',
            ]);
        }

        if (Schema::hasTable('public_services')) {
            $this->insertWithDefaults('public_services', [
                'customer_id' => $customerId,
                'service_name' => 'Citizen Helpdesk',
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('development_projects')) {
            $this->insertWithDefaults('development_projects', [
                'customer_id' => $customerId,
                'project_name' => 'Drainage Upgrade',
                'budget' => 1200000,
                'status' => 'in_progress',
            ]);
        }

        if (Schema::hasTable('public_events')) {
            $this->insertWithDefaults('public_events', [
                'customer_id' => $customerId,
                'event_title' => 'Health Camp',
                'description' => 'Free general checkup camp for all citizens.',
                'event_date' => Carbon::now()->addDays(8)->toDateString(),
                'status' => 1,
            ]);
        }

        if (Schema::hasTable('party_volunteers')) {
            $this->insertWithDefaults('party_volunteers', [
                'customer_id' => $customerId,
                'volunteer_name' => 'Imran Shaikh',
                'contact_number' => '9876517777',
                'status' => 1,
            ]);
        }
    }

    private function seedInfluencer(int $customerId, array $sample): void
    {
        $this->clearTable('creator_stats', 'customer_id', $customerId);
        $this->clearTable('brand_collaborations', 'customer_id', $customerId);
        $this->clearTable('creator_portfolio', 'customer_id', $customerId);

        if (Schema::hasTable('creator_stats')) {
            $statTitle = $sample['services'][0]->title ?? 'Lifestyle Creator';
            $statDesc = $sample['services'][0]->desc ?? 'Content creator with engaged audience.';
            $this->insertWithDefaults('creator_stats', [
                'customer_id' => $customerId,
                'niche' => $statTitle,
                'platform' => 'Instagram',
                'followers_count' => 125000,
                'engagement_rate' => 7.2,
            ]);
        }

        if (Schema::hasTable('brand_collaborations')) {
            $this->insertWithDefaults('brand_collaborations', [
                'customer_id' => $customerId,
                'brand_name' => 'GlowUp Skincare',
                'campaign_name' => 'Summer Glow',
                'status' => 'completed',
            ]);
        }

        if (Schema::hasTable('creator_portfolio')) {
            $this->insertWithDefaults('creator_portfolio', [
                'customer_id' => $customerId,
                'title' => 'Travel Reel Series',
                'description' => 'Short-form travel content with high engagement.',
                'content_url' => 'https://instagram.com/p/sample',
                'thumbnail' => 'frontend/user_images/1655631454.jpg',
                'status' => 1,
            ]);
        }

        // Ensure About Me section has content
        $this->clearTable('thoughts', 'user_id', $customerId);
        $this->insertWithDefaults('thoughts', [
            'user_id' => $customerId,
            'title' => 'Passionate Creator',
            'thought' => 'Passionate Creator',
            'description' => 'Creating content that inspires and entertains. Specializing in lifestyle, travel, and fashion with a unique perspective.',
        ]);
    }

    private function fallbackSample(string $themeName, string $slug): array
    {
        return [
            'user' => [
                'name' => $themeName . ' Demo',
                'company' => $themeName . ' Studio',
                'email' => $slug . '@example.com',
                'address' => 'Demo Street, India',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'country' => 'India',
                'about' => 'Demo profile for ' . $themeName,
                'desig' => $themeName . ' Specialist',
                'website' => 'https://example.com/' . $slug . '-demo',
                'instagram' => 'https://instagram.com/' . $slug . 'demo',
                'youtube' => 'https://youtube.com/@' . $slug . 'demo',
            ],
            'social' => (object)[
                'facebook' => 'https://facebook.com/' . $slug . 'demo',
                'instagram' => 'https://instagram.com/' . $slug . 'demo',
                'linkedin' => 'https://linkedin.com/in/' . $slug . 'demo',
                'twitter' => 'https://twitter.com/' . $slug . 'demo',
                'whatsapp' => '919876500000',
                'map' => 'https://maps.google.com/?q=' . rawurlencode($themeName . ' Demo'),
            ],
            'services' => [
                (object)[
                    'title' => $themeName . ' Service',
                    'desc' => 'Primary offering for ' . $themeName,
                ],
            ],
        ];
    }

    private function insertWithDefaults(string $table, array $data): int
    {
        if (!Schema::hasTable($table)) {
            return 0;
        }

        $columns = $this->getColumns($table);
        $meta = $this->getColumnMeta($table);
        $payload = [];

        foreach ($data as $column => $value) {
            if (in_array($column, $columns, true)) {
                $payload[$column] = $value;
            }
        }

        foreach ($meta as $column => $info) {
            if (array_key_exists($column, $payload)) {
                continue;
            }

            if (!empty($info['Extra']) && str_contains($info['Extra'], 'auto_increment')) {
                continue;
            }

            if ($info['Null'] === 'NO' && $info['Default'] === null) {
                $payload[$column] = $this->fallbackValue($info, $data);
            }
        }

        if (!array_key_exists('created_at', $payload) && in_array('created_at', $columns, true)) {
            $payload['created_at'] = Carbon::now();
        }
        if (!array_key_exists('updated_at', $payload) && in_array('updated_at', $columns, true)) {
            $payload['updated_at'] = Carbon::now();
        }

        return (int) DB::table($table)->insertGetId($payload);
    }

    private function fallbackValue(array $info, array $data)
    {
        $column = $info['Field'];
        if (Str::endsWith($column, '_id')) {
            return $data[$column] ?? null;
        }

        if (Str::contains($column, ['amount', 'price', 'fee', 'budget'])) {
            return 0;
        }

        if (Str::contains($column, ['status', 'is_active', 'is_default'])) {
            return 1;
        }

        $type = strtolower((string) ($info['Type'] ?? ''));

        if (str_contains($type, 'enum')) {
            $values = trim(substr($type, strpos($type, '(') + 1), ')');
            $first = explode(',', $values)[0] ?? '';
            return trim($first, " '");
        }

        if (str_contains($type, 'tinyint(1)') || str_contains($type, 'bool')) {
            return 0;
        }

        if (str_contains($type, 'int') || str_contains($type, 'decimal') || str_contains($type, 'float') || str_contains($type, 'double')) {
            return 0;
        }

        if (str_contains($type, 'datetime') || str_contains($type, 'timestamp')) {
            return Carbon::now();
        }

        if (str_contains($type, 'date')) {
            return Carbon::now()->toDateString();
        }

        if (str_contains($type, 'time')) {
            return '10:00';
        }

        if (str_contains($type, 'json')) {
            return json_encode([]);
        }

        if (str_contains($type, 'text')) {
            return '';
        }

        return '';
    }

    private function getColumns(string $table): array
    {
        if (array_key_exists($table, $this->columnCache)) {
            return $this->columnCache[$table];
        }

        $columns = DB::select("SHOW COLUMNS FROM {$table}");
        $this->columnCache[$table] = array_map(static fn ($col) => $col->Field, $columns);

        return $this->columnCache[$table];
    }

    private function getColumnMeta(string $table): array
    {
        if (array_key_exists($table, $this->columnMetaCache)) {
            return $this->columnMetaCache[$table];
        }

        $columns = DB::select("SHOW COLUMNS FROM {$table}");
        $this->columnMetaCache[$table] = collect($columns)->mapWithKeys(static function ($col) {
            return [$col->Field => [
                'Field' => $col->Field,
                'Type' => $col->Type,
                'Null' => $col->Null,
                'Key' => $col->Key,
                'Default' => $col->Default,
                'Extra' => $col->Extra,
            ]];
        })->all();

        return $this->columnMetaCache[$table];
    }

    private function clearTable(string $table, string $column, int $customerId): void
    {
        if (!Schema::hasTable($table)) {
            return;
        }

        if (!in_array($column, $this->getColumns($table), true)) {
            return;
        }

        DB::table($table)->where($column, $customerId)->delete();
    }

    private function sanitizePhone(string $value): string
    {
        $digits = preg_replace('/\D+/', '', $value);
        if ($digits === '') {
            return (string) $this->nextMobile();
        }

        if (strlen($digits) > 10) {
            $digits = substr($digits, -10);
        }

        return $digits;
    }

    private function nextMobile(): string
    {
        return (string) $this->mobileSeed++;
    }

    private function ensureFrontendUserImages(): void
    {
        $images = [
            '1655631454.jpg',
            '1656410629.jpg',
            '1657175064.png',
            '1658213749.jpg',
        ];

        $targetDir = base_path('frontend/user_images');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        foreach ($images as $image) {
            $target = $targetDir . DIRECTORY_SEPARATOR . $image;
            if (File::exists($target)) {
                continue;
            }

            $source = base_path('public/frontend/user_images/' . $image);
            if (File::exists($source)) {
                File::copy($source, $target);
            }
        }
    }

    private function ensureJewelleryImages(): void
    {
        $targetDir = base_path('public/uploads/jewellery/products');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $sourceFiles = [
            '69638c8a2a11a_1768131722.jpg',
            '696a376febabe_1768568687.jpg',
        ];

        $targets = [
            'luxury-01.jpg',
            'luxury-02.jpg',
        ];

        foreach ($sourceFiles as $index => $sourceFile) {
            $targetName = $targets[$index] ?? $sourceFile;
            $target = $targetDir . DIRECTORY_SEPARATOR . $targetName;
            if (File::exists($target)) {
                continue;
            }

            $source = base_path('public/frontend/portfolio/' . $sourceFile);
            if (File::exists($source)) {
                File::copy($source, $target);
            }
        }
    }

    private function ensureTechImages(): void
    {
        $targetDir = base_path('public/uploads/tech/case-studies');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $source = base_path('public/frontend/portfolio/69638c8a2a11a_1768131722.jpg');
        $target = $targetDir . DIRECTORY_SEPARATOR . 'case-01.jpg';
        if (!File::exists($target) && File::exists($source)) {
            File::copy($source, $target);
        }
    }

    private function ensureMenuImages(): void
    {
        $publicCategoryDir = base_path('public/uploads/menu/categories');
        $publicItemDir = base_path('public/uploads/menu/items');
        $rootCategoryDir = base_path('uploads/menu/categories');
        $rootItemDir = base_path('uploads/menu/items');

        foreach ([$publicCategoryDir, $rootCategoryDir] as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }
        foreach ([$publicItemDir, $rootItemDir] as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }

        $sourceImages = [
            '6551c452e155e_1699857490.png',
            '6551c452e16ae_1699857490.png',
            '6551c452e1768_1699857490.png',
            '6551c452e181a_1699857490.png',
            '6551cc6522153_1699859557.png',
        ];

        foreach ($sourceImages as $index => $sourceImage) {
            $fileName = sprintf('menu-cat-%02d.png', $index + 1);
            $categoryTargets = [
                $publicCategoryDir . DIRECTORY_SEPARATOR . $fileName,
                $rootCategoryDir . DIRECTORY_SEPARATOR . $fileName,
            ];
            $itemName = sprintf('menu-item-%02d.png', $index + 1);
            $itemTargets = [
                $publicItemDir . DIRECTORY_SEPARATOR . $itemName,
                $rootItemDir . DIRECTORY_SEPARATOR . $itemName,
            ];
            $source = base_path('public/frontend/myproducts/' . $sourceImage);

            if (File::exists($source)) {
                foreach ($categoryTargets as $target) {
                    if (!File::exists($target)) {
                        File::copy($source, $target);
                    }
                }
                foreach ($itemTargets as $target) {
                    if (!File::exists($target)) {
                        File::copy($source, $target);
                    }
                }
            }
        }
    }

    private function ensureTourImages(): void
    {
        $publicDir = base_path('public/uploads/tour/packages');
        $rootDir = base_path('uploads/tour/packages');

        foreach ([$publicDir, $rootDir] as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }

        $source = base_path('public/frontend/portfolio/69638c8a2a11a_1768131722.jpg');
        $targets = [
            $publicDir . DIRECTORY_SEPARATOR . 'tour-01.jpg',
            $rootDir . DIRECTORY_SEPARATOR . 'tour-01.jpg',
        ];

        if (File::exists($source)) {
            foreach ($targets as $target) {
                if (!File::exists($target)) {
                    File::copy($source, $target);
                }
            }
        }
    }

    private function ensureFitnessImages(): void
    {
        $publicTrainerDir = base_path('public/uploads/fitness/trainers');
        $publicTransformDir = base_path('public/uploads/fitness/transformations');
        $rootTrainerDir = base_path('uploads/fitness/trainers');
        $rootTransformDir = base_path('uploads/fitness/transformations');

        foreach ([$publicTrainerDir, $publicTransformDir, $rootTrainerDir, $rootTransformDir] as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }

        $sourceImages = [
            '6551c452e155e_1699857490.png',
            '6551c452e16ae_1699857490.png',
        ];
        $sourcePaths = array_map(static fn ($img) => base_path('public/frontend/myproducts/' . $img), $sourceImages);

        $trainerTargets = [
            $publicTrainerDir . DIRECTORY_SEPARATOR . 'trainer-01.png',
            $rootTrainerDir . DIRECTORY_SEPARATOR . 'trainer-01.png',
        ];
        $beforeTargets = [
            $publicTransformDir . DIRECTORY_SEPARATOR . 'transform-before-01.png',
            $rootTransformDir . DIRECTORY_SEPARATOR . 'transform-before-01.png',
        ];
        $afterTargets = [
            $publicTransformDir . DIRECTORY_SEPARATOR . 'transform-after-01.png',
            $rootTransformDir . DIRECTORY_SEPARATOR . 'transform-after-01.png',
        ];

        $sourceTrainer = $sourcePaths[0] ?? null;
        $sourceAfter = $sourcePaths[1] ?? null;

        if ($sourceTrainer && File::exists($sourceTrainer)) {
            foreach ($trainerTargets as $target) {
                if (!File::exists($target)) {
                    File::copy($sourceTrainer, $target);
                }
            }
        }

        if ($sourceTrainer && File::exists($sourceTrainer)) {
            foreach ($beforeTargets as $target) {
                if (!File::exists($target)) {
                    File::copy($sourceTrainer, $target);
                }
            }
        }

        if ($sourceAfter && File::exists($sourceAfter)) {
            foreach ($afterTargets as $target) {
                if (!File::exists($target)) {
                    File::copy($sourceAfter, $target);
                }
            }
        }
    }

    private function ensureSalonImages(): void
    {
        $publicArtistDir = base_path('public/uploads/salon/artists');
        $publicProductDir = base_path('public/uploads/salon/products');
        $publicPortfolioDir = base_path('public/uploads/salon/portfolio');
        $rootArtistDir = base_path('uploads/salon/artists');
        $rootProductDir = base_path('uploads/salon/products');
        $rootPortfolioDir = base_path('uploads/salon/portfolio');

        foreach ([$publicArtistDir, $publicProductDir, $publicPortfolioDir, $rootArtistDir, $rootProductDir, $rootPortfolioDir] as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }

        $sourceImages = [
            '6551c452e155e_1699857490.png',
            '6551c452e16ae_1699857490.png',
            '6551c452e1768_1699857490.png',
        ];
        $sourcePaths = array_map(static fn ($img) => base_path('public/frontend/myproducts/' . $img), $sourceImages);

        $artistTargets = [
            $publicArtistDir . DIRECTORY_SEPARATOR . 'artist-01.png',
            $rootArtistDir . DIRECTORY_SEPARATOR . 'artist-01.png',
        ];
        $productTargets = [
            $publicProductDir . DIRECTORY_SEPARATOR . 'product-01.png',
            $rootProductDir . DIRECTORY_SEPARATOR . 'product-01.png',
        ];
        $beforeTargets = [
            $publicPortfolioDir . DIRECTORY_SEPARATOR . 'before-01.png',
            $rootPortfolioDir . DIRECTORY_SEPARATOR . 'before-01.png',
        ];
        $afterTargets = [
            $publicPortfolioDir . DIRECTORY_SEPARATOR . 'after-01.png',
            $rootPortfolioDir . DIRECTORY_SEPARATOR . 'after-01.png',
        ];

        $sourceA = $sourcePaths[0] ?? null;
        $sourceB = $sourcePaths[1] ?? null;
        $sourceC = $sourcePaths[2] ?? null;

        if ($sourceA && File::exists($sourceA)) {
            foreach ($artistTargets as $target) {
                if (!File::exists($target)) {
                    File::copy($sourceA, $target);
                }
            }
        }

        if ($sourceB && File::exists($sourceB)) {
            foreach ($productTargets as $target) {
                if (!File::exists($target)) {
                    File::copy($sourceB, $target);
                }
            }
        }

        if ($sourceA && File::exists($sourceA)) {
            foreach ($beforeTargets as $target) {
                if (!File::exists($target)) {
                    File::copy($sourceA, $target);
                }
            }
        }

        if ($sourceC && File::exists($sourceC)) {
            foreach ($afterTargets as $target) {
                if (!File::exists($target)) {
                    File::copy($sourceC, $target);
                }
            }
        }
    }

    private function ensureInteriorImages(): void
    {
        $publicAfterDir = base_path('public/uploads/interior/portfolio/after');
        $publicBeforeDir = base_path('public/uploads/interior/portfolio/before');
        $publicRenderDir = base_path('public/uploads/interior/portfolio/renders');
        $rootAfterDir = base_path('uploads/interior/portfolio/after');
        $rootBeforeDir = base_path('uploads/interior/portfolio/before');
        $rootRenderDir = base_path('uploads/interior/portfolio/renders');

        foreach ([$publicAfterDir, $publicBeforeDir, $publicRenderDir, $rootAfterDir, $rootBeforeDir, $rootRenderDir] as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }

        $sourceImages = [
            base_path('public/frontend/portfolio/69638c8a2a11a_1768131722.jpg'),
            base_path('public/frontend/portfolio/696a376febabe_1768568687.jpg'),
            base_path('public/frontend/portfolio/696a4a0787bb7_1768573447.jpg'),
        ];

        $targets = [
            [$publicBeforeDir . DIRECTORY_SEPARATOR . 'interior-before-01.jpg', $rootBeforeDir . DIRECTORY_SEPARATOR . 'interior-before-01.jpg'],
            [$publicAfterDir . DIRECTORY_SEPARATOR . 'interior-after-01.jpg', $rootAfterDir . DIRECTORY_SEPARATOR . 'interior-after-01.jpg'],
            [$publicRenderDir . DIRECTORY_SEPARATOR . 'interior-render-01.jpg', $rootRenderDir . DIRECTORY_SEPARATOR . 'interior-render-01.jpg'],
        ];

        foreach ($targets as $index => $targetGroup) {
            $source = $sourceImages[$index] ?? null;
            if (!$source || !File::exists($source)) {
                continue;
            }

            foreach ($targetGroup as $target) {
                if (!File::exists($target)) {
                    File::copy($source, $target);
                }
            }
        }
    }
}
