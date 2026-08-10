<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('course_name', 150);
            $table->string('course_category', 100)->nullable();
            $table->string('board_exam', 50)->nullable();
            $table->string('class_standard', 50)->nullable();
            $table->json('subjects')->nullable();
            $table->string('batch_type', 50)->nullable();
            $table->string('mode', 30)->nullable();
            $table->unsignedSmallInteger('duration_months')->nullable();
            $table->string('fee_structure', 100)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('course_category');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_courses');
    }
};
