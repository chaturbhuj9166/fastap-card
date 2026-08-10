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
        if (Schema::hasTable('medical_profiles')) {
            return;
        }

        Schema::create('medical_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->enum('profile_type', ['doctor', 'hospital', 'daycare'])->default('doctor');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->integer('display_order')->default(0);

            $table->string('specialization')->nullable();
            $table->string('degree')->nullable();
            $table->integer('experience_years')->nullable();
            $table->integer('patients_treated')->nullable();
            $table->string('registration_number')->nullable();

            $table->string('hospital_name')->nullable();
            $table->integer('bed_capacity')->nullable();
            $table->text('departments')->nullable();
            $table->text('facilities')->nullable();
            $table->boolean('ambulance_service')->default(false);
            $table->string('emergency_contact')->nullable();
            $table->text('insurance_accepted')->nullable();

            $table->text('home_services')->nullable();
            $table->text('service_packages')->nullable();
            $table->text('service_areas')->nullable();
            $table->boolean('equipment_rental')->default(false);

            $table->string('consultation_fee_inperson')->nullable();
            $table->string('consultation_fee_video')->nullable();
            $table->text('opd_timings')->nullable();
            $table->text('clinic_address')->nullable();
            $table->text('clinic_facilities')->nullable();
            $table->text('gallery_images')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();

            $table->index(['customer_id', 'profile_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_profiles');
    }
};
