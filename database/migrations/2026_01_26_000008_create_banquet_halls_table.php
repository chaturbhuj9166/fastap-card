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
        Schema::create('banquet_halls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('hall_name', 150);
            $table->integer('capacity_min')->nullable();
            $table->integer('capacity_max')->nullable();
            $table->string('hall_type', 50)->nullable();
            $table->integer('size_sqft')->nullable();
            $table->json('amenities')->nullable();
            $table->json('images')->nullable();
            $table->decimal('price_per_plate', 10, 2)->nullable();
            $table->decimal('price_per_day', 10, 2)->nullable();
            $table->json('availability_calendar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banquet_halls');
    }
};
