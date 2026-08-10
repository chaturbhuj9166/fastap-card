<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profile_menu', function (Blueprint $table) {
            if (!Schema::hasColumn('profile_menu', 'menu_section')) {
                $table->tinyInteger('menu_section')->default(0)->comment('Show restaurant menu');
            }
            if (!Schema::hasColumn('profile_menu', 'reservation_section')) {
                $table->tinyInteger('reservation_section')->default(0);
            }
            if (!Schema::hasColumn('profile_menu', 'delivery_section')) {
                $table->tinyInteger('delivery_section')->default(0);
            }
            if (!Schema::hasColumn('profile_menu', 'property_listings')) {
                $table->tinyInteger('property_listings')->default(0)->comment('Real estate');
            }
            if (!Schema::hasColumn('profile_menu', 'showreel')) {
                $table->tinyInteger('showreel')->default(0)->comment('Actors/Production');
            }
            if (!Schema::hasColumn('profile_menu', 'team_section')) {
                $table->tinyInteger('team_section')->default(0);
            }
            if (!Schema::hasColumn('profile_menu', 'pricing_section')) {
                $table->tinyInteger('pricing_section')->default(0);
            }
            if (!Schema::hasColumn('profile_menu', 'booking_section')) {
                $table->tinyInteger('booking_section')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_menu', function (Blueprint $table) {
            $table->dropColumn([
                'menu_section',
                'reservation_section',
                'delivery_section',
                'property_listings',
                'showreel',
                'team_section',
                'pricing_section',
                'booking_section'
            ]);
        });
    }
};
