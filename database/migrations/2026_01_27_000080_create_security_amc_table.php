<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('security_amc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('security_amc');
    }
};
