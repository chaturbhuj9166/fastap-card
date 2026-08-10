<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solar_monitoring', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('client_mobile', 30)->nullable();
            $table->string('monitoring_platform', 255)->nullable();
            $table->decimal('daily_generation_kwh', 12, 2)->nullable();
            $table->decimal('monthly_generation_kwh', 12, 2)->nullable();
            $table->decimal('performance_ratio', 5, 2)->nullable();
            $table->decimal('system_uptime_percentage', 5, 2)->nullable();
            $table->json('alerts')->nullable();
            $table->date('last_updated')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('project_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solar_monitoring');
    }
};
