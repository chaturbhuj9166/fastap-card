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
        Schema::create('room_service_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('room_id');
            $table->string('guest_name', 150)->nullable();
            $table->string('service_type', 50)->default('food');
            $table->json('order_details')->nullable();
            $table->string('priority', 20)->default('normal');
            $table->string('status', 20)->default('pending');
            $table->timestamp('requested_time')->nullable();
            $table->timestamp('completed_time')->nullable();
            $table->string('staff_assigned', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('hotel_rooms')->onDelete('cascade');
            $table->index('company_id');
            $table->index(['room_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_service_orders');
    }
};
