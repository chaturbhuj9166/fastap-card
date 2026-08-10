<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Doctor/Hospital
            $table->unsignedBigInteger('medical_profile_id')->nullable();
            $table->enum('profile_type', ['doctor', 'hospital', 'daycare'])->default('doctor');

            // Patient details
            $table->string('patient_name');
            $table->string('patient_mobile', 15);
            $table->string('patient_email')->nullable();
            $table->integer('patient_age')->nullable();
            $table->enum('patient_gender', ['male', 'female', 'other'])->nullable();

            // Appointment details
            $table->string('service')->nullable(); // e.g., Consultation, Check-up, etc.
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->text('symptoms')->nullable();
            $table->text('notes')->nullable();

            // Status tracking
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled', 'rescheduled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid', 'partial'])->default('unpaid');
            $table->decimal('consultation_fee', 10, 2)->nullable();
            $table->string('payment_transaction_id')->nullable();

            // Reminders & notifications
            $table->boolean('reminder_sent')->default(false);
            $table->timestamp('reminder_sent_at')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('medical_profile_id')->references('id')->on('medical_profiles')->onDelete('set null');
            $table->timestamps();

            $table->index(['customer_id', 'appointment_date']);
            $table->index(['patient_mobile']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_appointments');
    }
}
