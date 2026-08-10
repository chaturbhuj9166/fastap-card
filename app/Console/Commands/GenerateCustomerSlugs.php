<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\customer;
use Illuminate\Support\Str;

class GenerateCustomerSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate unique slugs for all customers who don\'t have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating slugs for customers...');

        $customers = customer::whereNull('slug')
                            ->orWhere('slug', '')
                            ->get();

        $this->info('Found ' . $customers->count() . ' customers without slugs.');

        $progressBar = $this->output->createProgressBar($customers->count());
        $progressBar->start();

        $generated = 0;

        foreach ($customers as $customer) {
            // Generate slug from name, or use mobile as fallback
            $baseName = $customer->name ?: $customer->mobile;

            if ($baseName) {
                $customer->slug = customer::generateUniqueSlug($baseName, $customer->id);
                $customer->save();
                $generated++;
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();

        $this->info('Successfully generated ' . $generated . ' slugs!');

        return Command::SUCCESS;
    }
}
