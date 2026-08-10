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
        Schema::create('class_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->string('member_name', 150);
            $table->string('member_mobile', 30)->nullable();
            $table->date('booking_date')->nullable();
            $table->string('booking_status', 20)->default('confirmed');
            $table->boolean('is_trial')->default(false);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('fitness_classes')->onDelete('set null');
            $table->index('company_id');
            $table->index('booking_status');
            $table->index('booking_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_bookings');
    }
};
