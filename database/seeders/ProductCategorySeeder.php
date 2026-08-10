<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete existing categories if any (handle FK constraints safely)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        try {
            ProductCategory::truncate();
        } finally {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        $categories = [
            // Main Categories
            [
                'name' => 'NFC Business Cards',
                'slug' => 'nfc-business-cards',
                'parent_id' => null,
                'status' => 1,
            ],
            [
                'name' => 'Digital Products',
                'slug' => 'digital-products',
                'parent_id' => null,
                'status' => 1,
            ],
            [
                'name' => 'Professional Services',
                'slug' => 'professional-services',
                'parent_id' => null,
                'status' => 1,
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'parent_id' => null,
                'status' => 1,
            ],
            [
                'name' => 'Marketing Materials',
                'slug' => 'marketing-materials',
                'parent_id' => null,
                'status' => 1,
            ],
        ];

        // Create main categories first
        foreach ($categories as $category) {
            ProductCategory::create($category);
        }

        // Get parent category IDs
        $nfcCards = ProductCategory::where('slug', 'nfc-business-cards')->first();
        $digitalProducts = ProductCategory::where('slug', 'digital-products')->first();
        $services = ProductCategory::where('slug', 'professional-services')->first();
        $accessories = ProductCategory::where('slug', 'accessories')->first();
        $marketing = ProductCategory::where('slug', 'marketing-materials')->first();

        // Subcategories for NFC Business Cards
        $nfcSubcategories = [
            [
                'name' => 'Google Review Cards',
                'slug' => 'google-review-cards',
                'parent_id' => $nfcCards->id,
                'status' => 1,
            ],
            [
                'name' => 'Standard Business Cards',
                'slug' => 'standard-business-cards',
                'parent_id' => $nfcCards->id,
                'status' => 1,
            ],
            [
                'name' => 'Premium Gold Cards',
                'slug' => 'premium-gold-cards',
                'parent_id' => $nfcCards->id,
                'status' => 1,
            ],
            [
                'name' => 'Custom Design Cards',
                'slug' => 'custom-design-cards',
                'parent_id' => $nfcCards->id,
                'status' => 1,
            ],
        ];

        // Subcategories for Digital Products
        $digitalSubcategories = [
            [
                'name' => 'QR Code Generators',
                'slug' => 'qr-code-generators',
                'parent_id' => $digitalProducts->id,
                'status' => 1,
            ],
            [
                'name' => 'Digital Business Card Templates',
                'slug' => 'digital-card-templates',
                'parent_id' => $digitalProducts->id,
                'status' => 1,
            ],
            [
                'name' => 'Website Packages',
                'slug' => 'website-packages',
                'parent_id' => $digitalProducts->id,
                'status' => 1,
            ],
        ];

        // Subcategories for Professional Services
        $servicesSubcategories = [
            [
                'name' => 'Graphic Design',
                'slug' => 'graphic-design',
                'parent_id' => $services->id,
                'status' => 1,
            ],
            [
                'name' => 'Logo Design',
                'slug' => 'logo-design',
                'parent_id' => $services->id,
                'status' => 1,
            ],
            [
                'name' => 'Social Media Management',
                'slug' => 'social-media-management',
                'parent_id' => $services->id,
                'status' => 1,
            ],
            [
                'name' => 'Content Writing',
                'slug' => 'content-writing',
                'parent_id' => $services->id,
                'status' => 1,
            ],
        ];

        // Subcategories for Accessories
        $accessoriesSubcategories = [
            [
                'name' => 'Card Holders',
                'slug' => 'card-holders',
                'parent_id' => $accessories->id,
                'status' => 1,
            ],
            [
                'name' => 'NFC Stickers',
                'slug' => 'nfc-stickers',
                'parent_id' => $accessories->id,
                'status' => 1,
            ],
            [
                'name' => 'Phone Stands',
                'slug' => 'phone-stands',
                'parent_id' => $accessories->id,
                'status' => 1,
            ],
        ];

        // Subcategories for Marketing Materials
        $marketingSubcategories = [
            [
                'name' => 'Brochures',
                'slug' => 'brochures',
                'parent_id' => $marketing->id,
                'status' => 1,
            ],
            [
                'name' => 'Flyers',
                'slug' => 'flyers',
                'parent_id' => $marketing->id,
                'status' => 1,
            ],
            [
                'name' => 'Banners',
                'slug' => 'banners',
                'parent_id' => $marketing->id,
                'status' => 1,
            ],
        ];

        // Create all subcategories
        foreach (array_merge(
            $nfcSubcategories,
            $digitalSubcategories,
            $servicesSubcategories,
            $accessoriesSubcategories,
            $marketingSubcategories
        ) as $subcategory) {
            ProductCategory::create($subcategory);
        }

        $this->command->info('Product categories seeded successfully!');
        $this->command->info('Created 5 parent categories and 18 subcategories (23 total)');
    }
}
