<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('batch_name', 150);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->unsignedInteger('max_students')->nullable();
            $table->unsignedInteger('enrolled_students')->default(0);
            $table->json('class_schedule')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('course_id');
            $table->index('faculty_id');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_batches');
    }
};
