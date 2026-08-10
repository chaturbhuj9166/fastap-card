<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('exam_year', 10)->nullable();
            $table->string('exam_type', 50)->nullable();
            $table->unsignedInteger('total_students')->nullable();
            $table->decimal('pass_percentage', 5, 2)->nullable();
            $table->json('toppers')->nullable();
            $table->json('achievements')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('exam_year');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_results');
    }
};
