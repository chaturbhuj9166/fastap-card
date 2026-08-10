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
        Schema::create('tour_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('client_name', 150);
            $table->string('client_mobile', 30)->nullable();
            $table->string('client_email', 150)->nullable();
            $table->date('travel_date')->nullable();
            $table->date('return_date')->nullable();
            $table->unsignedInteger('adults')->default(1);
            $table->unsignedInteger('children')->default(0);
            $table->string('room_preference', 100)->nullable();
            $table->text('special_requirements')->nullable();
            $table->boolean('visa_assistance_needed')->default(false);
            $table->boolean('insurance_needed')->default(false);
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('advance_paid', 10, 2)->nullable();
            $table->string('booking_status', 30)->default('inquiry');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('tour_packages')->onDelete('set null');
            $table->index('company_id');
            $table->index('booking_status');
            $table->index('travel_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_bookings');
    }
};
