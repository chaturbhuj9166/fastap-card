<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->decimal('registration_fee', 10, 2)->nullable();
            $table->decimal('tuition_fee', 10, 2)->nullable();
            $table->unsignedSmallInteger('installment_count')->nullable();
            $table->decimal('late_fee_amount', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('course_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
