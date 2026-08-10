<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ca_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('service_category', 50)->nullable();
            $table->string('service_name', 150);
            $table->text('description')->nullable();
            $table->string('pricing_type', 30)->nullable();
            $table->decimal('base_price', 12, 2)->nullable();
            $table->integer('turnaround_time_days')->nullable();
            $table->json('required_documents')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ca_services');
    }
};
