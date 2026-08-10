<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('astro_consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('client_name', 150)->nullable();
            $table->string('client_mobile', 30)->nullable();
            $table->string('consultation_mode', 30)->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('appointment_time', 20)->nullable();
            $table->json('birth_details')->nullable();
            $table->json('property_details')->nullable();
            $table->decimal('consultation_fee', 12, 2)->nullable();
            $table->string('payment_status', 30)->nullable();
            $table->string('status', 30)->nullable();
            $table->string('meeting_link', 255)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('astro_consultations');
    }
};
