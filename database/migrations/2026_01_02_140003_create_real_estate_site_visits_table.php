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
        Schema::create('real_estate_site_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('customer_id'); // Property owner
            $table->string('visitor_name');
            $table->string('visitor_mobile');
            $table->string('visitor_email')->nullable();
            $table->date('visit_date');
            $table->time('visit_time');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->text('visitor_message')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('property_id')->references('id')->on('real_estate_properties')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            // Indexes
            $table->index(['customer_id', 'status']);
            $table->index('visit_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_site_visits');
    }
};
