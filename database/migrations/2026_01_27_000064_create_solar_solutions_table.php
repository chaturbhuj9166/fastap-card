<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solar_solutions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('solution_type', 50)->nullable();
            $table->decimal('system_capacity_kw', 8, 2)->nullable();
            $table->string('solution_name', 150);
            $table->text('description')->nullable();
            $table->json('components')->nullable();
            $table->decimal('price_per_kw', 12, 2)->nullable();
            $table->decimal('total_price', 12, 2)->nullable();
            $table->json('features')->nullable();
            $table->unsignedSmallInteger('warranty_years')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('solution_type');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solar_solutions');
    }
};
