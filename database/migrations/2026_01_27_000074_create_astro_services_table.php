<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('astro_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('service_category', 50)->nullable();
            $table->string('service_name', 150);
            $table->text('description')->nullable();
            $table->integer('consultation_duration_minutes')->nullable();
            $table->decimal('consultation_fee', 12, 2)->nullable();
            $table->boolean('is_online_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('astro_services');
    }
};
