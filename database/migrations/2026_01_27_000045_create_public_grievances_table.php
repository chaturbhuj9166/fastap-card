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
        Schema::create('public_grievances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('complainant_name', 150);
            $table->string('complainant_mobile', 30);
            $table->string('complainant_email', 150)->nullable();
            $table->string('issue_category', 100)->nullable();
            $table->text('issue_description');
            $table->string('location', 150)->nullable();
            $table->json('images')->nullable();
            $table->string('priority', 20)->default('medium');
            $table->string('status', 20)->default('submitted');
            $table->string('ticket_number', 50)->unique();
            $table->string('assigned_to', 100)->nullable();
            $table->text('resolution_notes')->nullable();
            $table->date('resolved_date')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('status');
            $table->index('priority');
            $table->index('ticket_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_grievances');
    }
};
