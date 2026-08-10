<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('security_site_surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('client_name', 150)->nullable();
            $table->string('client_mobile', 30)->nullable();
            $table->string('client_email', 150)->nullable();
            $table->string('property_type', 50)->nullable();
            $table->string('property_address', 255)->nullable();
            $table->integer('area_sqft')->nullable();
            $table->integer('number_of_cameras_required')->nullable();
            $table->integer('storage_days_required')->nullable();
            $table->date('survey_date')->nullable();
            $table->string('survey_status', 30)->nullable();
            $table->json('site_images')->nullable();
            $table->string('layout_file', 255)->nullable();
            $table->json('recommended_solution')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('security_site_surveys');
    }
};
