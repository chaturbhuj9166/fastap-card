<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->string('student_name', 150);
            $table->date('attendance_date');
            $table->string('status', 20)->default('present');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('batch_id');
            $table->index('attendance_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_attendance');
    }
};
