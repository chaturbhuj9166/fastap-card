<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates a test company account: testcompany@example.com / password123
     */
    public function run(): void
    {
        // Check if test company already exists
        $existingCompany = DB::table('companies')->where('email', 'testcompany@example.com')->first();

        if ($existingCompany) {
            $this->command->info('Test company already exists. Skipping...');
            return;
        }

        // Create the test company
        $companyId = DB::table('companies')->insertGetId([
            'name' => 'Test Company Pvt Ltd',
            'slug' => 'test-company',
            'email' => 'testcompany@example.com',
            'password' => Hash::make('password123'),
            'phone' => '9876543210',
            'description' => 'This is a test company account for development and testing purposes.',
            'profession_type' => 11, // IT & Technology theme
            'industry' => 'Information Technology',
            'website' => 'https://testcompany.example.com',
            'address' => '123 Test Street, Tech Park',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'country' => 'India',
            'pincode' => '400001',
            'gst_number' => 'GSTIN1234567890',
            'facebook' => 'https://facebook.com/testcompany',
            'instagram' => 'https://instagram.com/testcompany',
            'twitter' => 'https://twitter.com/testcompany',
            'linkedin' => 'https://linkedin.com/company/testcompany',
            'youtube' => null,
            'card_limit' => 25,
            'cards_used' => 0,
            'status' => 1,
            'subscription_type' => 'basic',
            'subscription_expires' => now()->addYear(),
            'branding_settings' => json_encode([
                'primary_color' => '#7c3aed',
                'secondary_color' => '#a78bfa',
                'font_family' => 'Inter',
                'show_company_logo' => true,
                'show_company_name' => true,
            ]),
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create sample staff members for the test company
        $staffMembers = [
            [
                'company_id' => $companyId,
                'employee_id' => 'EMP001',
                'name' => 'John Doe',
                'email' => 'john.doe@testcompany.example.com',
                'phone' => '9876543211',
                'designation' => 'CEO',
                'department' => 'Management',
                'role' => 'admin',
                'card_enabled' => 1,
                'visibility_settings' => json_encode([
                    'show_email' => true,
                    'show_phone' => true,
                    'show_department' => true,
                    'show_designation' => true,
                ]),
                'sort_order' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => $companyId,
                'employee_id' => 'EMP002',
                'name' => 'Jane Smith',
                'email' => 'jane.smith@testcompany.example.com',
                'phone' => '9876543212',
                'designation' => 'CTO',
                'department' => 'Technology',
                'role' => 'manager',
                'card_enabled' => 1,
                'visibility_settings' => json_encode([
                    'show_email' => true,
                    'show_phone' => true,
                    'show_department' => true,
                    'show_designation' => true,
                ]),
                'sort_order' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => $companyId,
                'employee_id' => 'EMP003',
                'name' => 'Bob Wilson',
                'email' => 'bob.wilson@testcompany.example.com',
                'phone' => '9876543213',
                'designation' => 'Senior Developer',
                'department' => 'Technology',
                'role' => 'staff',
                'card_enabled' => 1,
                'visibility_settings' => json_encode([
                    'show_email' => true,
                    'show_phone' => false,
                    'show_department' => true,
                    'show_designation' => true,
                ]),
                'sort_order' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('company_staff')->insert($staffMembers);

        // Update cards_used count
        DB::table('companies')
            ->where('id', $companyId)
            ->update(['cards_used' => count($staffMembers)]);

        $this->command->info('Test company created successfully!');
        $this->command->info('Email: testcompany@example.com');
        $this->command->info('Password: password123');
        $this->command->info('Staff members: ' . count($staffMembers));
    }
}
