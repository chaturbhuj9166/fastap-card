<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->enum('profile_type', ['doctor', 'hospital', 'daycare'])->default('doctor');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->integer('display_order')->default(0);

            // Doctor specific fields
            $table->string('specialization')->nullable();
            $table->string('degree')->nullable();
            $table->integer('experience_years')->nullable();
            $table->integer('patients_treated')->nullable();
            $table->string('registration_number')->nullable(); // Medical council registration

            // Hospital specific fields
            $table->string('hospital_name')->nullable();
            $table->integer('bed_capacity')->nullable();
            $table->text('departments')->nullable(); // JSON array
            $table->text('facilities')->nullable(); // JSON array
            $table->boolean('ambulance_service')->default(false);
            $table->string('emergency_contact')->nullable();
            $table->text('insurance_accepted')->nullable(); // JSON array

            // Day Care specific fields
            $table->text('home_services')->nullable(); // JSON array
            $table->text('service_packages')->nullable(); // JSON array
            $table->text('service_areas')->nullable(); // JSON array
            $table->boolean('equipment_rental')->default(false);

            // Common fields
            $table->string('consultation_fee_inperson')->nullable();
            $table->string('consultation_fee_video')->nullable();
            $table->text('opd_timings')->nullable(); // JSON object
            $table->text('clinic_address')->nullable();
            $table->text('clinic_facilities')->nullable(); // JSON array
            $table->text('gallery_images')->nullable(); // JSON array

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();

            $table->index(['customer_id', 'profile_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_profiles');
    }
}
