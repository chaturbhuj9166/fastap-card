<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solar_amc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('amc_type', 30)->nullable();
            $table->date('amc_start_date')->nullable();
            $table->date('amc_end_date')->nullable();
            $table->string('visit_frequency', 30)->nullable();
            $table->decimal('amc_amount', 12, 2)->nullable();
            $table->json('services_included')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->json('visit_history')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('project_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solar_amc');
    }
};
