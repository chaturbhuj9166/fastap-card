<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('security_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('client_name', 150)->nullable();
            $table->string('client_mobile', 30)->nullable();
            $table->string('client_email', 150)->nullable();
            $table->string('project_type', 50)->nullable();
            $table->string('property_type', 50)->nullable();
            $table->string('location', 150)->nullable();
            $table->json('products')->nullable();
            $table->decimal('installation_charges', 12, 2)->nullable();
            $table->decimal('total_amount', 12, 2)->nullable();
            $table->decimal('advance_paid', 12, 2)->nullable();
            $table->string('project_status', 30)->nullable();
            $table->date('installation_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->string('technician_assigned', 100)->nullable();
            $table->json('documents')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('security_projects');
    }
};
