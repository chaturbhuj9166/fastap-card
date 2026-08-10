<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tech_case_studies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('title', 150);
            $table->string('client_name', 150)->nullable();
            $table->string('industry', 100)->nullable();
            $table->text('summary')->nullable();
            $table->text('results')->nullable();
            $table->json('technology_stack')->nullable();
            $table->json('metrics')->nullable();
            $table->json('images')->nullable();
            $table->string('project_url', 255)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('industry');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech_case_studies');
    }
};
