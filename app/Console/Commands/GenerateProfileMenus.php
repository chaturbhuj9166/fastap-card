<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\customer;

class GenerateProfileMenus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile-menu:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate profile_menu records for all customers who don\'t have one';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Generating profile menu records for customers...');

        // Get all customer IDs
        $customerIds = customer::pluck('id');

        // Get existing profile_menu UIDs
        $existingMenus = DB::table('profile_menu')->pluck('uid');

        // Find customers without profile_menu
        $customersWithoutMenu = $customerIds->diff($existingMenus);

        $this->info('Found ' . $customersWithoutMenu->count() . ' customers without profile menu.');

        if ($customersWithoutMenu->isEmpty()) {
            $this->info('All customers already have profile menus!');
            return Command::SUCCESS;
        }

        $progressBar = $this->output->createProgressBar($customersWithoutMenu->count());
        $progressBar->start();

        $generated = 0;

        foreach ($customersWithoutMenu as $customerId) {
            DB::table('profile_menu')->insert([
                'uid' => $customerId,
                'profile' => 1,
                'quali' => 1,
                'service' => 1,
                'thought' => 1,
                'personal' => 1,
                'profess' => 1,
                'videos' => 1,
                'product' => 1,
                'social_link' => 1,
                'upload_file' => 1,
                'client' => 1,
                'block' => 0,
                'google_map' => 0,
                'download' => 0,
                'animation' => 0,
                'achievment' => 0,
                'ou_client' => 0,
                'menu_section' => 1,
                'reservation_section' => 1,
                'delivery_section' => 1,
                'property_listings' => 1,
                'showreel' => 1,
                'team_section' => 1,
                'pricing_section' => 1,
                'booking_section' => 1,
            ]);

            $generated++;
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();

        $this->info('Successfully generated ' . $generated . ' profile menu records!');

        return Command::SUCCESS;
    }
}
