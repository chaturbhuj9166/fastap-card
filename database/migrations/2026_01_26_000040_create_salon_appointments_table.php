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
        Schema::create('salon_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('client_name', 150);
            $table->string('client_mobile', 30)->nullable();
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->json('services')->nullable();
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->string('location', 20)->nullable();
            $table->text('home_address')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('advance_paid', 10, 2)->nullable();
            $table->string('status', 20)->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('artist_id')->references('id')->on('salon_artists')->onDelete('set null');
            $table->index('company_id');
            $table->index('status');
            $table->index('appointment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salon_appointments');
    }
};
