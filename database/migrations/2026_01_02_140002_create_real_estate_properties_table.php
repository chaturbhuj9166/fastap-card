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
        Schema::create('real_estate_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->enum('profile_type', ['residential', 'commercial', 'plot', 'rental', 'builder'])->default('residential');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('property_type', ['flat', 'villa', 'house', 'shop', 'office', 'showroom', 'plot', 'land', 'warehouse', 'apartment'])->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('rental_price', 10, 2)->nullable(); // Monthly rent for rental properties
            $table->decimal('deposit_amount', 10, 2)->nullable(); // Security deposit for rentals
            $table->decimal('area_sqft', 10, 2)->nullable();
            $table->string('location');
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('parking')->nullable();
            $table->enum('status', ['ready', 'under_construction', 'upcoming'])->default('ready');
            $table->string('rera_number')->nullable();
            $table->json('images')->nullable(); // Array of image URLs
            $table->json('features')->nullable(); // Array of features like ["Swimming Pool", "Gym", "Garden"]
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->enum('furnishing', ['furnished', 'semi_furnished', 'unfurnished'])->nullable();
            $table->date('available_from')->nullable(); // For rentals
            $table->integer('lease_duration')->nullable(); // In months
            $table->decimal('maintenance_charges', 10, 2)->nullable();
            $table->integer('floor_number')->nullable();
            $table->integer('total_floors')->nullable();
            $table->year('year_built')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            // Indexes
            $table->index(['customer_id', 'profile_type', 'is_active']);
            $table->index('slug');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_properties');
    }
};
