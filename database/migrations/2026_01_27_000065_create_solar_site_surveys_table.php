<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solar_site_surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('client_name', 150);
            $table->string('client_mobile', 30)->nullable();
            $table->string('client_email', 150)->nullable();
            $table->string('property_type', 50)->nullable();
            $table->string('property_address', 255)->nullable();
            $table->unsignedInteger('roof_area_sqft')->nullable();
            $table->unsignedInteger('monthly_power_consumption_units')->nullable();
            $table->decimal('current_electricity_bill', 12, 2)->nullable();
            $table->string('google_map_location', 255)->nullable();
            $table->json('roof_images')->nullable();
            $table->string('shadow_analysis_file', 255)->nullable();
            $table->date('survey_date')->nullable();
            $table->string('survey_status', 30)->default('requested');
            $table->decimal('recommended_capacity_kw', 8, 2)->nullable();
            $table->decimal('estimated_generation_monthly', 12, 2)->nullable();
            $table->decimal('estimated_savings_yearly', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('survey_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solar_site_surveys');
    }
};
