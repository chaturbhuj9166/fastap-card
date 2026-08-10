<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed profession themes (13 themes)
        $this->call(ProfessionThemesSeeder::class);

        // Seed test company account
        $this->call(TestCompanySeeder::class);

        // Seed product categories (Phase 4: E-Commerce)
        $this->call(ProductCategorySeeder::class);

        // Seed admin products (Phase 4: E-Commerce)
        $this->call(AdminProductSeeder::class);
    }
}
