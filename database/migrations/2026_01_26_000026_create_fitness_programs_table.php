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
        Schema::create('fitness_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('program_type', 40);
            $table->string('program_name', 150);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->unsignedInteger('duration_weeks')->nullable();
            $table->unsignedInteger('sessions_per_week')->nullable();
            $table->unsignedInteger('session_duration_minutes')->nullable();
            $table->unsignedInteger('max_participants')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->json('features')->nullable();
            $table->json('suitable_for')->nullable();
            $table->json('goals')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('fitness_trainers')->onDelete('set null');
            $table->index('company_id');
            $table->index('program_type');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitness_programs');
    }
};
