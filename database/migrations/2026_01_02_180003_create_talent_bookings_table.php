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
        Schema::create('talent_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Talent owner
            $table->enum('talent_type', [
                'actor',
                'model',
                'singer',
                'dancer',
                'youtuber',
                'music_producer',
                'anchor',
                'influencer',
                'custom'
            ]);

            // Client Information
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('client_mobile');
            $table->string('client_company')->nullable();

            // Event/Project Details
            $table->string('event_type')->nullable(); // Movie, Ad, Show, Event, Campaign, etc.
            $table->text('event_description')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_location')->nullable();
            $table->integer('duration_days')->nullable(); // Project duration

            // Booking Details
            $table->decimal('budget', 10, 2)->nullable();
            $table->text('requirements')->nullable(); // Special requirements
            $table->text('notes')->nullable(); // Owner's notes

            // Status Tracking
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'refunded'])->default('pending');

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index(['customer_id', 'talent_type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_bookings');
    }
};
