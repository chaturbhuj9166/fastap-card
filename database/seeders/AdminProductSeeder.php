<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class AdminProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset products for a clean seed run (handle FK constraints safely)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        try {
            Product::truncate();
        } finally {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        // Get category IDs
        $googleReviewCards = ProductCategory::where('slug', 'google-review-cards')->first();
        $standardCards = ProductCategory::where('slug', 'standard-business-cards')->first();
        $premiumGoldCards = ProductCategory::where('slug', 'premium-gold-cards')->first();
        $customDesignCards = ProductCategory::where('slug', 'custom-design-cards')->first();
        $qrCodeGen = ProductCategory::where('slug', 'qr-code-generators')->first();
        $digitalTemplates = ProductCategory::where('slug', 'digital-card-templates')->first();
        $websitePackages = ProductCategory::where('slug', 'website-packages')->first();
        $graphicDesign = ProductCategory::where('slug', 'graphic-design')->first();
        $logoDesign = ProductCategory::where('slug', 'logo-design')->first();
        $nfcStickers = ProductCategory::where('slug', 'nfc-stickers')->first();
        $cardHolders = ProductCategory::where('slug', 'card-holders')->first();

        $products = [
            // Google Review Cards
            [
                'user_id' => null, // Admin product
                'category_id' => $googleReviewCards->id,
                'name' => 'Google Review NFC Card - Standard',
                'slug' => 'google-review-nfc-card-standard',
                'description' => 'Boost your Google reviews with our NFC-enabled review card. Simply tap the card with any smartphone to instantly redirect customers to your Google review page. No app required!',
                'price' => 499.00,
                'sale_price' => 399.00,
                'stock_quantity' => 500,
                'sku' => 'GRC-STD-001',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 1,
                'source' => 'admin',
            ],
            [
                'user_id' => null,
                'category_id' => $googleReviewCards->id,
                'name' => 'Google Review NFC Card - Premium',
                'slug' => 'google-review-nfc-card-premium',
                'description' => 'Premium Google Review NFC card with custom branding options. Includes QR code backup and premium metallic finish.',
                'price' => 799.00,
                'sale_price' => null,
                'stock_quantity' => 250,
                'sku' => 'GRC-PRE-001',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 1,
                'source' => 'admin',
            ],

            // Standard Business Cards
            [
                'user_id' => null,
                'category_id' => $standardCards->id,
                'name' => 'NFC Business Card - Black Edition',
                'slug' => 'nfc-business-card-black',
                'description' => 'Professional NFC business card with sleek black design. Share your contact information, social media, and portfolio with a single tap.',
                'price' => 999.00,
                'sale_price' => 899.00,
                'stock_quantity' => 1000,
                'sku' => 'NBC-BLK-001',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 1,
                'source' => 'admin',
            ],
            [
                'user_id' => null,
                'category_id' => $standardCards->id,
                'name' => 'NFC Business Card - White Edition',
                'slug' => 'nfc-business-card-white',
                'description' => 'Clean and elegant white NFC business card. Perfect for modern professionals who want to make a lasting impression.',
                'price' => 999.00,
                'sale_price' => null,
                'stock_quantity' => 750,
                'sku' => 'NBC-WHT-001',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 0,
                'source' => 'admin',
            ],

            // Premium Gold Cards
            [
                'user_id' => null,
                'category_id' => $premiumGoldCards->id,
                'name' => 'NFC Business Card - Gold Luxury',
                'slug' => 'nfc-business-card-gold-luxury',
                'description' => 'Luxury gold-finished NFC business card. Stand out from the crowd with this premium metallic card that exudes sophistication.',
                'price' => 1999.00,
                'sale_price' => 1799.00,
                'stock_quantity' => 150,
                'sku' => 'NBC-GLD-001',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 1,
                'source' => 'admin',
            ],
            [
                'user_id' => null,
                'category_id' => $premiumGoldCards->id,
                'name' => 'NFC Business Card - Rose Gold Premium',
                'slug' => 'nfc-business-card-rose-gold',
                'description' => 'Elegant rose gold NFC business card with premium finishing. Perfect for luxury brands and high-end professionals.',
                'price' => 2199.00,
                'sale_price' => null,
                'stock_quantity' => 100,
                'sku' => 'NBC-RG-001',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 0,
                'source' => 'admin',
            ],

            // Custom Design Cards
            [
                'user_id' => null,
                'category_id' => $customDesignCards->id,
                'name' => 'Custom NFC Card Design Service',
                'slug' => 'custom-nfc-card-design',
                'description' => 'Get a fully customized NFC business card designed specifically for your brand. Includes 2 design revisions and premium printing.',
                'price' => 2999.00,
                'sale_price' => null,
                'stock_quantity' => 50,
                'sku' => 'CUST-NFC-001',
                'type' => 'service',
                'status' => 'active',
                'is_featured' => 1,
                'source' => 'admin',
            ],

            // Digital Products - QR Code
            [
                'user_id' => null,
                'category_id' => $qrCodeGen->id,
                'name' => 'Dynamic QR Code Generator - Lifetime',
                'slug' => 'dynamic-qr-code-lifetime',
                'description' => 'Generate unlimited dynamic QR codes with analytics tracking. Update destination URLs anytime without reprinting.',
                'price' => 4999.00,
                'sale_price' => 3999.00,
                'stock_quantity' => 9999,
                'sku' => 'QR-DYN-LT',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 1,
                'source' => 'admin',
            ],

            // Digital Templates
            [
                'user_id' => null,
                'category_id' => $digitalTemplates->id,
                'name' => 'Digital Business Card Template Pack',
                'slug' => 'digital-card-template-pack',
                'description' => 'Bundle of 10 professional digital business card templates. Fully customizable and mobile-responsive.',
                'price' => 1499.00,
                'sale_price' => null,
                'stock_quantity' => 9999,
                'sku' => 'DBC-TMPL-10',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 0,
                'source' => 'admin',
            ],

            // Website Packages
            [
                'user_id' => null,
                'category_id' => $websitePackages->id,
                'name' => 'Personal Portfolio Website',
                'slug' => 'personal-portfolio-website',
                'description' => 'Professional portfolio website with NFC integration. Perfect for freelancers and consultants. Includes hosting for 1 year.',
                'price' => 9999.00,
                'sale_price' => 7999.00,
                'stock_quantity' => 25,
                'sku' => 'WEB-PORT-001',
                'type' => 'service',
                'status' => 'active',
                'is_featured' => 1,
                'source' => 'admin',
            ],

            // Professional Services - Graphic Design
            [
                'user_id' => null,
                'category_id' => $graphicDesign->id,
                'name' => 'Business Card Design Service',
                'slug' => 'business-card-design-service',
                'description' => 'Professional business card design with 3 concepts and unlimited revisions. Print-ready files delivered in all formats.',
                'price' => 1999.00,
                'sale_price' => null,
                'stock_quantity' => 100,
                'sku' => 'GD-BC-001',
                'type' => 'service',
                'status' => 'active',
                'is_featured' => 0,
                'source' => 'admin',
            ],

            // Logo Design
            [
                'user_id' => null,
                'category_id' => $logoDesign->id,
                'name' => 'Professional Logo Design Package',
                'slug' => 'professional-logo-design',
                'description' => 'Complete logo design package with 5 initial concepts, 3 revisions, and all source files. Includes brand guidelines.',
                'price' => 4999.00,
                'sale_price' => 3999.00,
                'stock_quantity' => 50,
                'sku' => 'LOGO-PRO-001',
                'type' => 'service',
                'status' => 'active',
                'is_featured' => 1,
                'source' => 'admin',
            ],

            // Accessories - NFC Stickers
            [
                'user_id' => null,
                'category_id' => $nfcStickers->id,
                'name' => 'NFC Stickers - Pack of 10',
                'slug' => 'nfc-stickers-pack-10',
                'description' => 'Programmable NFC stickers compatible with all smartphones. Perfect for marketing campaigns, product labeling, and contactless sharing.',
                'price' => 799.00,
                'sale_price' => 699.00,
                'stock_quantity' => 500,
                'sku' => 'NFC-STICK-10',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 0,
                'source' => 'admin',
            ],

            // Card Holders
            [
                'user_id' => null,
                'category_id' => $cardHolders->id,
                'name' => 'Premium Leather Card Holder',
                'slug' => 'premium-leather-card-holder',
                'description' => 'Genuine leather card holder designed specifically for NFC business cards. Holds up to 5 cards with RFID protection.',
                'price' => 1299.00,
                'sale_price' => null,
                'stock_quantity' => 200,
                'sku' => 'ACC-CH-LEATH',
                'type' => 'product',
                'status' => 'active',
                'is_featured' => 0,
                'source' => 'admin',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Admin products seeded successfully!');
        $this->command->info('Created 15 sample Fastap official store products');
    }
}
