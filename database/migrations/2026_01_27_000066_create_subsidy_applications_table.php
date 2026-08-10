<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subsidy_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('client_name', 150)->nullable();
            $table->string('scheme_name', 100)->nullable();
            $table->decimal('system_capacity_kw', 8, 2)->nullable();
            $table->decimal('subsidy_amount', 12, 2)->nullable();
            $table->date('application_date')->nullable();
            $table->string('application_number', 100)->nullable();
            $table->string('status', 30)->default('applied');
            $table->json('documents')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('project_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subsidy_applications');
    }
};
