<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solar_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('client_name', 150)->nullable();
            $table->string('client_mobile', 30)->nullable();
            $table->string('client_email', 150)->nullable();
            $table->string('system_type', 50)->nullable();
            $table->decimal('capacity_kw', 8, 2)->nullable();
            $table->string('location', 150)->nullable();
            $table->decimal('quotation_amount', 12, 2)->nullable();
            $table->decimal('subsidy_amount', 12, 2)->nullable();
            $table->decimal('net_amount', 12, 2)->nullable();
            $table->decimal('advance_paid', 12, 2)->nullable();
            $table->string('project_status', 30)->default('quoted');
            $table->date('installation_start_date')->nullable();
            $table->date('commissioning_date')->nullable();
            $table->date('warranty_end_date')->nullable();
            $table->json('documents')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('project_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solar_projects');
    }
};
