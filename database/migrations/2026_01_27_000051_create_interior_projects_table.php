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
        Schema::create('interior_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('client_name', 150)->nullable();
            $table->string('client_mobile', 30)->nullable();
            $table->string('client_email', 150)->nullable();
            $table->string('project_type', 50)->nullable();
            $table->string('property_type', 50)->nullable();
            $table->unsignedInteger('area_sqft')->nullable();
            $table->string('location', 150)->nullable();
            $table->string('budget_range', 100)->nullable();
            $table->json('requirements')->nullable();
            $table->date('consultation_date')->nullable();
            $table->date('site_visit_date')->nullable();
            $table->date('design_approval_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expected_completion_date')->nullable();
            $table->string('project_status', 30)->default('inquiry');
            $table->decimal('quoted_amount', 12, 2)->nullable();
            $table->decimal('advance_paid', 12, 2)->nullable();
            $table->json('design_files')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('project_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interior_projects');
    }
};
