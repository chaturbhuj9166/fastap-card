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
        Schema::table('restaurant_info', function (Blueprint $table) {
            $table->string('cuisine_type', 255)->nullable()->after('restaurant_type');
            $table->string('dress_code', 100)->nullable()->after('average_cost');
            $table->tinyInteger('dine_in_available')->default(1)->after('takeaway_available');
            $table->tinyInteger('reservation_available')->default(0)->after('dine_in_available');
            $table->string('delivery_radius', 50)->nullable()->after('reservation_available');
            $table->decimal('minimum_order', 10, 2)->nullable()->after('delivery_radius');
            $table->decimal('delivery_fee', 10, 2)->nullable()->after('minimum_order');
            $table->string('delivery_time', 50)->nullable()->after('delivery_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurant_info', function (Blueprint $table) {
            $table->dropColumn([
                'cuisine_type',
                'dress_code',
                'dine_in_available',
                'reservation_available',
                'delivery_radius',
                'minimum_order',
                'delivery_fee',
                'delivery_time',
            ]);
        });
    }
};
