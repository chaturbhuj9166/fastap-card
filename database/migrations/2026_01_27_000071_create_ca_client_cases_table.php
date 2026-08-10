<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ca_client_cases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('client_name', 150)->nullable();
            $table->string('client_mobile', 30)->nullable();
            $table->string('client_email', 150)->nullable();
            $table->string('pan_number', 20)->nullable();
            $table->string('gstin', 25)->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('financial_year', 20)->nullable();
            $table->string('case_status', 30)->nullable();
            $table->json('documents_uploaded')->nullable();
            $table->json('filed_returns')->nullable();
            $table->date('due_date')->nullable();
            $table->date('filing_date')->nullable();
            $table->text('case_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ca_client_cases');
    }
};
