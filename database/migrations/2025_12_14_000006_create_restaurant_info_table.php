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
        Schema::create('restaurant_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('restaurant_type', 100)->nullable()->comment('Fine Dining, Cafe, Fast Food, etc.');
            $table->string('cuisine_types', 255)->nullable()->comment('Comma-separated cuisines');
            $table->integer('seating_capacity')->nullable();
            $table->decimal('average_cost', 10, 2)->nullable()->comment('For two people');
            $table->tinyInteger('accepts_reservations')->default(1);
            $table->string('reservation_link', 255)->nullable();
            $table->string('reservation_phone', 20)->nullable();
            $table->tinyInteger('delivery_available')->default(0);
            $table->tinyInteger('takeaway_available')->default(0);
            $table->string('zomato_link', 255)->nullable();
            $table->string('swiggy_link', 255)->nullable();
            $table->string('ubereats_link', 255)->nullable();
            $table->json('operating_hours')->nullable()->comment('Day-wise timings');
            $table->json('special_features')->nullable()->comment('WiFi, Parking, Live Music, etc.');
            $table->json('ambiance_images')->nullable();
            $table->string('payment_methods', 255)->nullable();
            $table->timestamps();

            $table->index('customer_id');
            $table->index('company_id');
            $table->unique('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_info');
    }
};
