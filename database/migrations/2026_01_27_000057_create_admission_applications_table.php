<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('student_name', 150);
            $table->string('parent_name', 150)->nullable();
            $table->string('mobile', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('class_standard', 50)->nullable();
            $table->json('documents')->nullable();
            $table->date('entrance_test_date')->nullable();
            $table->string('entrance_test_score', 50)->nullable();
            $table->string('admission_status', 30)->default('applied');
            $table->string('seat_allocated', 50)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('course_id');
            $table->index('admission_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_applications');
    }
};
