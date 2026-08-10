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
        Schema::create('tech_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('client_name', 150);
            $table->string('client_email', 150)->nullable();
            $table->string('client_mobile', 30)->nullable();
            $table->string('service_category', 50)->nullable();
            $table->json('services_required')->nullable();
            $table->text('project_description')->nullable();
            $table->string('budget_range', 100)->nullable();
            $table->string('timeline', 100)->nullable();
            $table->json('technology_preferences')->nullable();
            $table->string('project_status', 30)->default('inquiry');
            $table->decimal('quoted_amount', 10, 2)->nullable();
            $table->boolean('contract_signed')->default(false);
            $table->json('milestones')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('project_status');
            $table->index('service_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech_projects');
    }
};
